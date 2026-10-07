<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}


include("conexao.php");



// BLOQUEAR USUÁRIOS QUE NÃO SÃO COORDENADOR

if($_SESSION['tipo'] != "Coordenador"){

echo "

<script>

alert('Acesso permitido apenas ao Coordenador!');

window.location='index.php';

</script>

";

exit;

}




// APROVAR RESERVA


if(isset($_GET['aprovar'])){


$id=$_GET['aprovar'];


mysqli_query($conexao,

"

UPDATE reservas

SET status='Aprovada'

WHERE id='$id'

"

);


header("Location:coordenador.php");

exit;

}




// CANCELAR RESERVA


if(isset($_GET['cancelar'])){


$id=$_GET['cancelar'];


mysqli_query($conexao,

"

UPDATE reservas

SET status='Cancelada'

WHERE id='$id'

"

);


header("Location:coordenador.php");

exit;

}




// ALTERAR STATUS DO SUPORTE


if(isset($_GET['resolver'])){


$id=$_GET['resolver'];


mysqli_query($conexao,

"

UPDATE suporte

SET status='Resolvido'

WHERE id='$id'

"

);


header("Location:coordenador.php");

exit;

}





// BUSCAR RESERVAS


$reservas=mysqli_query($conexao,

"

SELECT

reservas.id,

usuarios.nome,

livros.titulo,

reservas.status


FROM reservas


INNER JOIN usuarios

ON usuarios.id=reservas.usuario_id


INNER JOIN livros

ON livros.id=reservas.livro_id


ORDER BY reservas.id DESC


"

);




// BUSCAR SUPORTE


$suporte=mysqli_query($conexao,

"

SELECT

suporte.*,

usuarios.nome


FROM suporte


INNER JOIN usuarios

ON usuarios.id=suporte.usuario_id


ORDER BY suporte.id DESC


"

);



?>



<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Área do Coordenador</title>

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


<a href="coordenador.php">
👨‍💼 Coordenador
</a>


<a href="logout.php">
🚪 Sair
</a>



</div>




<div class="main">


<h1 class="titulo">

👨‍💼 Painel do Coordenador

</h1>




<h2 class="titulo">

Controle de Reservas

</h2>



<table>


<tr>

<th>Usuário</th>

<th>Livro</th>

<th>Status</th>

<th>Ações</th>

</tr>



<?php


while($r=mysqli_fetch_assoc($reservas)){


?>


<tr>


<td>

<?= $r['nome']; ?>

</td>


<td>

<?= $r['titulo']; ?>

</td>


<td>

<?= $r['status']; ?>

</td>


<td>


<a href="coordenador.php?aprovar=<?= $r['id']; ?>">

✅ Aprovar

</a>



<a href="coordenador.php?cancelar=<?= $r['id']; ?>">

❌ Cancelar

</a>


</td>


</tr>


<?php

}

?>


</table>





<h2 class="titulo">

Chamados de Suporte

</h2>




<table>


<tr>

<th>Usuário</th>

<th>Assunto</th>

<th>Status</th>

<th>Ação</th>

</tr>



<?php


while($s=mysqli_fetch_assoc($suporte)){


?>


<tr>


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


<a href="coordenador.php?resolver=<?= $s['id']; ?>">

✔ Resolver

</a>


</td>


</tr>


<?php

}

?>


</table>



</div>


</body>

</html>