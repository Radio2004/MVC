<?php

namespace Controller\Login;

use Core\CoreController;
use Core\Language;
use Core\System;
use Model\Users;

class Login extends CoreController {
    protected const CONTENT_PATH = "view/login/v_index.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;
    private string $name;
    private string $password;

    protected object $instanceUser;

    public function exit() : void {
        if (isset($_GET['login-exit'])) {
            Users::logout();
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function submit() : void {
        if (isset($_POST['login_submit'])) {
            $this->instanceUser->loginUser($this->name, $this->password);
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function render(array $params) : string {
        // Get "Post" parameter but nothing
        $this->name = $_POST['login_name'] ?? '';
        $this->password = $_POST['login_password'] ?? '';
        // Set Title
        $this->title = Language::__('Login');
        // Create Instance User
        $this->instanceUser = new Users();
        // Exit from Account
        $this->exit();
        // Login to Account
        $this->submit();
        // Set Content 
        $this->content = System::template(static::CONTENT_PATH, []);
        // basic Params (title, content, etc)
        $basicParams = $this->basicParams();
        return System::template(static::INCLUDE_PATH, ['basicParams' => $basicParams]);
    }
}