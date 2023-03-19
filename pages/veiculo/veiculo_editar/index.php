<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

if (isset($id)) {
    $sql_veiculos = "SELECT * FROM veiculos WHERE id_veiculo = '$id' ";
    $query_veiculo = $conn->query($sql_veiculos) or die($conn->error);
    $veiculo = $query_veiculo->fetch_assoc();

    $modeloV = $veiculo['modelo_veiculo'];
    $anoV = $veiculo['ano_veiculo'];
    $corV = $veiculo['cor_veiculo'];
    $placaV = $veiculo['placa_veiculo'];
    $docsV = $veiculo['documentacao_veiculo'];
    $ipvaV = $veiculo['ipva_veiculo'];
    $licenciamentoV = $veiculo['licenciamento_veiculo'];
    $seguroV = $veiculo['seguro_veiculo'];


    $ipvaC = "";
    if ($ipvaV == 1) {
        $ipvaC = "checked";
    }

    $licenciamentoC = "";
    if ($licenciamentoV == 1) {
        $licenciamentoC = "checked";
    }

    $seguroC = "";
    if ($seguroV == 1) {
        $seguroC = "checked";
    }
}

if (($_POST) && (isset($_POST['updateVeiculo']))) {
    $modelo = $_POST['modelo_veiculo'];
    $ano = $_POST['ano_veiculo'];
    $cor = $_POST['cor_veiculo'];
    $placa = $_POST['placa_veiculo'];
    $docs = $_POST['docs_veiculo'];
    $ipva = $_POST['ipva_value'];
    $licenciamento = $_POST['licenciamento_value'];
    $seguro = $_POST['seguro_value'];


    $veiculoUpdate = "UPDATE veiculos SET
        modelo_veiculo = '$modelo',
        ano_veiculo = '$ano',
        cor_veiculo = '$cor',
        placa_veiculo = '$placa',
        documentacao_veiculo = '$docs',
        ipva_veiculo = '$ipva',
        licenciamento_veiculo = '$licenciamento',
        seguro_veiculo = '$seguro' 
        WHERE id_veiculo = '$id'";

    $sql_exe = $conn->query($veiculoUpdate) or die($conn->error);

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
    <title>Editar Veículo</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1>Editar Veículo</h1>

    <form id="form" method="POST" action="">

        <p>
            <label for="modelo_veiculo">Modelo:</label>
            <input type="text" name="modelo_veiculo" class="" id="modelo-input" placeholder="Celta 1.4" maxlength="30" oninput="validaModelo()" value="<?php echo $modeloV; ?>">
            <span class="alert-message" id="modelo-span">*Muito curto!</span>
            <span class="alert-message" id="modelo-empty">*Preencha este campo!</span>
        </p>

        <p>
            <label for="ano_veiculo">Ano:</label>
            <input type="text" name="ano_veiculo" class="" id="ano-input" placeholder="2023" maxlength="4" oninput="validaAno()" value="<?php echo $anoV; ?>">
            <span class="alert-message" id="ano-span">*Inválido!</span>
            <span class="alert-message" id="ano-empty">*Preencha este campo!</span>
        </p>

        <p>
            <label for="cor_veiculo">Cor:</label>
            <input type="text" name="cor_veiculo" class="" id="cor-input" placeholder="Preto" maxlength="15" oninput="validaCor()" value="<?php echo $corV; ?>">
            <span class="alert-message" id="cor-span">*Inválido!</span>
            <span class="alert-message" id="cor-empty">*Preencha este campo!</span>
        </p>

        <p>
            <label for="placa_veiculo">Placa:</label>
            <input type="text" name="placa_veiculo" class="" id="placa-input" placeholder="XXX-0000" maxlength="7" oninput="validaPlaca()" value="<?php echo $placaV; ?>">
            <span class="alert-message" id="placa-span">*Placa inválida!</span>
            <span class="alert-message" id="placa-empty">*Preencha este campo!</span>
        </p>

        <p>
            <label for="docs_veiculo">Documentação:</label>
        <p id="doc-displayIrregular" style="font-weight: bold; color: red;" hidden>Irregular</p>
        <p id="doc-displayRegular" style="font-weight: bold; color: green;" hidden>Regular</p>
        <input type="text" name="docs_veiculo" class="" id="docs-input" value="<?php echo $docsV; ?>" hidden>

        <label for="ipva_check">IPVA</label>
        <input type="checkbox" name="ipva_check" id="ipva-check" oninput="validaDoc()" <?php echo $ipvaC; ?>>
        <input type="text" name="ipva_value" id="ipva-value" value="<?php echo $ipvaV; ?>" hidden>

        <label for="licenciamento_check">Licenciamento</label>
        <input type="checkbox" name="licenciamento_check" id="licenciamento-check" oninput="validaDoc()" <?php echo $licenciamentoC; ?>>
        <input type="text" name="licenciamento_value" id="licenciamento-value" value="<?php echo $licenciamentoV; ?>" hidden>

        <label for="seguro_check">Seguro</label>
        <input type="checkbox" name="seguro_check" id="seguro-check" oninput="validaDoc()" <?php echo $seguroC; ?>>
        <input type="text" name="seguro_value" id="seguro-value" value="<?php echo $seguroV; ?>" hidden>
        </p>


        <button type="submit" name="updateVeiculo">Salvar</button>
        <button><a style="text-decoration: none;" href="../index.php">Cancelar</a></button>
    </form>



    <script>
        //Get dos inputs pelos IDs
        var modelo = document.getElementById('modelo-input');
        var ano = document.getElementById('ano-input');
        var cor = document.getElementById('cor-input');
        var placa = document.getElementById('placa-input');
        var doc = document.getElementById('docs-input');
        var doc_display = document.getElementById('doc-display');

        var ipva = document.getElementById('ipva-check');
        var licenciamento = document.getElementById('licenciamento-check');
        var seguro = document.getElementById('seguro-check');

        var ipva_value = document.getElementById('ipva-value');
        var licenciamento_value = document.getElementById('licenciamento-value');
        var seguro_value = document.getElementById('seguro-value');

        var docIrregular = document.getElementById('doc-displayIrregular');
        var docRegular = document.getElementById('doc-displayRegular');

        validaDoc();


        if (doc.value == "0") {
            doc_display.value = "Irregular";
            doc_display.style.color = 'red';
        } else if (doc.value == "1") {
            doc_display.value = "Regular";
            doc_display.style.color = 'green';
        };

        //Validação de todos os campos no momento do envio do FORM
        form.addEventListener('submit', (event) => {
            validaModelo();
            validaAno();
            validaCor();
            validaPlaca();
            validaDoc();
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
        function validaModelo() {
            if (modelo.value == "") {
                event.preventDefault();
                removeInputError('modelo-input', 'modelo-span');
                setInputError('modelo-input', 'modelo-empty');
            } else if (modelo.value.length < 2) {
                event.preventDefault();
                removeInputError('modelo-input', 'modelo-empty');
                setInputError('modelo-input', 'modelo-span');
            } else {
                removeInputError('modelo-input', 'modelo-span');
                removeInputError('modelo-input', 'modelo-empty');
            }
        }

        function validaAno() {
            if (ano.value == "") {
                event.preventDefault();
                removeInputError('ano-input', 'ano-span');
                setInputError('ano-input', 'ano-empty');
            } else if (ano.value.length < 4) {
                event.preventDefault();
                removeInputError('ano-input', 'ano-empty');
                setInputError('ano-input', 'ano-span');
            } else {
                removeInputError('ano-input', 'ano-span');
                removeInputError('ano-input', 'ano-empty');
            }
        }

        function validaCor() {
            if (cor.value == "") {
                event.preventDefault();
                removeInputError('cor-input', 'cor-span');
                setInputError('cor-input', 'cor-empty');
            } else if (cor.value.length < 3) {
                event.preventDefault();
                removeInputError('cor-input', 'cor-empty');
                setInputError('cor-input', 'cor-span');
            } else {
                removeInputError('cor-input', 'cor-span');
                removeInputError('cor-input', 'cor-empty');
            }
        }

        function validaPlaca() {
            const placaRegex = /^[a-zA-Z]{3}[0-9]{4}$/;
            const placaMercosulCarroRegex = /^[a-zA-Z]{3}[0-9]{1}[a-zA-Z]{1}[0-9]{2}$/;
            const placaMercosulMotoRegex = /^[a-zA-Z]{3}[0-9]{2}[a-zA-Z]{1}[0-9]{1}$/;

            if (placa.value == "") {
                event.preventDefault();
                removeInputError('placa-input', 'placa-span');
                setInputError('placa-input', 'placa-empty');
            } else if (placaMercosulMotoRegex.test(placa.value)) {
                removeInputError('placa-input', 'placa-span');
                removeInputError('placa-input', 'placa-empty');
            } else if (placaMercosulCarroRegex.test(placa.value)) {
                removeInputError('placa-input', 'placa-span');
                removeInputError('placa-input', 'placa-empty');
            } else if (placaRegex.test(placa.value)) {
                removeInputError('placa-input', 'placa-span');
                removeInputError('placa-input', 'placa-empty');
            } else {
                event.preventDefault();
                removeInputError('placa-input', 'placa-empty');
                setInputError('placa-input', 'placa-span');
            }
        }

        function validaDoc() {
            if ((!ipva.checked) || (!licenciamento.checked) || (!seguro.checked)) {
                doc.value = "0";
                docRegular.style.display = 'none';
                docIrregular.style.display = 'block';
            } else {
                doc.value = "1";
                docIrregular.style.display = 'none';
                docRegular.style.display = 'block';
            }

            if (ipva.checked) {
                ipva_value.value = "1";
            } else if (!ipva.checked) {
                ipva_value.value = "0";
            }

            if (licenciamento.checked) {
                licenciamento_value.value = "1";
            } else if (!licenciamento.checked) {
                licenciamento_value.value = "0";
            }

            if (seguro.checked) {
                seguro_value.value = "1";
            } else if (!seguro.checked) {
                seguro_value.value = "0";
            }
        }
    </script>

</body>

</html>