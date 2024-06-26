<?php
declare(strict_types=1);

require 'vendor/autoload.php';


use Symfony\Component\Console\Application;


$application = new Application();
$application->add(new \Model\Console\CensoreFilter());
$application->run();