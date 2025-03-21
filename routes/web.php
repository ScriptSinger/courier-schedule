<?php

use App\Controllers\Web\WelcomeController;

$router->get('/', function () {
    $controller = new WelcomeController();
    return $controller->index();
});
