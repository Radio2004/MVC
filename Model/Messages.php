<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 23.12.2020
 * @website: https://profstep.com
 **/

namespace Model;

use Core\Language;

class Messages
{
    public static function getMessages($connect) : array {
        $queryString = "SELECT * FROM messages WHERE 1";
        $result_arr = mysqli_fetch_all(mysqli_query($connect, $queryString),MYSQLI_ASSOC);
        return $result_arr ?? [];
    }

    public static function getMessage($connect, $id) : array {
        $queryString = sprintf("SELECT * FROM messages WHERE id = %s", $id);
        $result_arr = mysqli_fetch_accos(mysqli_query($connect, $queryString));
        return $result_arr ?? [];
    }

    public static function setMessage($connect, $fields) : bool {

        $queryString = sprintf("INSERT into messages VALUES (null, '%s', '%s', '%s', now(), '0', '%s', '1')", $fields['name'], $fields['title'], $fields['message'], $_SESSION['user_id']);
        $result = mysqli_query($connect, $queryString) or die(mysqli_error($connect));
        return is_bool($result)? $result : false;
    }

    public static function messagesValidate(array &$fields) : array{
        $errors = [];
        $nameLen = mb_strlen($fields['name'], 'UTF-8');
        $titleLen = mb_strlen($fields['title'], 'UTF-8');

        if(mb_strlen($fields['message'], 'UTF-8') < 2){
            $errors[] = Language::__('Message length must be not less then 2 characters!');
        }

        if($nameLen < 2 || $nameLen > 140){
            $errors[] = Language::__('Name must be from 2 to 140 chars!');
        }
        if($titleLen < 10 || $titleLen > 140){
            $errors[] = Language::__('Title must be from 10 to 140 chars!');
        }

        $fields['name'] = htmlspecialchars($fields['name']);
        $fields['title'] = htmlspecialchars($fields['title']);
        $fields['message'] = htmlspecialchars($fields['message']);

        return $errors;
    }

    public static function deleteMessage(int $idMessageFromLink, $connect) : void {
        $queryDelete = "DELETE FROM messages WHERE id = '$idMessageFromLink'";

        $queryDeleteResult = mysqli_query($connect, $queryDelete);
    }

    public static function changeMessage($post, int $id, $connect) : void {

        $postTitle = $post["message-title"];
        $postContent = $post["message-content"];

        $queryChange = "UPDATE messages SET title = '$postTitle', message = '$postContent' WHERE id = '$id'";

        mysqli_query($connect, $queryChange);
    }

    public static function isAlreadyExist(int $idMessage, $connect, string $whatGet = 'id') : array {
        // Get Only ID From Message
        $getOnlyId = "SELECT id FROM messages WHERE id = '$idMessage'";
        // Get Id, Title, Message From Message
        $getTitleMessage = "SELECT id, title, message FROM messages WHERE id = '$idMessage'";

        $whatGet = 'message' ? $getTitleMessage : $getOnlyId;

        $resultIsAlreadyExist = mysqli_query($connect, $whatGet);

        if (!mysqli_num_rows($resultIsAlreadyExist) > 0) {
            return [];
        } else {
            $row = mysqli_fetch_array($resultIsAlreadyExist, MYSQLI_ASSOC);
            return $row;
        }
    }
}