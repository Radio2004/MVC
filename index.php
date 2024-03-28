<?php

session_start();
use Core\System;


include_once('init.php');
include_once('autoload.php');
include_once('vendor/autoload.php');

$left = '';
/**
 * @var string $title
 * @var string $content
 */

$cname = '';
$badUrl = BASE_URL . 'index.php';

if (strpos($_SERVER['REQUEST_URI'], $badUrl) === 0) {
    $cname = 'Errors/Error404';
} else {
    $routes = Routes::getInstance();

    $url = $_GET['mvcsystemurl'] ?? '';

    $routerRes = $routes->getController($url);
    $cname = $routerRes['controller'];
    $params = $routerRes['params'] ?? [];

    $urlLen = strlen($url);

    if ($urlLen > 0 && $url[$urlLen - 1] == '/') {
        $url = substr($url, 0, $urlLen - 1);
    }
}

$path = "Controller\\$cname";
$path = str_replace("/", '\\', $path);
$controller = new $path();
echo $controller->render();

