<?php
include("conexao.php");

// Salvar equipamento
if(isset($_POST['salvar'])){

    $cliente=$_POST['cliente'];
    $tipo=$_POST['tipo'];
    $marca=$_POST['marca'];
    $modelo=$_POST['modelo'];
    $serie=$_POST['serie'];
    $cor=$_POST['cor'];
    $defeito=$_POST['defeito'];
    $acessorios=$_POST['acessorios'];
    $obs=$_POST['obs'];
    $status=$_POST['status'];
    $data=$_POST['data'];

    $sql="INSERT INTO equipamentos
    (cliente_id,tipo,marca,modelo,numero_serie,cor,defeito,acessorios,observacoes,status,data_entrada)
    VALUES
    ('$cliente','$tipo','$marca','$modelo','$serie','$cor','$defeito','$acessorios','$obs','$status','$data')";

    mysqli_query($conexao,$sql);

    header("Location:equipamentos.php");
    exit;
}

// Lista de clientes
$clientes=mysqli_query($conexao,"SELECT * FROM clientes ORDER BY nome");

// Lista de equipamentos
$equipamentos=mysqli_query($conexao,"
SELECT
equipamentos.*,
clientes.nome
FROM equipamentos
INNER JOIN clientes
ON clientes.id=equipamentos.cliente_id
ORDER BY equipamentos.id DESC
");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Equipamentos</title>

<link rel="stylesheet" href="css/style.css">

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

Cadastro de Equipamentos

</h1>

<form method="POST">

<label>Cliente</label>

<select name="cliente" required>

<?php
while($c=mysqli_fetch_assoc($clientes)){
?>

<option value="<?=$c['id']?>">

<?=$c['nome']?>

</option>

<?php } ?>

</select>

<input
name="tipo"
placeholder="Tipo (Notebook, Celular...)"
required>

<input
name="marca"
placeholder="Marca">

<input
name="modelo"
placeholder="Modelo">

<input
name="serie"
placeholder="Número de Série">

<input
name="cor"
placeholder="Cor">

<textarea
name="defeito"
placeholder="Defeito informado"></textarea>

<textarea
name="acessorios"
placeholder="Acessórios entregues"></textarea>

<textarea
name="obs"
placeholder="Observações"></textarea>

<select name="status">

<option>Recebido</option>

<option>Em Análise</option>

<option>Aguardando Peça</option>

<option>Em Manutenção</option>

<option>Pronto</option>

<option>Entregue</option>

</select>

<label>Data de Entrada</label>

<input
type="date"
name="data">

<button
name="salvar">

💾 Salvar Equipamento

</button>

</form>

<br><br>

<h2>

Equipamentos Cadastrados

</h2>

<table>

<thead>

<tr>

<th>ID</th>

<th>Cliente</th>

<th>Tipo</th>

<th>Marca</th>

<th>Modelo</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

while($e=mysqli_fetch_assoc($equipamentos)){

?>

<tr>

<td><?=$e['id']?></td>

<td><?=$e['nome']?></td>

<td><?=$e['tipo']?></td>

<td><?=$e['marca']?></td>

<td><?=$e['modelo']?></td>

<td><?=$e['status']?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>