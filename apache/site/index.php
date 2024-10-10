<?php
// Установка заголовков для REST API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Устанавливаем соединение с базой данных
$host = 'db';  // или просто 'localhost', если порт по умолчанию
$username = 'user';
$password = 'password';
$database = 'appDB';

//$mysqli = new mysqli("db", "user", "password", "appDB");
$mysqli = new mysqli($host, $username, $password, $database);

// Проверка соединения
if ($mysqli->connect_error) {
    die(json_encode(array("message" => "Connection failed: " . $mysqli->connect_error)));
}

// Обработка запроса
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            getDataById($_GET['id']);
        } else {
            getData();
        }
        break;

    case 'POST':
        postData();
        break;

    case 'PUT':
        putData();
        break;

    case 'DELETE':
        deleteData();
        break;

    default:
        echo json_encode(array("message" => "Invalid Request"));
        break;
}

// Функции обработки запросов
function getData() {
    global $mysqli;
    $sql = "SELECT * FROM users";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array("message" => "No data found"));
    }
}

function getDataById($id) {
    global $mysqli;
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array("message" => "Пользователь не найден"));
    }
}

function postData() {
    global $mysqli;
    $input = json_decode(file_get_contents('php://input'), true);

    $name = $mysqli->real_escape_string($input['name']);
    $surname = $mysqli->real_escape_string($input['surname']);

    $sql = "INSERT INTO users (name, surname) VALUES ('$name', '$surname')";

    if ($mysqli->query($sql) === TRUE) {
        echo json_encode(array("message" => "Record created successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $mysqli->error));
    }
}

function putData() {
    global $mysqli;
    $input = json_decode(file_get_contents('php://input'), true);

    $id = $mysqli->real_escape_string($input['id']);
    $name = $mysqli->real_escape_string($input['name']);
    $surname = $mysqli->real_escape_string($input['surname']);

    $sql = "UPDATE users SET name='$name', surname='$surname' WHERE id='$id'";

    if ($mysqli->query($sql) === TRUE) {
        echo json_encode(array("message" => "Record updated successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $mysqli->error));
    }
}

function deleteData() {
    global $mysqli;
    $input = json_decode(file_get_contents('php://input'), true);

    $id = $mysqli->real_escape_string($input['id']);

    $sql = "DELETE FROM users WHERE id='$id'";

    if ($mysqli->query($sql) === TRUE) {
        echo json_encode(array("message" => "Record deleted successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $mysqli->error));
    }
}

// Закрытие соединения
$mysqli->close();
?>
