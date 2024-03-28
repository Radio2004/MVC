<?php

use Core\System;
class Routes
{
    const CONTROLLERS = [
        [
            'regex' => '/^$/',
            'controller' => 'Messages/MessageIndex'
        ],
        [
            'regex' => '/^messages\/?$/',
            'controller' => 'Messages/MessageIndex'
        ],
        [
            'regex' => '/^messages\/add\/?$/',
            'controller' => 'Messages/AddMessage'
        ],
        [
            'regex' => '/^contacts\/?$/',
            'controller' => 'Contacts/Contact'
        ],
        [
            'regex' => '/^register\/?$/',
            'controller' => 'Register/Register'
        ],
        [
            'regex' => '/^login\/?$/',
            'controller' => 'Login/Login'
        ],
        [
            //message/n/edit
            'regex' => "/^message\/([1-9]+\d*)\/edit\/?$/",
            'controller' => 'message/EditMessage',
            'params' => ['mid' => 1]
        ],
        [
            //message/n/delete
            'regex' => "/^message\/([1-9]+\d*)\/delete\/?$/",
            'controller' => 'message/DeleteMessage',
            'params' => ['mid' => 1]
        ]
    ];
    private string $controller = 'Error/Error404';
    private static array $instances = [];
    private function __construct() { }
    private function __clone() { }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception("Cannot serialize a singleton.");
    }

    public static function getInstance(): Routes
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }

    public function getController(string $url): array
    {
        return System::parseUrl($url, static::CONTROLLERS);
    }
}