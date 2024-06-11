<?php

namespace Controller\Message;

use Core\DbConnect;

use Core\CoreController;
use Core\Language;
use Core\System;
use Model\Messages;

class DeleteMessage extends CoreController {
    protected const CONTENT_PATH = "view/message/v_delete.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";
    protected string $title;
    protected string $content;
    protected array $role = [1,2];
    private int $idMessageFromLink;

    public function getCheckIsExist(): array {
        return Messages::isAlreadyExist($this->idMessageFromLink, DbConnect::getConnect());
    }

    public function checkMessageExistence(): void
    {
        if (empty(self::getCheckIsExist())) {
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function deleteMessage() : void {
        if (isset($_POST['yes-delete'])) {
            Messages::deleteMessage($this->getCheckIsExist()['id'], DbConnect::getConnect());
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function render(array $params) : string {
        // explode('/', $_SERVER['REDIRECT_URL'][2] = ID MESSAGE FROM LINK
        // $this->idMessageFromLink = (int)explode('/', $_SERVER['REDIRECT_URL'])[2];
        $this->idMessageFromLink = $params['mid'];
        // Check id message is in database
        self::checkMessageExistence();
        // Title
        $this->title = Language::__('Delete');
        // If role isn't Admin or Manager then link to Error404
        self::checkRole();
        // If delete was confirmed
        self::deleteMessage();
        // Set Content
        $this->content = System::template(self::CONTENT_PATH, []);
        return System::template(static::INCLUDE_PATH, [], $this);
    }
}
