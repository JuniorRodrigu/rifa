<!DOCTYPE html>
<html>
<link rel="stylesheet" href="stayle.css">
<head>
	<title>Comprar Rifa</title>
</head>
<body>
	<form method="post" action="gerar.php">
		<input type="hidden" name="quantidade" value="<?php echo $_POST['quantidade']; ?>">
		<label for="nome">Nome:</label>
		<input type="text" id="nome" name="nome" required><br><br>
		<label for="telefone">Telefone:</label>
		<input type="text" id="telefone" name="telefone" required><br><br>
		<button type="submit">Próximo</button>
	</form>
</body>
</html>
