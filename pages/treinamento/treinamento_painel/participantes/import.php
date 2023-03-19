<?php

require_once 'connect.php';

$id = intval($_POST['id']);


if (isset($_FILES['arquivo_csv'])) {
    if ($_FILES['arquivo_csv']['error'] == UPLOAD_ERR_OK) {
        $arquivo_temporario = $_FILES['arquivo_csv']['tmp_name'];
        $file = fopen($arquivo_temporario, 'r');
        $headers = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $nome = $row[1];
            $cpf = preg_replace("/[^0-9]/", "", $row[2]);

            $sql = "SELECT * FROM participantes WHERE cpf = '$cpf' AND id_treinamento = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "Já existe um registro com o CPF $cpf e id diferente de 1.";
            } else {
                $sql = "INSERT INTO participantes (nome, cpf, id_treinamento) VALUES ('$nome', '$cpf', '$id')";
                $insere = $conn->query($sql);
            }
        }

        fclose($file);
        $conn->close();

        header("Location: lista_participantes.php?id=$id");
    } else {
        echo 'Erro ao carregar arquivo.';
    }
}
