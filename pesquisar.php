<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}


include("conexao.php");


$resultado = null;


if(isset($_GET['buscar'])){


$pesquisa = $_GET['pesquisa'];


$sql = "

SELECT * FROM livros

WHERE titulo LIKE '%$pesquisa%'

OR autor LIKE '%$pesquisa%'

OR categoria LIKE '%$pesquisa%'

";


$resultado = mysqli_query($conexao,$sql);


}


?>


<!DOCTYPE html>

<html lang="pt-br">


<head>

<meta charset="UTF-8">

<title>Pesquisar Livros</title>

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


<a href="devolucoes.php">
🔄 Devoluções
</a>


<a href="suporte.php">
🛠 Suporte
</a>


<a href="pesquisar.php">
🔎 Pesquisar
</a>


<a href="logout.php">
🚪 Sair
</a>


</div>




<div class="main">


<h1 class="titulo">

🔎 Pesquisa de Livros

</h1>



<form method="GET">


<input

type="text"

name="pesquisa"

placeholder="Digite título, autor ou categoria"

required>


<button name="buscar">

Pesquisar

</button>


</form>





<table>


<tr>

<th>Título</th>

<th>Autor</th>

<th>Categoria</th>

<th>Disponíveis</th>

<th>Status</th>

</tr>



<?php



if($resultado){



while($livro=mysqli_fetch_assoc($resultado)){


?>


<tr>


<td>

<?= $livro['titulo']; ?>

</td>


<td>

<?= $livro['autor']; ?>

</td>


<td>

<?= $livro['categoria']; ?>

</td>


<td>

<?= $livro['disponiveis']; ?>

</td>


<td>

<?= $livro['status']; ?>

</td>


</tr>


<?php


}


}


?>



</table>



</div>


</body>

</html>