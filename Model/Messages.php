<?php
declare(strict_types=1);
/**
 * @by ProfStep, inc. 23.12.2020
 * @website: https://profstep.com
 **/

namespace Model;

use Core\DbConnect;
use Core\Language;
use Core\System;
use DateTime;

class Messages
{
    protected $connect;
    protected object $instanceSys;

    public function __construct()
    {
        $this->connect = DbConnect::getConnect();

        $this->instanceSys = new System();
    }

    public function getMessages() : array {
        $queryString = $this->instanceSys->basicProtection("SELECT * FROM messages WHERE visible = 1");
        $result_arr = mysqli_fetch_all(mysqli_query($this->connect, $queryString),MYSQLI_ASSOC);
        return $result_arr ?? [];
    }

    public function getAllMessages() : array {
        $queryString = $this->instanceSys->basicProtection("SELECT * FROM messages");
        $result_arr = mysqli_fetch_all(mysqli_query($this->connect, $queryString),MYSQLI_ASSOC);
        return $result_arr ?? [];
    }

    public function getMessage($id) : array {
        $queryString = $this->instanceSys->basicProtection(sprintf("SELECT * FROM messages WHERE id = %s", $id));
        $result_arr = mysqli_fetch_array(mysqli_query($this->connect, $queryString), MYSQLI_ASSOC);
        return $result_arr ?? [];
    }

    public function setMessage($fields) : bool {
        $queryString = $this->instanceSys->basicProtection(sprintf("INSERT into messages VALUES (null, '%s', '%s', '%s', now(), '0', '%s', '1', NULL)", $_SESSION['user_login'], $fields['title'], $fields['message'], $_SESSION['user_id']));
        $result = mysqli_query($this->connect, $queryString) or die(mysqli_error($this->connect));
        return is_bool($result)? $result : false;
    }

    public static function messagesValidate(array &$fields) : array{
        $errors = [];
        $titleLen = mb_strlen($fields['title'], 'UTF-8');

        if(mb_strlen($fields['message'], 'UTF-8') < 2){
            $errors[] = Language::__('Message length must be not less then 2 characters!');
        }

        if($titleLen < 10 || $titleLen > 140){
            $errors[] = Language::__('Title must be from 10 to 140 chars!');
        }

        $fields['title'] = htmlspecialchars($fields['title']);
        $fields['message'] = htmlspecialchars($fields['message']);

        return $errors;
    }

    public function deleteMessage(int $idMessageFromLink) : void {
        $queryDelete = $this->instanceSys->basicProtection("UPDATE messages SET visible = '0' WHERE id = '$idMessageFromLink'");

        mysqli_query($this->connect, $queryDelete);
    }

    public function changeMessage($post, int $id) : void {

        $postTitle = $post["message-title"];
        $postContent = $post["message-content"];

        $queryChange = $this->instanceSys->basicProtection("UPDATE messages SET title = '$postTitle', message = '$postContent' WHERE id = '$id'");

        mysqli_query($this->connect, $queryChange);
    }

    public function isAlreadyExist(int $idMessage) : array {
        // Get ID, Title, Message From Message
        $getTitleMessage = $this->instanceSys->basicProtection("SELECT id, title, message FROM messages WHERE id = '$idMessage'");

        $resultIsAlreadyExist = mysqli_query($this->connect, $getTitleMessage);

        if (!mysqli_num_rows($resultIsAlreadyExist) > 0) {
            return [];
        } else {
            return mysqli_fetch_array($resultIsAlreadyExist, MYSQLI_ASSOC);
        }
    }

    public static function format_time_ago($timestamp): string
    {
        $now = new DateTime();
        $checked_time = new DateTime($timestamp);
        $interval = $now->diff($checked_time);

        if ($interval->y > 0) {
            return $interval->format('%y year ago');
        } elseif ($interval->m > 0) {
            return $interval->format('%m month ago');
        } elseif ($interval->d > 0) {
            return $interval->format('%d day ago');
        } elseif ($interval->h > 0) {
            return $interval->format('%h hours ago');
        } else {
            return $interval->format('%i minutes ago');
        }
    }
}