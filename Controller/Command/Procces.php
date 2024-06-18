<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use bin\censorship;
use Symfony\Component\Console\Application;


$application = new Application();
$application->add(new censorship());
$application->run();