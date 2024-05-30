<?php

namespace Controller\Censorship;

use Core\CoreController;
use Core\Includer;
use Core\System;
use Model\EditBuilder;

class EditCensorship extends CoreController
{
    protected const CONTENT_PATH = "view/edit/v_index.php";

    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;

    protected array $role = [1];

    public function render(array $params) : string {

        $editBuilder = new EditBuilder();

        $getData = $editBuilder->build();

        $this->content = System::template(static::CONTENT_PATH, ['getData' => $getData]);
        return System::template(static::INCLUDE_PATH, [], $this);
    }
}