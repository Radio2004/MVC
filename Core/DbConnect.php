<?php

namespace Core;

class DbConnect
{

    private const DB_HOST = 'localhost';
    private const DB_DATABASE_NAME = 'mvc';
    private const DB_USER = 'root';
    private const DB_PASS = 'root';
    private static $connect;

    static function init() {
        self::$connect = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_DATABASE_NAME) or die('Mysql connection error: ' . mysqli_error());
    }

    static function getConnect()
    {
        if (self::$connect === null) {
            self::init();
        }

        return static::$connect;
    }
}