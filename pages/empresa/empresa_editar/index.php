<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

if (isset($id)) {
    $sql_empresas = "SELECT * FROM empresas WHERE id_empresa = '$id' ";
    $query_empresa = $conn->query($sql_empresas) or die($conn->error);
    $empresa = $query_empresa->fetch_assoc();

    $nomeV = $empresa['nome_empresa'];
    $unidadeV = $empresa['unidade_empresa'];
    $cnpjV = $empresa['cnpj_empresa'];
    $estadoV = $empresa['estado_empresa'];
    $cidadeV = $empresa['cidade_empresa'];
    $bairroV = $empresa['bairro_empresa'];
    $cepV = $empresa['cep_empresa'];
    $enderecoV = $empresa['endereco_empresa'];
    $numeroV = $empresa['numero_empresa'];
    $complementoV = $empresa['complemento_empresa'];


    switch ($estadoV) {
        case "AC":
            $estadoNome = "Acre";
            break;
        case "AL":
            $estadoNome = "Alagoas";
            break;
        case "AP":
            $estadoNome = "Amapá";
            break;
        case "AM":
            $estadoNome = "Amazonas";
            break;
        case "BA":
            $estadoNome = "Bahia";
            break;
        case "CE":
            $estadoNome = "Ceará";
            break;
        case "DF":
            $estadoNome = "Distrito Federal";
            break;
        case "ES":
            $estadoNome = "Espírito Santo";
            break;
        case "GO":
            $estadoNome = "Goiás";
            break;
        case "MA":
            $estadoNome = "Maranhão";
            break;
        case "MT":
            $estadoNome = "Mato Grosso";
            break;
        case "MS":
            $estadoNome = "Mato Grosso do Sul";
            break;
        case "MG":
            $estadoNome = "Minas Gerais";
            break;
        case "PA":
            $estadoNome = "Pará";
            break;
        case "PB":
            $estadoNome = "Paraíba";
            break;
        case "PR":
            $estadoNome = "Paraná";
            break;
        case "PE":
            $estadoNome = "Pernambuco";
            break;
        case "PI":
            $estadoNome = "Piauí";
            break;
        case "RJ":
            $estadoNome = "Rio de Janeiro";
            break;
        case "RN":
            $estadoNome = "Rio Grande do Norte";
            break;
        case "RS":
            $estadoNome = "Rio Grande do Sul";
            break;
        case "RO":
            $estadoNome = "Rondônia";
            break;
        case "RR":
            $estadoNome = "Roraima";
            break;
        case "SC":
            $estadoNome = "Santa Catarina";
            break;
        case "SP":
            $estadoNome = "São Paulo";
            break;
        case "SE":
            $estadoNome = "Sergipe";
            break;
        case "TO":
            $estadoNome = "Tocantins";
            break;
    }

    if ($complementoV == "-") {
        $complementoV = "";
    }
}


