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

    public function render(array $params) : string {
        $this->title = Language::__("Censorship");

        $action = new CensoreAction();

        if (isset($_POST['action']) && $_POST['action'] == 'addcensore') {
            $action->add($_POST['new-censor']);
        }

        if (isset($_POST['action']) && $_POST['action'] == 'deletecensore') {
            $action->delete($_POST['id']);
        }

        $this->content = System::template(static::CONTENT_PATH, ['getAll' => $action->getAll()]);
        return  System::template(static::INCLUDE_PATH, [], $this);
    }
}