$(document).ready(function () {
  // Функция для загрузки списка поездок
  function loadTrips(url) {
    $.ajax({
      url: url,
      method: "GET",
      dataType: "json",
      success: function (response) {
        // Очищаем текущий список
        $("#scheduleTable tbody").empty();

        // Проверяем, есть ли поездки
        if (response.length === 0) {
          $("#scheduleTable tbody").append(
            '<tr><td colspan="5" class="text-center">Поездки не найдены</td></tr>'
          );
        } else {
          response.forEach(function (trip) {
            var row =
              "<tr>" +
              "<td>" +
              trip.id +
              "</td>" +
              "<td>" +
              trip.courier_name +
              "</td>" + // Теперь выводим имя курьера
              "<td>" +
              trip.region_name +
              "</td>" + // Теперь выводим название региона
              "<td>" +
              trip.departure_date +
              "</td>" +
              "<td>" +
              trip.arrival_date +
              "</td>" +
              "</tr>";
            $("#scheduleTable tbody").append(row);
          });
        }
      },
      error: function (xhr) {
        $("#message").html(
          '<div class="alert alert-danger">Ошибка загрузки данных: ' +
            xhr.statusText +
            "</div>"
        );
      },
    });
  }

  // Загружаем все поездки при загрузке страницы
  loadTrips("api/schedules");

  // Фильтр по дате выезда
  $("#filterByDeparture").on("click", function () {
    var departureDate = $("#departure_date").val();
    if (departureDate) {
      loadTrips("api/schedules/departure-date/" + departureDate);
    } else {
      alert("Выберите дату выезда!");
    }
  });

  // Фильтр по дате прибытия
  $("#filterByArrival").on("click", function () {
    var arrivalDate = $("#arrival_date").val();
    if (arrivalDate) {
      loadTrips("api/schedules/arrival-date/" + arrivalDate);
    } else {
      alert("Выберите дату прибытия!");
    }
  });

  // Сброс фильтра
  $("#resetFilter").on("click", function () {
    $("#departure_date").val("");
    $("#arrival_date").val("");
    loadTrips("api/schedules");
  });
});
