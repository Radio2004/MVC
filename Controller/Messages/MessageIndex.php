<?php

// NameSpace
namespace Controller\Messages;

// Include Classes
use core\CoreController;
use core\DbConnect;
use Core\Language;
use Core\System;
use Core\Includer;
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

    public function render() : string
    {
        // Set Title
        $this->title = Language::__('Chat List');
        // Get Messages
        $messages = Messages::getMessages(DbConnect::getConnect());
        // Check Is Added Messages
        $this->isAddedMessage();
        // Get bool role result, what allow Admin and Manager Edit/Delete Messages
        $boolResult = $this->getBoolRole([1,2]); 
        // Content
        $this->content = System::template(static::CONTENT_PATH, ['successText' => $this->successText, 'messages' => $messages, 'boolResult' => $boolResult]);
        $mainHtml = Includer::includeHTML(static::INCLUDE_PATH, $this);
        return $mainHtml;
    }
}