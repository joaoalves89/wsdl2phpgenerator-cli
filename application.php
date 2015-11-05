#!/usr/bin/env php
<?php

require_once "vendor/autoload.php";

use Symfony\Component\Console\Application;
use VentureOakLabs\Wsdl2PhpGenerator\Console\Command\Wsdl2PhpGeneratorCommand;

$application = new Application();
$application->add(new Wsdl2PhpGeneratorCommand());
$application->run();
