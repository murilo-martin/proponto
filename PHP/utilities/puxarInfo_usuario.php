<?php

    include "mysqlconecta.php";

    $id = $_POST["id"];
    $acao = $_POST["acao"];

    $query = mysqli_query($conexao,"SELECT `name`, `telefone`, `email` FROM usuario WHERE id = '$id'");
    $disabled = $acao === "Cancel" ? "disabled" : "";

    $row = mysqli_fetch_array($query);

       echo'<div class="row">
        <div class="col">
          <div class="mb-3 w-100">
            <label for="nome" class="col-form-label fw-bold">Nome:</label>
            <input type="text" value="'.$row[0].'" class="form-control" id="nome_'.$acao.'" '.$disabled.'>
          </div>
        </div>
        <div class="col">
          <div class="mb-3">
            <label for="email" class="col-form-label fw-bold">Email:</label>
            <input type="email" value="'.$row[2].'" class="form-control" id="email_'.$acao.'" '.$disabled.'>
          </div>
        </div>
        <div class="col">
          <div class="mb-3">
            <label for="tel" class="col-form-label fw-bold">Telefone:</label>
            <input type="text" value="'.$row[1].'" class="form-control tel" id="tel_'.$acao.'" placeholder="(XX)XXXXX-XXXX" '.$disabled.'>
          </div>
          <input type="hidden" id="id_usuario'.$acao.'" value='.$id.'>
        </div>
      </div>';
    

?>