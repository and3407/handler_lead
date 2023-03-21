<?php

use LeadHandler\controllers\StartController;
use LeadHandler\controllers\TaskController;

$container = require __DIR__ . '/app/bootstrap.php';

switch ($argv[1]) {
    case 'start':
        $container->call(StartController::class);
        break;
    case 'task':
        $container->call(TaskController::class);
        break;
    default:
        die();
}
