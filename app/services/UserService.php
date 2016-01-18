<?php

namespace Services;

use Kernel\Application;
use Kernel\Config;
use Models\User;

class UserService
{
    private static $userSessionName = 'user';
    private static $tableName = 'user';

    const ERROR_USER_NOT_FOUND = 'user.not_found';

    /**
     * @return User|null
     */
    public static function getCurrentUser()
    {
        if (isset($_SESSION[self::$userSessionName])) {
            return self::getUserById($_SESSION[self::$userSessionName]);
        }
    }

    /**
     * @param string $userId
     * @return User|null
     */
    public static function getUserById($userId)
    {
        $database = Application::getDatabase();

        $sth = $database->prepare("SELECT * FROM " . self::$tableName . " WHERE user_id = ? LIMIT 1");
        $sth->execute([$userId]);

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        if (false !== $result) {
            return new User($result);
        }
    }

    /**
     * @param $email
     * @param $password
     * @return User|null
     */
    public static function getUserByEmailAndPassword($email, $password)
    {
        $database = Application::getDatabase();

        $sth = $database->prepare("SELECT * FROM " . self::$tableName . " WHERE email = ? AND password = ? LIMIT 1");
        $sth->execute([$email, self::makePassword($password)]);

        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        if (false !== $result) {
            return new User($result);
        }
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public static function authorize($email, $password)
    {
        $user = self::getUserByEmailAndPassword($email, $password);

        if ($user instanceof User) {
            self::setCurrentUser($user);

            return true;
        }

        return false;
    }

    /**
     * @param User $user
     */
    public static function setCurrentUser(User $user)
    {
        $_SESSION[self::$userSessionName] = $user->user_id;
    }

    public static function logout()
    {
        unset($_SESSION[self::$userSessionName]);
    }

    public static function setFile($filename)
    {
    }

    /**
     * @param string $password
     * @return string
     */
    public static function makePassword($password)
    {
        $salt = 'xGdwLgjIhZmc6awWJ2OvPFMXBpK';
        return md5(strval($password) . md5($salt));
    }

    /**
     * @param User $user
     * @return bool
     */
    private static function makeUserStorageDirectory(User $user)
    {
        $directory = self::produceFullUserCategoryDir($user);
        if (!empty($directory)) {
            if (!file_exists($directory)) {
                return mkdir($directory, 0755);
            }
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @return null|string
     */
    private static function produceFullUserCategoryDir(User $user)
    {
        $directory = Config::get('app.userUploadDir');
        return !empty($directory) ? $directory . self::produceUserCategoryDir() : null;
    }

    /**
     * @param User $user
     * @return null|string
     */
    public static function produceUserCategoryDir(User $user)
    {
        return md5($user->user_id) . '/';
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function saveUploadedFile(User $user)
    {
        if ($user->file->isValid()) {
            $directoryExists = UserService::makeUserStorageDirectory($user);
            if ($directoryExists) {
                $destination = UserService::produceFullUserCategoryDir($user);

                return $user->file->move($destination . $user->file->getClientOriginalName());
            }
        }

        return false;
    }
}