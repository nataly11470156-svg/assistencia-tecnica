<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}

include("conexao.php");


// CADASTRAR RESERVA

if(isset($_POST['salvar'])){


$usuario = $_POST['usuario'];

$livro = $_POST['livro'];

$data_reserva = date("Y-m-d");

$data_prevista = $_POST['data_prevista'];



// verifica disponibilidade do livro

$verifica = mysqli_query($conexao,

"SELECT disponiveis FROM livros WHERE id='$livro'"

);


$dados = mysqli_fetch_assoc($verifica);



if($dados['disponiveis'] > 0){



$sql = "

INSERT INTO reservas

(usuario_id,livro_id,data_reserva,data_prevista,status)

VALUES

('$usuario',
'$livro',
'$data_reserva',
'$data_prevista',
'Pendente')

";



mysqli_query($conexao,$sql);



// diminui quantidade disponível


mysqli_query($conexao,

"UPDATE livros 
SET disponiveis = disponiveis - 1
WHERE id='$livro'"

);



header("Location:reservas.php");

exit;



}else{


echo "<script>

alert('Livro indisponível!');

</script>";


}



}


// BUSCAR USUÁRIOS


$usuarios = mysqli_query($conexao,

"SELECT * FROM usuarios 
WHERE tipo='Aluno' OR tipo='Professor'"

);



// BUSCAR LIVROS DISPONÍVEIS


$livros = mysqli_query($conexao,

"SELECT * FROM livros 
WHERE disponiveis > 0"

);



// LISTAR RESERVAS


$reservas = mysqli_query($conexao,

"

SELECT

reservas.*,

usuarios.nome,

livros.titulo


FROM reservas


INNER JOIN usuarios

ON usuarios.id = reservas.usuario_id


INNER JOIN livros

ON livros.id = reservas.livro_id


ORDER BY reservas.id DESC


"

);


?>



<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Reservas</title>

<link rel="stylesheet" href="css/style.css">

</head>


<body>



<div class="sidebar">


<div class="logo">

📚 Biblioteca Online

</div>


<a href="index.php">
🏠 Dashboard
</a>


<a href="usuarios.php">
👥 Usuários
</a>


<a href="livros.php">
📚 Livros
</a>


<a href="reservas.php">
📅 Reservas
</a>


<a href="logout.php">
🚪 Sair
</a>


</div>




<div class="main">


<h1 class="titulo">

Reserva de Livros

</h1>




<form method="POST">



<select name="usuario" required>


<option>

Selecione o usuário

</option>


<?php

while($u=mysqli_fetch_assoc($usuarios)){

?>


<option value="<?= $u['id']; ?>">

<?= $u['nome']; ?>

</option>


<?php } ?>


</select>





<select name="livro" required>


<option>

Selecione o livro

</option>



<?php

while($l=mysqli_fetch_assoc($livros)){

?>


<option value="<?= $l['id']; ?>">

<?= $l['titulo']; ?>

</option>



<?php } ?>


</select>





<label>

Data prevista de devolução

</label>


<input

type="date"

name="data_prevista"

required>



<button name="salvar">

📅 Fazer Reserva

</button>


</form>






<h2 class="titulo">

Reservas cadastradas

</h2>




<table>


<tr>

<th>ID</th>

<th>Usuário</th>

<th>Livro</th>

<th>Data Reserva</th>

<th>Entrega</th>

<th>Status</th>

</tr>



<?php


while($r=mysqli_fetch_assoc($reservas)){


?>


<tr>


<td>

<?= $r['id']; ?>

</td>


<td>

<?= $r['nome']; ?>

</td>


<td>

<?= $r['titulo']; ?>

</td>


<td>

<?= $r['data_reserva']; ?>

</td>


<td>

<?= $r['data_prevista']; ?>

</td>


<td>

<?= $r['status']; ?>

</td>


</tr>


<?php

}

?>


</table>



</div>


</body>

</html>