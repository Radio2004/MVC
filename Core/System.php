<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 28.12.2020
 * @website: https://profstep.com
 **/


/**
 * @param string $url
 * @param array $routes
 * @return array
 */

namespace Core;

class System
{
    public $connect;

    public function __construct()
    {
        $this->connect = DbConnect::getConnect();
    }

   public static function parseUrl(string $url, array $routes) : array{
        $result = [
            'controller' => 'Errors/Error404',
            'params' => []
        ];

        foreach($routes as $route){
            $matches = [];

            $regex = (string)$route->regex;

            $controller = (string)$route->controller;


            if(preg_match($regex, $url, $matches)){
                $result['controller'] = $controller;

                $params = (array)$route->params;

                if(count($params) > 0){
                    foreach($params as $name => $num){
                        $result['params'][$name] = $matches[$num];
                    }
                }

                break;
            }
        }

        return $result;
    }

   public static function validateInput(string $word) : string|bool {
       /** @var string $word */
        $word = htmlspecialchars($word, ENT_QUOTES);
        $word = filter_var($word, FILTER_SANITIZE_SPECIAL_CHARS);
        
        if ($word === false){
            return false;
        }

        if (preg_match('/\s+/', $word)) {
            return false;
        }

        return $word;
    }

   public static function template(string $path, array $params): string {
        ob_start();

        extract($params);

        include($path);

       return ob_get_clean();
    }

    public function basicProtection($elem): string
    {

        $elem = htmlspecialchars((string)$elem, ENT_QUOTES);

        return mysqli_real_escape_string($this->connect, $elem);
    }
}