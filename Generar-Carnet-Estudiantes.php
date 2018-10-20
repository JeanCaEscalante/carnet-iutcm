<?PHP 
	date_default_timezone_set('America/Caracas');
	session_start();
	if(!isset($_SESSION["Usuario"]) and !isset($_SESSION["idNivel"])){ //Comprobacion de inicio de session

    	header('Location:login.php');
    	exit; 
	}
	//realizar la conexion desde otro archivo
	include('ConfigBdd.php');

	//Variables
	$Cedula = $_POST['Cedula'];
	$fecha = date('Y-m-j');
	$meses = $_POST['meses'];

if (isset($_POST['busca'])) {
	
		$sql = ("select alumcarnet.Cedula, alumcarnet.Nombres, alumcarnet.Apellidos, carrera.Carrera, semestre.Semes, formatcarnet.FormatCarnet, estatus.idEstatus from alumcarnet 
			INNER JOIN regcarnetalum ON alumcarnet.Cedula = regcarnetalum.Cedula
			INNER JOIN semestre ON regcarnetalum.CodSemes = semestre.CodSemes
			INNER JOIN carrera ON regcarnetalum.CodCarrera = carrera.CodCarrera
            INNER JOIN estatus ON regcarnetalum.idEstatus = estatus.idEstatus
			INNER JOIN formatcarnet ON carrera.idFormato = formatcarnet.idFormato
		 	where alumcarnet.Cedula ='$Cedula' and 
		 		  estatus.idEstatus = 1 and 
		 		  regcarnetalum.FechaVen is NULL and 
		 		  regcarnetalum.FechaEntre is NULL");
				

		$respu = mysql_query($sql);

		if ($fila = mysql_fetch_array($respu)){

				$Cedula = $fila['Cedula'];
				$Nombres = $fila['Nombres'];
				$Apellidos = $fila['Apellidos'];
				$Semes = $fila['Semes'];
				$FormatCarnet = $fila['FormatCarnet'];
				$FechaV  = date("m/Y", strtotime("+$meses month", strtotime ($fecha)));

				echo '
				<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
				<script>

					$(document).ready(function(){
								var Carnet = document.getElementById("Carnet");

						if (Carnet.style.display == "none"){

								document.getElementById("Carnet").style.display = "block";
						}

					});

				     </script>';
		}else{ 

		echo '<script>setTimeout(function(){swal("OOPSS!","Registro no encontrado","error");}, 250);</script>';
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">

	<title>IUTCM</title>
  <!-- Bootstrap -->
	<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/logo/style.css">
<!-- sweetalert -->
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/sweetalert/sweetalert.css">
	<link rel="stylesheet" href="css/estilo.css">
  <!-- CSS -->
 	<link rel="stylesheet" href="css/estilo.css">
 	<link rel="stylesheet" media="all" href="css/estilocarnet.css">
  <!-- Javascript -->
    <script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
  <!-- sweetalert -->
    <script src="bootstrap-3.3.7/sweetalert/sweetalert.min.js"></script>
  <!-- Lightbox -->
  <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/lightbox2-master/dist/css/lightbox.min.css">
  <script src="bootstrap-3.3.7/lightbox2-master/dist/js/lightbox.min.js"></script>
</head>
<body>
<div class="wrapper">
				<nav id="sidebar">
					<div class="sidebar-header">
						<h3>Instituto Universitario de Tecnología "Dr. Cristobal Mendoza"</h3>
						<i class="icon-iutcm_logo-2"></i>
					</div>
				
				<ul class="list-unstyled" id="sidebarCollapse">

					<li>
						<a href="index.php">
								<i class="glyphicon glyphicon-home"></i>
							<span>Inicio</span>
						</a>
					</li>
					<li class="active">
						<a href="#Menu1" data-toggle="collapse" aria-expanded="false">
								<i class="glyphicon glyphicon-pencil"></i>
						<span>Registro</span>
						</a>
						<ul class="collapse list-unstyled" id="Menu1">
							<li><a href="Registro-Estudiantes.php">Estudiantes</a></li>
							<?php 
								if ($_SESSION['idNivel']==2) {
									
							?>
							<li><a href="Registro-Personal.php">Personal</a></li>
							<?php
								}
							?>
							<?php 
								if ($_SESSION['idNivel']==1) {
									
							?>
							<li class="active">
						<a href="#SubMenu" data-toggle="collapse" aria-expanded="false">
							Personal</a>
								<ul class="collapse list-unstyled" id="SubMenu">

									<li><a href="Registro-Personal.php">Personal</a></li>
									<li><a href="Registro-Cargos.php">Cargos</a></li>
								</ul>
							</li>
							<?php
								}
							?>
						</ul>
					</li>
					<li class="active">
						<a href="#Menu2" data-toggle="collapse" aria-expanded="false">
								<i class="glyphicon glyphicon-list-alt"></i>
							<span>Carnet</span>
						</a>
						<ul class="collapse list-unstyled" id="Menu2">
							<li><a href="Carnet-Estudiantes.php">Estudiantes</a></li>
							<li><a href="Carnet-Personal.php">Personal</a></li>
							<?php 
								if ($_SESSION['idNivel']==1) {
									
							?>
							<li class="active">
						<a href="#SubMenu1" data-toggle="collapse" aria-expanded="false">
							Formatos</a>
								<ul class="collapse list-unstyled" id="SubMenu1">
									<li><a href="Formato-Carnet-Estudiantes.php">Estudiantes</a></li>
									<li><a href="Formato-Carnet-Personal.php">Personal</a></li>
								</ul>
							</li>
							<?php
								}
							?>
						</ul>
					</li>
					<li class="active">
						<a href="#Menu3"  data-toggle="collapse" aria-expanded="false">
								<i class="glyphicon glyphicon-search"></i>
						<span>Buscar</span>
						</a>
						<ul class="collapse list-unstyled" id="Menu3">
							<li><a href="Busqueda-Estudiantes.php">Estudiantes</a></li>
							<li><a href="Busqueda-Personal.php">Personal</a></li>
						</ul>
					</li>
					<li class="active">
						<a href="#Menu4"  data-toggle="collapse" aria-expanded="false">
								<i class="glyphicon glyphicon-print"></i>
						<span> Imprimir</span>
						</a>
						<ul class="collapse list-unstyled" id="Menu4">
							<li><a href="Generar-Carnet-Estudiantes.php">Estudiantes</a></li>
							<li><a href="Generar-Carnet-Personal.php">Personal</a></li>
						</ul>
					</li>
					<?php 
						if ($_SESSION['idNivel']==1) {
							
					?>
					<li class="active">
						<a href="#Menu5" data-toggle="collapse" aria-expanded="false">
							<i class="glyphicon glyphicon-dashboard"></i>
						<span>Reportes</span>
						</a>
						<ul class="collapse list-unstyled" id="Menu5">
							<li><a href="Reportes-Estudiantes.php">Estudiantes</a></li>
							<li><a href="Reportes-Personal.php">Personal</a></li>
						</ul>
					</li>
					<?php
						}
					?>
		</ul>
</nav>
		<div id="content">
<nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
 
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <?php 
									if ($_SESSION['idNivel']==1) {
										
								?>
                                <li class="dropdown">
                                	<a href="#"  class="dropdown-toggle menubar" data-toggle="dropdown"><i class="glyphicon glyphicon-lock"></i> Cuentas Usuario <b class="caret"></b>
                                	</a>
	                                <ul id="BarraMenu1" class="dropdown-menu" role="menu">

									    <li class="BarraMenu"><a href="NuevaCuenta.php">Crear cuenta</a></li>
									    <li class="BarraMenu"><a href="AdministradorUsuarios.php">Administrar Cuentas</a></li>
									    <li class="BarraMenu"><a href="Bitacora.php">Bitacora Bdd</a></li>
								  </ul>
								</li>
                                 <li class="dropdown">
                                	<a href="#" class="menubar" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-shopping-cart"></i> Inventario <b class="caret"></b>
                                	</a>
	                                <ul id="BarraMenu1" class="dropdown-menu" role="menu">
									    <li class="BarraMenu"><a href="Registro-Producto.php">Registro Material</a></li>
									    <li class="BarraMenu"><a href="Entrada-Producto.php">Entrada Material</a></li>
									    <li class="BarraMenu"><a href="Entrega-Carnet.php">Entrega Carnet</a></li>
									    <li class="BarraMenu"><a href="Entrega-Carnet-Personal.php">Entrega Personal</a></li>
								  </ul>
								</li>
                                <?php
									}
								?>
								<?php 
									if ($_SESSION['idNivel']==2) {
										
								?>
								<li class="dropdown">
                                	<a href="#" class="menubar" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-shopping-cart"></i> Inventario <b class="caret"></b>
                                	</a>
	                                <ul id="BarraMenu1" class="dropdown-menu" role="menu">
									    <li class="BarraMenu"><a href="Entrega-Carnet.php">Entrega Carnet</a></li>
									    <li class="BarraMenu"><a href="Entrega-Carnet-Personal.php">Entrega Personal</a></li>
								  </ul>
								</li>
								<?php
									}
								?>
                                <li><a class="menubar" href="Salir.php" ><i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
       
	       	<div class="container-fluid">
	       				<h2 class="text-center">Generar Carnet Estudiantes</h2>
	       				<br>
	       				<form class="form-horizontal" action="" method="post" id="Buscar">
	       											<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Fecha Vencimiento</label>
														</div>
														<div class="col-md-5">
															<input type="number" name="meses" id="meses" class="form-control">
															<span class="help-block"></span>
														</div>
													</div>
	       											<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Cedula</label>
														</div>
														<div class="col-md-5">
																<div class="input-group">
									                    			<input type="text" class="form-control search-query" name="Cedula" placeholder="Cedula"  id="Cedula">
																	<span class="input-group-btn">
																		<button type="submit" name="busca" class="btn btn-success" id="busca">
																				<span class="glyphicon glyphicon-search"></span>
																				Buscar
																		</button>
																	</span>
																</div>															<span class="help-block"></span>
														</div>
			                    					</div>  
			                    						
	       				</form>
									
	
													<div class="carnet text-center" id="Carnet" style="display: none;">
														<style type="text/css">
														@media print{
																	#btn-print{
																		display: none;
																	}

																	.fondo{	
																		position: relative;
																	}

																	.fondo img{

																		height:240px;
																		width:400px;
																	}

																	.Nombres{
																	position:absolute;
																	top:120px;
																	left:27px;
																	border:none;
																	}
																	.Apellidos{
																	position:absolute;
																	top:133px;
																	left:27px;
																	border:none;
																	}

																	.Cedula{
																	position:absolute;
																	top:148px;
																	left:12%;
																	border:none;
																	}

																	.Semestre{
																	position:absolute;
																	top:184px;
																	left:27px;
																	border:none;
																	}

																	.Foto{
																	position:absolute;
																	top:24%;
																	left:71%;
																	border:none;
																	}

																	.Foto img{
																	height:100px;
																	width:90px;
																	}

																	.Valido{
																	position:absolute;
																	top:219px;
																	left:62%;
																	border:none
																	}

																	.Valido label{
																	font: Arial;
																	font-size: 10px;
																	color: #000;
																	}
																	label{
																	font: Arial;
																	font-size: 12px;
																	color: #000;
																	font-weight:bold;
																	}
																	}
																	</style>
														<?php
														
														 $directorio = 'Formatos/Estudiante';
															echo '<div class="fondo"><img src="'.$directorio.'/'.$FormatCarnet.'" ></div>';
														 ?>
														

														<div class="Nombres">
															<label><?php echo $Nombres ?></label><br>
														</div>
														<div class="Apellidos">
															<label><?php echo $Apellidos ?></label>
														</div>
														<div class="Cedula">
															<label><?php echo number_format($Cedula, 0, "" , ".");?></label>
														</div>
														<?php
															
															$directorio = 'Fotos/Foto-Estudiantes';
															echo '<div class="Foto"><img src="'.$directorio.'/'.$Cedula.'.png"  height="174" width="160"></div>';
														
														?>
														<div class="Semestre">
															<label><?php echo $Semes ?></label>
														</div>

														<div class="Valido">
															<label><?php  
																	echo $FechaV;
															 ?></label>
														</div>

												<div class="row form-group text-center" id="btn-print">
													<div class="col-md-12">
																<br>	
															<button  class="btn btn-info" onclick="imprimir();"><i class="glyphicon glyphicon-print"></i> Imprimir</button>
															
													</div>
												</div>
													</div>
												</div>
														
	       		<footer class="text-center"><p>&copy; 2018 Jean Carlos Escalante Lara</p></footer>
       		</div>
  </div>

<script type="text/javascript">

			$(document).ready(function () {
             	
                 $('#sidebarCollapse').on('mousemove', function (e) {     
                   	 $('#sidebar, #content').addClass('active'); 
                   		e.preventDefault();
                 });

                  $('#content').on('mousemove', function () { 

                   	 $('#sidebar, #content').removeClass('active');
                   	 $(".collapse").collapse('hide');
                   		
                 });
             });



</script>
<script type="text/javascript">

	function imprimir(){

		  	var objeto=document.getElementById('Carnet');  //obtenemos el objeto a imprimir
		  	var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
		  	ventana.document.write(objeto.innerHTML); //imprimimos el HTML del objeto en la nueva ventana 
		  	ventana.document.close();  //cerramos el documento
		  	ventana.print();  //imprimimos la ventana
		 	ventana.close();  //cerramos la ventana
	}
	
</script>
<script type="text/javascript">
	   	var Buscar = document.getElementById("Buscar");
    	window.onload = iniciar;

    function iniciar(){

    		document.getElementById("busca").addEventListener('click', validacion, false);
    	}
		
    function ValidaMeses(){

    		var meses = document.getElementById("meses").value;

    		if( meses == null || meses.length == 0 || /^\s+$/.test(meses) ){

    			$("#IcoValida").remove();
				$("#meses").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#meses").parent().children("span").text("Este campo no puede estar vacio");
				$("#meses").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');

				
				return false;
			}
			else if (!(/^\d*$/.test(meses))){
				$("#IcoValida").remove();
				$("#meses").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#meses").parent().children("span").text("Este campo no puede contener (a-zA-Z/!.*+-)");
				$("#meses").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				
			  	return false;
			}
				$("#IcoValida").remove();
				$("#meses").parent().parent().attr("class", "form-group has-success has-feedback");
				$("#meses").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				
			return true;
    	}

      function ValidaCedula(){

    		var Cedula = document.getElementById("Cedula").value;

    		if( Cedula == null || Cedula.length == 0 || /^\s+$/.test(Cedula) ){

    			$("#IcoValida").remove();
				$("#Cedula").parent().attr("class", "input-group has-error has-feedback");
				$("#Cedula").parent().parent().children("span").text("Este campo no puede estar vacio");
				

				
				return false;
			}
			else if (!(/^\d*$/.test(Cedula))){
				$("#IcoValida").remove();
				$("#Cedula").parent().attr("class", "input-group has-error has-feedback");
				$("#Cedula").parent().parent().children("span").text("Este campo no puede contener (a-zA-Z/!.*+-)");
				
				
			  	return false;
			}
				$("#IcoValida").remove();
				$("#Cedula").parent().parent().attr("class", "input-group has-success has-feedback");
				
				
			return true;
    	}
    
	function validacion(e){

			if( ValidaMeses() && ValidaCedula()){

				return true;
			}else{

				e.preventDefault();
				return false;
			}
	}
</script>
</body>
</html>