$(document).ready(function () {
  // Функция для загрузки курьеров
  function loadCouriers() {
    $.ajax({
      url: "/api/couriers", // Эндпоинт для получения списка курьеров
      type: "GET",
      success: function (response) {
        if (response && Array.isArray(response)) {
          const courierSelect = $("#courier_name");
          courierSelect.empty(); // Очищаем список
          courierSelect.append('<option value="">Выберите курьера</option>'); // Начальный элемент

          // Заполняем список курьеров
          response.forEach((courier) => {
            courierSelect.append(
              `<option value="${courier.id}">${courier.name}</option>`
            );
          });
        } else {
          $("#formMessage").html(
            '<div class="alert alert-danger">Не удалось загрузить курьеров.</div>'
          );
        }
      },
      error: function () {
        $("#formMessage").html(
          '<div class="alert alert-danger">Ошибка при загрузке курьеров.</div>'
        );
      },
    });
  }

  // Функция для загрузки регионов
  function loadRegions() {
    $.ajax({
      url: "/api/regions", // Эндпоинт для получения списка регионов
      type: "GET",
      success: function (response) {
        if (response && Array.isArray(response)) {
          const regionSelect = $("#region_name");
          regionSelect.empty(); // Очищаем список
          regionSelect.append('<option value="">Выберите регион</option>'); // Начальный элемент

          // Заполняем список регионов
          response.forEach((region) => {
            regionSelect.append(
              `<option value="${region.id}">${region.name}</option>`
            );
          });
        } else {
          $("#formMessage").html(
            '<div class="alert alert-danger">Не удалось загрузить регионы.</div>'
          );
        }
      },
      error: function () {
        $("#formMessage").html(
          '<div class="alert alert-danger">Ошибка при загрузке регионов.</div>'
        );
      },
    });
  }

  // Загружаем курьеров и регионы при загрузке страницы
  loadCouriers();
  loadRegions();

  // Обработчик для отправки формы добавления поездки
  $("#addTripForm").on("submit", function (e) {
    e.preventDefault(); // Предотвращаем стандартное поведение формы

    // Очищаем предыдущие сообщения
    $("#formMessage").empty();

    // Собираем данные из формы
    const formData = {
      courier_id: $("#courier_name").val(), // отправляем ID курьера
      region_id: $("#region_name").val(), // отправляем ID региона
      departure_date: $("#departure_date_add").val(), // дата отправления
    };

    // Проверка на пустые поля формы
    if (
      !formData.courier_id ||
      !formData.region_id ||
      !formData.departure_date
    ) {
      $("#formMessage").html(
        '<div class="alert alert-warning">Пожалуйста, заполните все обязательные поля.</div>'
      );
      return;
    }

    // Логируем отправляемые данные для отладки
    console.log("Отправляемые данные:", formData);

    // Делаем запрос на сервер

    $.ajax({
      url: "/api/schedules", // Эндпоинт, куда отправляем данные
      type: "POST",
      contentType: "application/json", // Устанавливаем тип контента как JSON
      data: JSON.stringify(formData), // Преобразуем объект в JSON
      success: function (response) {
        // Логируем весь ответ для проверки
        console.log("Ответ сервера:", response);

        // Проверяем наличие ключей "message" и "data" в ответе
        if (response && response.message) {
          if (response.data) {
            $("#formMessage").html(
              `<div class="alert alert-success">${response.message}</div>`
            );
            // Очищаем форму
            $("#addTripForm")[0].reset();
          } else {
            $("#formMessage").html(
              `<div class="alert alert-danger">${response.message}</div>`
            );
          }
        } else {
          $("#formMessage").html(
            '<div class="alert alert-danger">Неверный формат ответа от сервера.</div>'
          );
        }
      },
      error: function (xhr, status, error) {
        // Логируем ответ на случай ошибок
        console.error("Ошибка при отправке запроса:", xhr.responseText);

        // Обработка ошибок
        let errorMessage = "Произошла ошибка при отправке запроса";
        try {
          const response = JSON.parse(xhr.responseText);
          errorMessage = response.message || errorMessage;
        } catch (e) {
          errorMessage = "Не удалось обработать ответ от сервера.";
        }

        $("#formMessage").html(
          `<div class="alert alert-danger">${errorMessage}</div>`
        );
      },
    });
  });
});
