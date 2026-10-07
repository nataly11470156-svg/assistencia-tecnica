<?php
include("conexao.php");

// Salvar cliente
if(isset($_POST['salvar'])){

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $sql = "INSERT INTO clientes
    (nome, cpf, telefone, email, endereco, cidade, estado, cep)
    VALUES
    ('$nome','$cpf','$telefone','$email','$endereco','$cidade','$estado','$cep')";

    mysqli_query($conexao,$sql);

    header("Location: clientes.php");
    exit;
}

// Buscar clientes
$clientes = mysqli_query($conexao,"SELECT * FROM clientes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Clientes</title>

<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="sidebar">

<div class="logo">

🔧 Assistência Técnica

</div>

<ul>

<li><a href="index.php">🏠 Dashboard</a></li>

<li><a href="clientes.php">👥 Clientes</a></li>

<li><a href="equipamentos.php">💻 Equipamentos</a></li>

<li><a href="ordens.php">📄 Ordens</a></li>

</ul>

</div>

<div class="main">

<h1 class="titulo">

Cadastro de Clientes

</h1>

<form method="POST">

<input
type="text"
name="nome"
placeholder="Nome Completo"
required>

<input
type="text"
name="cpf"
placeholder="CPF">

<input
type="text"
name="telefone"
placeholder="Telefone">

<input
type="email"
name="email"
placeholder="E-mail">

<input
type="text"
name="endereco"
placeholder="Endereço">

<input
type="text"
name="cidade"
placeholder="Cidade">

<input
type="text"
name="estado"
placeholder="Estado">

<input
type="text"
name="cep"
placeholder="CEP">

<button
type="submit"
name="salvar">

💾 Salvar Cliente

</button>

</form>

<br><br>

<h2>

Clientes Cadastrados

</h2>

<table>

<thead>

<tr>

<th>ID</th>

<th>Nome</th>

<th>CPF</th>

<th>Telefone</th>

<th>E-mail</th>

<th>Cidade</th>

</tr>

</thead>

<tbody>

<?php

while($c = mysqli_fetch_assoc($clientes)){

?>

<tr>

<td><?= $c['id']; ?></td>

<td><?= $c['nome']; ?></td>

<td><?= $c['cpf']; ?></td>

<td><?= $c['telefone']; ?></td>

<td><?= $c['email']; ?></td>

<td><?= $c['cidade']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>