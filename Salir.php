<?php
date_default_timezone_set('America/Caracas');
include('ConfigBdd.php');
session_start();
 $Usuario = $_SESSION['Usuario'];

 $FechaSal = date("d-m-y");
 $HoraSal = date("H:m:s"); 

     $sql = ("update bitacora set FechaSal = '$FechaSal', HoraSal= '$HoraSal' Where Usuario = '$Usuario'");
	 $respu = mysql_query($sql);
echo "<script>window.location='login.php'</script>";

session_destroy();
?>