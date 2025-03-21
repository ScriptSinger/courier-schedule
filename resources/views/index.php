<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вывод поездок</title>

    <!-- Подключение Bootstrap CSS через CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Поездки курьеров в регионы</h1>

        <!-- Форма для фильтрации -->
        <div class="row mb-4">
            <!-- Фильтр по дате выезда -->
            <div class="col-md-4">
                <label for="departure_date" class="form-label">Дата выезда</label>
                <input type="date" class="form-control" id="departure_date">
                <button id="filterByDeparture" class="btn btn-primary mt-2 w-100">Фильтровать по дате выезда</button>
            </div>

            <!-- Фильтр по дате прибытия -->
            <div class="col-md-4">
                <label for="arrival_date" class="form-label">Дата прибытия</label>
                <input type="date" class="form-control" id="arrival_date">
                <button id="filterByArrival" class="btn btn-primary mt-2 w-100">Фильтровать по дате прибытия</button>
            </div>

            <!-- Кнопка сброса фильтров -->
            <div class="col-md-4 d-flex align-items-end">
                <button id="resetFilter" class="btn btn-secondary w-100">Сбросить фильтр</button>
            </div>
        </div>

        <!-- Место для отображения списка поездок -->
        <div id="message" class="mt-4"></div>

        <table class="table" id="scheduleTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Курьер</th>
                    <th>Регион</th>
                    <th>Дата выезда</th>
                    <th>Дата прибытия</th>
                </tr>
            </thead>
            <tbody>
                <!-- Данные будут добавляться сюда динамически -->
            </tbody>
        </table>
    </div>

    <!-- Подключение Bootstrap JS и jQuery через CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Подключение внешнего скрипта для работы с Ajax -->
    <script src="public/assets/js/app.js"></script>
</body>

</html>