<?php

/**
 * @var \Core\Router $router
 */

use App\Controllers\ScheduleController;

$router->get('/', function () {
    return 'Добро пожаловать на главную страницу!';
});

$router->get('/schedules', function () {
    $controller = new ScheduleController();
    return $controller->index();
});
