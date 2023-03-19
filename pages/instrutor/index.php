<?php

include_once('../../connect.php');
include_once('../../config.php');

$sql_instrutores = "SELECT * FROM instrutor";
$query_instrutores = $conn->query($sql_instrutores) or die($conn->error);
$qtd_instrutores = $query_instrutores->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrutores</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Lista de Instrutores</h1>
    <h3>Instrutores cadastrados</h3>
    <a class="btn new" href="instrutor_novo/index.php">+ Novo</a>
    <br><br><br>

    <table border="1" cellpadding="10">
        <thead>
            <th>Nome</th>
            <th>Assinatura</th>
            <th>Veículo</th>
            <th>NR-5</th>
            <th>NR-6</th>
            <th>NR-10</th>
            <th>NR-12</th>
            <th>NR-18</th>
            <th>NR-20</th>
            <th>NR-23</th>
            <th>NR-26</th>
            <th>NR-33</th>
            <th>NR-35</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php if ($qtd_instrutores == 0) { ?>
                <tr>
                    <td colspan="14">Nenhum funcionário cadastrado.</td>
                </tr>
                <?php } else {
                while ($instrutor = $query_instrutores->fetch_assoc()) {
                    //Nome
                    $nomeInstrutor = $instrutor['nome_instrutor'];
                    $assinaturaRef = $instrutor['assinatura_instrutor'];
                    $veiculoInstrutor = $instrutor['veiculo_instrutor'];

                    $assinaturaInstrutor = "-";
                    if ($assinaturaRef != "-") {
                        $assinaturaInstrutor = $assinaturaRef;
                    }

                    $nr5V = $instrutor['nr5'];
                    $nr6V = $instrutor['nr6'];
                    $nr10V = $instrutor['nr10'];
                    $nr12V = $instrutor['nr12'];
                    $nr18V = $instrutor['nr18'];
                    $nr20V = $instrutor['nr20'];
                    $nr23V = $instrutor['nr23'];
                    $nr26V = $instrutor['nr26'];
                    $nr33V = $instrutor['nr33'];
                    $nr35V = $instrutor['nr35'];

                    $nr5 = "X";
                    if ($nr5V == "1") {
                        $nr5 = "Apto";
                    }

                    $nr6 = "X";
                    if ($nr6V == "1") {
                        $nr6 = "Apto";
                    }

                    $nr10 = "X";
                    if ($nr10V == "1") {
                        $nr10 = "Apto";
                    }

                    $nr12 = "X";
                    if ($nr12V == "1") {
                        $nr12 = "Apto";
                    }

                    $nr18 = "X";
                    if ($nr18V == "1") {
                        $nr18 = "Apto";
                    }

                    $nr20 = "X";
                    if ($nr20V == "1") {
                        $nr20 = "Apto";
                    }

                    $nr23 = "X";
                    if ($nr23V == "1") {
                        $nr23 = "Apto";
                    }

                    $nr26 = "X";
                    if ($nr26V == "1") {
                        $nr26 = "Apto";
                    }

                    $nr33 = "X";
                    if ($nr33V == "1") {
                        $nr33 = "Apto";
                    }

                    $nr35 = "X";
                    if ($nr35V == "1") {
                        $nr35 = "Apto";
                    }


                ?>
                    <tr>
                        <td><?php echo $nomeInstrutor ?></td>
                        <td><?php echo $assinaturaInstrutor ?></td>
                        <td><?php echo $veiculoInstrutor ?></td>
                        <td align="center"><?php echo $nr5 ?></td>
                        <td align="center"><?php echo $nr6 ?></td>
                        <td align="center"><?php echo $nr10 ?></td>
                        <td align="center"><?php echo $nr12 ?></td>
                        <td align="center"><?php echo $nr18 ?></td>
                        <td align="center"><?php echo $nr20 ?></td>
                        <td align="center"><?php echo $nr23 ?></td>
                        <td align="center"><?php echo $nr26 ?></td>
                        <td align="center"><?php echo $nr33 ?></td>
                        <td align="center"><?php echo $nr35 ?></td>

                        <td>
                            <a class="btn edit" href="instrutor_editar/index.php?id=<?php echo $instrutor['id_instrutor'] ?>">Editar</a>

                            <a class="btn del" href="instrutor_deletar/index.php?id=<?php echo $instrutor['id_instrutor'] ?>">Deletar</a>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <button style="margin-top: 20px;"><a href="../../index.php">Menu</a></button>

</body>

</html>