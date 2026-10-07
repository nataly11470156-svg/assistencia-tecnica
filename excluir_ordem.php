<?php

include("conexao.php");


$id = $_GET["id"];


$sql = "DELETE FROM ordens WHERE id=$id";



if($conexao->query($sql)){


header("Location:listar_ordens.php");


}else{


echo "Erro ao excluir ordem: ".$conexao->error;


}


?>