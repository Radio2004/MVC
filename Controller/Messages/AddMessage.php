<?php

namespace Controller\Messages;

use Core\ArrFields;
use core\CoreController;
use core\DbConnect;
use Core\Language;
use Core\System;
use Model\Messages;

class AddMessage extends CoreController {
    protected const CONTENT_PATH = "view/messages/v_add.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";
    protected string $title;
    protected string $content;
    private array $neededFieldsArray = ['name', 'title', 'message'];
    public function checkSetMessage() : void
    {
        if(empty(self::getValidateErrors()) and count($_POST)) {
            $result = Messages::setMessage(DbConnect::getConnect(), self::getFields());
            $_SESSION['is_message_added'] = $result;
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }
    public function getFields(): array
    {
        return ArrFields::extractFields($_POST, $this->neededFieldsArray);
    }

    public function getValidateErrors(): array
    {
        $getFields = $this->getFields();
        return $_POST?Messages::messagesValidate($getFields):[];
    }

    public function render(array $params): string
    {
        // Set Title
        $this->title = Language::__('Add message');
        /**  validate */
        self::checkSetMessage();
        // Set Content
        $this->content = System::template(static::CONTENT_PATH, ['validateErrors' => self::getValidateErrors(), 'fields' => self::getFields()]);
        return System::template(static::INCLUDE_PATH, [], $this);
    }

}




