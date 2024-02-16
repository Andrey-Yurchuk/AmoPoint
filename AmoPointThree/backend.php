<?php

// Получение данных от JavaScript-счетчика
$data = json_decode(file_get_contents("php://input"));

$servername = "localhost";
$username = "admin";
$password = "StrongPassword123!";
$dbname = "visits";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка соединения с базой данных: " . $conn->connect_error);
}

// Подготовка и выполнение SQL-запроса для вставки данных о посещении в базу данных
$stmt = $conn->prepare("INSERT INTO visits (ip, city, device) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $data->ip, $data->city, $data->device);
$stmt->execute();

$stmt->close();
$conn->close();

