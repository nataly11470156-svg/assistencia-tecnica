<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}

include("conexao.php");


$id = $_SESSION['id'];



// ATUALIZAR PERFIL

if(isset($_POST['salvar'])){


$nome = $_POST['nome'];

$email = $_POST['email'];

$telefone = $_POST['telefone'];

$endereco = $_POST['endereco'];



$sql = "

UPDATE usuarios SET

nome='$nome',

email='$email',

telefone='$telefone',

endereco='$endereco'


WHERE id='$id'

";


mysqli_query($conexao,$sql);



$_SESSION['nome']=$nome;


header("Location:perfil.php");

exit;


}



// ALTERAR SENHA

if(isset($_POST['senha'])){


$novaSenha = $_POST['novaSenha'];



mysqli_query($conexao,

"

UPDATE usuarios SET

senha='$novaSenha'

WHERE id='$id'

"

);



echo "<script>

alert('Senha alterada com sucesso!');

</script>";


}




// BUSCAR USUÁRIO


$usuario = mysqli_fetch_assoc(

mysqli_query($conexao,

"SELECT * FROM usuarios WHERE id='$id'"

)

);


?>



<!DOCTYPE html>

<html lang="pt-br">


<head>

<meta charset="UTF-8">

<title>Meu Perfil</title>

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


<a href="perfil.php">
👤 Meu Perfil
</a>


<a href="logout.php">
🚪 Sair
</a>



</div>




<div class="main">


<h1 class="titulo">

Meu Perfil

</h1>



<form method="POST">


<input

type="text"

name="nome"

value="<?= $usuario['nome']; ?>"

required>



<input

type="email"

name="email"

value="<?= $usuario['email']; ?>"

required>



<input

type="text"

name="telefone"

value="<?= $usuario['telefone']; ?>"

placeholder="Telefone">



<input

type="text"

name="endereco"

value="<?= $usuario['endereco']; ?>"

placeholder="Endereço">



<button name="salvar">

💾 Salvar Alterações

</button>



</form>




<h2 class="titulo">

Alterar Senha

</h2>




<form method="POST">


<input

type="password"

name="novaSenha"

placeholder="Nova senha"

required>



<button name="senha">

🔐 Alterar Senha

</button>



</form>



</div>


</body>

</html>