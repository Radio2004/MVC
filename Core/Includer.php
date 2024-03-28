<?php

namespace Core;

class Includer
{
    public static function includeHTML(string $path, $controller) : string {
        ob_start();

        include($path);

        $result = ob_get_clean();
        return $result;
    }
}