<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

if (isset($id)) {
    $sql_instrutores = "SELECT * FROM instrutor WHERE id_instrutor = '$id' ";
    $query_instrutor = $conn->query($sql_instrutores) or die($conn->error);
    $instrutor = $query_instrutor->fetch_assoc();

    $nomeInstrutor = $instrutor['nome_instrutor'];
    $rgInstrutor = $instrutor['rg_instrutor'];
    $mteInstrutor = $instrutor['mte_instrutor'];
    $craInstrutor = $instrutor['cra_instrutor'];
    $nitInstrutor = $instrutor['nit_instrutor'];
    $funcaoInstrutor = $instrutor['funcao_instrutor'];
    $veiculoInstrutor = $instrutor['veiculo_instrutor'];


    //Formatar CPF para apresentação
    $cpfBruto = $instrutor['cpf_instrutor'];
    $cpfA = substr($cpfBruto, 0, 3);
    $cpfB = substr($cpfBruto, 3, 3);
    $cpfC = substr($cpfBruto, 6, 3);
    $cpfD = substr($cpfBruto, 9, 2);
    $cpfInstrutor = "$cpfA.$cpfB.$cpfC-$cpfD";

    $celBruto = $instrutor['celular_instrutor'];
    $ddd = substr($celBruto, 0, 2);
    $celPA = substr($celBruto, 2, 5);
    $celPB = substr($celBruto, 7, 4);
    $celularInstrutor = "($ddd) $celPA-$celPB";

    //Seleção de NRs

    $nr5V = $instrutor['nr5'];
    $nr6V = $instrutor['nr6'];
    $nr10V = $instrutor['nr10'];
    $nr12V = $instrutor['nr12'];
    $nr18V = $instrutor['nr18'];
    $nr20V = $instrutor['nr20'];
    $nr23V = $instrutor['nr23'];
    $nr26V = $instrutor['nr26'];
    $nr33V = $instrutor['nr33'];
    $nr35V = $instrutor['nr35'];

    $nr5Check = "";
    if ($nr5V == 1) {
        $nr5Check = "checked";
    }

    $nr6Check = "";
    if ($nr6V == 1) {
        $nr6Check = "checked";
    }

    $nr10Check = "";
    if ($nr10V == 1) {
        $nr10Check = "checked";
    }

    $nr12Check = "";
    if ($nr12V == 1) {
        $nr12Check = "checked";
    }

    $nr18Check = "";
    if ($nr18V == 1) {
        $nr18Check = "checked";
    }

    $nr20Check = "";
    if ($nr20V == 1) {
        $nr20Check = "checked";
    }

    $nr23Check = "";
    if ($nr23V == 1) {
        $nr23Check = "checked";
    }

    $nr26Check = "";
    if ($nr26V == 1) {
        $nr26Check = "checked";
    }

    $nr33Check = "";
    if ($nr33V == 1) {
        $nr33Check = "checked";
    }

    $nr35Check = "";
    if ($nr35V == 1) {
        $nr35Check = "checked";
    }
}

