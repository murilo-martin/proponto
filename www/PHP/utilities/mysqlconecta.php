<?php

    $servidor = "127.0.0.1";
    $usuario = "root";
    $senha = "";
    $bancoDados = "proponto";
    
    $conexao = mysqli_connect($servidor,$usuario,$senha,$bancoDados) or die("Error");

?>