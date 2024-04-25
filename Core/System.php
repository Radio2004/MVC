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
   public static function parseUrl(string $url, array $routes) : array{
        $result = [
            'controller' => 'Errors/Error404',
            'params' => []
        ];

        foreach($routes as $route){
            $matches = [];

            if(preg_match($route['regex'], $url, $matches)){
                $result['controller'] = $route['controller'];

                if(isset($route['params'])){
                    foreach($route['params'] as $name => $num){
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
        if (str_contains($word, ' ') !== false) {
            return false;
        }

        return $word;
    }

   public static function template(string $path, array $params): string {
        $html = '';
        ob_start();
        extract($params);

        include($path);
        $html = ob_get_clean();
        return $html;
    }
}