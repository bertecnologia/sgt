<?php
include('../../../connect.php');

// Recebe o ID da categoria selecionada
$id_curso = $_POST['id_curso'];

// Monta a query SQL
$sql1 = "SELECT * FROM cursos WHERE id_curso = $id_curso";
$dados = $conn->query($sql1);
while ($row = $dados->fetch_assoc()){
    $cod_curso = $row['cod_curso'];
}

$sql = "SELECT * FROM instrutor WHERE $cod_curso = 1";

// Executa a query SQL e armazena o resultado em $result
$result = $conn->query($sql);

// Monta o HTML com as opções do select de produtos
$html = "";
while ($row = $result->fetch_assoc()) {
    $html .= "<option value='" . $row['id_instrutor'] . "'>" . $row['nome_instrutor'] . "</option>";
}

// Retorna o HTML gerado para ser utilizado pelo Javascript
echo $html;

// Fecha a conexão com o banco de dados
$conn->close();
