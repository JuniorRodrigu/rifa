<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css" media="screen and (min-width: 480px)">

<head>
    <title>Comprar Rifa</title>
</head>
<body>
<?php
        $quantidade = $_POST['quantidade'];
    ?>
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


