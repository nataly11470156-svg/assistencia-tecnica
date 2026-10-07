<?php

include("conexao.php");

if(isset($_POST['salvar'])){

$cliente=$_POST['cliente'];
$equipamento=$_POST['equipamento'];
$tecnico=$_POST['tecnico'];
$problema=$_POST['problema'];
$diagnostico=$_POST['diagnostico'];
$servico=$_POST['servico'];
$pecas=$_POST['pecas'];
$vpecas=$_POST['valor_pecas'];
$vservico=$_POST['valor_servico'];
$vtotal=$vpecas+$vservico;
$status=$_POST['status'];
$abertura=$_POST['abertura'];
$entrega=$_POST['entrega'];

$sql="INSERT INTO ordens
(cliente_id,equipamento_id,tecnico,problema,diagnostico,servico,pecas,valor_pecas,valor_servico,valor_total,status,data_abertura,data_entrega)

VALUES

('$cliente','$equipamento','$tecnico','$problema','$diagnostico','$servico','$pecas','$vpecas','$vservico','$vtotal','$status','$abertura','$entrega')";

mysqli_query($conexao,$sql);

header("Location:ordens.php");

exit;

}

$clientes=mysqli_query($conexao,"SELECT * FROM clientes");

$equipamentos=mysqli_query($conexao,"SELECT * FROM equipamentos");

$ordens=mysqli_query($conexao,

"SELECT

ordens.*,

clientes.nome,

equipamentos.modelo

FROM ordens

INNER JOIN clientes
ON clientes.id=ordens.cliente_id

INNER JOIN equipamentos
ON equipamentos.id=ordens.equipamento_id

ORDER BY ordens.id DESC");

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Ordens de Serviço</title>

<link rel="stylesheet" href="css/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<header>

<div class="logo">

<h2>Ordens de Serviço</h2>

</div>

<nav>

<a href="index.php">Dashboard</a>

<a href="clientes.php">Clientes</a>

<a href="equipamentos.php">Equipamentos</a>

</nav>

</header>

<div class="container mt-5">

<div class="card shadow p-4">

<h3>Nova Ordem de Serviço</h3>

<form method="POST">

<select class="form-control" name="cliente">

<?php while($c=mysqli_fetch_assoc($clientes)){ ?>

<option value="<?=$c['id']?>">

<?=$c['nome']?>

</option>

<?php } ?>

</select>

<br>

<select class="form-control" name="equipamento">

<?php while($e=mysqli_fetch_assoc($equipamentos)){ ?>

<option value="<?=$e['id']?>">

<?=$e['marca']?> <?=$e['modelo']?>

</option>

<?php } ?>

</select>

<br>

<input class="form-control"

name="tecnico"

placeholder="Técnico Responsável">

<br>

<textarea class="form-control"

name="problema"

placeholder="Problema Informado"></textarea>

<br>

<textarea class="form-control"

name="diagnostico"

placeholder="Diagnóstico"></textarea>

<br>

<textarea class="form-control"

name="servico"

placeholder="Serviço Executado"></textarea>

<br>

<textarea class="form-control"

name="pecas"

placeholder="Peças Utilizadas"></textarea>

<br>

<div class="row">

<div class="col">

<input type="number"

step="0.01"

name="valor_pecas"

class="form-control"

placeholder="Valor Peças">

</div>

<div class="col">

<input type="number"

step="0.01"

name="valor_servico"

class="form-control"

placeholder="Mão de obra">

</div>

</div>

<br>

<select class="form-control"

name="status">

<option>Recebido</option>

<option>Em análise</option>

<option>Aguardando peça</option>

<option>Em manutenção</option>

<option>Pronto</option>

<option>Entregue</option>

</select>

<br>

<div class="row">

<div class="col">

<label>Data de abertura</label>

<input type="date"

name="abertura"

class="form-control">

</div>

<div class="col">

<label>Previsão entrega</label>

<input type="date"

name="entrega"

class="form-control">

</div>

</div>

<br>

<button class="btn btn-success"

name="salvar">

Salvar Ordem

</button>

</form>

</div>

<br>

<div class="card shadow p-4">

<h3>Ordens Cadastradas</h3>

<table class="table table-striped">

<thead>

<tr>

<th>OS</th>

<th>Cliente</th>

<th>Equipamento</th>

<th>Técnico</th>

<th>Status</th>

<th>Total</th>

</tr>

</thead>

<tbody>

<?php while($o=mysqli_fetch_assoc($ordens)){ ?>

<tr>

<td><?=$o['id']?></td>

<td><?=$o['nome']?></td>

<td><?=$o['modelo']?></td>

<td><?=$o['tecnico']?></td>

<td><?=$o['status']?></td>

<td>

R$

<?=number_format($o['valor_total'],2,",",".")?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>

</html>