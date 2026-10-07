<?php

include("conexao.php");


$id = $_POST["id"];

$equipamento = $_POST["equipamento"];

$marca = $_POST["marca"];

$modelo = $_POST["modelo"];

$defeito = $_POST["defeito"];

$status = $_POST["status"];

$valor = $_POST["valor"];



$sql = "UPDATE ordens SET

equipamento='$equipamento',

marca='$marca',

modelo='$modelo',

defeito='$defeito',

status='$status',

valor='$valor'


WHERE id=$id";



if($conexao->query($sql)){


header("Location:listar_ordens.php");


}else{


echo "Erro ao atualizar ordem: ".$conexao->error;


}


?>