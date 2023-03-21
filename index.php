<?php

use LeadHandler\controllers\StartController;

$container = require __DIR__ . '/app/bootstrap.php';

switch ($argv[1]) {
    case 'start':
        $container->call(StartController::class);
        break;
    default:
        die();
}
