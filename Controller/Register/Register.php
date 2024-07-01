<?php

namespace Controller\Register;

use Core\CoreController;
use Core\Language;
use Core\System;
use Model\Users;

class Register extends CoreController {
    protected const CONTENT_PATH = "view/register/v_index.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;
    private string $name;
    private string $password;
    private string $email;

    // Check Is Exist
    public function checkIsRegistered() : void
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    // Register User
    public function registerUser() : void
    {
        if (isset($_POST['register_submit'])) {
            $instanceUsers = new Users();
            $instanceUsers->registerUser($this->name, $this->password, $this->email);
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function render(array $params): string
    {
        // Check Is Exist
        self::checkIsRegistered();
        // Set Title
        $this->title = Language::__('Register');
        // Set User Data
        $this->name =  $_POST['register_name'] ?? '';
        $this->password = $_POST['register_password'] ?? '';
        $this->email = $_POST['register_email'] ?? '';
        // If There is Data, Register User
        self::registerUser();
        // Set Content
        $this->content = System::template(static::CONTENT_PATH, []);
        // basic Params (title, content, etc)
        $basicParams = $this->basicParams();
        return System::template(static::INCLUDE_PATH, ['basicParams' => $basicParams]);
    }
}