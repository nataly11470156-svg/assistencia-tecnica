<?php

include("conexao.php");

$id = $_GET["id"];

$sql = "DELETE FROM clientes WHERE id=$id";

if($conexao->query($sql)){

header("Location:listar.php");

}else{

echo "Erro ao excluir.";

}

?>