if (($_POST) && (isset($_POST['updateInstrutor']))) {
    $mte = $_POST['mte_instrutor'];
    $cra = $_POST['cra_instrutor'];
    $nit = $_POST['nit_instrutor'];
    $funcao = $_POST['funcao_instrutor'];
    $assinatura = $_POST['ass_instrutor'];
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

    echo $nr5;

    $instrutorUpdate = "UPDATE instrutor SET
        mte_instrutor = '$mte',
        cra_instrutor = '$cra',
        nit_instrutor = '$nit',
        funcao_instrutor = '$funcao',
        assinatura_instrutor = '$assinatura',
        veiculo_instrutor = '$veiculo',
        nr5 = '$nr5',
        nr6 = '$nr6',
        nr10 = '$nr10',
        nr12 = '$nr12',
        nr18 = '$nr18',
        nr20 = '$nr20',
        nr23 = '$nr23',
        nr26 = '$nr26',
        nr33 = '$nr33',
        nr35 = '$nr35'
        WHERE id_instrutor = '$id'";

    $sql_exe = $conn->query($instrutorUpdate) or die($conn->error);

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
    <title>Editar Instrutor</title>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQuery_v3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo BASEURL?>lib/js/jQueryMaskPlugin_v1.14.16.js"></script>

</head>

<body>

    <h1>Editar Instrutor</h1>

    <form id="form" method="POST">
        <p><b>Nome:</b> <?php echo $nomeInstrutor ?> </p>
        <p><b>RG:</b> <?php echo $rgInstrutor ?> </p>
        <p><b>CPF:</b> <?php echo $cpfInstrutor ?> </p>
        <p><b>Celular:</b> <?php echo $celularInstrutor ?> </p>

        <p>
            <label for="mte-instrutor">MTE:</label>
            <input type="text" name="mte_instrutor" class="mte" id="mte-input" placeholder="" oninput="validaMTE()" value="<?php echo $mteInstrutor ?>">
            <span class="alert-message" id="mte-empty">*Preencha MTE e/ou CRA!</span>
            <span class="alert-message" id="mte-span">*MTE incorreto!</span>
        </p>

        <p>
            <label for="cra-instrutor">CRA:</label>
            <input type="text" name="cra_instrutor" class="cra" id="cra-input" placeholder="000000" oninput="validaCRA()" value="<?php echo $craInstrutor ?>">
            <span class="alert-message" id="cra-empty">*Preencha MTE e/ou CRA!</span>
            <span class="alert-message" id="cra-span">*CRA inválido!</span>
        </p>

        <p>
            <label for="nit_instrutor">NIT:</label>
            <input type="text" name="nit_instrutor" class="nit" id="nit-input" placeholder="000.00000.00-0" oninput="validaNIT()" value="<?php echo $nitInstrutor ?>">
            <span class="alert-message" id="nit-empty">*Preencha este campo!</span>
            <span class="alert-message" id="nit-span">*NIT inválido!</span>
        </p>

        <p>
            <label for="funcao_instrutor">Função:</label>
            <input type="text" name="funcao_instrutor" class="" id="funcao-input" placeholder="Ex: Engenheiro Eletricista" oninput="validaFuncao()" value="<?php echo $funcaoInstrutor ?>">
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
                <option value="<?php echo $veiculoInstrutor ?>"><?php echo $veiculoInstrutor ?></option>
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
            <input type="checkbox" id="nr5-check" oninput="validaNr5()" <?php echo $nr5Check ?>>
        </p>

        <p>
            <label for="nr_6">NR-6:</label>
            <input type="checkbox" id="nr6-check" oninput="validaNr6()" <?php echo $nr6Check ?>>
        </p>

        <p>
            <label for="nr_10">NR-10:</label>
            <input type="checkbox" id="nr10-check" oninput="validaNr10()" <?php echo $nr10Check ?>>
        </p>
        <p>
            <label for="nr_12">NR-12:</label>
            <input type="checkbox" id="nr12-check" oninput="validaNr12()" <?php echo $nr12Check ?>>
        </p>

        <p>
            <label for="nr_18">NR-18:</label>
            <input type="checkbox" id="nr18-check" oninput="validaNr18()" <?php echo $nr18Check ?>>
        </p>

        <p>
            <label for="nr_20">NR-20:</label>
            <input type="checkbox" id="nr20-check" oninput="validaNr20()" <?php echo $nr20Check ?>>
        </p>

        <p>
            <label for="nr_23">NR-23:</label>
            <input type="checkbox" id="nr23-check" oninput="validaNr23()" <?php echo $nr23Check ?>>
        </p>

        <p>
            <label for="nr_26">NR-26:</label>
            <input type="checkbox" id="nr26-check" oninput="validaNr26()" <?php echo $nr26Check ?>>
        </p>

        <p>
            <label for="nr_33">NR-33:</label>
            <input type="checkbox" id="nr33-check" oninput="validaNr33()" <?php echo $nr33Check ?>>
        </p>

        <p>
            <label for="nr_35">NR-35:</label>
            <input type="checkbox" id="nr35-check" oninput="validaNr35()" <?php echo $nr35Check ?>>
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

        <button type="submit" name="updateInstrutor">Salvar</button>
    </form>

    <script>
        //Máscaras por class
        $('.cra').mask('000000');
        $('.nit').mask('000.00000.00-0');

        //Get dos inputs por ID
        //Inputs de preenchimento manual ou automático
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

        //Validação dos insputs no envio do Form
        form.addEventListener('submit', (event) => {
            validaMteCra();
            validaNIT();
            validaFuncao();
            validaVeiculo();
            validaNRS();
            validaNr5();
            validaNr6();
            validaNr10();
            validaNr12();
            validaNr18();
            validaNr20();
            validaNr23();
            validaNr26();
            validaNr33();
            validaNr35();
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
                console.log("nr5-check");
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