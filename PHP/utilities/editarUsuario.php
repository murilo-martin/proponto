<?php

 include "mysqlconecta.php";

 $id = $_POST['id'];
 $nome = $_POST['nome'];
 $email = $_POST['email'];
 $tel = $_POST['telefone'];

 mysqli_query($conexao,"update usuario set name='$nome', email= '$email',telefone= '$tel' WHERE id = '$id' ");

 mysqli_close( $conexao );

?>