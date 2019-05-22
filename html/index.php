<?php

define('APP_ROOT', dirname(__DIR__));

chdir(APP_ROOT);

include 'src/Psr4AutoloaderClass.php';

$loader = new \TodoTest\Psr4AutoloaderClass;

$loader->register();

$loader->addNamespace('TodoTest', 'src');

$app = new TodoTest\App();

$app->run();
