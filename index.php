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
		const precoUnitario = 0.20;

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
