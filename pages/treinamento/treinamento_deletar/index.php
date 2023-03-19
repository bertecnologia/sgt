<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

$sql_treinamentos = "SELECT * FROM treinamentos JOIN cursos ON treinamentos.id_curso = cursos.cod_curso JOIN instrutor ON treinamentos.id_instrutor = instrutor.id_instrutor";
$query_treinamento = $conn->query($sql_treinamentos) or die($conn->error);
$treinamento_dados = $query_treinamento->fetch_assoc();

$idTreinamento = $treinamento_dados['id_treinamento'];
$codCurso = $treinamento_dados['cod_curso'];
$idInstrutor = $treinamento_dados['id_instrutor'];
$empresa = $treinamento_dados['empresa'];
$data_inicio = $treinamento_dados['data_inicio'];
$data_fim = $treinamento_dados['data_fim'];
$status = $treinamento_dados['status_treinamento'];

$nomeCurso = $treinamento_dados['nome_curso'];

$dataInicio = $data_inicio;
$dataFim = $data_fim;

if ($data_inicio == NULL) {
    $dataInicio = "Indefinido";
}

if ($data_fim == NULL) {
    $dataFim = "Indefinido";
}




if (isset($_POST['deletarTreinamento'])) {
    $sql_code = "DELETE FROM treinamentos WHERE id_treinamento = '$id'";
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
    <title>Deletar Treinamento</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Tem certeza que deseja deletar esse treinamento?</h1>
    <h2>Essa ação é irreversível!</h2>
    <br>
    <p><b>Curso:</b> <?php echo $nomeCurso ?> </p>
    <p><b>Empresa:</b> <?php echo $empresa ?> </p>
    <p><b>Data Início:</b> <?php echo $dataInicio ?> </p>
    <p><b>Data Fim:</b> <?php echo $dataFim ?> </p>

    <form method="POST">
        <button class="btn nao"><a href="../index.php">Não</a></button>
        <button class="btn sim" name="deletarTreinamento" type="submit">Sim</button>
    </form>


</body>

</html>