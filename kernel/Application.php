<?php

namespace Kernel;

class Application
{
    protected static $instance;

    protected $resolved = [];

    protected function __construct()
    {
        $this->resolved['request'] = new Request($_GET, $_POST);
        $this->resolved['database'] = Database::create();
        $this->resolved['router'] = new Router();
    }

    /**
     * @return Application
     */
    public static function create()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @return Application
     */
    public function run()
    {
        session_start();

        require APP_DIR . 'routes.php';

        $response = $this->getRouter()->dispatch($this->getRequest());
        $response->send();

        return $this;
    }

    /**
     * @return \Kernel\Request
     */
    public static function getRequest()
    {
        return self::create()->resolved['request'];
    }

    /**
     * @return \PDO
     */
    public static function getDatabase()
    {
        return self::create()->resolved['database'];
    }

    /**
     * @return \Kernel\Router
     */
    public static function getRouter()
    {
        return self::create()->resolved['router'];
    }
}