<?php

namespace Controller\Messages;

use Core\ArrFields;
use core\CoreController;
use Core\Language;
use Core\System;
use Model\Messages;

class AddMessage extends CoreController {
    protected const CONTENT_PATH = "view/messages/v_add.php";

    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;
    private array $neededFieldsArray = ['title', 'message'];
    protected object $instanceMessage;

    public function checkSetMessage() : void
    {
        if(empty(self::getValidateErrors()) and count($_POST)) {
            $result = $this->instanceMessage->setMessage(self::getFields());
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
        $this->instanceMessage = new Messages();
        self::checkSetMessage();
        // Set Content
        $this->content = System::template(static::CONTENT_PATH, ['validateErrors' => self::getValidateErrors(), 'fields' => self::getFields()]);
        // basic Params (title, content, etc)
        $basicParams = $this->basicParams();
        return System::template(static::INCLUDE_PATH, ['basicParams' => $basicParams]);
    }

}




