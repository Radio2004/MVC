<?php

namespace Model;

use Container\ContainerEdit;
use Core\MysqlRequest;
use Core\DbConnect;

class EditBuilder implements ContainerEdit
{

    private int $idMessageFromLink = 0;

    public static function isAlreadyExist(int $idMessage, $connect, array $requsets) : array {

        $mysqlRequset = new MysqlRequest();

        $result = count($requsets) > 0 ? $mysqlRequset-> getValue($requsets, 'Censorship') : $mysqlRequset->getAll('Censorship');

        if (!mysqli_num_rows($result) > 0) {
            return [];
        }

        return $result;
    }

    public function getCheckIsExist($requsets): array
    {
       return self::isAlreadyExist($this->idMessageFromLink, DbConnect::getConnect(), $requsets);
    }

    public function checkMessageExistence(): void
    {
        // TODO: Implement checkMessageExistence() method.
        if (empty(self::getCheckIsExist())) {
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

    function __construct($params) {
        $id = $params['mid'] ?? 0;

        $this->idMessageFromLink = $id;
    }

    public function build(array $array): array
    {
        // TODO: Implement changeMessage() method.

        // Check ID Message is in Database
        self::checkMessageExistence();
        

        return self::getCheckIsExist($array);
    }
}