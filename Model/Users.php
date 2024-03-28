<?php

namespace Model;

use Core\System;

class Users
{
    public static function registerUser(string $registerName, string $registerPassword, string $registerEmail, $connect) : void {
        // Get Name
        $registerName = System::validateInput($registerName) or die("Login is Wrong");
        // Get Password
        $notHashPassword = System::validateInput($registerPassword) or die("Password is Wrong");
        $hashPassword = password_hash($notHashPassword, PASSWORD_DEFAULT);
        // Get Email
        $registerEmail = System::validateInput($registerEmail) or die("Email is Wrong");;

        // Check If Login Already Exists
        $query = "SELECT * FROM users WHERE login = '$registerName'";
        // Get Result
        $result = mysqli_query($connect, $query);

        // If Login Not Exists
        if (!mysqli_num_rows($result) > 0) {

            // Insert
            $queryRegister = "INSERT INTO users (login, password, email, role) VALUES ('$registerName', '$hashPassword', '$registerEmail', 1)";
            mysqli_query($connect, $queryRegister);

            // Get Data After Insert
            $idAfterInsert = mysqli_insert_id($connect);
            // Get data New User
            $queryName = "SELECT id, login, role FROM users WHERE id='$idAfterInsert'";
            $queryResult = mysqli_query($connect, $queryName);
            $row = mysqli_fetch_array($queryResult, MYSQLI_ASSOC);
            // Add Data User in Session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_login'] = $row['login'];
            $_SESSION['user_role'] = $row['role'];
        }
    }

    public static function loginUser(string $loginName, string $loginPassword, $connect) : void {
        // Get Name
        $loginName = System::validateInput($loginName);
        // Get Password
        $loginPassword = System::validateInput($loginPassword);
        // Searching For a User by Username
        $queryLogin = "SELECT * FROM users WHERE login = '$loginName'";
        $resultLogin = mysqli_query($connect, $queryLogin);
        $row = mysqli_fetch_array($resultLogin,MYSQLI_ASSOC);
        // If Everything Is Fine, Then Write Down Its Data
        if (mysqli_num_rows($resultLogin) == 1 && password_verify($loginPassword, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
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