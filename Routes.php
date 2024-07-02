<?php

return (function(){
    $intGT0 = '[1-9]+\d*';
    //$text = '[0-9aA-zZ_-]+';

    return [
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
            'controller' => 'Contacts/Contacts'
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
            'regex' => '/^command\/?$/',
            'controller' => 'Command/Command'
        ],
        [
            'regex' => '/^censoreFilter\/?$/',
            'controller' => 'Censorship/Censorship'
        ],
        [
            //message/n/editCensor
            'regex' => "/^message\/($intGT0)\/editCensor\/?$/",
            'controller' => 'message/EditMessage',
            'params' => ['mid' => 1]
        ],
        [
            //message/n/delete
            'regex' => "/^message\/($intGT0)\/delete\/?$/",
            'controller' => 'message/DeleteMessage',
            'params' => ['mid' => 1]
        ],
        [
            //censoreFilter/n
            'regex' => "/^censoreFilter\/($intGT0)\/?$/",
            'controller' => 'Censorship/Censorship',
            'params' => ['mid' => 1]
        ]
    ];
})();