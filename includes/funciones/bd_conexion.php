<?php
  $host_bd="localhost";
  $user_bd="root";
  $password_db="";
  $name_db="gdlwebcam";
  
  
  $conexion= new mysqli($host_bd,$user_bd,$password_db,$name_db);

  if($conexion->connect_error){
      echo "Error en la conexion de la base de datos" .$conexion->connect_error;
  }
   
$conexion->set_charset('utf8');

?>