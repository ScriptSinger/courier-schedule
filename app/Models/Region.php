<?php

namespace App\Models;

use App\Database\DatabaseConnection;

class Region
{

    public static function all()
    {
        $db = DatabaseConnection::getInstance();
        $sql = 'SELECT * FROM regions';
        $stmt = $db->query($sql);

        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        $db = DatabaseConnection::getInstance();
        $sql = 'SELECT * FROM regions WHERE id = ?';
        $stmt = $db->query($sql, [$id]);
        return $stmt->fetch();
    }
}
