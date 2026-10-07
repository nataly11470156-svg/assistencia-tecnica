<?php

session_start();

if(!isset($_SESSION['id'])){

header("Location:login.php");
exit;

}


include("conexao.php");



// REALIZAR DEVOLUÇÃO

if(isset($_POST['devolver'])){


$reserva = $_POST['reserva'];

$observacao = $_POST['observacao'];

$data = date("Y-m-d");



// buscar livro da reserva

$buscar = mysqli_query($conexao,

"
SELECT livro_id 
FROM reservas 
WHERE id='$reserva'
"

);


$dados = mysqli_fetch_assoc($buscar);


$livro = $dados['livro_id'];



// cadastrar devolução


mysqli_query($conexao,

"

INSERT INTO devolucoes

(reserva_id,data_entrega,observacao,status)

VALUES

('$reserva',
'$data',
'$observacao',
'Finalizada')

"

);



// atualizar reserva


mysqli_query($conexao,

"

UPDATE reservas

SET status='Finalizada'

WHERE id='$reserva'

"

);



// devolver livro ao estoque


mysqli_query($conexao,

"

UPDATE livros

SET disponiveis = disponiveis + 1

WHERE id='$livro'

"

);



header("Location:devolucoes.php");

exit;


}





// RESERVAS ATIVAS


$reservas = mysqli_query($conexao,

"

SELECT

reservas.id,

usuarios.nome,

livros.titulo,

reservas.data_prevista


FROM reservas


INNER JOIN usuarios

ON usuarios.id = reservas.usuario_id


INNER JOIN livros

ON livros.id = reservas.livro_id


WHERE reservas.status <> 'Finalizada'


ORDER BY reservas.id DESC


"

);




// DEVOLUÇÕES REALIZADAS


$lista = mysqli_query($conexao,

"

SELECT

devolucoes.*,

usuarios.nome,

livros.titulo


FROM devolucoes


INNER JOIN reservas

ON reservas.id = devolucoes.reserva_id


INNER JOIN usuarios

ON usuarios.id = reservas.usuario_id


INNER JOIN livros

ON livros.id = reservas.livro_id


ORDER BY devolucoes.id DESC


"

);


?>



<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Devoluções</title>

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


<a href="logout.php">
🚪 Sair
</a>


</div>




<div class="main">


<h1 class="titulo">

Controle de Devoluções

</h1>




<form method="POST">


<select name="reserva" required>


<option>

Selecione a reserva

</option>



<?php

while($r=mysqli_fetch_assoc($reservas)){


?>


<option value="<?= $r['id']; ?>">


<?= $r['nome']; ?> -
<?= $r['titulo']; ?>


</option>



<?php

}

?>


</select>



<textarea

name="observacao"

placeholder="Observação da devolução">

</textarea>




<button name="devolver">

🔄 Registrar Devolução

</button>


</form>






<h2 class="titulo">

Histórico de devoluções

</h2>




<table>


<tr>

<th>ID</th>

<th>Usuário</th>

<th>Livro</th>

<th>Data</th>

<th>Status</th>

</tr>



<?php


while($d=mysqli_fetch_assoc($lista)){


?>


<tr>


<td>

<?= $d['id']; ?>

</td>


<td>

<?= $d['nome']; ?>

</td>


<td>

<?= $d['titulo']; ?>

</td>


<td>

<?= $d['data_entrega']; ?>

</td>


<td>

<?= $d['status']; ?>

</td>


</tr>


<?php

}

?>


</table>



</div>


</body>

</html>