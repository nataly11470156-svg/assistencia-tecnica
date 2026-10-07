<?php

include("conexao.php");

$sql="SELECT * FROM clientes";

$resultado=$conexao->query($sql);

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Clientes</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Clientes Cadastrados</h2>

<table>

<tr>

<th>ID</th>
<th>Nome</th>
<th>Telefone</th>
<th>Email</th>
<th>Endereço</th>
<th>Ações</th>

</tr>

<?php while($cliente = $resultado->fetch_assoc()){ ?>

<tr>

<td><?php echo $cliente["id"]; ?></td>

<td><?php echo $cliente["nome"]; ?></td>

<td><?php echo $cliente["telefone"]; ?></td>

<td><?php echo $cliente["email"]; ?></td>

<td><?php echo $cliente["endereco"]; ?></td>

<td>

<a class="editar" href="editar.php?id=<?php echo $cliente["id"]; ?>">Editar</a>

|

<a class="excluir" href="excluir.php?id=<?php echo $cliente["id"]; ?>">Excluir</a>

</td>

</tr>

<?php } ?>

</table>

<br>

<a class="voltar" href="index.php">Voltar ao Menu</a>

</div>

</body>

</html>