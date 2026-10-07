<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}

include("conexao.php");



// ENVIAR CHAMADO

if(isset($_POST['enviar'])){


$usuario = $_SESSION['id'];

$assunto = $_POST['assunto'];

$mensagem = $_POST['mensagem'];



$sql = "

INSERT INTO suporte

(usuario_id,assunto,mensagem,status)

VALUES

('$usuario',
'$assunto',
'$mensagem',
'Aberto')

";



mysqli_query($conexao,$sql);



header("Location:suporte.php");

exit;


}



// LISTAR CHAMADOS


$chamados = mysqli_query($conexao,

"

SELECT

suporte.*,

usuarios.nome


FROM suporte


INNER JOIN usuarios

ON usuarios.id = suporte.usuario_id


ORDER BY suporte.id DESC


"

);


?>



<!DOCTYPE html>

<html lang="pt-br">


<head>

<meta charset="UTF-8">

<title>Suporte</title>

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


<a href="logout.php">
🚪 Sair
</a>



</div>




<div class="main">


<h1 class="titulo">

Central de Suporte

</h1>




<form method="POST">


<input

type="text"

name="assunto"

placeholder="Assunto do chamado"

required>



<textarea

name="mensagem"

placeholder="Digite sua dúvida, problema ou sugestão"

rows="6"

required></textarea>




<button name="enviar">

📨 Enviar Chamado

</button>



</form>





<h2 class="titulo">

Chamados registrados

</h2>




<table>


<tr>

<th>ID</th>

<th>Usuário</th>

<th>Assunto</th>

<th>Status</th>

<th>Data</th>

</tr>



<?php


while($s=mysqli_fetch_assoc($chamados)){


?>


<tr>


<td>

<?= $s['id']; ?>

</td>


<td>

<?= $s['nome']; ?>

</td>


<td>

<?= $s['assunto']; ?>

</td>


<td>

<?= $s['status']; ?>

</td>


<td>

<?= $s['data_envio']; ?>

</td>


</tr>



<?php

}

?>


</table>




</div>


</body>

</html>