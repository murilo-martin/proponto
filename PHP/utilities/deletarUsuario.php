<?php

 include "mysqlconecta.php";

 $id = $_POST['id'];

 mysqli_query($conexao,"DELETE FROM usuario WHERE id = $id");

 mysqli_close( $conexao );

?>