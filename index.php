<?php

session_start();
use Core\System;


include_once ('init.php');


$left = '';
/**
 * @var string $title
 * @var string $content
 */


$xml = simplexml_load_file('routes.xml');


$cname = '';
$badUrl = BASE_URL . 'index.php';
$params = [];

if (strpos($_SERVER['REQUEST_URI'], $badUrl) === 0) {
    $cname = 'errors/Error';
} else {
    // $routes = include ('routes.php');
    $xmlRoutes = $xml->xpath("route[@disabled='false']");
    $url = $_GET['mvcsystemurl'] ?? '';

    $routerRes = System::parseUrl($url, $xmlRoutes);
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
echo $controller->render($params);
