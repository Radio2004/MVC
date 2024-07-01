<?php

declare(strict_types=1);

namespace Model;

use Container\ContainerCensoreAction;
use Core\DbConnect;
use Core\System;

class CensorAction implements ContainerCensoreAction
{
    private int $idMessageFromLink;

    protected $connect;
    protected object $instanceSys;

    public function __construct($id = -1)
    {
        $this->idMessageFromLink = (int)$id;

        $this->connect = DbConnect::getConnect();

        $this->instanceSys = new System();
    }
    public function getAll(): array {

        $queryString = $this->instanceSys->basicProtection("SELECT * FROM Censorship");

        return mysqli_fetch_all(mysqli_query($this->connect, $queryString),MYSQLI_ASSOC);
    }

    public function getCensoreMessages(): array
    {

        $queryString = $this->instanceSys->basicProtection("SELECT * FROM censorship_messages");

        return mysqli_fetch_all(mysqli_query($this->connect, $queryString),MYSQLI_ASSOC);
    }

    public function add($word): bool {

        $validateWord = System::validateInput($word) or die('Error');

        // Check If Login Already Exists
        $query = $this->instanceSys->basicProtection("SELECT * FROM Censorship WHERE censorship_word = '$validateWord'");

        // Get Result
        $result = mysqli_query($this->connect, $query);

        // If Login Not Exists
        if (!mysqli_num_rows($result) > 0) {
            $queryString = sprintf("INSERT into Censorship VALUES (null, '%s')", mysqli_real_escape_string($this->connect, $validateWord));
            $result = mysqli_query($this->connect, $queryString) or die(mysqli_error($this->connect));
            return is_bool($result);
        }

        return false;
    }

    public function edit($post): bool {

        $postWord = mysqli_real_escape_string($this->connect, $post['Censorship_word']);

        $queryChange = $this->instanceSys->basicProtection("UPDATE Censorship SET Censorship_word = '$postWord' WHERE censorship_id = '$this->idMessageFromLink'");

        mysqli_query($this->connect, $queryChange);

        return true;
    }

    public function delete($id): bool {

        $sqlInjection = mysqli_real_escape_string($this->connect, $id);

        $queryDelete = $this->instanceSys->basicProtection("DELETE FROM Censorship WHERE censorship_id = '$sqlInjection'");

        $queryDeleteResult = mysqli_query($this->connect, $queryDelete);

        return is_bool($queryDeleteResult);
    }

    public function isAlreadyExist() : array {

        $queryString = $this->instanceSys->basicProtection("SELECT Censorship_word FROM Censorship WHERE censorship_id = '$this->idMessageFromLink'");
        $result_arr = mysqli_fetch_array(mysqli_query($this->connect, $queryString),MYSQLI_ASSOC);

        return $result_arr ?? [];
    }
}