<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$nomeFuncionarioSelect = "Selecione";
$valueFuncionarioSelect = "#";

if (($_POST) && (isset($_POST['selectInstrutor']))) {
    $id_funcionario = $_POST['funcionario_select'];

    //select no DB para pegar as infos do ID selecionado
    $sql_funcionarios = "SELECT * FROM funcionarios WHERE id_funcionario = '$id_funcionario' ";
    $query_funcionario = $conn->query($sql_funcionarios) or die($conn->error);
    $funcionario = $query_funcionario->fetch_assoc();

    $nomeFuncionario = $funcionario['nome_funcionario'];
    $sobrenomeFuncionario = $funcionario['sobrenome_funcionario'];
    $rgFuncionario = $funcionario['rg_funcionario'];

    //Formatar CPF para apresentação
    $cpfBruto = $funcionario['cpf_funcionario'];
    $cpfA = substr($cpfBruto, 0, 3);
    $cpfB = substr($cpfBruto, 3, 3);
    $cpfC = substr($cpfBruto, 6, 3);
    $cpfD = substr($cpfBruto, 9, 2);
    $cpfFuncionario = "$cpfA.$cpfB.$cpfC-$cpfD";

    $celBruto = $funcionario['celular_funcionario'];
    $ddd = substr($celBruto, 0, 2);
    $celPA = substr($celBruto, 2, 5);
    $celPB = substr($celBruto, 7, 4);
    $celularFuncionario = "($ddd) $celPA-$celPB";

    $nomeCompleto = "$nomeFuncionario $sobrenomeFuncionario";
    $nomeFuncionarioSelect = "$nomeCompleto";
    $valueFuncionarioSelect = "$nomeCompleto";
}

