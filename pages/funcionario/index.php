<?php

include_once('../../connect.php');
include_once('../../config.php');

$sql_funcionarios = "SELECT * FROM funcionarios";
$query_funcionarios = $conn->query($sql_funcionarios) or die($conn->error);
$qtd_funcionarios = $query_funcionarios->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Lista de Funcionários</h1>
    <h3>Funcionários cadastrados</h3>
    <a class="btn new" href="funcionario_novo/index.php">+ Novo</a>
    <br><br><br>

    <table border="1" cellpadding="10">
        <thead>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Celular</th>
            <th>RG</th>
            <th>CPF</th>
            <th>CNPJ</th>
            <th>Nascimento</th>
            <th>Área</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php if ($qtd_funcionarios == 0) { ?>
                <tr>
                    <td colspan="9">Nenhum funcionário cadastrado.</td>
                </tr>
                <?php } else {
                while ($funcionario = $query_funcionarios->fetch_assoc()) {
                    //Nome
                    $nome = $funcionario['nome_funcionario'];
                    $sobrenome = $funcionario['sobrenome_funcionario'];
                    $nomeCompleto = "$nome $sobrenome";
                    $area = $funcionario['area_funcionario'];

                    //E-mail
                    $email = $funcionario['email_funcionario'];

                    //Celular
                    $celBruto = $funcionario['celular_funcionario'];
                    $ddd = substr($celBruto, 0, 2);
                    $celPA = substr($celBruto, 2, 5);
                    $celPB = substr($celBruto, 7, 4);
                    $celular = "($ddd) $celPA-$celPB";

                    //RG
                    $rg = $funcionario['rg_funcionario'];

                    //CPF
                    $cpfBruto = $funcionario['cpf_funcionario'];
                    $cpfA = substr($cpfBruto, 0, 3);
                    $cpfB = substr($cpfBruto, 3, 3);
                    $cpfC = substr($cpfBruto, 6, 3);
                    $cpfD = substr($cpfBruto, 9, 2);
                    $cpf = "$cpfA.$cpfB.$cpfC-$cpfD";

                    //CNPJ
                    if ($funcionario['cnpj_funcionario'] != "-") {
                        $cnpjBruto = $funcionario['cnpj_funcionario'];
                        $cnpjA = substr($cnpjBruto, 0, 2);
                        $cnpjB = substr($cnpjBruto, 2, 3);
                        $cnpjC = substr($cnpjBruto, 5, 3);
                        $cnpjD = substr($cnpjBruto, 8, 4);
                        $cnpjE = substr($cnpjBruto, 12, 2);
                        $cnpj = "$cnpjA.$cnpjB.$cnpjC/$cnpjD-$cnpjE";
                    } else {
                        $cnpj = $funcionario['cnpj_funcionario'];
                    };

                    //Nascimento
                    $nascBruto =  strtotime($funcionario['nascimento_funcionario']);
                    $nascimento = date("d/m/Y", $nascBruto);


                ?>
                    <tr>
                        <td><?php echo $nomeCompleto ?></td>
                        <td><?php echo $email ?></td>
                        <td align="center"><?php echo $celular ?></td>
                        <td align="center"><?php echo $rg ?></td>
                        <td align="center"><?php echo $cpf ?></td>
                        <td align="center"><?php echo $cnpj ?></td>
                        <td align="center"><?php echo $nascimento ?></td>
                        <td><?php echo $area ?></td>

                        <td>
                            <a class="btn edit" href="funcionario_editar/index.php?id=<?php echo $funcionario['id_funcionario'] ?>">Editar</a>

                            <a class="btn del" href="funcionario_deletar/index.php?id=<?php echo $funcionario['id_funcionario'] ?>">Deletar</a>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <button style="margin-top: 20px;"><a href="../../index.php">Menu</a></button>


</body>

</html>