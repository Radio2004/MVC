<?php

namespace Core;

abstract class CoreController {
    protected string  $title;
    protected string $content;
    protected const CONTENT_PATH = "Error404";
    protected const INCLUDE_PATH = "Error404";

    // 1 = Admin 2 = Manager 3 = User
    protected array $role;

    public function checkRole() : void {
        if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], $this->role)) {
            header('Location: ' . HOST . BASE_URL . 'error');
            exit;
        }
    }

    public function getBoolRole(array $role) : bool {
        if (isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], $role)) {
            return true;
        }

        return false;
    }

    protected function basicParams(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'adminUser' => $this->getBoolRole([1,3]),
            'admin' => $this->getBoolRole([1])
        ];
    }

    abstract public function render(array $params) : string;
}