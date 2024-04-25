<?php

namespace Controller\Login;

use Core\CoreController;
use Core\DbConnect;
use Core\Language;
use Core\System;
use Core\Includer;
use Model\Users;

class Login extends CoreController {
    protected const CONTENT_PATH = "view/login/v_index.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;
    private string $name;
    private string $password;

    public function exit() : void {
        if (isset($_GET['login-exit'])) {
            Users::logout();
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function submit() : void {
        if (isset($_POST['login_submit'])) {
            Users::loginUser($this->name, $this->password, DbConnect::getConnect());
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function render() : string {
        // Get "Post" parameter but nothing
        $this->name = $_POST['login_name'] ?? '';
        $this->password = $_POST['login_password'] ?? '';
        // Set Title
        $this->title = Language::__('Login');
        // Exit from Account
        self::exit();
        // Login to Account
        self::submit();
        // Set Content 
        $this->content = System::template(static::CONTENT_PATH, []);
        $mainHtml = Includer::includeHTML(static::INCLUDE_PATH, $this);
        return $mainHtml;
    }
}