<?php

session_start();

include("conexao.php");


if(isset($_POST['entrar'])){


$email = $_POST['email'];

$senha = $_POST['senha'];



$sql = "SELECT * FROM usuarios 
WHERE email='$email' 
AND senha='$senha'";


$resultado = mysqli_query($conexao,$sql);



if(mysqli_num_rows($resultado)>0){


$usuario = mysqli_fetch_assoc($resultado);



$_SESSION['id'] = $usuario['id'];

$_SESSION['nome'] = $usuario['nome'];

$_SESSION['tipo'] = $usuario['tipo'];



header("Location:index.php");


}else{


$erro = "Email ou senha incorretos!";


}



}


?>



<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Biblioteca Online - Login</title>


<link rel="stylesheet" href="css/style.css">


<style>

body{

display:flex;
justify-content:center;
align-items:center;
height:100vh;

}


.login{

width:400px;

}


.login h1{

text-align:center;
color:#d4af37;
margin-bottom:25px;

}


</style>


</head>



<body>


<div class="login">


<form method="POST">


<h1>

📚 Biblioteca Online

</h1>



<?php

if(isset($erro)){

echo "<p style='color:red;text-align:center'>$erro</p>";

}

?>



<input 
type="email"
name="email"
placeholder="Digite seu email"
required>



<input 
type="password"
name="senha"
placeholder="Digite sua senha"
required>



<button 
name="entrar"
type="submit">

Entrar

</button>



</form>


</div>


</body>

</html>