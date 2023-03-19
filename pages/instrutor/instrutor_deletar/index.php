<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

$sql_instrutores = "SELECT * FROM instrutor WHERE id_instrutor = '$id' ";
$query_instrutor = $conn->query($sql_instrutores) or die($conn->error);
$instrutor = $query_instrutor->fetch_assoc();

$nomeInstrutor = $instrutor['nome_instrutor'];

if (isset($_POST['deletarInstrutor'])) {
    $sql_code = "DELETE FROM instrutor WHERE id_instrutor = '$id'";
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
    <title>Deletar Instrutor</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Deletar instrutor: <?php echo $nomeInstrutor ?>?</h1>

    <form method="POST">
        <button class="btn nao"><a href="../index.php">Não</a></button>
        <button class="btn sim" name="deletarInstrutor" type="submit">Sim</button>
    </form>


</body>

</html>