<?php

include("conexao.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];

$sql = "INSERT INTO clientes
(nome,telefone,email,endereco)
VALUES
('$nome','$telefone','$email','$endereco')";

if($conexao->query($sql)){

echo "<script>

alert('Cliente cadastrado com sucesso!');

window.location='clientes.php';

</script>";

}else{

echo "Erro: ".$conexao->error;

}

?>