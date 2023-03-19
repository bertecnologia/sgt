<?php
require_once 'connect.php';

$id_treinamento = $_POST['id_treinamento'];
$participantes = json_decode(json_encode($_POST['participantes']), true);

foreach ($participantes as $participante) {
    $id = $participante['id'];
    $nome = $participante['nome'];
    $cpf = $participante['cpf'];

    if (empty($id)) {
        $sql = "INSERT INTO participantes (nome, cpf, id_treinamento) VALUES ('$nome', '$cpf', '$id_treinamento')";
        $result = $conn->query($sql);
    } else {
        $sql = "UPDATE participantes SET nome = '$nome', cpf = '$cpf' WHERE id = '$id' AND id_treinamento = '$id_treinamento'";
        $result = $conn->query($sql);
    }

    if (!$result) {
        echo 'error';
        exit;
    }
}

echo 'success';
$conn->close();
?>
