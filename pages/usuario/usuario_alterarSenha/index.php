<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

if (isset($id)) {
    $sql_usuarios = "SELECT * FROM usuarios WHERE id_usuario = '$id' ";
    $query_usuario = $conn->query($sql_usuarios) or die($conn->error);
    $usuario = $query_usuario->fetch_assoc();

    $nome = $usuario['nome_usuario'];
    $email = $usuario['email_usuario'];
};

if (($_POST) && (isset($_POST['updatePassUsuario']))) {

    $novaSenha = password_hash($_POST['senha_usu'], PASSWORD_DEFAULT);

    $usuarioUpdate = "UPDATE usuarios SET senha_usuario = '$novaSenha' WHERE id_usuario = '$id'";
    $sql_exe = $conn->query($usuarioUpdate) or die($conn->error);

    if ($sql_exe) {
        header('Location: ../index.php');
    }
};

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - Usuário</title>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQuery_v3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQueryMaskPlugin_v1.14.16.js"></script>

</head>

<body>

    <h1>Alterar senha</h1>
    <br>
    <p><b>Nome:</b><?php echo $nome ?></p>
    <p><b>E-mail:</b><?php echo $email ?></p>
    <br>
    <form id="form" method="POST">



        <p>
            <label for="senha_usu">Nova senha:</label>
            <input type="password" name="senha_usu" class="" id="senha-input" placeholder="********" maxlength="20" oninput="validaSenha()">
            <span class="alert-message" id="senha-span">*Senha deve ter entre 8 e 20 caracteres, contendo letra Maiúscula, Número e Caracter Especial!</span>
            <span class="alert-message" id="senha-empty">*Preencha a senha!</span>
        </p>

        <p>
            <label for="rep_senha">Repita a senha:</label>
            <input type="password" name="rep_senha" class="" id="rep-senha" placeholder="********" maxlength="20" oninput="validaRepSenha()">
            <span class="alert-message" id="repSenha-span">*As senhas não coincidem!</span>
        </p>


        <button type="submit" name="updatePassUsuario">Alterar Senha</button>
    </form>

    <script>
        const passRegex = /^(?=.*[@!#$%^&*()/\\])[@!#$%^&*()/\\a-zA-Z0-9]{8,20}$/;
        const espacoBrancoRegex = /\s/g;

        //Get dos inputs pelos IDs
        var senha = document.getElementById('senha-input');
        var repSenha = document.getElementById('rep-senha');

        //Validação dos campos no envio do Form
        form.addEventListener('submit', (event) => {
            validaSenha();
            validaRepSenha();
        });

        //Função para exibir alertas de erro definida por ID
        function setInputError(idcampo, idspan) {
            var campo = document.getElementById(idcampo);
            var span = document.getElementById(idspan);

            campo.style.border = '2px solid #e63636';
            span.style.display = 'block';
        };

        //Função para desativar alertas de erro definida por ID
        function removeInputError(idcampo, idspan) {
            var campo = document.getElementById(idcampo);
            var span = document.getElementById(idspan);

            campo.style.border = '';
            span.style.display = 'none';
        };

        function validaSenha() {
            if (senha.value == "") {
                event.preventDefault();
                removeInputError('senha-input', 'senha-span');
                setInputError('senha-input', 'senha-empty');
            } else if (!passRegex.test(senha.value)) {
                event.preventDefault();
                removeInputError('senha-input', 'senha-empty');
                setInputError('senha-input', 'senha-span');
            } else {
                removeInputError('senha-input', 'senha-span');
                removeInputError('senha-input', 'senha-empty');
            }

            validaRepSenha();
        };

        function validaRepSenha() {
            if ((repSenha.value != senha.value) || repSenha.value == "") {
                event.preventDefault();
                setInputError('rep-senha', 'repSenha-span');
            } else {
                removeInputError('rep-senha', 'repSenha-span');
            }
        };
    </script>

</body>

</html>