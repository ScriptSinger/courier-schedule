<?php

namespace App\Controllers;

use App\Models\Courier;

class ScheduleController
{
    public function index()
    {
        $courierModel = new Courier();
        $couriers = $courierModel->getAll();



        echo '<pre>';
        var_dump($couriers);
        echo '</pre>';
    }
}
