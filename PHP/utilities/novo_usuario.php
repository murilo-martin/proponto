<?php

    include "mysqlconecta.php";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tel = $_POST["telefone"];

    $verifyName = mysqli_query($conexao, "Select name,email,telefone FROM usuario WHERE name = '$nome' ");
    $verifyTel = mysqli_query($conexao, "Select name,email,telefone FROM usuario WHERE telefone = '$tel'");
    $verifyEmail = mysqli_query($conexao, "Select name,email,telefone FROM usuario WHERE email = '$email'");

    if (mysqli_num_rows($verifyName) != 0) {
        echo "nome cadastrado";
    } 
    if(mysqli_num_rows($verifyTel) != 0){
        echo "telefone cadastrado";
    }
    if(mysqli_num_rows($verifyEmail) != 0){
        echo "email cadastrado";
    }

    if(mysqli_num_rows($verifyTel) == 0 && mysqli_num_rows($verifyEmail) == 0 && mysqli_num_rows($verifyName) == 0){

        mysqli_query($conexao,"insert into usuario(name,email,telefone) values ('$nome','$email','$tel')");
        echo "success";
    }

    mysqli_close($conexao);

?>