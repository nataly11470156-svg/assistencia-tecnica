<?php

session_start();


if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}


include("conexao.php");


// SOMENTE COORDENADOR

if($_SESSION['tipo']!="Coordenador"){

echo "

<script>

alert('Acesso exclusivo do Coordenador');

window.location='index.php';

</script>

";

exit;

}



// CONSULTAS


$totalUsuarios = mysqli_fetch_assoc(

mysqli_query($conexao,

"SELECT COUNT(*) total FROM usuarios"

)

)['total'];



$totalLivros = mysqli_fetch_assoc(

mysqli_query($conexao,

"SELECT COUNT(*) total FROM livros"

)

)['total'];



$livrosDisponiveis = mysqli_fetch_assoc(

mysqli_query($conexao,

"SELECT SUM(disponiveis) total FROM livros"

)

)['total'];



$totalReservas = mysqli_fetch_assoc(

mysqli_query($conexao,

"SELECT COUNT(*) total FROM reservas"

)

)['total'];



$historico = mysqli_query($conexao,

"

SELECT

usuarios.nome,

livros.titulo,

reservas.status,

reservas.data_reserva


FROM reservas


INNER JOIN usuarios

ON usuarios.id=reservas.usuario_id


INNER JOIN livros

ON livros.id=reservas.livro_id


ORDER BY reservas.id DESC


"

);


?>


<!DOCTYPE html>

<html lang="pt-br">


<head>

<meta charset="UTF-8">

<title>Relatórios</title>

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


<a href="coordenador.php">
👨‍💼 Coordenador
</a>


<a href="relatorios.php">
📊 Relatórios
</a>


<a href="logout.php">
🚪 Sair
</a>


</div>





<div class="main">


<h1 class="titulo">

📊 Relatórios da Biblioteca

</h1>



<div class="cards">



<div class="card">

<h2>

<?= $totalUsuarios ?>

</h2>

<p>

Usuários

</p>

</div>




<div class="card">

<h2>

<?= $totalLivros ?>

</h2>

<p>

Livros cadastrados

</p>

</div>




<div class="card">

<h2>

<?= $livrosDisponiveis ?? 0 ?>

</h2>

<p>

Livros disponíveis

</p>

</div>




<div class="card">

<h2>

<?= $totalReservas ?>

</h2>

<p>

Reservas

</p>

</div>



</div>





<h2 class="titulo">

Histórico de Reservas

</h2>




<table>


<tr>

<th>Usuário</th>

<th>Livro</th>

<th>Status</th>

<th>Data</th>


</tr>



<?php


while($h=mysqli_fetch_assoc($historico)){


?>


<tr>


<td>

<?= $h['nome']; ?>

</td>


<td>

<?= $h['titulo']; ?>

</td>


<td>

<?= $h['status']; ?>

</td>


<td>

<?= $h['data_reserva']; ?>

</td>


</tr>


<?php

}

?>


</table>



<br>


<button onclick="window.print()">

🖨 Imprimir Relatório

</button>



</div>



</body>

</html>