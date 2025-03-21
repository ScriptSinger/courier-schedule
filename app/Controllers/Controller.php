<?php

namespace App\Controllers;

class Controller
{
    /**
     * Устанавливает заголовки для JSON-ответа
     */
    protected function setJsonHeaders(int $statusCode)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
    }

    /**
     * Метод для ответа с данными в формате JSON
     *
     * @param mixed $data
     * @param int   $statusCode
     */
    protected function jsonResponse($data, int $statusCode = 200)
    {
        $this->setJsonHeaders($statusCode);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Метод для обработки ошибок (например, 404, 500 и т.д.)
     *
     * @param string|array $message
     * @param int          $statusCode
     */
    protected function errorResponse($message, int $statusCode = 500)
    {
        $this->setJsonHeaders($statusCode);

        // Если сообщение - это массив ошибок, преобразуем его в строку
        if (is_array($message)) {
            $message = implode(', ', $message);
        }

        echo json_encode(['error' => $message], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Метод для получения данных из тела запроса (если запрос в формате JSON)
     *
     * @return mixed
     */
    protected function getJsonData()
    {
        return json_decode(file_get_contents('php://input'), true);
    }
}
