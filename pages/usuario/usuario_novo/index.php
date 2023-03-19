<?php

include_once('../../../connect.php');
include_once('../../../config.php');

if (($_POST) && (isset($_POST['newUsuario']))) {
    $nome = $_POST['nome_usu'];
    $email = $_POST['email_usu'];
    $cpfBruto = $_POST['cpf_usu'];
    $senha = password_hash($_POST['senha_usu'], PASSWORD_DEFAULT);
    $nivel = $_POST['nivel_usu'];
    $status = $_POST['status_usu'];

    $caracteres = array('(', ')', ' ', '-', '.', '/');
    $branco = ('');
    $cpf = str_replace($caracteres, $branco, $cpfBruto);


    $usuarioNew = "INSERT INTO usuarios VALUES (NULL, '$nome', '$email', '$cpf', '$senha', '$nivel', '$status')";

    $sql_exe = $conn->query($usuarioNew) or die($conn->error);

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
    <title>Cadastro de Usuário</title>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQuery_v3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQueryMaskPlugin_v1.14.16.js"></script>

</head>

<body>

    <h1>Cadastro de Usuário</h1>

    <form id="form" method="POST">

        <p>
            <label for="nome_usu">Nome:</label>
            <input type="text" name="nome_usu" class="" id="nome-input" placeholder="Nome do Colaborador" oninput="validaNome()">
            <span class="alert-message" id="nome-span">*Nome inválido!</span>
            <span class="alert-message" id="nome-empty">*Preencha o nome!</span>
        </p>

        <p>
            <label for="email_usu">E-mail:</label>
            <input type="text" name="email_usu" class="" id="email-input" placeholder="seu@email.com" oninput="validaEmail()">
            <span class="alert-message" id="email-span">*E-mail inválido!</span>
            <span class="alert-message" id="email-empty">*Preencha o e-mail!</span>
        </p>

        <p>
            <label for="cpf_usu">CPF:</label>
            <input type="text" name="cpf_usu" class="cpf" id="cpf-input" placeholder="000.000.000-00" oninput="validaCPF()">
            <span class="alert-message" id="cpf-span">*CPF inválido!</span>
            <span class="alert-message" id="cpf-empty">*Preencha o CPF!</span>
        </p>

        <p>
            <label for="senha_usu">Senha:</label>
            <input type="password" name="senha_usu" class="" id="senha-input" placeholder="********" maxlength="20" oninput="validaSenha()">
            <span class="alert-message" id="senha-span">*Senha deve ter entre 8 e 20 caracteres, contendo letra Maiúscula, Número e Caracter Especial!</span>
            <span class="alert-message" id="senha-empty">*Preencha a senha!</span>
        </p>

        <p>
            <label for="rep_senha">Repita a senha:</label>
            <input type="password" name="rep_senha" class="" id="rep-senha" placeholder="********" maxlength="20" oninput="validaRepSenha()">
            <span class="alert-message" id="repSenha-span">*As senhas não coincidem!</span>
        </p>

        <p>
            <label for="nivel_usu">Nível:</label>
            <select name="nivel_usu" id="nivel-select" oninput="validaNivel()">
                <option value="#">Selecione</option>
                <option value="1">Empresa</option>
                <option value="2">Operador</option>
                <option value="3">Master</option>
            </select>
            <span class="alert-message" id="nivel-span">*Selecione o nível do usuário!</span>
        </p>

        <p>
            <label for="status_usu">Status:</label>
            <select name="status_usu" id="status-select" oninput="validaStatus()">
                <option value="#">Selecione</option>
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
            <span class="alert-message" id="status-span">*Selecione o status do usuário!</span>
        </p>

        <button type="submit" name="newUsuario">Cadastrar</button>
    </form>

    <button style="margin-top: 20px;"><a href="../index.php">Cancelar</a></button>

    <script>
        $('.cpf').mask('000.000.000-00');
        //Regexs para validações
        const emailRegex =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const passRegex = /^(?=.*[@!#$%^&*()/\\])[@!#$%^&*()/\\a-zA-Z0-9]{8,20}$/;
        const espacoBrancoRegex = /\s/g;

        //Get dos inputs pelos IDs
        var nome = document.getElementById('nome-input');
        var email = document.getElementById('email-input');
        var cpf = document.getElementById('cpf-input');
        var senha = document.getElementById('senha-input');
        var repSenha = document.getElementById('rep-senha');
        var nivel_usu = document.getElementById('nivel-select');
        var status_usu = document.getElementById('status-select');

        //Validação dos campos no envio do Form
        form.addEventListener('submit', (event) => {
            validaNome();
            validaEmail();
            validaCPF();
            validaSenha();
            validaRepSenha();
            validaNivel();
            validaStatus();
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

        function validaNome() {
            if (nome.value == "") {
                event.preventDefault();
                setInputError('nome-input', 'nome-empty');
            } else if ((nome.value.length > 0) && (nome.value.length < 3)) {
                event.preventDefault();
                setInputError('nome-input', 'nome-span');
            } else {
                removeInputError('nome-input', 'nome-span');
                removeInputError('nome-input', 'nome-empty');
            }
        }

        function validaEmail() {
            if (email.value == "") {
                event.preventDefault();
                setInputError('email-input', 'email-empty');
            } else if (!emailRegex.test(email.value)) {
                event.preventDefault();
                setInputError('email-input', 'email-span');
            } else {
                removeInputError('email-input', 'email-span');
                removeInputError('email-input', 'email-empty');
            }
        }

        function validaCPF() {
            var cpfLimpo = cpf.value.replace(/\D/gim, '');

            if (cpf.value == "") {
                event.preventDefault();
                setInputError('cpf-input', 'cpf-empty');
            } else if ((cpf.value.length < 14) || (testaCPF(cpfLimpo) == false)) {
                event.preventDefault();
                setInputError('cpf-input', 'cpf-span');
            } else {
                removeInputError('cpf-input', 'cpf-span');
                removeInputError('cpf-input', 'cpf-empty');
            }
        }

        function testaCPF(strCPF) {

            var Soma;
            var Resto;
            Soma = 0;
            if (strCPF == "00000000000" ||
                strCPF == "11111111111" ||
                strCPF == "22222222222" ||
                strCPF == "33333333333" ||
                strCPF == "44444444444" ||
                strCPF == "55555555555" ||
                strCPF == "66666666666" ||
                strCPF == "77777777777" ||
                strCPF == "88888888888" ||
                strCPF == "99999999999") return false;

            for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10))) return false;

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11))) return false;
            return true;
        }

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

        function validaNivel() {
            if ((nivel_usu.value == "#") || (nivel_usu.value == "")) {
                event.preventDefault();
                setInputError('nivel-select', 'nivel-span');
            } else {
                removeInputError('nivel-select', 'nivel-span');
            }
        }

        function validaStatus() {
            if ((status_usu.value == "#") || (status_usu.value == "")) {
                event.preventDefault();
                setInputError('status-select', 'status-span');
            } else {
                removeInputError('status-select', 'status-span');
            }
        }
    </script>

</body>

</html>