<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loteria";

// Cria conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
  die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if(isset($_POST['telefone'])){
  $telefone = $_POST['telefone'];
  
  // Definição da consulta SQL
  $sql = "SELECT bilhete FROM clientes WHERE telefone = '$telefone'";

  // Executa a consulta
  $result = $conn->query($sql);

  echo "Bilhetes: " ;
  if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      
      echo " ".$row["bilhete"];
    }
  } else {
    echo "Nenhum bilhete encontrado para este número de telefone.";
  }
  
  // Fecha a conexão com o banco de dados
  $conn->close();
}

?>

<form method="post">
  <label for="telefone">Telefone:</label>
  <input type="text" id="telefone" name="telefone">
  <button type="submit">Buscar</button>
</form>

