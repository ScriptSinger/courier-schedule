<?php

namespace Core;

class Router
{
    protected $routes = [];

    public function get(string $uri, callable $callback): void
    {
        $this->addRoute('GET', $uri, $callback);
    }

    public function post(string $uri, callable $callback): void
    {
        $this->addRoute('POST', $uri, $callback);
    }

    protected function addRoute(string $method, string $uri, callable $callback): void
    {
        // Преобразуем параметры {id} в регулярное выражение
        $uri = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $uri);
        $this->routes[] = [
            'method'   => strtoupper($method),
            'uri'      => "#^$uri$#",
            'callback' => $callback,
        ];
    }

    public function dispatch(string $requestUri, string $requestMethod): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($requestMethod) && preg_match($route['uri'], $requestUri, $matches)) {
                array_shift($matches); // Убираем полный совпадающий URL
                $params = array_values($matches); // Берем только числовые индексы
                echo call_user_func_array($route['callback'], $params);
                return;
            }
        }

        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => 'Route not found'], JSON_UNESCAPED_UNICODE);
    }
}
