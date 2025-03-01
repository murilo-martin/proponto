<?php

    include "mysqlconecta.php";
  
    function isDataValida($data) {
      
      $dataFormatada = date('Y-m-d', strtotime($data));
  
      $dataAtual = date('Y-m-d');
  
      return $dataFormatada >= $dataAtual;
  }
  
    function formatarHora($horaCompleta) {
      
      if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $horaCompleta)) {
          return "Formato de hora inválido. Use HH:MM:SS.";
      }
  
      $partes = explode(':', $horaCompleta);
      
      return $partes[0] . ':' . $partes[1];
  }
  
    $id = $_POST["id"];
    $acao = $_POST["acao"];

    $query = mysqli_query($conexao,"SELECT `tipo_evento`, `nome_evento`, `descricao_evento`, `endereco_evento`,`linkEnd_evento`,`preco_evento`,`dataIni_evento`,`horaInicial_evento` FROM eventos WHERE id_evento = '$id'");
    $disabled = $acao === "Cancel" ? "disabled" : "";

    $row = mysqli_fetch_array($query);

       echo'<div class="row">
        <div class="row">
              <div class="col">
                <small class="form-text align-start mb-1">
                  Tipo do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Nome do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Descrição do evento:
                </small>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <select class="form-select" id="tipo_'.$acao.'" aria-label="Default select example" '.$disabled.'>
                  <option value="Social">Social</option>
                  <option value="Cultural">Cultural</option>
                  <option value="Esportivo">Esportivo</option>
                  <option value="Corporativo">Corporativo</option>
                  <option value="Religioso">Religioso</option>
                  <option value="Entreterimento">Entreterimento</option>
                  <option value="Outro">Outro</option>
                </select>
              <script>
                document.getElementById("tipo_'.$acao.'").value = "'.$row[0].'"
              </script>
              </div>
              <div class="col">
                <input class="form-control" value="'.$row[1].'" type="text" id="nome_'.$acao.'" '.$disabled.'>
                <div class="invalid-feedback">
                  Insira um nome.
                </div>
              </div>
              <div class="col">
                <input class="form-control" value="'.$row[2].'" type="text" id="desc_'.$acao.'" '.$disabled.'>
                <div class="invalid-feedback">
                  Insira uma Descrição
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <small class="form-text align-start mb-1">
                  Endereço do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Link do Endereço:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Data:
                </small>
              </div>

            </div>
            <div class="row">
              <div class="col">
                <input class="form-control" value="'.$row[3].'" type="text" id="endereco_'.$acao.'" '.$disabled.'>
                <div class="invalid-feedback">
                  Insira um endereço.
                </div>

              </div>
              <div class="col">
                <input class="form-control" value="'.$row[4].'" type="text" id="linkEnde_'.$acao.'" '.$disabled.'>
                <div class="invalid-feedback">
                  Insira um link do endereço.
                </div>
              </div>
              <div class="col">
                <input class="form-control" value="'.$row[6].'" type="date" id="date_'.$acao.'" '.$disabled.'>
                <div class="invalid-feedback">
                  Insira a data inicial
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <small class="form-text align-start mb-1">
                  Hora inicial do evento:
                </small>
              </div>
              <div class="col">
                <small class="form-text align-start mb-1">
                  Preço :
                </small>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <input class="form-control" value="'.formatarHora($row[7]).'" type="text" onblur="validarHora(this)" id="horaInicial_'.$acao.'" '.$disabled.'>
                <div class="invalid-feedback">
                  Insira uma hora inicial.
                </div>
              </div>
              <div class="col">
                <input class="form-control" value="'.$row[5].'" type="text" id="preco_'.$acao.'" '.$disabled.'>
                <div class="invalid-feedback">
                  Insira um preço.
                </div>
          <input type="hidden" id="id_usuario'.$acao.'" value='.$id.'>
        </div>
      </div>';
    

?>