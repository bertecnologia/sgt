<?php

include_once('../../../connect.php');
include_once('../../../config.php');

if (($_POST) && (isset($_POST['novoFuncionario']))) {
    $nome = $_POST['nome_input'];
    $sobrenome = $_POST['sobrenome_input'];
    $email = $_POST['email_input'];
    $celularBruto = $_POST['cel_input'];
    $rgBruto = $_POST['rg_input'];
    $cpfBruto = $_POST['cpf_input'];
    $cnpjBruto = $_POST['cnpj_input'];
    $nascBruto = $_POST['nascimento_input'];
    $estado = $_POST['estado_select'];
    $cidade = $_POST['cidade_input'];
    $bairro = $_POST['bairro_input'];
    $cepBruto = $_POST['cep_input'];
    $endereco = $_POST['endereco_input'];
    $numero = $_POST['num_input'];
    $complemento = $_POST['complemento_input'];
    $cargo = $_POST['cargo_usu_input'];
    $area = $_POST['area_usu_select'];
    $observacoes = $_POST['observacoes_input'];

    $caracteres = array('(', ')', ' ', '-', '.', '/');
    $branco = ('');

    $cep = str_replace($caracteres, $branco, $cepBruto);
    $celular = str_replace($caracteres, $branco, $celularBruto);
    $rg = str_replace($caracteres, $branco, $rgBruto);
    $cpf = str_replace($caracteres, $branco, $cpfBruto);

    if ($cnpjBruto == "") {
        $cnpj = "-";
    } else if ($cnpjBruto != "") {
        $cnpj = str_replace($caracteres, $branco, $cnpjBruto);
    }

    if ($complemento == "") {
        $complemento = "-";
    }

    if ($observacoes == "") {
        $observacoes = "-";
    }




    $nasc = str_replace($caracteres, $branco, $nascBruto);
    $nascDia = substr($nasc, 0, 2);
    $nascMes = substr($nasc, 2, 2);
    $nascAno = substr($nasc, 4, 4);
    $nascimento = "$nascAno-$nascMes-$nascDia";

    if (!empty($veiculo['placa_veiculo'])) {
        $parteA = substr($veiculo['placa_veiculo'], 0, 3);
        $parteB = substr($veiculo['placa_veiculo'], 3);
        $placa = "$parteA-$parteB";
    }

    echo $cnpj;


    $funcionarioNew = "INSERT INTO funcionarios VALUES (NULL, '$nome', '$sobrenome', '$email', '$celular', '$rg', '$cpf','$cnpj', '$nascimento', '$estado', '$cidade', '$bairro', '$cep', '$endereco', '$numero', '$complemento', '$cargo', '$area', '$observacoes')";

    $sql_exe = $conn->query($funcionarioNew) or die($conn->error);

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
    <title>Cadastro de Funcionário</title>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQuery_v3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQueryMaskPlugin_v1.14.16.js"></script>

</head>

<body>

    <h1>Cadastro de Funcionário - B&R</h1>

    <form id="form" method="POST">

        <p>
            <label for="nome_input">Nome:</label>
            <input type="text" name="nome_input" class="" id="nome-input" placeholder="Nome" maxlength="15" oninput="validaNome()">
            <span class="alert-message" id="nome-span">*Nome inválido!</span>
            <span class="alert-message" id="nome-empty">*Preencha o nome!</span>
        </p>

        <p>
            <label for="sobrenome_input">Sobrenome:</label>
            <input type="text" name="sobrenome_input" class="" id="sobrenome-input" placeholder="Sobrenome" maxlength="50" oninput="validaSobrenome()">
            <span class="alert-message" id="sobrenome-span">*Sobrenome inválido!</span>
            <span class="alert-message" id="sobrenome-empty">*Preencha o sobrenome!</span>
        </p>

        <p>
            <label for="email_input">E-mail:</label>
            <input type="email" name="email_input" class="" id="email-input" placeholder="exemplo@email.com" maxlength="50" oninput="validaEmail()">
            <span class="alert-message" id="email-span">*E-mail inválido!</span>
            <span class="alert-message" id="email-empty">*Preencha o e-mail!</span>
        </p>

        <p>
            <label for="cel_input">Celular:</label>
            <input type="tel" name="cel_input" class="cel" id="cel-input" placeholder="(00) 90000-0000" maxlength="15" oninput="validaCelular()">
            <span class="alert-message" id="cel-span">*Celular inválido!</span>
            <span class="alert-message" id="cel-empty">*Preencha o celular!</span>
        </p>

        <p>
            <label for="rg_input">RG:</label>
            <input type="text" name="rg_input" class="" id="rg-input" placeholder="00.000.000-0" maxlength="12" oninput="validaRG()">
            <span class="alert-message" id="rg-span">*RG inválido!</span>
            <span class="alert-message" id="rg-empty">*Preencha o RG!</span>
        </p>

        <p>
            <label for="cpf_input">CPF:</label>
            <input type="text" name="cpf_input" class="cpf" id="cpf-input" placeholder="000.000.000-00" maxlength="14" oninput="validaCPF()">
            <span class="alert-message" id="cpf-span">*CPF inválido!</span>
            <span class="alert-message" id="cpf-empty">*Preencha o CPF!</span>
        </p>

        <p>
            <label for="cnpj_input">CNPJ:</label>
            <input type="text" name="cnpj_input" class="cnpj" id="cnpj-input" placeholder="Opcional" maxlength="18" oninput="validaCNPJ()">
            <span class="alert-message" id="cnpj-span">*CNPJ Inválido!</span>
        </p>

        <p>
            <label for="nascimento_input">Data de Nascimento:</label>
            <input type="text" name="nascimento_input" class="data" id="nascimento-input" placeholder="00/00/0000" maxlength="10" oninput="validaNascimento()">
            <span class="alert-message" id="nascimento-span">*Data inválida!</span>
            <span class="alert-message" id="nascimento-empty">*Preencha a data de nascimento!</span>
        </p>

        <hr>

        <p>
            <label for="estado">Estado:</label>
            <select name="estado_select" id="estado-select" oninput="validaEstado()">
                <option value="#">Selecione</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
            <span class="alert-message" id="estado-empty">*Selecione o estado!</span>
        </p>

        <p>
            <label for="cidade_input">Cidade</label>
            <input type="text" name="cidade_input" class="" id="cidade-input" placeholder="Cidade" maxlength="30" oninput="validaCidade()" required>
            <span class="alert-message" id="cidade-span">*Cidade inválida!</span>
            <span class="alert-message" id="cidade-empty">*Preencha a cidade!</span>
        </p>

        <p>
            <label for="bairro_input">Bairro</label>
            <input type="text" name="bairro_input" class="" id="bairro-input" placeholder="Bairro" maxlength="30" oninput="validaBairro()" required>
            <span class="alert-message" id="bairro-span">*Bairro inválido!</span>
            <span class="alert-message" id="bairro-empty">*Preencha o bairro!</span>
        </p>

        <p>
            <label for="cep_input">CEP</label>
            <input type="text" name="cep_input" class="cep" id="cep-input" placeholder="00000-000" maxlength="9" oninput="validaCEP()" required>
            <span class="alert-message" id="cep-span">*CEP inválido!</span>
            <span class="alert-message" id="cep-empty">*Preencha o CEP!</span>
        </p>

        <p>
            <label for="endereco_input">Endereço</label>
            <input type="text" name="endereco_input" class="" id="endereco-input" placeholder="Av. Principal" maxlength="50" oninput="validaEndereco()" required>
            <span class="alert-message" id="endereco-span">*Endereço inválido!</span>
            <span class="alert-message" id="endereco-empty">*Preencha o endereco!</span>
        </p>

        <p>
            <label for="num_input">Número</label>
            <input type="text" name="num_input" class="" id="numero-input" placeholder="000" maxlength="4" oninput="validaNumero()" required>
            <span class="alert-message" id="numero-span">*Número inválido!</span>
            <span class="alert-message" id="numero-empty">*Preencha o numero!</span>
        </p>

        <p>
            <label for="complemento_input">Complemento</label>
            <input type="text" name="complemento_input" class="" id="complemento-input" placeholder="Apto. 00" maxlength="30">
        </p>

        <hr>

        <p>
            <label for="cargo_usu_input">Cargo</label>
            <input type="text" name="cargo_usu_input" class="" id="cargo-input" placeholder="Estagiário" maxlength="100" oninput="validaCargo()" required>
            <span class="alert-message" id="cargo-empty">*Informe o cargo do usuário!</span>
            <span class="alert-message" id="cargo-span">*Inválido!</span>
        </p>

        <p>
            <label for="area_usu_select">Área</label>
            <select name="area_usu_select" id="area-select" oninput="validaArea()" required>
                <option value="#">Selecione</option>
                <option value="Tecnologia">Tecnologia</option>
                <option value="Engenharia">Engenharia</option>
            </select>
            <span class="alert-message" id="area-span">*Selecione a área do usuário!</span>
        </p>

        <hr>

        <p>
            <label for="observacoes_input">Observações</label>
            <textarea name="observacoes_input" id="observacoes-input" cols="30" rows="4" oninput="validaObservacoes()"></textarea>
            <span class="alert-message" id="observacoes-span">*Contém caracteres inválidos!</span>
        </p>

        <button type="submit" name="novoFuncionario">Cadastrar</button>
    </form>

    <button style="margin-top: 20px;"><a href="../index.php">Cancelar</a></button>


    <script>
        //Máscaras por class
        $('.cel').mask('(00) 00000-0000');
        $('.cpf').mask('000.000.000-00');
        $('.cep').mask('00000-000');
        $('.data').mask('00/00/0000');
        $('.cnpj').mask('00.000.000/0000-00');

        //Regexs para validações
        const emailRegex =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const passRegex = /^(?=.*[@!#$%^&*()/\\])[@!#$%^&*()/\\a-zA-Z0-9]{8,20}$/;
        const espacoBrancoRegex = /\s/g;
        const dataPattern = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;

        //Get dos inputs pelos IDs
        var nome = document.getElementById('nome-input');
        var sobrenome = document.getElementById('sobrenome-input');
        var email = document.getElementById('email-input');
        var celular = document.getElementById('cel-input');
        var rg = document.getElementById('rg-input');
        var cpf = document.getElementById('cpf-input');
        var cnpj = document.getElementById('cnpj-input');
        var data_nasc = document.getElementById('nascimento-input');
        var estado = document.getElementById('estado-select');
        var cidade = document.getElementById('cidade-input');
        var bairro = document.getElementById('bairro-input');
        var cep = document.getElementById('cep-input');
        var endereco = document.getElementById('endereco-input');
        var numero = document.getElementById('numero-input');
        var complemento = document.getElementById('complemento-input');
        var cargo = document.getElementById('cargo-input');
        var area = document.getElementById('area-select');
        var observacoes = document.getElementById('observacoes-input')

        //Validação dos insputs no envio do Form
        form.addEventListener('submit', (event) => {
            validaNome();
            validaSobrenome();
            validaEmail();
            validaCelular();
            validaRG();
            validaCPF();
            validaNascimento();
            validaEstado();
            validaCidade();
            validaBairro();
            validaCEP();
            validaEndereco();
            validaNumero();
            validaCargo();
            validaArea();
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

        function validaSobrenome() {
            if (sobrenome.value == "") {
                event.preventDefault();
                setInputError('sobrenome-input', 'sobrenome-empty');
            } else if ((sobrenome.value.length > 0) && (sobrenome.value.length < 3)) {
                event.preventDefault();
                setInputError('sobrenome-input', 'sobrenome-span');
            } else {
                removeInputError('sobrenome-input', 'sobrenome-span');
                removeInputError('sobrenome-input', 'sobrenome-empty');
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

        function validaCelular() {
            if (celular.value == "") {
                event.preventDefault();
                setInputError('cel-input', 'cel-empty');
            } else if ((celular.value.length > 0) && (celular.value.length <= 14)) {
                event.preventDefault();
                setInputError('cel-input', 'cel-span');
            } else {
                removeInputError('cel-input', 'cel-span');
                removeInputError('cel-input', 'cel-empty');
            }
        }

        function validaRG() {
            if (rg.value == "" || rg.value.length < 1) {
                event.preventDefault();
                setInputError('rg-input', 'rg-empty');
                removeInputError('rg-input', 'rg-span');
            } else if (rg.value.lenght < 5) {
                event.preventDefault();
                setInputError('rg-input', 'rg-span');
                removeInputError('rg-input', 'rg-empty');
            } else {
                removeInputError('rg-input', 'rg-empty');
                removeInputError('rg-input', 'rg-span');
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

        function validaCNPJ() {
            var cnpjLimpo = cnpj.value.replace(/[^\d]+/g, '');

            if ((testaCNPJ(cnpjLimpo) == false)) {
                event.preventDefault();
                setInputError('cnpj-input', 'cnpj-span');
            } else {
                removeInputError('cnpj-input', 'cnpj-span');
            }
        }

        function testaCNPJ(cnpj) {
            if (cnpj == '') return false;

            if (cnpj.length != 14)
                return false;

            // Elimina CNPJs invalidos conhecidos
            if (cnpj == "00000000000000" ||
                cnpj == "11111111111111" ||
                cnpj == "22222222222222" ||
                cnpj == "33333333333333" ||
                cnpj == "44444444444444" ||
                cnpj == "55555555555555" ||
                cnpj == "66666666666666" ||
                cnpj == "77777777777777" ||
                cnpj == "88888888888888" ||
                cnpj == "99999999999999")
                return false;

            // Valida DVs
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0, tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;

            tamanho = tamanho + 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;

            return true;
        }

        function validaNascimento() {
            if (data_nasc.value == "") {
                event.preventDefault();
                setInputError('nascimento-input', 'nascimento-empty');
            } else if (!dataPattern.test(data_nasc.value)) {
                event.preventDefault();
                setInputError('nascimento-input', 'nascimento-span');
            } else {
                removeInputError('nascimento-input', 'nascimento-span');
                removeInputError('nascimento-input', 'nascimento-empty');
            }
        }

        function validaEstado() {
            if (estado.value == "#") {
                event.preventDefault();
                setInputError('estado-select', 'estado-empty');
            } else {
                removeInputError('estado-select', 'estado-empty');
            }
        }

        function validaCidade() {
            if ((estado.value != "#") && (cidade.value == "")) {
                event.preventDefault();
                setInputError('cidade-input', 'cidade-empty');
            } else if ((cidade.value.length > 0) && (cidade.value.length < 3)) {
                event.preventDefault();
                setInputError('cidade-input', 'cidade-span');
                removeInputError('cidade-input', 'cidade-empty');
            } else {
                removeInputError('cidade-input', 'cidade-empty');
                removeInputError('cidade-input', 'cidade-span');
            }
        }

        function validaBairro() {
            if ((cidade.value != "") && (bairro.value == "")) {
                event.preventDefault();
                setInputError('bairro-input', 'bairro-empty');
            } else if ((bairro.value.length > 0) && (bairro.value.length < 3)) {
                event.preventDefault();
                removeInputError('bairro-input', 'bairro-empty');
                setInputError('bairro-input', 'bairro-span');
            } else {
                removeInputError('bairro-input', 'bairro-empty');
                removeInputError('bairro-input', 'bairro-span');
            }
        }

        function validaCEP() {
            if ((bairro.value != "") && (cep.value == "")) {
                event.preventDefault();
                setInputError('cep-input', 'cep-empty');
            } else if ((cep.value.length > 0) && (cep.value.length < 9)) {
                event.preventDefault();
                removeInputError('cep-input', 'cep-empty');
                setInputError('cep-input', 'cep-span');
            } else {
                removeInputError('cep-input', 'cep-empty');
                removeInputError('cep-input', 'cep-span');
            }
        }

        function validaEndereco() {
            if ((cep.value != "") && (endereco.value == "")) {
                event.preventDefault();
                setInputError('endereco-input', 'endereco-empty');
            } else if ((endereco.value.length > 0) && (endereco.value.length < 5)) {
                event.preventDefault();
                removeInputError('endereco-input', 'endereco-empty');
                setInputError('endereco-input', 'endereco-span');
            } else {
                removeInputError('endereco-input', 'endereco-empty');
                removeInputError('endereco-input', 'endereco-span');
            }
        }

        function validaNumero() {
            if ((numero.value.length < 1) || (numero.value == "")) {
                event.preventDefault();
                setInputError('numero-input', 'numero-empty');
            } else {
                removeInputError('numero-input', 'numero-empty');
            }
        }

        function validaCargo() {
            if (cargo.value == "") {
                event.preventDefault();
                removeInputError('cargo-input', 'cargo-span')
                setInputError('cargo-input', 'cargo-empty');
            } else if (cargo.value.length < 3) {
                event.preventDefault();
                removeInputError('cargo-input', 'cargo-empty');
                setInputError('cargo-input', 'cargo-span');
            } else {
                removeInputError('cargo-input', 'cargo-empty');
                removeInputError('cargo-input', 'cargo-span')
            }
        }

        function validaArea() {
            if ((area.value == "#") || (area.value == "")) {
                event.preventDefault();
                setInputError('area-select', 'area-span');
            } else {
                removeInputError('area-select', 'area-span')
            }
        }
    </script>

</body>

</html>