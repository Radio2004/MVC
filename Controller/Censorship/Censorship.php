<?php


declare(strict_types=1);

namespace Controller\Censorship;

use Core\CoreController;
use Core\Language;
use Core\System;
use Model\CensoreAction;

class Censorship extends CoreController
{
    protected const CONTENT_PATH = "view/censorship/v_index.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;

    protected array $role = [1];

    protected $action;

    public function addCensore(): void
    {
        if (isset($_POST['action']) && $_POST['action'] == 'addcensore') {
            $this->action->add($_POST['new-censor']);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
    }

    public function deleteCensore(): void
    {
        if (isset($_POST['action']) && $_POST['action'] == 'deletecensore') {
            $this->action->delete($_POST['id']);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
    }

    public function render(array $params) : string {
        $this->title = Language::__("Censorship");

        $this->action = new CensoreAction();

        self::addCensore();

        self::deleteCensore();

        $getCensoreMessages = $this->action->getCensoreMessages();

        $this->content = System::template(static::CONTENT_PATH, ['getAll' => $this->action->getAll(), 'getCensoreMessages' => $getCensoreMessages]);
        return  System::template(static::INCLUDE_PATH, [], $this);
    }
}