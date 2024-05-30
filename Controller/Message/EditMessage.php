<?php

namespace Controller\Message;

use Core\CoreController;
use Core\DbConnect;
use Core\Language;
use Core\System;
use Model\Messages;

class EditMessage extends CoreController
{
    protected const CONTENT_PATH = "view/message/v_index.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;

    protected array $role = [1,2];

    private int $idMessageFromLink;

    public function getCheckIsExist(): array
    {
        return Messages::isAlreadyExist($this->idMessageFromLink, DbConnect::getConnect(), 'message');
    }

    public function checkMessageExistence(): void
    {
        if (empty(self::getCheckIsExist())) {
            header('Location: ' . HOST . BASE_URL . 'error');
            exit;
        }
    }

    public function changeMessage() : void {
        if (isset($_POST['yes-edit'])) {
            Messages::changeMessage($_POST, self::getCheckIsExist()['id'],  DbConnect::getConnect());
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    public function render(array $params): string
    {
        // explode('/', $_SERVER['REDIRECT_URL'][2] = ID MESSAGE FROM LINK
        $this->idMessageFromLink = (int)explode('/', $_SERVER['REDIRECT_URL'])[2];
        // Check ID Message is in Database
        self::checkMessageExistence();
        // If change was confirmed
        self::changeMessage();
        // Set Title
        $this->title = Language::__('Edit');
        // Set Content
        $this->content = System::template(static::CONTENT_PATH, ['checkIsExist' => self::getCheckIsExist()]);
        return System::template(static::INCLUDE_PATH, [], $this);
    }
}
