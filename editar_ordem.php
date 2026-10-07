<?php

include("conexao.php");


$id = $_GET["id"];


$sql = "SELECT * FROM ordens WHERE id=$id";


$resultado = $conexao->query($sql);


$ordem = $resultado->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Editar Ordem</title>

<link rel="stylesheet" href="style.css">

</head>


<body>


<div class="container">


<h2>Editar Ordem de Serviço</h2>


<form action="atualizar_ordem.php" method="POST">


<input type="hidden" name="id" value="<?php echo $ordem["id"]; ?>">


<label>Equipamento</label>

<input type="text" 
name="equipamento" 
value="<?php echo $ordem["equipamento"]; ?>">



<label>Marca</label>

<input type="text" 
name="marca" 
value="<?php echo $ordem["marca"]; ?>">



<label>Modelo</label>

<input type="text" 
name="modelo" 
value="<?php echo $ordem["modelo"]; ?>">



<label>Defeito</label>

<textarea name="defeito"><?php echo $ordem["defeito"]; ?></textarea>



<label>Status</label>


<select name="status">


<option>
<?php echo $ordem["status"]; ?>
</option>

<option>Recebido</option>

<option>Em análise</option>

<option>Em manutenção</option>

<option>Pronto</option>

<option>Entregue</option>


</select>



<label>Valor</label>

<input type="number"
step="0.01"
name="valor"
value="<?php echo $ordem["valor"]; ?>">



<input type="submit" value="Atualizar">


</form>


<br>

<a class="voltar" href="listar_ordens.php">
Voltar
</a>


</div>


</body>

</html>