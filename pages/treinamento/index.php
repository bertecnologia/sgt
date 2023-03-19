<?php

include_once('../../connect.php');
include_once('../../config.php');

$sql_treinamentos = "SELECT * FROM treinamentos JOIN cursos ON treinamentos.id_curso = cursos.id_curso JOIN instrutor ON treinamentos.id_instrutor = instrutor.id_instrutor";
$query_treinamentos = $conn->query($sql_treinamentos) or die($conn->error);
$qtd_treinamentos = $query_treinamentos->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treinamentos</title>
</head>

<body>

    <h1>Lista de Treinamentos</h1>
    <h3>Treinamentos cadastrados</h3>
    <a class="btn new" href="treinamento_novo/index.php">+ Novo Treinamento</a>
    <br><br><br>

    <table border="1" cellpadding="10">
        <thead>
            <th>Treinamento</th>
            <th>Instrutor</th>
            <th>Empresa</th>
            <th>Duração</th>
            <th>Início</th>
            <th>Fim</th>
            <th>Situação</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php if ($qtd_treinamentos == 0) { ?>
                <tr>
                    <td colspan="8">Nenhum treinamento cadastrado.</td>
                </tr>
                <?php } else {
                while ($treinamento_dados = $query_treinamentos->fetch_assoc()) {

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

                ?>
                    <tr>
                        <td><?php echo $nomeCurso ?></td>
                        <td><?php echo $nomeInstrutor ?></td>
                        <td><?php echo $empresa ?></td>
                        <td><?php echo "$duracaoCurso Hrs" ?></td>
                        <td><?php echo $dataInicio ?></td>
                        <td><?php echo $dataFim ?></td>
                        <td><?php echo $status ?></td>

                        <td>
                            <a class="btn edit" href="treinamento_painel/index.php?id=<?php echo $treinamento_dados['id_treinamento'] ?>">Abrir</a>

                            <a class="btn del" href="treinamento_deletar/index.php?id=<?php echo $treinamento_dados['id_treinamento'] ?>">Deletar</a>

                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <button style="margin-top: 20px;"><a href="../../index.php">Menu</a></button>
</body>

</html>

<style>
    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    .btn {
        border: 1px solid black;
        border-radius: 5px;
        padding: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .del {
        color: black;
        background-color: #f28080;
    }

    .del:hover {
        background-color: #f04a4a;
    }

    .edit {
        color: black;
        background-color: #05fca1;
    }

    .edit:hover {
        background-color: #02eb48;
    }

    .new {
        color: black;
        background-color: #4dd0f7;
    }

    .new:hover {
        background-color: #168ede;
    }
</style>