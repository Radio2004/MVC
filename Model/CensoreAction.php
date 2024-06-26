<?php

declare(strict_types=1);

namespace Model;

use Container\ContainerCensoreAction;
use Core\DbConnect;
use Core\System;

class CensoreAction implements ContainerCensoreAction
{
    private int $idMessageFromLink;

    public function __construct($id = -1)
    {
        $this->idMessageFromLink = (int)$id;
    }
    public function getAll(): array {
        $connect = DbConnect::getConnect();

        $queryString = "SELECT * FROM Censorship";

        return mysqli_fetch_all(mysqli_query($connect, $queryString),MYSQLI_ASSOC);
    }

    public function getCensoreMessages(): array
    {
        $connect = DbConnect::getConnect();

        $queryString = "SELECT * FROM censorship_messages";

        return mysqli_fetch_all(mysqli_query($connect, $queryString),MYSQLI_ASSOC);
    }

    public function add($word): bool {
        $connect = DbConnect::getConnect();

        $validateWord = System::validateInput($word) or die('Error');

        // Check If Login Already Exists
        $query = "SELECT * FROM Censorship WHERE censorship_word = '$validateWord'";

        // Get Result
        $result = mysqli_query($connect, $query);

        // If Login Not Exists
        if (!mysqli_num_rows($result) > 0) {
            $queryString = sprintf("INSERT into Censorship VALUES (null, '%s')", mysqli_real_escape_string($connect, $validateWord));
            $result = mysqli_query($connect, $queryString) or die(mysqli_error($connect));
            return is_bool($result);
        }

        return false;
    }

    public function edit($post): bool {
        $connect = DbConnect::getConnect();

        $postWord = mysqli_real_escape_string($connect, $post['Censorship_word']);

        $queryChange = "UPDATE Censorship SET Censorship_word = '$postWord' WHERE censorship_id = '$this->idMessageFromLink'";

        mysqli_query($connect, $queryChange);

        return true;
    }

    public function delete($id): bool {
        $connect = DbConnect::getConnect();

        $sqlInjection = mysqli_real_escape_string($connect, $id);

        $queryDelete = "DELETE FROM Censorship WHERE censorship_id = '$sqlInjection'";

        $queryDeleteResult = mysqli_query($connect, $queryDelete);

        return is_bool($queryDeleteResult);
    }

    public function isAlreadyExist() : array {

        $connect = DbConnect::getConnect();

        $queryString = "SELECT Censorship_word FROM Censorship WHERE censorship_id = '$this->idMessageFromLink'";
        $result_arr = mysqli_fetch_array(mysqli_query($connect, $queryString),MYSQLI_ASSOC);

        return $result_arr ?? [];
    }
}