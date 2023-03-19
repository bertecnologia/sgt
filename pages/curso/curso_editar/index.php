<?php

include_once('../../../connect.php');
include_once('../../../config.php');

$id = intval($_GET['id']);

if (isset($id)) {
    $sql_cursos = "SELECT * FROM cursos WHERE id_curso = '$id' ";
    $query_curso = $conn->query($sql_cursos) or die($conn->error);
    $curso = $query_curso->fetch_assoc();

    $nomeV = $curso['nome_curso'];
    $duracaoV = $curso['duracao_curso'];
    $descricaoV = $curso['descricao_curso'];
    $tipo = $curso['tipo_curso'];

    $codBruto = $curso['cod_curso'];
    $codV = str_replace("nr", "", $codBruto);

    $hidden = "hidden";
    $tipoV = "";
    if ($tipo == "nr") {
        $tipoV = "NR";
        $hidden = "";
    } else if ($tipo == "outro") {
        $tipoV = "Outros";
    };
}

if (($_POST) && (isset($_POST['updateCurso']))) {
    $nomeCurso = $_POST['nome_curso'];
    $tipoCurso = $_POST['tipo_curso'];
    $codNr = $_POST['nr_cod'];
    $codOutro = $_POST['outro_cod'];
    $duracaoCurso = $_POST['duracao_curso'];
    $descricaoCurso = $_POST['descricao_curso'];

    $codigoCurso = "";
    if ($tipoCurso == "nr") {
        $codigoCurso = "nr$codNr";
    } else if ($tipoCurso == "outro") {
        $codigoCurso = "outro";
    }

    $cursoUpdate = "UPDATE cursos SET
        nome_curso = '$nomeCurso',
        tipo_curso = '$tipoCurso',
        cod_curso = '$codigoCurso',
        duracao_curso = '$duracaoCurso',
        descricao_curso = '$descricaoCurso'
        WHERE id_curso = '$id'";

    $sql_exe = $conn->query($cursoUpdate) or die($conn->error);

    if ($sql_exe) {
        header('Location: ../index.php');
    } else {
        echo "ERRO";
    }
};

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h1>Editar Curso</h1>

    <form id="form" method="POST">

        <p>
            <label for="">Nome:</label>
            <input type="text" name="nome_curso" class="" id="nome-input" placeholder="NR-33 (Espaço Confinado)" maxlength="" oninput="validaNome()" value="<?php echo $nomeV ?>">
            <span class="alert-message" id="nome-span">*Nome inválido!</span>
            <span class="alert-message" id="nome-empty">*Preencha este campo!</span>
        </p>
        <br>
        <p>
            <label for="tipo_cod">Tipo:</label>
            <select name="tipo_curso" id="tipoCod-select" oninput="validaTipoCod()">
                <option value="<?php echo $tipo ?>"><?php echo $tipoV ?></option>
                <option value="nr">NR</option>
                <option value="outro">Outros</option>
            </select>
            <span class="alert-message" id="codSelect-span">*Selecione uma opção!</span>
            <br>


            <label for="nr_cod" id="label-nr" hidden>NR-</label>
            <input type="number" name="nr_cod" class="" id="codNr" placeholder="33" maxlength="3" oninput="validaNR()" value="<?php echo $codV ?>" <?php echo $hidden ?>> <span class="alert-message" id="nr-empty">*Preencha o código da NR!</span>
        </p>
        <br>
        <p>
            <label for="">Duração:</label>
            <input type="number" name="duracao_curso" class="" id="horas-input" placeholder="10" maxlength="3" oninput="validaDuracao()" value="<?php echo $duracaoV ?>">Hrs
            <span class="alert-message" id="horas-empty">*Preencha a duração do curso!</span>
        </p>
        <br>
        <p>
            <label for="descricao_curso">Descrição:</label>
            <br>
            <textarea name="descricao_curso" id="descricao-input" cols="36" rows="5" oninput="validaDescricao()"><?php echo $descricaoV ?></textarea>
            <span class="alert-message" id="descricao-empty">*Preencha a descrição!</span>
        </p>


        <button type="submit" name="updateCurso">Atualizar</button>
        <br>
        <button style="margin-top: 20px;"><a href="../index.php">Cancelar</a></button>
    </form>

    <script>
        //Get dos inputs pelos IDs
        var nome = document.getElementById('nome-input');
        var tipo_cod = document.getElementById('tipoCod-select');
        var cod_nr = document.getElementById('codNr');
        var cod_outro = document.getElementById('codOutro');
        var duracao = document.getElementById('horas-input');
        var descricao = document.getElementById('descricao-input');

        var labelNr = document.getElementById('label-nr');
        var codNr = document.getElementById('codNr');
        var labelOutro = document.getElementById('label-outro');
        var codOutro = document.getElementById('codOutro');


        //Validação de todos os campos no momento do envio do FORM
        form.addEventListener('submit', (event) => {
            validaNome();
            validaDuracao();
            validaDescricao();
            validaTipoCod();
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
            } else if (nome.value.length < 3) {
                removeInputError('nome-input', 'nome-empty');
                setInputError('nome-input', 'nome-span');
            } else {
                removeInputError('nome-input', 'nome-empty');
                removeInputError('nome-input', 'nome-span');
            }
        }

        function validaTipoCod() {
            if (tipo_cod.value == "#") {
                event.preventDefault();
                setInputError('tipoCod-select', 'codSelect-span');

                removeInputError('codNr', 'nr-empty');
                removeInputError('codOutro', 'outro-empty');

                labelOutro.style.display = 'none';
                codOutro.style.display = 'none';
                labelNr.style.display = 'none';
                codNr.style.display = 'none';
                codOutro.value = "";
                codNr.value = "";

            } else if (tipo_cod.value == "nr") {
                removeInputError('tipoCod-select', 'codSelect-span');
                labelNr.style.display = 'block';
                codNr.style.display = 'block';

                labelOutro.style.display = 'none';
                codOutro.style.display = 'none';
                codOutro.value = "";

                validaNR();

            } else if (tipo_cod.value == "outro") {
                removeInputError('tipoCod-select', 'codSelect-span');
                labelOutro.style.display = 'block';
                codOutro.style.display = 'block';

                labelNr.style.display = 'none';
                codNr.style.display = 'none';
                codNr.value = "";

                validaOutro();
            }
        }

        function validaNR() {
            if (codNr.value == "") {
                event.preventDefault();
                setInputError('codNr', 'nr-empty');
                removeInputError('codOutro', 'outro-empty');
            } else {
                removeInputError('codNr', 'nr-empty');
                removeInputError('codOutro', 'outro-empty');
            }
        }

        function validaOutro() {
            if (codOutro.value == "") {
                event.preventDefault();
                removeInputError('codNr', 'nr-empty');
                setInputError('codOutro', 'outro-empty');
            } else {
                removeInputError('codNr', 'nr-empty');
                removeInputError('codOutro', 'outro-empty');
            }
        }

        function validaDuracao() {
            if (duracao.value == "") {
                event.preventDefault();
                setInputError('horas-input', 'horas-empty');
            } else {
                removeInputError('horas-input', 'horas-empty');
            }
        }

        function validaDescricao() {
            if (descricao.value == "") {
                event.preventDefault();
                setInputError('descricao-input', 'descricao-empty');
            } else {
                removeInputError('descricao-input', 'descricao-empty');
            }
        }
    </script>

</body>

</html>