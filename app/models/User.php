<?php

namespace Models;

use Kernel\Models\ModelBase;
use Kernel\UploadedFile;
use Services\UserService;

class User extends ModelBase
{
    protected $attributes = [
        'id',
        'user_id',
        'name',
        'last_name',
        'middle_name',
        'email',
        'password',
        'birth_year',
        'location',
        'marital_status',
        'education',
        'experience',
        'phone',
        'additional',
        'filename',
    ];

    protected $validatorRules = [
        'name' => 'required',
        'last_name' => 'required',
        'email' => 'email|required',
        'password' => 'required|confirmed:password_confirmed',
        'file' => 'mimes:jpeg,gif,png',
    ];

    protected $tableName = "user";

    public $user_id;
    public $name;
    public $last_name;
    public $middle_name;
    public $email;
    public $password;
    public $password_confirmed;
    public $birth_year;
    public $location;
    public $marital_status;
    public $education;
    public $experience;
    public $phone;
    public $additional;
    public $filename;
    /**
     * @var UploadedFile|null
     */
    public $file;

    public function onBeforeInsert()
    {
        parent::onBeforeInsert();

        $this->castValues();

        $this->user_id = md5(rand(0, 1e6) . microtime(true));
        $this->password = UserService::makePassword($this->password);
    }

    public function onBeforeUpdate()
    {
        parent::onBeforeUpdate();

        $this->castValues();
    }

    private function castValues()
    {
        $this->birth_year = !empty($this->birth_year) ? intval($this->birth_year) : null;
        $this->data['birth_year'] = $this->birth_year;

        $this->name = mb_substr(trim($this->name), 0, 255);
        $this->last_name = mb_substr(trim($this->last_name), 0, 255);
        $this->middle_name = mb_substr(trim($this->middle_name), 0, 255);
        $this->email = mb_substr(trim($this->email), 0, 255);
        $this->location = mb_substr(trim($this->location), 0, 255);
        $this->marital_status = mb_substr(trim($this->marital_status), 0, 255);
        $this->education = mb_substr(trim($this->education), 0, 255);
        $this->experience = trim($this->experience);
        $this->phone = mb_substr(trim($this->phone), 0, 15);
        $this->additional = trim($this->additional);
    }
}