<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

$sql_usuarios = "SELECT * FROM usuarios WHERE id_usuario = '$id' ";
$query_usuario = $conn->query($sql_usuarios) or die($conn->error);
$usuario = $query_usuario->fetch_assoc();

$nomeUsuario = $usuario['nome_usuario'];
$emailUsuario = $usuario['email_usuario'];

if (isset($_POST['deletarUsuario'])) {
    $sql_code = "DELETE FROM usuarios WHERE id_usuario = '$id'";
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
    <title>Deletar usuário</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Tem certeza que deseja deletar esse usuário ?</h1>
    <br>
    <p><b>Nome:</b><?php echo $nomeUsuario ?></p>
    <p><b>E-mail</b><?php echo $emailUsuario ?></p>

    <form method="POST">
        <button class="btn nao"><a href="../index.php">Não</a></button>
        <button class="btn sim" name="deletarUsuario" type="submit">Sim</button>
    </form>


</body>

</html>