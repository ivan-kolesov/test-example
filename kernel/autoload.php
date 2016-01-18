<?php

require 'psr4autoloader.php';

$loader = new Psr4AutoloaderClass;
$loader->addNamespace('Kernel', dirname(APP_DIR) . '/kernel');
$loader->addNamespace('Kernel\Models', dirname(APP_DIR) . '/kernel');
$loader->addNamespace('Kernel\Exceptions', dirname(APP_DIR) . '/kernel/exceptions');
$loader->addNamespace('Controllers', dirname(APP_DIR) . '/app/controllers');
$loader->addNamespace('Models', dirname(APP_DIR) . '/app/models');
$loader->addNamespace('Services', dirname(APP_DIR) . '/app/services');

$loader->register();