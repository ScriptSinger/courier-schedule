<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Models\Courier;
use Core\Request;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::all();
        return $this->jsonResponse($couriers);  // Возвращаем результат в формате JSON
    }

    public function show($id)
    {
        $courier = Courier::find($id);

        if (!$courier) {
            http_response_code(404);
            return json_encode(['error' => 'Courier not found'], JSON_UNESCAPED_UNICODE);
        }

        return json_encode($courier, JSON_UNESCAPED_UNICODE);
    }

    public function store()
    {

        $request = new Request();

        $name = $request->input('name');


        // Получаем данные из запроса
        // $data = $request->all();

        var_dump($name);
        die;

        // Проверяем, передано ли имя курьера
        if (!$request->input('name')) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(['error' => 'Name is required']);
            return;
        }

        // Создаем курьера
        Courier::create($data);

        // Отправляем успешный ответ
        header("HTTP/1.1 201 Created");
        echo json_encode(['message' => 'Courier created successfully']);
    }
}
