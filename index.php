<?php

session_start();

if(!isset($_SESSION['id'])){

    header("Location:login.php");
    exit;

}


include("conexao.php");


// TOTAL DE USUÁRIOS

$usuarios = mysqli_fetch_assoc(
mysqli_query($conexao,
"SELECT COUNT(*) total FROM usuarios")
)['total'];



// TOTAL DE LIVROS

$livros = mysqli_fetch_assoc(
mysqli_query($conexao,
"SELECT COUNT(*) total FROM livros")
)['total'];



// LIVROS DISPONÍVEIS

$disponiveis = mysqli_fetch_assoc(
mysqli_query($conexao,
"SELECT SUM(disponiveis) total FROM livros")
)['total'];



// RESERVAS

$reservas = mysqli_fetch_assoc(
mysqli_query($conexao,
"SELECT COUNT(*) total FROM reservas")
)['total'];




// ÚLTIMAS RESERVAS

$ultimas = mysqli_query($conexao,

"
SELECT 

usuarios.nome,
livros.titulo,
reservas.status,
reservas.data_reserva

FROM reservas

INNER JOIN usuarios

ON usuarios.id = reservas.usuario_id


INNER JOIN livros

ON livros.id = reservas.livro_id


ORDER BY reservas.id DESC

LIMIT 5

"

);


?>


<!DOCTYPE html>

<html lang="pt-br">


<head>

<meta charset="UTF-8">

<title>Biblioteca Online</title>


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
<a href="suporte.php">
🛠 Suporte
</a>
<a href="pesquisar.php">
🔎 Pesquisar Livros
</a>
<a href="perfil.php">
👤 Meu Perfil
</a>
<a href="coordenador.php">
👨‍💼 Coordenador
</a>
<a href="logout.php">
🚪 Sair
</a>



</div>





<div class="main">


<h1 class="titulo">

Olá, 
<?php echo $_SESSION['nome']; ?> 👋

</h1>



<div class="cards">



<div class="card">

<h2>

<?php echo $usuarios; ?>

</h2>

<p>

Usuários

</p>

</div>





<div class="card">

<h2>

<?php echo $livros; ?>

</h2>

<p>

Livros cadastrados

</p>

</div>






<div class="card">

<h2>

<?php echo $disponiveis ?? 0; ?>

</h2>

<p>

Livros disponíveis

</p>

</div>






<div class="card">

<h2>

<?php echo $reservas; ?>

</h2>

<p>

Reservas

</p>

</div>



</div>




<h2 class="titulo">

Últimas reservas

</h2>




<table>


<tr>

<th>Usuário</th>

<th>Livro</th>

<th>Status</th>

<th>Data</th>


</tr>



<?php


if(mysqli_num_rows($ultimas)>0){


while($linha=mysqli_fetch_assoc($ultimas)){


?>


<tr>


<td>

<?php echo $linha['nome']; ?>

</td>


<td>

<?php echo $linha['titulo']; ?>

</td>


<td>

<?php echo $linha['status']; ?>

</td>


<td>

<?php echo $linha['data_reserva']; ?>

</td>


</tr>



<?php


}

}else{


?>


<tr>

<td colspan="4">

Nenhuma reserva cadastrada

</td>

</tr>


<?php


}


?>



</table>




</div>


</body>


</html>