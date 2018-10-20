 <?php 
include('ConfigBdd.php');

	$CedulaPerso = $_POST['CedulaPerso'];
	
	
	$sql="select * from personalcarnet where CedulaPerso='$CedulaPerso' ";
	$busqueda=mysql_query($sql);

	$resultado = mysql_num_rows($busqueda);	

	if ($resultado == 1) {

		echo "<p style='font-weight:bold;color:red;'>Registro ya Existe<p>";


	}

  ?>	