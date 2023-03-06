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
<html>
<head>
	<title>Escolha a quantidade de bilhetes</title>
	<link rel="stylesheet" href="stayle.css">
</head>
<body>
	<div >
		<h1>Escolha a quantidade de bilhetes</h1>
		<form action="informacoes.php" method="post">
			<div class="container">
        <button type="button" id="decrement" onclick="stepper(-1)"> - </button>
        <input type="number" min="1" max="100" step="1" value="1" name="quantidade" id="quantidade" oninput="stepper(0)">
        <button type="button" id="increment" onclick="stepper(1)"> + </button>
    </div>
		
			<p id="total"></p>
			<button type="submit" id="continuar" name="submit">Continuar</button>
		</form>
	</div>
	<div>
	<script >
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
	</div>
</body>
</html>
