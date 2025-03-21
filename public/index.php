<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\Router;

// Инициализация маршрутизатора
$router = new Router();

require __DIR__ . '/../routes/api.php';  // API маршруты
require __DIR__ . '/../routes/web.php';  // Веб маршруты

// Получение текущего URI и метода запроса
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Обработка маршрутизации
$router->dispatch($requestUri, $requestMethod);
