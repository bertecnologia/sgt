<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

$sql_veiculos = "SELECT * FROM veiculos WHERE id_veiculo = '$id' ";
$query_veiculo = $conn->query($sql_veiculos) or die($conn->error);
$veiculo = $query_veiculo->fetch_assoc();

$modeloVeiculo = $veiculo['modelo_veiculo'];
$placaVeiculo = $veiculo['placa_veiculo'];

if (isset($_POST['deletarVeiculo'])) {
    $sql_code = "DELETE FROM veiculos WHERE id_veiculo = '$id'";
    $sql_query = $conn->query($sql_code) or die($conn->error);

    if ($sql_query) {
        header('Location: ../index.php');
    } else {
        echo "<script> alert('Erro') </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Veículo</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Deletar veículo?</h1>
    <br>
    <p><b>Modelo:</b> <?php echo $modeloVeiculo ?> </p>
    <p><b>Placa:</b> <?php echo $placaVeiculo ?> </p>

    <form method="POST">
        <button class="btn nao"><a href="../index.php">Não</a></button>
        <button class="btn sim" name="deletarVeiculo" type="submit">Sim</button>
    </form>


</body>

</html>