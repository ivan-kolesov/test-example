<?php

use Kernel\Application;

define("APP_DIR", dirname(__DIR__) . '/app/');

require dirname(APP_DIR) . "/kernel/autoload.php";

$app = Application::create();
$app->run();