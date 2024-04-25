<?php

declare(strict_types=1);

namespace Model;
use ContainerCensoreAction;

class CensoreAction implements ContainerCensoreAction
{
    public function getAll($connect): array {
        $queryString = "SELECT * FROM censorship";
        $result_arr = mysqli_fetch_all(mysqli_query($connect, $queryString),MYSQLI_ASSOC);
        return $result_arr ?? [];
    }

    public function add($connect): bool {
        $queryString = sprintf("INSERT into censorship VALUES (null, '%s', '%s', '%s', now(), '0')", $fields['name'], $fields['title'], $fields['message']);
        $result = mysqli_query($connect, $queryString) or die(mysqli_error($connect));
        return is_bool($result)? $result : false;
    }

    public function rename($connect, $id): string {

    }

    public function delete($connect, $id): string {

    }
}