<?php

// NameSpace
namespace Controller\Messages;

// Include Classes
use core\CoreController;
use Core\Language;
use Core\System;
use Model\Messages;


// Own Class
class MessageIndex extends CoreController
{
    protected const CONTENT_PATH = "view/messages/v_index.php";

    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;
    private bool $successText = false;


    public function isAddedMessage() : void
    {
        if (isset($_SESSION['is_message_added']) && $_SESSION['is_message_added']) {
            $this->successText = true;
            unset($_SESSION['is_message_added']);
        }
    }

    public function render(array $params) : string
    {
        // Set Title
        $this->title = Language::__('Chat List');
        // Get Messages
        $instanceMessages = new Messages();
        $messages = $instanceMessages->getMessages();
        // Check Is Added Messages
        $this->isAddedMessage();
        // Get bool role result, what allow Admin and Manager Edit/Delete Messages
        $boolResult = $this->getBoolRole([1,2]);
        // Content
        $this->content = System::template(static::CONTENT_PATH, ['successText' => $this->successText, 'messages' => $messages, 'boolResult' => $boolResult]);
        // basic Params (title, content, etc)
        $basicParams = $this->basicParams();
        return System::template(static::INCLUDE_PATH, ['basicParams' => $basicParams]);
    }
}