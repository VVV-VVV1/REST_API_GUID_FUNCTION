<?php

$host = 'db';
$db_name = 'appDB';
$username = 'user';
$password = 'password';


# $conn = new mysqli($host, $username, $password, $database);

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
?>
