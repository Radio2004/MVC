<?php


declare(strict_types=1);

namespace Controller\Censorship;

use Core\CoreController;
use Core\Includer;
use Core\Language;
use Core\System;

class Censorship extends CoreController
{
    protected const CONTENT_PATH = "view/censorship/v_index.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";
    protected string $title;
    protected string $content;

    public function render() : string {
        $this->title = Language::__("Censorship");
        $this->content = System::template(static::CONTENT_PATH, []);
        $mainHtml = Includer::includeHTML(static::INCLUDE_PATH, $this);
        return $mainHtml;
    }
}