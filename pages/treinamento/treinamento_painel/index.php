<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id_treinamento = intval($_GET['id']);

$sql_treinamentos = "SELECT * FROM treinamentos JOIN cursos ON treinamentos.id_curso = cursos.id_curso JOIN instrutor ON treinamentos.id_instrutor = instrutor.id_instrutor";
$query_treinamento = $conn->query($sql_treinamentos) or die($conn->error);
$treinamento_dados = $query_treinamento->fetch_assoc();

$idTreinamento = $treinamento_dados['id_treinamento'];
$codCurso = $treinamento_dados['cod_curso'];
$idInstrutor = $treinamento_dados['id_instrutor'];
$empresa = $treinamento_dados['empresa'];
$data_inicio = strtotime($treinamento_dados['data_inicio']);
$data_fim = $treinamento_dados['data_fim'];
$status = $treinamento_dados['status_treinamento'];

$nomeCurso = $treinamento_dados['nome_curso'];
$duracaoCurso = $treinamento_dados['duracao_curso'];

$nomeInstrutor = $treinamento_dados['nome_instrutor'];

$dataInicio = date("d/m/Y", $data_inicio);

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
    <title>Painel Treinamento</title>

    <link rel="stylesheet" href="">
</head>

<a href="../index.php">Voltar</a>
<br>

<body>
    <p><b>Curso:</b> <?php echo $nomeCurso ?> </p>
    <p><b>Empresa:</b> <?php echo $empresa ?> </p>
    <p><b>Instrutor:</b> <?php echo $nomeInstrutor ?> </p>
    <p><b>Duração:</b> <?php echo "$duracaoCurso Hrs" ?> </p>
    <p><b>Início:</b> <?php echo $dataInicio ?> </p>
    <p><b>Fim:</b> <?php echo $dataFim ?> </p>
    <p><b>Situação</b> <?php echo $status ?> </p>

    <a href="participantes/lista_participantes.php?id=<?php echo $id_treinamento ?>">Participantes</a>


</body>

</html>