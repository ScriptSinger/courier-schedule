<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Models\Region;


use Core\Request;

class RegionController extends Controller
{
    public function index()
    {
        $couriers = Region::all();
        return $this->jsonResponse($couriers);
    }
}
