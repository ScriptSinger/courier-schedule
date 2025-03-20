<?php

namespace Core;

class Router
{
    /**
     * @var array Массив зарегистрированных маршрутов
     */
    protected $routes = [];

    /**
     * Регистрация GET маршрута.
     *
     * @param string   $uri      URI маршрута
     * @param callable $callback Замыкание или метод контроллера для обработки запроса
     */
    public function get(string $uri, callable $callback): void
    {
        $this->addRoute('GET', $uri, $callback);
    }

    /**
     * Регистрация POST маршрута.
     *
     * @param string   $uri      URI маршрута
     * @param callable $callback Замыкание или метод контроллера для обработки запроса
     */
    public function post(string $uri, callable $callback): void
    {
        $this->addRoute('POST', $uri, $callback);
    }

    /**
     * Метод регистрации маршрута.
     *
     * @param string   $method   HTTP метод (GET, POST, etc.)
     * @param string   $uri      URI маршрута
     * @param callable $callback Замыкание или метод контроллера
     */
    protected function addRoute(string $method, string $uri, callable $callback): void
    {
        $this->routes[] = [
            'method'   => strtoupper($method),
            'uri'      => $uri,
            'callback' => $callback,
        ];
    }

    /**
     * Обработка входящего запроса.
     *
     * @param string $requestUri    URI запроса
     * @param string $requestMethod HTTP метод запроса
     */
    public function dispatch(string $requestUri, string $requestMethod): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($requestMethod) && $route['uri'] === $requestUri) {
                echo call_user_func($route['callback']);
                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}
