<?php

include_once('../../connect.php');
include_once('../../config.php');

$sql_veiculos = "SELECT * FROM veiculos";
$query_veiculos = $conn->query($sql_veiculos) or die($conn->error);
$qtd_veiculos = $query_veiculos->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Lista de Veículos</h1>
    <h3>Veículos cadastrados</h3>
    <a class="btn new" href="veiculo_novo/index.php">+ Novo Veículo</a>
    <br><br><br>

    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Cor</th>
            <th>Placa</th>
            <th>Documentação</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php if ($qtd_veiculos == 0) { ?>
                <tr>
                    <td colspan="7">Nenhum veículo cadastrado.</td>
                </tr>
                <?php } else {
                while ($veiculo = $query_veiculos->fetch_assoc()) {

                    $placa = "";
                    if (!empty($veiculo['placa_veiculo'])) {
                        $parteA = substr($veiculo['placa_veiculo'], 0, 3);
                        $parteB = substr($veiculo['placa_veiculo'], 3);
                        $placa = "$parteA-$parteB";
                    }

                    $docSituacao = "";
                    if ($veiculo['documentacao_veiculo'] == 0) {
                        $docSituacao = "Irregular";
                        $docCor = "red";
                    } else if ($veiculo['documentacao_veiculo'] == 1) {
                        $docSituacao = "Regular";
                        $docCor = "green";
                    };


                ?>
                    <tr>
                        <td><?php echo $veiculo['id_veiculo'] ?></td>
                        <td><?php echo $veiculo['modelo_veiculo'] ?></td>
                        <td align="center"><?php echo $veiculo['ano_veiculo'] ?></td>
                        <td align="center"><?php echo $veiculo['cor_veiculo'] ?></td>
                        <td align="center"><?php echo strtoupper($placa) ?></td>
                        <td align="center" style="color:<?php echo $docCor; ?> ;"><?php echo $docSituacao; ?></td>

                        <td>
                            <a class="btn edit" href="veiculo_editar/index.php?id=<?php echo $veiculo['id_veiculo'] ?>">Editar</a>

                            <a class="btn del" href="veiculo_deletar/index.php?id=<?php echo $veiculo['id_veiculo'] ?>">Deletar</a>

                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <button style="margin-top: 20px;"><a href="../../index.php">Menu</a></button>
</body>

</html>