<?php
$host ="localhost";
$user ="root"; //usuario de appserv
$password ="12345678"; //clave para ingresar
$dbname="carnet-iutcm"; //base de datos a conectar


if (!$conexion=mysql_connect($host,$user,$password)){
echo"<script>alert('No se puede conectar al servidor');</script>;";
//echo "<script>window.location='errorserv.html'</script>;";

}
if(!mysql_select_db($dbname,$conexion)){
echo"<script>alert('No se pude conectar a la base de datos');</script>";
//echo "<script>window.location='errordb.html'</script>;";
}

?>