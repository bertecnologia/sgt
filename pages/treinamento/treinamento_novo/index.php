<?php

include_once('../../../connect.php');
include_once('../../../config.php');

if (isset($_POST['newTreinamento'])) {
    $vazio = "";
    $status = "Aberto";
    // Pega os valores do form
    $codCurso = $_POST['select_codCurso'];
    $instrutor = $_POST['select_instrutor'];
    $empresa = $_POST['select_empresa'];
    $data_inicio = $_POST['data_inicio'];

    // Insere no banco
    $query = "INSERT INTO treinamentos VALUES (NULL, '$codCurso', '$instrutor', '$empresa', '$data_inicio', NULL, '$status')";
    $result = $conn->query($query) or die($conn->error);

    if ($result) {
        header('Location: ../index.php');
    } else {
        echo "Erro ao adicionar treinamento";
    }
}

?>

<!DOCTYPE html>
<html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Treinamento - Novo</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            //Pega o select com o id #cod_curso
            $("#id_curso").change(function() {
                //Atribui o value do select para a var -> cod_curso
                var id_curso = $(this).val();
                $.ajax({
                    //Envia via POST o valor de cad_curso para o arquivo -> get_intrutores.php
                    url: "get_instrutores.php",
                    method: "POST",
                    data: {
                        id_curso: id_curso
                    },
                    dataType: "text",
                    success: function(data) {
                        //Insere as infos retornadas no select de id #instrutor
                        $("#instrutor").html(data);
                    }
                });
            });
        });
    </script>

</head>

<body>
    <h2>Novo Treinamento</h2>

    <form action="" method="POST">
        <label for="categoria">Curso:</label>
        <select id="id_curso" name="select_codCurso">
            <option value="#">Selecione</option>
            <?php
            $curso_query = "SELECT id_curso, nome_curso, cod_curso, duracao_curso FROM cursos";
            $curso_exec = $conn->query($curso_query) or die($conn->error);
            if ($curso_exec->num_rows > 0) {
                while ($curso_dados = $curso_exec->fetch_object()) {
                    //Atribui o nome_da_empresa + nome_da_unidade para -> $nomeCurso
                    $nomeCurso = "$curso_dados->nome_curso: $curso_dados->duracao_curso Hrs";
                    //Define o código e ID do curso
                    $codCurso = $curso_dados->cod_curso;
                    $idCurso = $curso_dados->id_curso;

            ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nomeCurso ?></option>
            <?php
                }
            }
            ?>
        </select>
        <br><br>
        <label for="instrutor">Instrutor:</label>
        <select name="select_instrutor" id="instrutor"></select>
        <br><br>


        <label for="categoria">Empresa:</label>
        <select id="cod_curso" name="select_empresa">
            <option value="#">Selecione</option>
            <?php
            $empresa_query = "SELECT id_empresa, nome_empresa, unidade_empresa FROM empresas";
            $empresa_exec = $conn->query($empresa_query) or die($conn->error);
            if ($empresa_exec->num_rows > 0) {
                while ($empresa_dados = $empresa_exec->fetch_object()) {

                    $idEmpresa = $empresa_dados->id_empresa;
                    $nomeEmpresa = "$empresa_dados->nome_empresa - $empresa_dados->unidade_empresa";

            ?>
                    <option value="<?php echo $nomeEmpresa ?>"><?php echo $nomeEmpresa ?></option>
            <?php
                }
            }
            ?>
        </select>
        <br><br>

        <label for="data_inicio">Data de Início:</label>
        <input type="date" name="data_inicio" required>

        <br><br>
        <div class="form-buttons">
            <button type="submit" name="newTreinamento">Iniciar Novo Treinamento</button>
            <a href="../index.php" class="cancel-button">CANCELAR</a>
        </div>
        <br>

    </form>
</body>

</html>