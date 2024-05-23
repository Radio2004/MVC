<?php

declare(strict_types=1);

namespace Model;

use Container\ContainerCensoreAction;
use Core\DbConnect;
use Core\System;

class CensoreAction implements ContainerCensoreAction
{
    public function getAll(): array {
        $connect = DbConnect::getConnect();

        $queryString = "SELECT * FROM Censorship";

        $result_arr = mysqli_fetch_all(mysqli_query($connect, $queryString),MYSQLI_ASSOC);

        return $result_arr;
    }

    public function add($word): bool {
        $connect = DbConnect::getConnect();

        $validateWord = System::validateInput($word) or die('Error');

        // Check If Login Already Exists
        $query = "SELECT * FROM censorship WHERE censorship_word = '$validateWord'";

        // Get Result
        $result = mysqli_query($connect, $query);

        // If Login Not Exists
        if (!mysqli_num_rows($result) > 0) {
            $queryString = sprintf("INSERT into censorship VALUES (null, '%s')", mysqli_real_escape_string($connect, $validateWord));
            $result = mysqli_query($connect, $queryString) or die(mysqli_error($connect));
            return is_bool($result);
        }

        return false;
    }

    public function rename($id): bool {
        return true;
    }

    public function delete($id): bool {
        $connect = DbConnect::getConnect();

        $sqlInjection = mysqli_real_escape_string($connect, $id);

        $queryDelete = "DELETE FROM censorship WHERE censorship_id = '$sqlInjection'";

        $queryDeleteResult = mysqli_query($connect, $queryDelete);

        return is_bool($queryDeleteResult);
    }
}