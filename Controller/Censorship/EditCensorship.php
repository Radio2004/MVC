<?php

namespace Controller\Censorship;

use Core\CoreController;
use Core\Includer;
use Core\System;
use Core\Language;
use Model\EditBuilder;

class EditCensorship extends CoreController
{
    protected const CONTENT_PATH = "view/edit/v_index.php";

    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title;

    protected string $content;

    protected array $role = [1];

    public function render(array $params) : string {

        $this->title = Language::__('Edit');

        $editBuilder = new EditBuilder($params);

        $data = ["censorship_word"];

        $getData = $editBuilder->build($data);

        $this->content = System::template(static::CONTENT_PATH, ['getData' => $getData]);
        return System::template(static::INCLUDE_PATH, [], $this);
    }
}