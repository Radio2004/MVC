<?php

namespace Model;

use Core\DbConnect;
use Core\System;

class Users
{
    protected object $connect;

    public function __construct()
    {
        $this->connect = DbConnect::getConnect();
    }

    public function registerUser(string $registerName, string $registerPassword, string $registerEmail) : void {
        // Get Name
        $registerName = System::validateInput($registerName) or die("Login is Wrong");
        // Get Password
        $notHashPassword = System::validateInput($registerPassword) or die("Password is Wrong");
        $hashPassword = password_hash($notHashPassword, PASSWORD_DEFAULT);
        // Get Email
        $registerEmail = System::validateInput($registerEmail) or die("Email is Wrong");

        $instanceSys = new System();

        // Check If Login Already Exists
        $query = $instanceSys->basicProtection("SELECT * FROM users WHERE login = '$registerName'");

        // Get Result
        $result = mysqli_query($this->connect, $query);

        // If Login Not Exists
        if (!mysqli_num_rows($result) > 0) {

            // Insert
            $queryRegister = $instanceSys->basicProtection("INSERT INTO users (login, password, email, role) VALUES ('$registerName', '$hashPassword', '$registerEmail', 3)");
            mysqli_query($this->connect, $queryRegister);

            // Get Data After Insert
            $idAfterInsert = mysqli_insert_id($this->connect);
            // Get data New User
            $queryName = $instanceSys->basicProtection("SELECT user_id, login, role FROM users WHERE user_id='$idAfterInsert'");
            $queryResult = mysqli_query($this->connect, $queryName);
            $row = mysqli_fetch_array($queryResult, MYSQLI_ASSOC);
            // Add Data User in Session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_login'] = $row['login'];
            $_SESSION['user_role'] = $row['role'];
        }
    }

    public function loginUser(string $loginName, string $loginPassword) : void {
        // Get Name
        $loginName = System::validateInput($loginName);
        // Get Password
        $loginPassword = System::validateInput($loginPassword);
        // Searching For a User by Username
        $instanceSys = new System();

        $queryLogin = $instanceSys->basicProtection("SELECT * FROM users WHERE login = '$loginName'");

        $resultLogin = mysqli_query($this->connect, $queryLogin);

        $row = mysqli_fetch_array($resultLogin,MYSQLI_ASSOC);

        // If Everything Is Fine, Then Write Down Its Data
        if (mysqli_num_rows($resultLogin) == 1 && password_verify($loginPassword, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_login'] = $row['login'];
            $_SESSION['user_role'] = $row['role'];
        }
    }

    public static function logout(): void {
        $_SESSION = [];
        unset($_COOKIE[session_name()]);
        session_destroy();
    }
}