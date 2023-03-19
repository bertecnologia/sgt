<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

$sql_funcionarios = "SELECT * FROM funcionarios WHERE id_funcionario = '$id' ";
$query_funcionario = $conn->query($sql_funcionarios) or die($conn->error);
$funcionario = $query_funcionario->fetch_assoc();

$nomeV = $funcionario['nome_funcionario'];
$sobrenomeV = $funcionario['sobrenome_funcionario'];
$nomeCompleto = "$nomeV $sobrenomeV";

if (isset($_POST['deletarFuncionario'])) {
    $sql_code = "DELETE FROM funcionarios WHERE id_funcionario = '$id'";
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
    <title>Deletar Funcionário</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Deletar funcionário: <?php echo $nomeCompleto ?> ?</h1>

    <form method="POST">
        <button class="btn nao"><a href="../index.php">Não</a></button>
        <button class="btn sim" name="deletarFuncionario" type="submit">Sim</button>
    </form>


</body>

</html>