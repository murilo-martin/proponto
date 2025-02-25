<?php

    include "mysqlconecta.php";

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tel = $_POST["telefone"];

    mysqli_query($conexao,"insert into usuario(name,email,telefone) values ('$nome','$email','$tel')");
     
    mysqli_close($conexao);

?>