if (($_POST) && (isset($_POST['newInstrutor']))) {
    $nome = $_POST['nome_instrutor'];
    $rg = $_POST['rg_instrutor'];
    $cpf = $_POST['cpf_instrutor'];
    $cel = $_POST['cel_instrutor'];
    $mte = $_POST['mte_instrutor'];
    $cra = $_POST['cra_instrutor'];
    $nit = $_POST['nit_instrutor'];
    $funcao = $_POST['funcao_instrutor'];
    $assinatura = "-";
    $veiculo = $_POST['veiculo_instrutor'];
    $nr5 = $_POST['nr5'];
    $nr6 = $_POST['nr6'];
    $nr10 = $_POST['nr10'];
    $nr12 = $_POST['nr12'];
    $nr18 = $_POST['nr18'];
    $nr20 = $_POST['nr20'];
    $nr23 = $_POST['nr23'];
    $nr26 = $_POST['nr26'];
    $nr33 = $_POST['nr33'];
    $nr35 = $_POST['nr35'];

    $instrutorNew = "INSERT INTO instrutor VALUES (NULL, '$nome', '$rg', '$cpf', '$cel', '$mte', '$cra','$nit', '$funcao', '$assinatura', '$veiculo', '$nr5', '$nr6', '$nr10', '$nr12', '$nr18', '$nr20', '$nr23', '$nr26', '$nr33', '$nr35')";

    $sql_exe = $conn->query($instrutorNew) or die($conn->error);

    if ($sql_exe) {
        header('Location: ../index.php');
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Instrutor</title>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQuery_v3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQueryMaskPlugin_v1.14.16.js"></script>

</head>

<body>

    <?php
    $sql_funcionarios = "SELECT * FROM funcionarios";
    $query_funcionarios = $conn->query($sql_funcionarios) or die($conn->error);
    $qtd_funcionarios = $query_funcionarios->num_rows;

    if ($qtd_funcionarios == 0) {
    ?>
        <h2>ERRO - Nenhum funcionário cadastrado.</h2>
        <h3>Para cadastrar um novo instrutor, cadastre um novo funcionário <a style="color:blue" href="../funcionario/funcionario_novo.php">Aqui</a>.</h3>

        <button style="margin-top: 20px;"><a href="../index.php">VOLTAR</a></button>

    <?php } else { ?>

        <h1>Cadastro de Instrutor</h1>

        <form id="form-select" method="POST">

            <p>
                <label for="funcionario_select">Colaborador:</label>
                <select name="funcionario_select" id="funcionario-select">
                    <option value="<?php echo $valueFuncionarioSelect ?>"><?php echo $nomeFuncionarioSelect ?></option>
                    <?php
                    $colabNome_query = "SELECT id_funcionario, nome_funcionario, sobrenome_funcionario FROM funcionarios";
                    $colabNome_exec = $conn->query($colabNome_query) or die($conn->error);
                    if ($colabNome_exec->num_rows > 0) {
                        while ($colabNome_dados = $colabNome_exec->fetch_object()) {
                            $fName = $colabNome_dados->nome_funcionario;
                            $lastName = $colabNome_dados->sobrenome_funcionario;
                            $fullname = "$fName $lastName";

                    ?>
                            <option value="<?php echo $colabNome_dados->id_funcionario ?>"><?php echo $fullname ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <span class="alert-message" id="funcionario-empty">*Selecione um colaborador!</span>
                <button id="btn-formColab" type="submit" name="selectInstrutor">Selecionar</button>
            </p>

        </form>

        <form id="form" method="POST">
            <p><b>Nome:</b> <?php echo $nomeCompleto ?></p>
            <p><b>RG:</b> <?php echo $rgFuncionario ?></p>
            <p><b>CPF:</b> <?php echo $cpfFuncionario ?></p>
            <p><b>Celular:</b> <?php echo $celularFuncionario ?></p>



            <input type="text" name="nome_instrutor" value="<?php echo $nomeCompleto ?>" hidden>
            <input type="text" name="rg_instrutor" value="<?php echo $rgFuncionario ?>" hidden>
            <input type="text" name="cpf_instrutor" value="<?php echo $cpfBruto ?>" hidden>
            <input type="text" name="cel_instrutor" value="<?php echo $celBruto ?>" hidden>

            <p>
                <label for="mte-instrutor">MTE:</label>
                <input type="text" name="mte_instrutor" class="mte" id="mte-input" placeholder="" oninput="validaMTE()">
                <span class="alert-message" id="mte-empty">*Preencha MTE e/ou CRA!</span>
                <span class="alert-message" id="mte-span">*MTE incorreto!</span>
            </p>

            <p>
                <label for="cra-instrutor">CRA:</label>
                <input type="text" name="cra_instrutor" class="cra" id="cra-input" placeholder="000000" oninput="validaCRA()">
                <span class="alert-message" id="cra-empty">*Preencha MTE e/ou CRA!</span>
                <span class="alert-message" id="cra-span">*CRA inválido!</span>
            </p>

            <p>
                <label for="nit_instrutor">NIT:</label>
                <input type="text" name="nit_instrutor" class="nit" id="nit-input" placeholder="000.00000.00-0" oninput="validaNIT()">
                <span class="alert-message" id="nit-empty">*Preencha este campo!</span>
                <span class="alert-message" id="nit-span">*NIT inválido!</span>
            </p>

            <p>
                <label for="funcao_instrutor">Função:</label>
                <input type="text" name="funcao_instrutor" class="" id="funcao-input" placeholder="Ex: Engenheiro Eletricista" oninput="validaFuncao()">
                <span class="alert-message" id="funcao-empty">*Preencha este campo!</span>
                <span class="alert-message" id="funcao-span">*Função Inválida!</span>
            </p>

            <p>
                <label for="ass_instrutor">Assinatura:</label>
                <input type="file" name="ass_instrutor" class="" id="ass-file">
                <span class="alert-message" id="ass-empty">*Selecione uma assinatura!</span>
            </p>

            <p>
                <label for="veiculo_instrutor">Veículo:</label>
                <select name="veiculo_instrutor" id="veiculo-select" oninput="validaVeiculo()">
                    <option value="#">Selecione</option>
                    <?php
                    $veiculos_query = "SELECT id_veiculo, modelo_veiculo FROM veiculos";
                    $veiculos_exec = $conn->query($veiculos_query) or die($conn->error);
                    if ($veiculos_exec->num_rows > 0) {
                        while ($veiculo_dados = $veiculos_exec->fetch_object()) {
                            $id_veiculo = $veiculo_dados->id_veiculo;
                            $modelo_veiculo = $veiculo_dados->modelo_veiculo;
                            $placa_veiculo = $veiculo_dados->placa_veiculo;

                    ?>
                            <option value="<?php echo $modelo_veiculo ?>"><?php echo $modelo_veiculo ?></option>
                    <?php
                        }
                    }
                    ?>
                    <option value="Próprio">Veículo Próprio</option>
                </select>
                <span class="alert-message" id="veiculo-empty">*Selecione um veículo!</span>
            </p>

            <hr>
            <br>

            <p>
            <p>NRs autorizadas:</p>

            <p>
                <label for="nr_5">NR-5:</label>
                <input type="checkbox" class="" id="nr5-check" oninput="validaNr5()">
            </p>

            <p>
                <label for="nr_6">NR-6:</label>
                <input type="checkbox" class="" id="nr6-check" oninput="validaNr6()">
            </p>

            <p>
                <label for="nr_10">NR-10:</label>
                <input type="checkbox" class="" id="nr10-check" oninput="validaNr10()">
            </p>
            <p>
                <label for="nr_12">NR-12:</label>
                <input type="checkbox" class="" id="nr12-check" oninput="validaNr12()">
            </p>

            <p>
                <label for="nr_18">NR-18:</label>
                <input type="checkbox" class="" id="nr18-check" oninput="validaNr18()">
            </p>

            <p>
                <label for="nr_20">NR-20:</label>
                <input type="checkbox" class="" id="nr20-check" oninput="validaNr20()">
            </p>

            <p>
                <label for="nr_23">NR-23:</label>
                <input type="checkbox" class="" id="nr23-check" oninput="validaNr23()">
            </p>

            <p>
                <label for="nr_26">NR-26:</label>
                <input type="checkbox" class="" id="nr26-check" oninput="validaNr26()">
            </p>

            <p>
                <label for="nr_33">NR-33:</label>
                <input type="checkbox" class="" id="nr33-check" oninput="validaNr33()">
            </p>

            <p>
                <label for="nr_35">NR-35:</label>
                <input type="checkbox" class="" id="nr35-check" oninput="validaNr35()">
            </p>
            <span class="alert-message" id="nrs-empty">*Selecone as NRs que o instrutor está autorizado a dar!</span>
            </p>
            <br><br>

            <input type="text" id="nr5" name="nr5" value="0" hidden>
            <input type="text" id="nr6" name="nr6" value="0" hidden>
            <input type="text" id="nr10" name="nr10" value="0" hidden>
            <input type="text" id="nr12" name="nr12" value="0" hidden>
            <input type="text" id="nr18" name="nr18" value="0" hidden>
            <input type="text" id="nr20" name="nr20" value="0" hidden>
            <input type="text" id="nr23" name="nr23" value="0" hidden>
            <input type="text" id="nr26" name="nr26" value="0" hidden>
            <input type="text" id="nr33" name="nr33" value="0" hidden>
            <input type="text" id="nr35" name="nr35" value="0" hidden>

            <button type="submit" name="newInstrutor">Cadastrar</button>
        </form>

        <button style="margin-top: 20px;"><a href="../index.php">Cancelar</a></button>

    <?php } ?>

    <script>
        //Máscaras por class
        $('.cra').mask('000000');
        $('.nit').mask('000.00000.00-0');

        //Get dos inputs por ID
        //Inputs de preenchimento manual ou automático
        var funcionario = document.getElementById('funcionario-select');
        var nome = document.getElementById('nome-input');
        var rg = document.getElementById('rg-input');
        var cpf = document.getElementById('cpf-input');
        var celular = document.getElementById('cel-input');
        var mte = document.getElementById('mte-input');
        var cra = document.getElementById('cra-input');
        var nit = document.getElementById('nit-input');
        var funcao = document.getElementById('funcao-input');
        var assinatura = document.getElementById('ass-file');
        var veiculo = document.getElementById('veiculo-select');
        //Checkboxs NRs
        var nr5 = document.getElementById('nr5-check');
        var nr6 = document.getElementById('nr6-check');
        var nr10 = document.getElementById('nr10-check');
        var nr12 = document.getElementById('nr12-check');
        var nr18 = document.getElementById('nr18-check');
        var nr20 = document.getElementById('nr20-check');
        var nr23 = document.getElementById('nr23-check');
        var nr26 = document.getElementById('nr26-check');
        var nr33 = document.getElementById('nr33-check');
        var nr35 = document.getElementById('nr35-check');

        var form_principal = document.getElementById('form');
        var form_select = document.getElementById('form-select');

        if (funcionario.value != "#") {
            form_principal.style.display = 'block';
            form_select.style.display = 'none';

        } else {
            form_principal.style.display = 'none';
            form_select.style.display = 'block';
        }

        //Validação dos insputs no envio do Form
        form.addEventListener('submit', (event) => {
            validaMteCra();
            validaNIT();
            validaFuncao();
            validaVeiculo();
            validaNRS();
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


        function validaMteCra() {
            if ((mte.value.length == 0) && (cra.value.length != 6)) {
                event.preventDefault();
                setInputError('mte-input', 'mte-empty');
                setInputError('cra-input', 'cra-span');
            } else if ((mte.value.length < 3) && (cra.value.length == 0)) {
                event.preventDefault();
                setInputError('cra-input', 'cra-empty');
                setInputError('mte-input', 'mte-span');
            } else if ((mte.value.length == 0) && (cra.value.length == 0)) {
                event.preventDefault();
                setInputError('mte-input', 'mte-empty');
                setInputError('cra-input', 'cra-empty');
            } else {
                removeInputError('mte-input', 'mte-empty');
                removeInputError('mte-input', 'mte-span');
                removeInputError('cra-input', 'cra-span');
                removeInputError('cra-input', 'cra-empty');
            }
        }

        function validaMTE() {
            if ((mte.value.length > 0) && (mte.value.length < 5)) {
                event.preventDefault();
                setInputError('mte-input', 'mte-span');
            } else {
                removeInputError('mte-input', 'mte-span');
                removeInputError('mte-input', 'mte-empty');
            }
        }

        function validaCRA() {
            if (cra.value.length != 6) {
                event.preventDefault();
                setInputError('cra-input', 'cra-span');
            } else {
                removeInputError('cra-input', 'cra-span');
                removeInputError('cra-input', 'cra-empty');
            }
        }

        function validaNIT() {
            if (nit.value == "") {
                event.preventDefault();
                removeInputError('nit-input', 'nit-span');
                setInputError('nit-input', 'nit-empty');
            } else if (nit.value.length < 13) {
                event.preventDefault();
                removeInputError('nit-input', 'nit-empty');
                setInputError('nit-input', 'nit-span');
            } else {
                removeInputError('nit-input', 'nit-empty');
                removeInputError('nit-input', 'nit-span');
            }
        }

        function validaFuncao() {
            if (funcao.value == "" || funcao.value.length < 1) {
                event.preventDefault();
                setInputError('funcao-input', 'funcao-empty');
                removeInputError('funcao-input', 'funcao-span');
            } else if (funcao.value.length < 5) {
                event.preventDefault();
                setInputError('funcao-input', 'funcao-span');
                removeInputError('funcao-input', 'funcao-empty');
            } else {
                removeInputError('funcao-input', 'funcao-empty');
                removeInputError('funcao-input', 'funcao-span');
            }
        }

        function validaVeiculo() {
            if (veiculo.value == "#" || veiculo.value == "") {
                event.preventDefault();
                setInputError('veiculo-select', 'veiculo-empty');
            } else {
                removeInputError('veiculo-select', 'veiculo-empty');
            }
            console.log(veiculo.value)
        }

        function validaNRS() {
            if (
                (nr5.checked == false) &&
                (nr6.checked == false) &&
                (nr10.checked == false) &&
                (nr12.checked == false) &&
                (nr18.checked == false) &&
                (nr20.checked == false) &&
                (nr23.checked == false) &&
                (nr26.checked == false) &&
                (nr33.checked == false) &&
                (nr35.checked == false)
            ) {
                event.preventDefault();
                document.getElementById('nrs-empty').style.display = 'block';
            } else {
                document.getElementById('nrs-empty').style.display = 'none';
            }
        }

        var nr5V = document.getElementById('nr5');
        var nr6V = document.getElementById('nr6');
        var nr10V = document.getElementById('nr10');
        var nr12V = document.getElementById('nr12');
        var nr18V = document.getElementById('nr18');
        var nr20V = document.getElementById('nr20');
        var nr23V = document.getElementById('nr23');
        var nr26V = document.getElementById('nr26');
        var nr33V = document.getElementById('nr33');
        var nr35V = document.getElementById('nr35');

        function validaNr5() {
            if (nr5.checked == true) {
                nr5V.value = "1";
            } else {
                nr5V.value = "0";
            }
        }

        function validaNr6() {
            if (nr6.checked == true) {
                nr6V.value = "1";
            } else {
                nr6V.value = "0";
            }
        }

        function validaNr10() {
            if (nr10.checked == true) {
                nr10V.value = "1";
            } else {
                nr10V.value = "0";
            }
        }

        function validaNr12() {
            if (nr12.checked == true) {
                nr12V.value = "1";
            } else {
                nr12V.value = "0";
            }
        }

        function validaNr18() {
            if (nr18.checked == true) {
                nr18V.value = "1";
            } else {
                nr18V.value = "0";
            }
        }

        function validaNr20() {
            if (nr20.checked == true) {
                nr20V.value = "1";
            } else {
                nr20V.value = "0";
            }
        }

        function validaNr23() {
            if (nr23.checked == true) {
                nr23V.value = "1";
            } else {
                nr23V.value = "0";
            }
        }

        function validaNr26() {
            if (nr26.checked == true) {
                nr26V.value = "1";
            } else {
                nr26V.value = "0";
            }
        }

        function validaNr33() {
            if (nr33.checked == true) {
                nr33V.value = "1";
            } else {
                nr33V.value = "0";
            }
        }

        function validaNr35() {
            if (nr35.checked == true) {
                nr35V.value = "1";
            } else {
                nr35V.value = "0";
            }
        }
    </script>

</body>

</html>