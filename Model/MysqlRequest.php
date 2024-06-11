<?php

declare(strict_types=1);

namespace Model;

class MysqlRequest
{
    public static function getAll($from) : array {
        $connect = DbConnect::getConnect();

        $from = mysqli_real_escape_string($from);

        

        $queryString = "SELECT * FROM "$from" WHERE 1";
        $result_arr = mysqli_fetch_array(mysqli_query($connect, $queryString),MYSQLI_ASSOC);
        return $result_arr ?? [];
    }

    public static function getValue($array, $from) : array {
        $connect = DbConnect::getConnect();

        $from = mysqli_real_escape_string($from);

        

        $queryString = "SELECT * FROM "$from" WHERE 1";
        $result_arr = mysqli_fetch_array(mysqli_query($connect, $queryString),MYSQLI_ASSOC);
        return $result_arr ?? [];
    }
}