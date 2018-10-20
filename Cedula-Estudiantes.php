 <?php 
 
include('ConfigBdd.php');

	$Cedula = $_POST['Cedula'];
	
	
	$sql="select * from alumcarnet where Cedula='$Cedula' ";
	$busqueda=mysql_query($sql);

	$resultado = mysql_num_rows($busqueda);	

	if ($resultado == 1) {

		echo "<p style='font-weight:bold;color:red;'>Registro ya Existe<p>";


	}

 ?>	