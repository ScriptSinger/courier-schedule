<?php

/**
 * @var \Core\Router $router
 */

use App\Controllers\Api\CourierController;
use App\Controllers\Api\RegionController;
use App\Controllers\Api\ScheduleController;


$router->get('/api/regions', [new RegionController(), 'index']);


$router->get('/api/couriers', [new CourierController(), 'index']);
$router->get('/api/couriers/{id}', [new CourierController(), 'show']);



$router->get('/api/schedules', [new ScheduleController(), 'index']);
$router->post('/api/schedules', [new ScheduleController(), 'store']);
$router->get('/api/schedules/departure-date/{date}', [new ScheduleController(), 'getByDepartureDate']);
$router->get('/api/schedules/arrival-date/{date}', [new ScheduleController(), 'getByArrivalDate']);
