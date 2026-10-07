<?php
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);

    $sql = "INSERT INTO clientes
    (nome, cpf, telefone, email, endereco, cidade, estado, cep)
    VALUES
    ('$nome','$cpf','$telefone','$email','$endereco','$cidade','$estado','$cep')";

    if(mysqli_query($conexao,$sql)){
        echo "<script>
                alert('Cliente cadastrado com sucesso!');
                window.location='clientes.php';
              </script>";
    }else{
        echo "Erro: ".mysqli_error($conexao);
    }

}
?>