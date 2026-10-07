<?php

include("conexao.php");

$id = $_GET["id"];

$sql = "SELECT * FROM clientes WHERE id=$id";

$resultado = $conexao->query($sql);

$cliente = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Editar Cliente</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Editar Cliente</h2>

<form action="atualizar.php" method="POST">

<input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

<label>Nome</label>
<input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" required>

<label>Telefone</label>
<input type="text" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?php echo $cliente['email']; ?>">

<label>Endereço</label>
<input type="text" name="endereco" value="<?php echo $cliente['endereco']; ?>">

<input type="submit" value="Atualizar Cliente">

</form>

<br>

<a class="voltar" href="listar.php">Voltar</a>

</div>

</body>

</html>