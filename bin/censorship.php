<?php

declare(strict_types=1);

namespace bin;

use Core\DbConnect;
use Model\Messages;

include_once ('init.php');

$messages = Messages::getMessages(DbConnect::getConnect());

$queryString = "SELECT * FROM Censorship";

$result_arr = mysqli_fetch_all(mysqli_query(DbConnect::getConnect(), $queryString), MYSQLI_ASSOC);

$result = [];

// Print the entire match result
// var_dump($matches);

foreach ($messages as $message) {
    foreach ($result_arr as $value) {

        $cenName = $value['CenName'];

        $re = "/($cenName)\b/mi";

        $strTitle = $message['title'];
    
        preg_match($re, $strTitle, $matchesTitle, PREG_SET_ORDER, 0);

        var_dump($matchesTitle);

        $strMessage = $message['message'];
    
        preg_match($re, $strMessage, $matchesMessage, PREG_SET_ORDER, 0);

        var_dump($matchesMessage);
    }
}



