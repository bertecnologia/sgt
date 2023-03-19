<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "sgt";
$port = "3306";

$conn = new mysqli($hostname, $username, $password, $database, $port);
$conn->set_charset("utf8");

if ($conn->error) {
    die("Falha ao se conectar ao banco de dados" . $conn->error);
}

