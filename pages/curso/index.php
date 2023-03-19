<?php

include_once('../../connect.php');
include_once('../../config.php');

$sql_cursos = "SELECT * FROM cursos";
$query_cursos = $conn->query($sql_cursos) or die($conn->error);
$qtd_cursos = $query_cursos->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Lista de Cursos / NRs</h1>
    <h3>Cursos cadastrados</h3>
    <a class="btn new" href="curso_novo/index.php">+ Novo Curso</a>
    <br><br><br>

    <table border="1" cellpadding="10">
        <thead>
            <th>Nome</th>
            <th>Cod</th>
            <th>Duração</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php if ($qtd_cursos == 0) { ?>
                <tr>
                    <td colspan="7">Nenhum curso cadastrado.</td>
                </tr>
                <?php } else {
                while ($curso = $query_cursos->fetch_assoc()) {

                    $cargaHoraria = $curso['duracao_curso'];
                    $duracao = "$cargaHoraria Hrs";
                    $codCurso = str_replace("nr", "NR-", $curso['cod_curso']);

                ?>
                    <tr>
                        <td><?php echo $curso['nome_curso'] ?></td>
                        <td align="center"><?php echo $codCurso ?></td>
                        <td align="center"><?php echo $duracao ?></td>


                        <td>
                            <a class="btn edit" href="curso_editar/index.php?id=<?php echo $curso['id_curso'] ?>">Editar</a>

                            <a class="btn del" href="curso_deletar/index.php?id=<?php echo $curso['id_curso'] ?>">Deletar</a>

                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <button style="margin-top: 20px;"><a href="../../index.php">Menu</a></button>
</body>

</html>