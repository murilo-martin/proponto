<?php

 include "mysqlconecta.php";

    $id = $_POST['id'];
    $tipo = $_POST["tipo"];
    $nome = $_POST["nome"];
    $desc = $_POST["descricao"];
    $preco = $_POST["preco"];
    $endereco = $_POST["endereco"];
    $link = $_POST["link"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    mysqli_query($conexao,"update eventos set tipo_evento='$tipo', nome_evento= '$nome', descricao_evento= '$desc', preco_evento='$preco', endereco_evento='$endereco', linkEnd_evento = '$link',dataIni_evento = '$data', horaInicial_evento='$hora' WHERE id_evento = '$id' ");

    mysqli_close( $conexao );

?>