<?php
require_once 'conc.php';
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
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>


	<head>
		<title>Escolha a quantidade de bilhetes</title>
		<link rel="stylesheet" href="stayle.css">
	</head>

<body>

	<div>
		<form action="informacoes.php" method="post">

			<h1>Escolha a quantidade de bilhetes</h1>

			<div class="img">
				<img class="imagem" src="https://static.vecteezy.com/ti/fotos-gratis/p3/6671766-fantastica-lua-magica-luz-e-agua-barco-com-arvore-papel-de-parede-gratis-foto.jpg" alt="">
			</div>

			<div class="container">
				<div class="adiction">
					<button type="button" id="decrement" onclick="stepper(-1)">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 255, 1);">
							<path d="M5 11h14v2H5z"></path>
						</svg>
					</button>
					<input type="number" min="1" max="100" step="1" value="1" name="quantidade" id="quantidade" oninput="stepper(0)">
					<button type="button" id="increment" onclick="stepper(1)">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 255, 1);">
							<path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
						</svg>
					</button>
				</div>
			</div>

			<p id="total"><?php echo "Total: R$ " . $row["valor"] . "0" ?></p>

			<button type="submit" id="continuar" name="submit">Continuar</button>

		</form>
	</div>
	<div>

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

			function stepper(value) {
				const quantidade = parseInt(quantidadeInput.value);
				const novoValor = quantidade + value;

				if (novoValor >= 0 && novoValor <= 100) {
					quantidadeInput.value = novoValor;
					const total = novoValor * precoUnitario;
					totalParagrafo.innerText = `Total: R$ ${total.toFixed(2)}`;
				}
			}
		</script>
</body>

</html>