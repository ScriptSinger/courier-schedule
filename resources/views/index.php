<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление поездками</title>

    <!-- Подключение Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <!-- Навигационная панель -->
        <ul class="nav nav-tabs" id="tripTabs">
            <li class="nav-item">
                <a class="nav-link active" id="view-tab" data-bs-toggle="tab" href="#viewTrips">Просмотр поездок</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="add-tab" data-bs-toggle="tab" href="#addTrip">Добавить поездку</a>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <!-- Раздел просмотра поездок -->
            <div class="tab-pane fade show active" id="viewTrips">
                <h1 class="text-center mb-4">Поездки курьеров в регионы</h1>

                <!-- Форма фильтрации -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="departure_date" class="form-label">Дата выезда</label>
                        <input type="date" class="form-control" id="departure_date">
                        <button id="filterByDeparture" class="btn btn-primary mt-2 w-100">Фильтровать</button>
                    </div>

                    <div class="col-md-4">
                        <label for="arrival_date" class="form-label">Дата прибытия</label>
                        <input type="date" class="form-control" id="arrival_date">
                        <button id="filterByArrival" class="btn btn-primary mt-2 w-100">Фильтровать</button>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button id="resetFilter" class="btn btn-secondary w-100">Сбросить фильтр</button>
                    </div>
                </div>

                <!-- Таблица с поездками -->
                <div id="message" class="mt-4"></div>
                <table class="table" id="scheduleTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Курьер</th>
                            <th>Регион</th>
                            <th>Дата выезда</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- Данные загружаются динамически -->
                    </tbody>
                </table>
            </div>


            <!-- Раздел добавления поездки -->
            <div class="tab-pane fade" id="addTrip">
                <h1 class="text-center mb-4">Добавить новую поездку</h1>
                <form id="addTripForm">
                    <div class="mb-3">
                        <label for="courier_name" class="form-label">Имя курьера</label>
                        <!-- Селект для выбора курьера -->
                        <select class="form-control" id="courier_name" required>
                            <option value="">Выберите курьера</option>
                            <!-- Данные курьеров будут загружены через JavaScript -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="region_name" class="form-label">Регион</label>
                        <!-- Селект для выбора региона -->
                        <select class="form-control" id="region_name" required>
                            <option value="">Выберите регион</option>
                            <!-- Данные регионов будут загружены через JavaScript -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="departure_date_add" class="form-label">Дата выезда</label>
                        <input type="date" class="form-control" id="departure_date_add" required>
                    </div>

                    <!-- Место для вывода сообщений внутри формы -->
                    <div id="formMessage" class="mt-4"></div>



                    <button type="submit" class="btn btn-success w-100">Добавить поездку</button>
                </form>
            </div>



        </div>
    </div>

    <!-- Подключение Bootstrap JS и jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Подключение внешнего JS -->
    <script src="public/assets/js/app.js"></script>
    <script src="public/assets/js/add-trip.js"></script>

</body>

</html>