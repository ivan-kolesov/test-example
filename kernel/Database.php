<?php

namespace Kernel;

class Database
{
    protected static $instance;

    private function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * @return \PDO
     */
    public static function create()
    {
        if (is_null(self::$instance)) {
            $dsn = Config::get('database.dsn');
            $username = Config::get('database.username');
            $password = Config::get('database.password');
            self::$instance = new \PDO($dsn, $username, $password);
        }

        return self::$instance;
    }
}