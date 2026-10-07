<?php

include("conexao.php");

$sql = "SELECT ordens.*, clientes.nome 

FROM ordens 

INNER JOIN clientes 

ON ordens.cliente_id = clientes.id";

$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Ordens de Serviço</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Ordens de Serviço</h2>


<table>

<tr>

<th>ID</th>
<th>Cliente</th>
<th>Equipamento</th>
<th>Marca</th>
<th>Modelo</th>
<th>Defeito</th>
<th>Status</th>
<th>Valor</th>
<th>Ações</th>

</tr>


<?php while($ordem = $resultado->fetch_assoc()){ ?>

<tr>

<td>
<?php echo $ordem["id"]; ?>
</td>


<td>
<?php echo $ordem["nome"]; ?>
</td>


<td>
<?php echo $ordem["equipamento"]; ?>
</td>


<td>
<?php echo $ordem["marca"]; ?>
</td>


<td>
<?php echo $ordem["modelo"]; ?>
</td>


<td>
<?php echo $ordem["defeito"]; ?>
</td>


<td>
<?php echo $ordem["status"]; ?>
</td>


<td>
R$ <?php echo $ordem["valor"]; ?>
</td>


<td>

<a class="editar" href="editar_ordem.php?id=<?php echo $ordem["id"]; ?>">
Editar
</a>

|

<a class="excluir" href="excluir_ordem.php?id=<?php echo $ordem["id"]; ?>">
Excluir
</a>


</td>


</tr>


<?php } ?>


</table>


<br>

<a class="voltar" href="index.php">
Voltar ao Menu
</a>


</div>

</body>

</html>