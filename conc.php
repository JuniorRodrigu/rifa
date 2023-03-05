<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rifa_db";

// Conecta ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Executa uma consulta na tabela "clientes"
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Itera sobre os resultados
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . ", Nome: " . $row["nome"] . ", Telefone: " . $row["telefone"] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Executa uma consulta na tabela "rifas"
$sql = "SELECT rifas.numero, clientes.nome 
        FROM rifas 
        INNER JOIN clientes ON rifas.cliente_id = clientes.id";
$result = $conn->query($sql);

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Itera sobre os resultados
    while ($row = $result->fetch_assoc()) {
        echo "Rifa: " . $row["numero"] . ", Cliente: " . $row["nome"] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
