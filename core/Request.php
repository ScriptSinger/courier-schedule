<?php

namespace Core;

class Request
{
    private array $query;
    private array $body;

    public function __construct()
    {
        // Получаем GET-параметры
        $this->query = $_GET ?? [];
        // Получаем тело запроса (POST, PUT, DELETE и т.д.)
        $input = file_get_contents("php://input");
        $this->body = json_decode($input, true) ?? [];
    }

    /**
     * Получить GET-параметр
     */
    public function query(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    /**
     * Получить POST/JSON параметр
     */
    public function input(string $key, mixed $default = null): mixed
    {
        return $this->body[$key] ?? $default;
    }

    /**
     * Получить все GET-параметры
     */
    public function allQuery(): array
    {
        return $this->query;
    }

    /**
     * Получить все POST/JSON параметры
     */
    public function all(): array
    {
        return $this->body;
    }
}
