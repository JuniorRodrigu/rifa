<?php

$servername = "db4free.net";
$username = "rifasdadosdb12";
$password = "lulade24";
$dbname = "rifadadso12";

// Cria conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
  die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta SQL para buscar o valor do bilhete
$sql = "SELECT valor FROM valor LIMIT 1";

// Executa a consulta
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $precoUnitario = $row["valor"];
} else {
  $precoUnitario = 0.20; // valor padrão em caso de falha na consulta
}

// Fecha a conexão com o banco de dados
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Escolha a quantidade de bilhetes</title>
	<link rel="stylesheet" href="stayle.css">
</head>
<body>
	<div class="container">
		<h1>Escolha a quantidade de bilhetes</h1>
		<form action="informacoes.php" method="post">
			<label for="quantidade">Quantidade:</label>
			<input type="number" name="quantidade" id="quantidade" min="1" max="10" required>
			<p id="total"></p>
			<button type="submit" name="submit">Continuar</button>
		</form>
	</div>
	<script>
		// Obter referência ao campo de entrada da quantidade e ao parágrafo para exibir o total
		const quantidadeInput = document.getElementById("quantidade");
		const totalParagrafo = document.getElementById("total");

		// Definir o preço unitário dos bilhetes
		const precoUnitario = <?php echo $precoUnitario ?>;

		// Adicionar um ouvinte de eventos para o campo de entrada da quantidade
		quantidadeInput.addEventListener("input", () => {
			// Obter a quantidade atual
			const quantidade = quantidadeInput.value;

			// Calcular o valor total e atualizar o parágrafo
			const total = quantidade * precoUnitario;
			totalParagrafo.innerText = `Total: R$ ${total.toFixed(2)}`;
		});
	</script>
</body>
</html>
