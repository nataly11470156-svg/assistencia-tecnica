<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}

include("conexao.php");


// CADASTRAR LIVRO

if(isset($_POST['salvar'])){


$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$categoria = $_POST['categoria'];
$ano = $_POST['ano'];
$quantidade = $_POST['quantidade'];


$sql = "

INSERT INTO livros

(titulo,autor,editora,categoria,ano,quantidade,disponiveis)

VALUES

('$titulo',
'$autor',
'$editora',
'$categoria',
'$ano',
'$quantidade',
'$quantidade')

";


mysqli_query($conexao,$sql);


header("Location:livros.php");

exit;


}


// LISTAR LIVROS

$livros = mysqli_query($conexao,

"SELECT * FROM livros ORDER BY id DESC"

);


?>


<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Livros</title>

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

Cadastro de Livros

</h1>




<form method="POST">


<input 
type="text"
name="titulo"
placeholder="Título do livro"
required>


<input 
type="text"
name="autor"
placeholder="Autor">


<input 
type="text"
name="editora"
placeholder="Editora">


<input 
type="text"
name="categoria"
placeholder="Categoria">


<input 
type="number"
name="ano"
placeholder="Ano de publicação">


<input 
type="number"
name="quantidade"
placeholder="Quantidade"
required>



<button name="salvar">

📚 Cadastrar Livro

</button>


</form>



<h2 class="titulo">

Livros cadastrados

</h2>



<table>


<tr>

<th>ID</th>

<th>Título</th>

<th>Autor</th>

<th>Categoria</th>

<th>Total</th>

<th>Disponíveis</th>

</tr>



<?php


while($l=mysqli_fetch_assoc($livros)){


?>


<tr>


<td>

<?= $l['id']; ?>

</td>


<td>

<?= $l['titulo']; ?>

</td>


<td>

<?= $l['autor']; ?>

</td>


<td>

<?= $l['categoria']; ?>

</td>


<td>

<?= $l['quantidade']; ?>

</td>


<td>

<?= $l['disponiveis']; ?>

</td>


</tr>


<?php

}

?>


</table>



</div>


</body>

</html>