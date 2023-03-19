<?php

include_once('../../connect.php');
include_once('../../config.php');

$sql_usuarios = "SELECT * FROM usuarios";
$query_usuarios = $conn->query($sql_usuarios) or die($conn->error);
$qtd_usuarios = $query_usuarios->num_rows;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Lista de Usuários</h1>
    <h3>Usuários cadastrados</h3>
    <a class="btn new" href="usuario_novo/index.php">+ Novo Usuário</a>
    <br><br><br>

    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>CPF</th>
            <th>Nível</th>
            <th>Status</th>
            <th>Ações</th>
        </thead>

        <tbody>
            <?php if ($qtd_usuarios == 0) { ?>
                <tr>
                    <td colspan="7">Nenhum usuário cadastrado.</td>
                </tr>
                <?php } else {
                while ($usuario = $query_usuarios->fetch_assoc()) {

                    $idUsuario = $usuario['id_usuario'];
                    $nomeUsuario = $usuario['nome_usuario'];
                    $emailUsuario = $usuario['email_usuario'];
                    $cpfBruto = $usuario['cpf_usuario'];
                    $nivelBruto = $usuario['nivel_usuario'];
                    $statusBruto = $usuario['status_usuario'];

                    $cpfA = substr($cpfBruto, 0, 3);
                    $cpfB = substr($cpfBruto, 3, 3);
                    $cpfC = substr($cpfBruto, 6, 3);
                    $cpfD = substr($cpfBruto, 9, 2);
                    $cpfUsuario = "$cpfA.$cpfB.$cpfC-$cpfD";

                    $nivelUsuario = "Cliente";
                    if ($nivelBruto == "2") {
                        $nivelUsuario = "Operador";
                    } else if ($nivelBruto == "3") {
                        $nivelUsuario = "Master";
                    }

                    $statusUsuario = "Inativo";
                    if ($statusBruto == "1") {
                        $statusUsuario = "Ativo";
                    }



                ?>
                    <tr>
                        <td><?php echo $idUsuario ?></td>
                        <td><?php echo $nomeUsuario ?></td>
                        <td><?php echo $emailUsuario ?></td>
                        <td><?php echo $cpfUsuario ?></td>
                        <td><?php echo $nivelUsuario ?></td>
                        <td><?php echo $statusUsuario ?></td>

                        <td>
                            <a class="btn edit" href="usuario_editar/index.php?id=<?php echo $usuario['id_usuario'] ?>">Editar</a>

                            <a class="btn del" href="usuario_deletar/index.php?id=<?php echo $usuario['id_usuario'] ?>">Deletar</a>

                            <a class="btn del" href="usuario_alterarSenha/index.php?id=<?php echo $usuario['id_usuario'] ?>">Alterar Senha</a>

                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>

    <button style="margin-top: 20px;"><a href="../../index.php">Menu</a></button>
</body>

</html>