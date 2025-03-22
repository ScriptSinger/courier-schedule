-- Устанавливаем кодировку
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Очистка таблиц перед вставкой (если данные уже есть)
TRUNCATE TABLE couriers;
TRUNCATE TABLE regions; 

-- Наполнение таблицы курьеров (10 человек)
INSERT INTO couriers (name) VALUES 
('Иван Иванов'),
('Петр Петров'),
('Алексей Смирнов'),
('Сергей Кузнецов'),
('Дмитрий Васильев'),
('Андрей Соколов'),
('Максим Попов'),
('Егор Лебедев'),
('Владимир Козлов'),
('Артем Новиков');

-- Наполнение таблицы регионов (10 регионов)
INSERT INTO regions (name, travel_days) VALUES 
('Санкт-Петербург', 2),
('Уфа', 3),
('Нижний Новгород', 1),
('Владимир', 1),
('Кострома', 2),
('Екатеринбург', 4),
('Ковров', 1),
('Воронеж', 2),
('Самара', 3),
('Астрахань', 5);



-- Очистка таблицы перед вставкой (если данные уже есть)
TRUNCATE TABLE schedule;

-- Заполнение данными о поездках за последние 3 месяца
INSERT INTO schedule (courier_id, region_id, departure_date, arrival_date)
SELECT 
    c.id AS courier_id,
    r.id AS region_id,
    DATE_ADD(CURDATE(), INTERVAL -FLOOR(RAND() * 90) DAY) AS departure_date,
    DATE_ADD(CURDATE(), INTERVAL -FLOOR(RAND() * 90) + r.travel_days DAY) AS arrival_date
FROM couriers c
JOIN regions r 
ON RAND() < 0.5 -- 50% вероятность поездки в этот регион
ORDER BY RAND()
LIMIT 100; -- Можно увеличить число записей при необходимости










SET FOREIGN_KEY_CHECKS = 1;