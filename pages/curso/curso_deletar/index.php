<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

$sql_cursos = "SELECT * FROM cursos WHERE id_curso = '$id' ";
$query_curso = $conn->query($sql_cursos) or die($conn->error);
$curso = $query_curso->fetch_assoc();

$nomeCurso = $curso['nome_curso'];

if (isset($_POST['deletarCurso'])) {
    $sql_code = "DELETE FROM cursos WHERE id_curso = '$id'";
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
    <title>Deletar Curso</title>

    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <h1>Deletar Curso?</h1>
    <br>
    <p><b>Nome:</b> <?php echo $nomeCurso ?> </p>

    <form method="POST">
        <button class="btn nao"><a href="../index.php">Não</a></button>
        <button class="btn sim" name="deletarCurso" type="submit">Sim</button>
    </form>


</body>

</html>