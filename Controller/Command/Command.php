<?php

declare(strict_types=1);

namespace Controller\Command;


class Command
{
    private string $consoleCommand;

    public function setConsoleCommand(string $word): void
    {
        if (isset($_POST['command'])) {
            $this->consoleCommand = $word;
        }
    }

    public function render(): void {
        $this->setConsoleCommand($_POST['command']);
        $output = null;
        if (preg_match('/^\w+:\w+$/m', $this->consoleCommand)) {
            $output = shell_exec('php Core/ConsoleRun.php ' . $this->consoleCommand);
        } else {
            $output = shell_exec($this->consoleCommand);
        }
        echo $output;
    }
}