<?php

namespace App\Models;

use App\Database\DatabaseConnection;

class Courier
{
    public static function all()
    {
        // Получаем всех курьеров
        $db = DatabaseConnection::getInstance();
        $sql = 'SELECT * FROM couriers';
        $stmt = $db->query($sql);

        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        // Поиск курьера по ID
        $db = DatabaseConnection::getInstance();
        $sql = 'SELECT * FROM couriers WHERE id = ?';
        $stmt = $db->query($sql, [$id]);
        return $stmt->fetch();
    }

    public static function create(array $data)
    {
        // Создание нового курьера
        $db = DatabaseConnection::getInstance();
        $sql = 'INSERT INTO couriers (name) VALUES (?)';
        $db->query($sql, [$data['name']]);

        return true;
    }

    public static function update($id, array $data)
    {
        // Обновление данных курьера по ID
        $db = DatabaseConnection::getInstance();
        $sql = 'UPDATE couriers SET name = ? WHERE id = ?';
        $db->query($sql, [$data['name'], $id]);

        return true;
    }

    public static function delete($id)
    {
        // Удаление курьера по ID
        $db = DatabaseConnection::getInstance();
        $sql = 'DELETE FROM couriers WHERE id = ?';
        $db->query($sql, [$id]);

        return true;
    }
}
