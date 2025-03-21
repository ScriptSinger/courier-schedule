<?php

namespace App\Controllers\Web;

use App\Models\Schedule;
use Core\View;

class WelcomeController
{
    public function index()
    {

        $schedules = Schedule::all();






        // var_dump($schedules);
        // die;

        // Данные для отображения
        $data = [
            'schedules' => $schedules
        ];
        // Инициализация шаблонизатора
        $view = new View();

        // Рендерим шаблон и выводим результат
        echo $view->render('index', $data);
    }
}
