<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Models\Region;

use App\Models\Schedule;

use Core\Request;
use DateTime;

class ScheduleController extends  Controller
{
    public function index()
    {
        $schedules = Schedule::all();

        return $this->jsonResponse($schedules);
    }

    public function store()
    {
        $request = new Request();

        $region = Region::find($request->input('region_id'));

        $data = [
            'courier_id' => $request->input('courier_id'),
            'region_id' => $request->input('region_id'),
            'departure_date' => $request->input('departure_date')
        ];


        // Создаем объект DateTime для даты отправления
        $departureDate = new DateTime($data['departure_date']);

        // Прибавляем количество дней из travel_days
        $departureDate->modify('+' . $region['travel_days'] . ' days');

        // Получаем дату прибытия в нужном формате
        $arrivalDate = $departureDate->format('Y-m-d');

        // Добавляем вычисленную дату прибытия в массив данных
        $data['arrival_date'] = $arrivalDate;

        // Проверяем, не занят ли курьер в этот период для указанного региона
        if (Schedule::isCourierBusy($data['courier_id'], $data['region_id'], $data['departure_date'], $arrivalDate)) {
            return $this->jsonResponse([
                'message' => 'Курьер уже занят в этом регионе на указанные даты.'
            ], 400); // Код 400 - Bad Request
        }

        $result = Schedule::create($data);

        return $this->jsonResponse([
            'message' => 'Поездка успешно добавлена.',
            'data' => $result
        ], 201); // Код 201 - Created
    }


    // Метод для получения расписания по дате выезда
    public function getByDepartureDate($date)
    {
        $schedules = Schedule::getByDepartureDate($date);
        return $this->jsonResponse($schedules);
    }

    // Метод для получения расписания по дате прибытия
    public function getByArrivalDate($date)
    {
        $schedules = Schedule::getByArrivalDate($date);
        return $this->jsonResponse($schedules);
    }
}
