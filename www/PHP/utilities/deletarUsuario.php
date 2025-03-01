<?php

 include "mysqlconecta.php";

 $id = $_POST['id'];

 mysqli_query($conexao,"DELETE FROM eventos WHERE id_evento = $id");

 mysqli_close( $conexao );

?>