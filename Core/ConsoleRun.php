<?php
declare(strict_types=1);

require 'vendor/autoload.php';


use Model\Console\CensoreFilter;
use Symfony\Component\Console\Application;


$application = new Application();
$application->add(new CensoreFilter());
$application->run();