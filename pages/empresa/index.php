<?php

include_once('../../connect.php');
include_once('../../config.php');

$sql_empresas = "SELECT * FROM empresas";
$query_empresas = $conn->query($sql_empresas) or die($conn->error);
$qtd_empresas = $query_empresas->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Lista de Empresas</h1>
    <h3>Empresas cadastradas</h3>
    <a class="btn new" href="empresa_novo/index.php">+ Nova empresa</a>
    <br><br><br>

    <table border="1" cellpadding="10">
        <thead>
            <th>Empresa</th>
            <th>Unidade</th>
            <th>CNPJ</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php if ($qtd_empresas == 0) { ?>
                <tr>
                    <td colspan="6">Nenhuma empresa cadastrada.</td>
                </tr>
                <?php } else {
                while ($empresa = $query_empresas->fetch_assoc()) {

                    $nomeEmpresa = $empresa['nome_empresa'];
                    $unidadeEmpresa = $empresa['unidade_empresa'];
                    $cnpjBruto = $empresa['cnpj_empresa'];
                    $cepBruto = $empresa['cep_empresa'];
                    $enderecoEmpresa = $empresa['endereco_empresa'];

                    //Formatação CNPJ
                    $cnpjA = substr($cnpjBruto, 0, 2);
                    $cnpjB = substr($cnpjBruto, 2, 3);
                    $cnpjC = substr($cnpjBruto, 5, 3);
                    $cnpjD = substr($cnpjBruto, 8, 4);
                    $cnpjE = substr($cnpjBruto, 12, 2);
                    $cnpjEmpresa = "$cnpjA.$cnpjB.$cnpjC/$cnpjD-$cnpjE";

                    $cepA = substr($cepBruto, 0, 5);
                    $cepB = substr($cepBruto, 5, 3);
                    $cepEmpresa = "$cepA-$cepB";

                ?>
                    <tr>
                        <td><?php echo $nomeEmpresa ?></td>
                        <td><?php echo $unidadeEmpresa ?></td>
                        <td align="center"><?php echo $cnpjEmpresa ?></td>
                        <td align="center"><?php echo $cepEmpresa ?></td>
                        <td><?php echo $enderecoEmpresa ?></td>


                        <td>
                            <a class="btn edit" href="empresa_editar/index.php?id=<?php echo $empresa['id_empresa'] ?>">Editar</a>

                            <a class="btn del" href="empresa_deletar/index.php?id=<?php echo $empresa['id_empresa'] ?>">Deletar</a>

                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <button style="margin-top: 20px;"><a href="../../index.php">Menu</a></button>
</body>

</html>