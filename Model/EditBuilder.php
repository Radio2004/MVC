<?php

namespace Model;

use Container\ContainerEdit;
use Core\DbConnect;

class EditBuilder implements ContainerEdit
{

    private int $idMessageFromLink = 0;

    public function getCheckIsExist(): array
    {
       return Messages::isAlreadyExist($this->idMessageFromLink, DbConnect::getConnect(), 'message');
    }

    public function checkMessageExistence(): void
    {
        // TODO: Implement checkMessageExistence() method.
        if (empty(self::getCheckIsExist()) && $this->idMessageFromLink != 0) {
            header('Location: ' . HOST . BASE_URL . 'error');
            exit;
        }
    }

    public function changeMessage(): void
    {
        // TODO: Implement changeMessage() method.
        if (isset($_POST['yes-edit'])) {
            Messages::changeMessage($_POST, self::getCheckIsExist()['id'],  DbConnect::getConnect());
            header('Location: ' . HOST . BASE_URL);
            exit;
        }
    }

    function __construct() {
        $id = $params['mid'] ?? 0;

        $this->idMessageFromLink = (int)$id;
    }

    public function build(array ...$array): array
    {
        // TODO: Implement changeMessage() method.

        // Check ID Message is in Database
        self::checkMessageExistence();

        // If change was confirmed
        self::changeMessage();

        

        return [

        ];
    }
}