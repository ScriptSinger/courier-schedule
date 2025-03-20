<?php

require __DIR__ . '/../vendor/autoload.php';

use Core\Router;

// Инициализация маршрутизатора
$router = new Router();

// Подключение файла с определениями маршрутов
require __DIR__ . '/../routes/api.php';

// Получение текущего URI и метода запроса
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Обработка маршрутизации
$router->dispatch($requestUri, $requestMethod);
