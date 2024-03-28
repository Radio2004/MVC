<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 23.12.2020
 * @website: https://profstep.com
 **/

/**
 * @param array $target (associate array)
 * @param array $fields (list of fields)
 * @return array
 */

namespace Core;

class ArrFields
{
    private static array $arrayResult = [];
    public static function extractFields(array $target, array $fields): array {

        foreach ($fields as $field) {
            static::$arrayResult[$field] = array_key_exists($field, $target) ? trim($target[$field]): '';
        }

        return static::$arrayResult;
    }
}