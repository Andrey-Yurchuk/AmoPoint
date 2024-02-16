<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
    <title>Статистика посещений</title>
    <!-- Подключение библиотеки Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<h1>Статистика посещений</h1>

<!-- График посещений по часам -->
<div id="hourly-chart"></div>

<!-- Круговая диаграмма посещений по городам -->
<div id="city-chart"></div>

<?php

$servername = "localhost";
$username = "admin";
$password = "StrongPassword123!";
$dbname = "visits";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка соединения с базой данных: " . $conn->connect_error);
}

$hourlyVisits = [];
$cityVisits = [];

// Получаем количество уникальных посещений по часам
$hourlyQuery = "SELECT HOUR(timestamp) AS hour, COUNT(DISTINCT ip) AS unique_visits FROM visits GROUP BY HOUR(timestamp)";
$hourlyResult = $conn->query($hourlyQuery);
if ($hourlyResult->num_rows > 0) {
    while($row = $hourlyResult->fetch_assoc()) {
        $hourlyVisits[$row["hour"]] = $row["unique_visits"];
    }
}

// Получаем количество посещений по городам
$cityQuery = "SELECT city, COUNT(DISTINCT ip) AS unique_visits FROM visits GROUP BY city";
$cityResult = $conn->query($cityQuery);
if ($cityResult->num_rows > 0) {
    while($row = $cityResult->fetch_assoc()) {
        $cityVisits[$row["city"]] = $row["unique_visits"];
    }
}

$conn->close();
?>

<script>
    // Функция для отрисовки графика посещений по часам
    function drawHourlyChart() {
        const data = new google.visualization.DataTable();
        data.addColumn('string', 'Hour');
        data.addColumn('number', 'Unique Visits');

        <?php
        foreach ($hourlyVisits as $hour => $visits) {
            echo "data.addRow(['$hour:00', $visits]);";
        }
        ?>

        const options = {
            title: 'Посещения по часам',
            hAxis: {title: 'Час'},
            vAxis: {title: 'Уникальные посещения'}
        };

        const chart = new google.visualization.ColumnChart(document.getElementById('hourly-chart'));
        chart.draw(data, options);
    }

    // Функция для отрисовки круговой диаграммы посещений по городам
    function drawCityChart() {
        const data = new google.visualization.DataTable();
        data.addColumn('string', 'City');
        data.addColumn('number', 'Unique Visits');

        <?php
        foreach ($cityVisits as $city => $visits) {
            echo "data.addRow(['$city', $visits]);";
        }
        ?>

        const options = {
            title: 'Посещения по городам',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('city-chart'));
        chart.draw(data, options);
    }

    // Загрузка библиотеки Google Charts и отрисовка графиков
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(function() {
        drawHourlyChart();
        drawCityChart();
    });
</script>

</body>
</html>
