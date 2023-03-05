
<?php
// Verifica se as informações necessárias foram enviadas
if (isset($_POST['quantidade']) && isset($_POST['nome']) && isset($_POST['telefone'])) {
    // Conecta com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "loteria";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

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

    // Cria uma string para armazenar os números de bilhetes gerados
    $numeros_gerados = "";

    // Gera um número aleatório para cada bilhete
    for ($i = 1; $i <= $quantidade; $i++) {
        // Gera um número no padrão da loteria federal
        $numero = mt_rand(10000, 99999);

        // Verifica se o número já foi vendido
        $sql = "SELECT * FROM clientes WHERE FIND_IN_SET($numero, bilhete)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $i--;
            continue;
        }

        // Adiciona o número de bilhete gerado à string
        $numeros_gerados .= $numero . ",";

    }

    // Remove a última vírgula da string
    $numeros_gerados = rtrim($numeros_gerados, ",");

    // Insere as informações dos bilhetes no banco de dados
    $sql = "UPDATE clientes SET bilhete='$numeros_gerados' WHERE id=$cliente_id";
    if ($conn->query($sql) === false) {
        die("Erro ao inserir informações dos bilhetes: " . $conn->error);
    }

    // Redireciona o usuário para a página de resultado com os números de bilhetes gerados
    header("Location: resultado.php?numeros=" . $numeros_gerados);
    exit();
}
?>
