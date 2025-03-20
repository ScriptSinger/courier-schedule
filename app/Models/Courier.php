<?php

namespace App\Models;

use App\Database\DatabaseConnection;

class Courier
{
    protected DatabaseConnection $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance();
    }

    public function getAll(): array
    {
        return $this->db->query("SELECT * FROM couriers")->fetchAll();
    }
}
