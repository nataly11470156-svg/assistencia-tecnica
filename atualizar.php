<?php

include("conexao.php");

$id = $_POST["id"];
$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$endereco = $_POST["endereco"];

$sql = "UPDATE clientes SET

nome='$nome',
telefone='$telefone',
email='$email',
endereco='$endereco'

WHERE id=$id";

if($conexao->query($sql)){

header("Location:listar.php");

}else{

echo "Erro ao atualizar.";

}

?>