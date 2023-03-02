<?php
// Verifica se as informações necessárias foram enviadas
if (isset($_POST['quantidade']) && isset($_POST['nome']) && isset($_POST['telefone'])) {
    // Conecta com o banco de dados
    $servername = "db4free.net";
    $username = "rifasdadosdb12";
    $password = "lulade24";
    $dbname = "rifadadso12";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }



    // Define o valor da rifa
    $valor_rifa = 10;

    // Pega a quantidade de bilhetes selecionada
    $quantidade = $_POST['quantidade'];

    // Insere as informações do cliente no banco de dados
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $sql = "INSERT INTO clientes (nome, telefone) VALUES ('$nome', '$telefone')";
    if ($conn->query($sql) === false) {
        die("Erro ao inserir informações do cliente: " . $conn->error);
    }
    $cliente_id = $conn->insert_id;

    // Gera um número aleatório para cada bilhete
    for ($i = 1; $i <= $quantidade; $i++) {
        // Gera um número no padrão da loteria federal
        $numero = mt_rand(10000, 99999);

        // Verifica se o número já foi vendido
        $sql = "SELECT * FROM rifas WHERE numero = $numero";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $i--;
            continue;
        }

        // Insere as informações da rifa no banco de dados
        $sql = "INSERT INTO rifas (numero, cliente_id, valor) VALUES ($numero, $cliente_id, $valor_rifa)";
        if ($conn->query($sql) === false) {
            die("Erro ao inserir informações da rifa: " . $conn->error);
        }

        // Exibe o número do bilhete gerado
        echo "Número do bilhete gerado: $numero<br>";
    }
}
?>
