<?php
session_start();
//antes de hacer los cálculos, compruebo que el usuario está logueado

$Inactivo=$_POST["Inactivo"];

    //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["ultimoAcceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

    //comparamos el tiempo transcurrido 660
     if($tiempo_transcurrido >=30) {
     //si pasaron 10 minutos o más
      session_destroy(); // destruyo la sesión
      header("Location:login.php"); //envío al usuario a la pag. de autenticación
      
    } else if($Inactivo == true){

         session_destroy(); // destruyo la sesión 

    }else{

      $_SESSION["ultimoAcceso"] = $ahora;

   }

?>


