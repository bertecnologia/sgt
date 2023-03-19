<?php
require_once 'connect.php';

$id = $_POST['id'];

$sql = "DELETE FROM participantes WHERE id = '$id'";
$result = $conn->query($sql);

if ($result) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
