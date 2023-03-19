<?php 
$id = intval($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Importar arquivo CSV</title>
</head>
<body>
	<form method="post" action="import.php" enctype="multipart/form-data">
		<label>Selecione o arquivo CSV:</label>
		<input type="file" name="arquivo_csv">
		<input type="hidden" name="id_treinamento" value="<?php echo $id; ?>">
		<input type="submit" value="Importar">
	</form>
</body>
</html>
