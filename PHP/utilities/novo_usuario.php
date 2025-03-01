<?php

    include "mysqlconecta.php";

    $tipo = $_POST["tipo"];
    $nome = $_POST["nome"];
    $desc = $_POST["descricao"];
    $preco = $_POST["preco"];
    $endereco = $_POST["endereco"];
    $link = $_POST["link"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    $verifyName = mysqli_query($conexao, "Select nome_evento FROM eventos WHERE nome_evento = '$nome'");
    $verifyDesc = mysqli_query($conexao, "Select descricao_evento FROM eventos WHERE descricao_evento = '$desc'");
    $verifyEnd = mysqli_query($conexao, "Select endereco_evento FROM eventos WHERE endereco_evento = '$endereco'");
    $verifyLink = mysqli_query($conexao, "Select linkEnd_evento FROM eventos WHERE linkEnd_evento = '$link'");
    $verifyData = mysqli_query($conexao, "Select dataIni_evento FROM eventos WHERE dataIni_evento = '$data'");

    if (mysqli_num_rows($verifyName) != 0) {
        echo "nome cadastrado";
    } 
    if (mysqli_num_rows($verifyDesc) != 0) {
        echo "descricao cadastrado";
    } 
    if(mysqli_num_rows($verifyEnd) != 0 && mysqli_num_rows($verifyData) != 0){
        echo "endereco cadastrado";
    }
    if(mysqli_num_rows($verifyLink) != 0){
        echo "link cadastrado";
    }

    if(mysqli_num_rows($verifyName) == 0 && mysqli_num_rows($verifyDesc) == 0 && mysqli_num_rows($verifyEnd) == 0 && mysqli_num_rows($verifyLink) == 0){

        mysqli_query($conexao,"INSERT INTO `eventos`(`tipo_evento`, `nome_evento`, `descricao_evento`, `endereco_evento`, `linkEnd_evento`, `preco_evento`, `dataIni_evento`, `horaInicial_evento`) VALUES ('$tipo','$nome','$desc','$endereco','$link','$preco','$data', '$hora')");
        echo "success";
    }

    mysqli_close($conexao);

?>