if (($_POST) && (isset($_POST['updateEmpresa']))) {
    $nome = $_POST['nome_input'];
    $unidade = $_POST['unidade_input'];
    $cnpjBruto = $_POST['cnpj_input'];
    $estado = $_POST['estado_select'];
    $cidade = $_POST['cidade_input'];
    $bairro = $_POST['bairro_input'];
    $cepBruto = $_POST['cep_input'];
    $endereco = $_POST['endereco_input'];
    $numero = $_POST['num_input'];
    $complemento = $_POST['complemento_input'];


    $caracteres = array('(', ')', ' ', '-', '.', '/');
    $branco = ('');

    $cep = str_replace($caracteres, $branco, $cepBruto);

    if ($cnpjBruto != "") {
        $cnpj = str_replace($caracteres, $branco, $cnpjBruto);
    }

    if ($complemento == "") {
        $complemento = "-";
    }


    $empresaUpdate = "UPDATE empresas SET
    nome_empresa = '$nome',
    unidade_empresa = '$unidade',
    cnpj_empresa = '$cnpj',
    estado_empresa = '$estado',
    cidade_empresa = '$cidade',
    cep_empresa = '$cep',
    bairro_empresa = '$bairro',
    numero_empresa = '$numero',
    endereco_empresa = '$endereco',
    complemento_empresa = '$complemento'
    WHERE id_empresa = '$id'";

$sql_exe = $conn->query($empresaUpdate) or die($conn->error);

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
    <title>Cadastro de Empresa</title>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQuery_v3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQueryMaskPlugin_v1.14.16.js"></script>


</head>

<body>

    <h1>Cadastro de Empresa</h1>

    <form id="form" method="POST">

        <p>
            <label for="nome_input">Nome:</label>
            <input type="text" name="nome_input" class="" id="nome-input" placeholder="Nome da empresa" maxlength="100" oninput="validaNome()" value="<?php echo $nomeV ?>">
            <span class="alert-message" id="nome-span">*Nome inválido!</span>
            <span class="alert-message" id="nome-empty">*Preencha o nome!</span>
        </p>

        <p>
            <label for="unidade_input">Unidade:</label>
            <input type="text" name="unidade_input" class="" id="unidade-input" placeholder="Unidade Cajamar" maxlength="50" oninput="validaUnidade()" value="<?php echo $unidadeV ?>">
            <span class="alert-message" id="unidade-span">*Inválido!</span>
            <span class="alert-message" id="unidade-empty">*Preencha a unidade!</span>
        </p>

        <p>
            <label for="cnpj_input">CNPJ:</label>
            <input type="text" name="cnpj_input" class="cnpj" id="cnpj-input" placeholder="00.000.000/0000-00" maxlength="18" oninput="validaCNPJ()" value="<?php echo $cnpjV ?>">
            <span class="alert-message" id="cnpj-span">*CNPJ Inválido!</span>
            <span class="alert-message" id="cnpj-empty">*Preencha o CNPJ!</span>
        </p>

        <p>
            <label for="estado">Estado:</label>
            <select name="estado_select" id="estado-select" oninput="validaEstado()">
                <option value="<?php echo $estadoV?>"><?php echo $estadoNome?></option>
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
            <input type="text" name="cidade_input" class="" id="cidade-input" placeholder="Cidade" maxlength="30" oninput="validaCidade()" value="<?php echo $cidadeV ?>">
            <span class="alert-message" id="cidade-span">*Cidade inválida!</span>
            <span class="alert-message" id="cidade-empty">*Preencha a cidade!</span>
        </p>

        <p>
            <label for="bairro_input">Bairro</label>
            <input type="text" name="bairro_input" class="" id="bairro-input" placeholder="Bairro" maxlength="30" oninput="validaBairro()" value="<?php echo $bairroV ?>">
            <span class="alert-message" id="bairro-span">*Bairro inválido!</span>
            <span class="alert-message" id="bairro-empty">*Preencha o bairro!</span>
        </p>

        <p>
            <label for="cep_input">CEP</label>
            <input type="text" name="cep_input" class="cep" id="cep-input" placeholder="00000-000" maxlength="9" oninput="validaCEP()" value="<?php echo $cepV ?>">
            <span class="alert-message" id="cep-span">*CEP inválido!</span>
            <span class="alert-message" id="cep-empty">*Preencha o CEP!</span>
        </p>

        <p>
            <label for="endereco_input">Endereço</label>
            <input type="text" name="endereco_input" class="" id="endereco-input" placeholder="Av. Principal" maxlength="50" oninput="validaEndereco()" value="<?php echo $enderecoV ?>">
            <span class="alert-message" id="endereco-span">*Endereço inválido!</span>
            <span class="alert-message" id="endereco-empty">*Preencha o endereco!</span>
        </p>

        <p>
            <label for="num_input">Número</label>
            <input type="text" name="num_input" class="" id="numero-input" placeholder="000" maxlength="4" oninput="validaNumero()" value="<?php echo $numeroV ?>">
            <span class="alert-message" id="numero-span">*Número inválido!</span>
            <span class="alert-message" id="numero-empty">*Preencha o numero!</span>
        </p>

        <p>
            <label for="complemento_input">Complemento</label>
            <input type="text" name="complemento_input" class="" id="complemento-input" placeholder="Apto. 00" maxlength="100" value="<?php echo $complementoV ?>">
        </p>


        <button type="submit" name="updateEmpresa">Salvar</button>
    </form>

    <button style="margin-top: 20px;"><a href="empresas.php">Cancelar</a></button>

    <script>
        //Máscaras por class
        $('.cep').mask('00000-000');
        $('.cnpj').mask('00.000.000/0000-00');

        //Get dos inputs pelos IDs
        var nome = document.getElementById('nome-input');
        var unidade = document.getElementById('unidade-input');
        var cnpj = document.getElementById('cnpj-input');
        var estado = document.getElementById('estado-select');
        var cidade = document.getElementById('cidade-input');
        var bairro = document.getElementById('bairro-input');
        var cep = document.getElementById('cep-input');
        var endereco = document.getElementById('endereco-input');
        var numero = document.getElementById('numero-input');
        var complemento = document.getElementById('complemento-input');


        //Validação de todos os campos no momento do envio do FORM
        form.addEventListener('submit', (event) => {
            validaNome();
            validaUnidade();
            validaCNPJ();
            validaEstado();
            validaCidade();
            validaBairro();
            validaCEP();
            validaEndereco();
            validaNumero();
        });


        //Funções de mensagens de Erro
        function setInputError(idcampo, idspan) {
            var campo = document.getElementById(idcampo);
            var span = document.getElementById(idspan);

            campo.style.border = '2px solid #e63636';
            span.style.display = 'block';
        };

        function removeInputError(idcampo, idspan) {
            var campo = document.getElementById(idcampo);
            var span = document.getElementById(idspan);

            campo.style.border = '';
            span.style.display = 'none';
        };

        //Funções de validação dos campos do FORM
        function validaNome() {
            if (nome.value == "") {
                event.preventDefault();
                setInputError('nome-input', 'nome-empty');
                removeInputError('nome-input', 'nome-span');
            } else if ((nome.value.length > 0) && (nome.value.length < 3)) {
                event.preventDefault();
                setInputError('nome-input', 'nome-span');
                removeInputError('nome-input', 'nome-empty');
            } else {
                removeInputError('nome-input', 'nome-span');
                removeInputError('nome-input', 'nome-empty');
            }
        }

        function validaUnidade() {
            if (unidade.value == "") {
                event.preventDefault();
                setInputError('unidade-input', 'unidade-empty');
                removeInputError('unidade-input', 'unidade-span');
            } else if ((unidade.value.length > 0) && (unidade.value.length < 3)) {
                event.preventDefault();
                setInputError('unidade-input', 'unidade-span');
                removeInputError('unidade-input', 'unidade-empty');
            } else {
                removeInputError('unidade-input', 'unidade-span');
                removeInputError('unidade-input', 'unidade-empty');
            }
        }

        function validaCNPJ() {
            var cnpjLimpo = cnpj.value.replace(/[^\d]+/g, '');

            if (cnpj.value == "") {
                event.preventDefault();
                setInputError('cnpj-input', 'cnpj-empty');
                removeInputError('cnpj-input', 'cnpj-span');
            } else if ((testaCNPJ(cnpjLimpo) == false)) {
                event.preventDefault();
                setInputError('cnpj-input', 'cnpj-span');
                removeInputError('cnpj-input', 'cnpj-empty');
            } else {
                removeInputError('cnpj-input', 'cnpj-span');
                removeInputError('cnpj-input', 'cnpj-empty');
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

        function validaEstado() {
            if (estado.value == "#") {
                event.preventDefault();
                setInputError('estado-select', 'estado-empty');
            } else {
                removeInputError('estado-select', 'estado-empty');
            }
        }

        function validaCidade() {
            if (cidade.value == "") {
                event.preventDefault();
                setInputError('cidade-input', 'cidade-empty');
                removeInputError('cidade-input', 'cidade-span');
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
            if (bairro.value == "") {
                event.preventDefault();
                setInputError('bairro-input', 'bairro-empty');
                removeInputError('bairro-input', 'bairro-span');
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
            if (cep.value == "") {
                event.preventDefault();
                setInputError('cep-input', 'cep-empty');
                removeInputError('cep-input', 'cep-span');
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
            if (endereco.value == "") {
                event.preventDefault();
                setInputError('endereco-input', 'endereco-empty');
                removeInputError('endereco-input', 'endereco-span');
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
    </script>

</body>

</html>