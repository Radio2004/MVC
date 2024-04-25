<?php
/**
 * @by ProfStep, inc. 28.12.2020
 * @website: https://profstep.com
 **/

namespace Controller\Contacts;

use Core\CoreController;
use Core\Language;
use Core\System;
use Core\Includer;

class Contacts extends CoreController {
    protected const CONTENT_PATH = "view/contacts/v_index.php";
    protected const INCLUDE_PATH = "view/base/v_con1col.php";
    protected string $title;
    protected string $content;

    public function render() : string {
        $this->title = Language::__("Contacts");
        $this->content = System::template(static::CONTENT_PATH, []);
        $mainHtml = Includer::includeHTML(static::INCLUDE_PATH, $this);
        return $mainHtml;
    }
}