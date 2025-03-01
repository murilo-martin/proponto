<?php

  include "mysqlconecta.php";

  $search = $_POST["search"];

  $tipo = $_POST["tipo"];
  $column = $_POST["column"];
  $date = $_POST["date"];
  $preco = $_POST["preco"];

  function combinarDataHora($data, $hora) {

    $dataHoraString = $data . ' ' . $hora ;

    $timestamp = strtotime($dataHoraString);

    if ($timestamp === false) {
        return "Formato de data ou hora inválido.";
    }

    return date('d/m/Y H:i', $timestamp);
}
function fixMoney($value){
  return str_replace(".", ",", sprintf("%1$.2f", $value));
}

  $query = mysqli_query($conexao,"SELECT * from eventos where $column LIKE '%$search%' $tipo $date $preco ORDER BY nome_evento");

  while($row = mysqli_fetch_array($query)) {
  
    echo "<tr>";
    echo "<td>";
    echo "$row[1]";
    echo "</td>";
    
    echo "<td>";
    echo "$row[2]";
    echo  "</td>";
    
    echo  "<td class=' vertical-alig'>";
    echo  "$row[3]" ;
    echo  "</td>";

    echo  "<td class=' vertical-alig'>";
    echo  "$row[4]" ;
    echo  "</td>";

    echo  "<td class=' vertical-alig'>";
    echo  "<a href='$row[5]'>Clique aqui para ver no maps</a>" ;
    echo  "</td>";

    echo  "<td class=' vertical-alig'>";
    echo  combinarDataHora($row[7],$row[8]);
    echo  "</td>";
    
    echo  "<td class=' vertical-alig'>";
    echo  "R$ ", fixMoney($row[6]);
    echo  "</td>";

    echo "<td class='d-flex justify-content-evenly align-center w-100' >";
    echo "<button class='btn btn-primary' id='edit' onclick='showModalDelEdit($row[0], \"Edit\")'>"; 
    echo '<svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed"><path d="M186.67-186.67H235L680-631l-48.33-48.33-445 444.33v48.33ZM120-120v-142l559.33-558.33q9.34-9 21.5-14 12.17-5 25.5-5 12.67 0 25 5 12.34 5 22 14.33L821-772q10 9.67 14.5 22t4.5 24.67q0 12.66-4.83 25.16-4.84 12.5-14.17 21.84L262-120H120Zm652.67-606-46-46 46 46Zm-117 71-24-24.33L680-631l-24.33-24Z"/></svg>';
    echo "</button>";
    echo "<button class='btn btn-danger' id='delete' onclick='showModalDelEdit($row[0], \"Cancel\")'>";
    echo '<svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed"><path d="M267.33-120q-27.5 0-47.08-19.58-19.58-19.59-19.58-47.09V-740H160v-66.67h192V-840h256v33.33h192V-740h-40.67v553.33q0 27-19.83 46.84Q719.67-120 692.67-120H267.33Zm425.34-620H267.33v553.33h425.34V-740Zm-328 469.33h66.66v-386h-66.66v386Zm164 0h66.66v-386h-66.66v386ZM267.33-740v553.33V-740Z"/></svg>';
    echo " </button>";
    echo  "</td>";
    echo "</tr>";

  }

?>