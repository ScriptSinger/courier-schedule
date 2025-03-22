<?php

namespace App\Models;

use App\Database\DatabaseConnection;

class Schedule
{
    public static function all()
    {
        $db = DatabaseConnection::getInstance();
        $sql = "
            SELECT 
                s.id, 
                s.departure_date, 
                s.arrival_date,
                c.name AS courier_name, 
                r.name AS region_name
            FROM schedule s
            JOIN couriers c ON s.courier_id = c.id
            JOIN regions r ON s.region_id = r.id
        ";

        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        $db = DatabaseConnection::getInstance();
        $sql = 'SELECT * FROM schedule WHERE id = ?';
        $stmt = $db->query($sql, [$id]);
        return $stmt->fetch();
    }

    public static function isCourierBusy($courierId, $departureDate, $arrivalDate)
    {
        $db = DatabaseConnection::getInstance();
        $sql = 'SELECT 1 FROM schedule 
                WHERE courier_id = ? 
                AND (
                    (departure_date <= ? AND arrival_date >= ?) -- Новая поездка начинается внутри существующей
                    OR 
                    (departure_date <= ? AND arrival_date >= ?) -- Новая поездка заканчивается внутри существующей
                    OR 
                    (departure_date >= ? AND arrival_date <= ?) -- Новая поездка полностью внутри существующей
                    OR 
                    (departure_date <= ? AND arrival_date >= ?) -- Существующая поездка полностью внутри новой
                )';

        $stmt = $db->query($sql, [
            $courierId,
            $departureDate,
            $departureDate,
            $arrivalDate,
            $arrivalDate,
            $departureDate,
            $arrivalDate,
            $departureDate,
            $arrivalDate
        ]);

        return $stmt->fetch() !== false;
    }

    public static function create(array $data)
    {
        $db = DatabaseConnection::getInstance();
        $sql = 'INSERT INTO schedule (courier_id, region_id, departure_date, arrival_date) VALUES (?, ?, ?, ?)';
        $stmt = $db->query($sql, array_values($data));
        return $stmt->rowCount() > 0;
    }

    public static function delete($id)
    {
        // Удаление расписания по ID
        $db = DatabaseConnection::getInstance();
        $sql = 'DELETE FROM schedule WHERE id = ?';
        $db->query($sql, [$id]);

        return true;
    }

    public static function getByDepartureDate($date)
    {
        $db = DatabaseConnection::getInstance();
        $sql = '
            SELECT s.id, 
                   c.name AS courier_name, 
                   r.name AS region_name, 
                   s.departure_date, 
                   s.arrival_date 
            FROM schedule s
            JOIN couriers c ON s.courier_id = c.id
            JOIN regions r ON s.region_id = r.id
            WHERE s.departure_date = ?';

        $stmt = $db->query($sql, [$date]);
        return $stmt->fetchAll();
    }

    public static function getByArrivalDate($date)
    {
        $db = DatabaseConnection::getInstance();
        $sql = '
            SELECT s.id, 
                   c.name AS courier_name, 
                   r.name AS region_name, 
                   s.departure_date, 
                   s.arrival_date 
            FROM schedule s
            JOIN couriers c ON s.courier_id = c.id
            JOIN regions r ON s.region_id = r.id
            WHERE s.arrival_date = ?';

        $stmt = $db->query($sql, [$date]);
        return $stmt->fetchAll();
    }
}
