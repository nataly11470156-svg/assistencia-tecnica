<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}


include("conexao.php");



// CADASTRAR USUÁRIO

if(isset($_POST['salvar'])){


$nome = $_POST['nome'];

$email = $_POST['email'];

$cpf = $_POST['cpf'];

$matricula = $_POST['matricula'];

$telefone = $_POST['telefone'];

$endereco = $_POST['endereco'];

$senha = $_POST['senha'];

$tipo = $_POST['tipo'];



$sql = "

INSERT INTO usuarios

(nome,email,cpf,matricula,telefone,endereco,senha,tipo)

VALUES

('$nome',
'$email',
'$cpf',
'$matricula',
'$telefone',
'$endereco',
'$senha',
'$tipo')

";



mysqli_query($conexao,$sql);


header("Location:usuarios.php");

exit;


}




// LISTAR USUÁRIOS

$lista = mysqli_query($conexao,

"SELECT * FROM usuarios ORDER BY id DESC"

);


?>



<!DOCTYPE html>

<html lang="pt-br">


<head>

<meta charset="UTF-8">

<title>Usuários - Biblioteca Online</title>

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

Cadastro de Usuários

</h1>




<form method="POST">


<input 
type="text"
name="nome"
placeholder="Nome completo"
required>



<input 
type="email"
name="email"
placeholder="E-mail"
required>



<input 
type="text"
name="cpf"
placeholder="CPF">



<input 
type="text"
name="matricula"
placeholder="Matrícula">



<input 
type="text"
name="telefone"
placeholder="Telefone">



<input 
type="text"
name="endereco"
placeholder="Endereço">



<input 
type="password"
name="senha"
placeholder="Senha">



<select name="tipo">


<option value="Aluno">

Aluno

</option>


<option value="Professor">

Professor

</option>


<option value="Coordenador">

Coordenador

</option>


</select>




<button name="salvar">

💾 Cadastrar Usuário

</button>



</form>





<h2 class="titulo">

Usuários cadastrados

</h2>




<table>


<tr>

<th>ID</th>

<th>Nome</th>

<th>Email</th>

<th>Tipo</th>

<th>Matrícula</th>


</tr>



<?php


while($u=mysqli_fetch_assoc($lista)){


?>


<tr>


<td>

<?= $u['id']; ?>

</td>


<td>

<?= $u['nome']; ?>

</td>


<td>

<?= $u['email']; ?>

</td>


<td>

<?= $u['tipo']; ?>

</td>


<td>

<?= $u['matricula']; ?>

</td>


</tr>


<?php

}

?>


</table>




</div>



</body>

</html>