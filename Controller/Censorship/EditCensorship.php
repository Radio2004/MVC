<?php

namespace Controller\Censorship;

use Core\CoreController;
use Core\System;
use Core\Language;
use Model\CensorAction;

class EditCensorship extends CoreController
{
    protected const CONTENT_PATH = "view/edit/v_index.php";

    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;

    protected array $role = [1];
    protected $action;

    public function changeMessage() : void {
        if (isset($_POST['yes-edit'])) {
            $this->action->edit($_POST);
            header('Location: ' . HOST . BASE_URL . 'censorship');
            exit;
        }
    }

    public function checkMessageExistence(): void
    {
        // TODO: Implement checkMessageExistence() method.
        if (empty($this->action->isAlreadyExist())) {
            header('Location: ' . HOST . BASE_URL . 'error');
            exit;
        }
    }

    public function render(array $params) : string {
        $id = $params['mid'] ?? 0;

        $this->action = new CensorAction($id);

        self::checkMessageExistence();

        self::changeMessage();

        $getData = $this->action->isAlreadyExist();

        $this->title = Language::__('Edit');

        $this->content = System::template(static::CONTENT_PATH, ['getData' => $getData]);
        // basic Params (title, content, etc)
        $basicParams = $this->basicParams();
        return System::template(static::INCLUDE_PATH, ['basicParams' => $basicParams]);
    }
}