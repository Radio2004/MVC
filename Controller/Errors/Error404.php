<?php
/**
 * @by ProfStep, inc. 28.12.2020
 * @website: https://profstep.com
 **/

// Title in Index.php
// Content Path

namespace Controller\Errors;

use Core\CoreController;
use Core\System;

class Error404 extends CoreController {
    protected const CONTENT_PATH = "view/errors/v_404.php";

    protected const INCLUDE_PATH = "view/base/v_con1col.php";

    protected string $title = 'Error 404';

    protected string $content;

    public function render(array $params) : string {
        $this->content = System::template(static::CONTENT_PATH, []);
        // basic Params (title, content, etc)
        $basicParams = $this->basicParams();
        return System::template(static::INCLUDE_PATH, ['basicParams' => $basicParams]);
    }
}