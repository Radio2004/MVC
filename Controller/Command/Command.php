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

    public function getConsoleCommand(): void
    {
        $result = shell_exec($this->consoleCommand);
        echo $result;
    }

    public function render(): void {
//        $this->setConsoleCommand($_POST['command']);
//        $this->getConsoleCommand();
        $output = shell_exec('php Controller/Command/Procces.php censorship:filter');
        echo $output;
    }
}