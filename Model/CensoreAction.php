<?php

declare(strict_types=1);

namespace Model;

use Container\ContainerCensoreAction;
use Core\DbConnect;

class CensoreAction implements ContainerCensoreAction
{
    public function getAll(): array {
        $connect = DbConnect::getConnect();

        $queryString = "SELECT * FROM Censorship";

        $result_arr = mysqli_fetch_all(mysqli_query($connect, $queryString), MYSQLI_ASSOC);

        return $result_arr ?? [];
    }

    public function add(): bool {
        $connect = DbConnect::getConnect();
        $queryString = sprintf("INSERT into censorship VALUES (null, '%s')", 'word');
        $result = mysqli_query($connect, $queryString) or die(mysqli_error($connect));
        return is_bool($result)? $result : false;
    }

    public function rename($id): bool {
        return true;
    }

    public function delete($id): bool {
        return true;
    } 
}