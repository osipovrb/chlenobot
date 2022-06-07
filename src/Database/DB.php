<?php

namespace App\Database;

use Medoo\Medoo;

class DB
{
    /** @var null|DB */
    private static $db = null;

    /** @var Medoo */
    public $medoo;

    public function __construct()
    {
        //singleton, so
    }

    public function __clone()
    {
        //singleton, so
    }

    public function __wakeup()
    {
        //singleton, so
    }

    public static function getInstance(): self
    {
        if (static::$db === null) {
            static::$db = new static();
        }

        return static::$db;
    }

    public function initialize()
    {
        $this->medoo = new Medoo([
            'type' => 'mysql',
            'host' => $_ENV['MYSQL_HOST'],
            'username' => $_ENV['MYSQL_USERNAME'],
            'password' => $_ENV['MYSQL_PASSWORD'],
            'database' => $_ENV['MYSQL_DATABASE'],
        ]);
    }
}