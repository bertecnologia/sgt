<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

$sql_empresas = "SELECT * FROM empresas WHERE id_empresa = '$id' ";
$query_empresa = $conn->query($sql_empresas) or die($conn->error);
$empresa = $query_empresa->fetch_assoc();

$nomeEmpresa = $empresa['nome_empresa'];
$unidadeEmpresa = $empresa['unidade_empresa'];

if (isset($_POST['deletarEmpresa'])) {
    $sql_code = "DELETE FROM empresas WHERE id_empresa = '$id'";
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
    <title>Deletar Empresa</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Deletar empresa: <?php echo $nomeEmpresa ?> ?</h1>
    <h2>Unidade: <?php echo $unidadeEmpresa ?></h2>


    <form method="POST">
        <button class="btn nao"><a href="../index.php">Não</a></button>
        <button class="btn sim" name="deletarEmpresa" type="submit">Sim</button>
    </form>


</body>

</html>