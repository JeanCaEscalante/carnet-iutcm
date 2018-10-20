<?php
date_default_timezone_set('America/Caracas');
	session_start();
	if(!isset($_SESSION["Usuario"]) and !isset($_SESSION["idNivel"])){ //Comprobacion de inicio de session

    	header('Location:login.php');
    	exit; 
	}
	include('ConfigBdd.php');

	$boton=$_POST["boton"];

	$idPro = $_POST["idPro"];
	$CantiMov = $_POST["CantiMov"];
	$idTipoMov = 1;
	$Fecha = date("y-m-d");

// Almacenar los datos
	if($boton=="Guardar"){

			$CantActual = "select CantExiste from producto where idPro = '$idPro'";
			$Cantidad = mysql_query($CantActual);
			$row=mysql_fetch_array($Cantidad);
			$CantExiste = $row['CantExiste'];

		$sql="insert into movimient(idPro, CantiMov, idTipoMov, Fecha) values ('$idPro', '$CantiMov', '$idTipoMov', '$Fecha')";
		if(mysql_query($sql)){

			$CantidadTotal = $CantExiste + $CantiMov;

			$consulta = "update producto set CantExiste = '$CantidadTotal' where idPro = '$idPro'";
			mysql_query($consulta);

					  echo '<script>setTimeout(function(){swal({title:"Buen trabajo!!!",text:"Datos Guardados",type:"success"}, 
															function(isConfirm){location.href="Entrada-Producto.php";});}, 100);</script>';


		}else{
			echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser GUARDADOS","error");}, 250);</script>';
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
<!-- sweetalert -->
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/sweetalert/sweetalert.css">
	<link rel="stylesheet" href="css/logo/style.css">
  <!-- CSS -->
 	<link rel="stylesheet" href="css/estilo.css">
  <!-- Javascript -->
    <script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
  <!-- sweetalert -->
    <script src="bootstrap-3.3.7/sweetalert/sweetalert.min.js"></script>

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
	       			<h2 class="text-center">Entrada Producto</h2>
	       				<br>
												<form class="form-horizontal" action="" method="post" name="FormEntProduc">
												<!-- Entrada de Productos -->
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Productos</label>
														</div>
														<div class="col-md-5">
															<select class="form-control" name="idPro" id="idPro">
																<option value="" selected="" disabled="">Seleccione</option>
																<?php

																		$producto ="Select * From producto";
																		$result=mysql_query($producto);
																		while($row = mysql_fetch_array($result)) {
																				echo "<option value='".$row['idPro']."'>".$row['Nombre']."</option>";
																		}

																?>
															</select>
															<span class="help-block"></span>						
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Cantidad</label>
														</div>
														<div class="col-md-5">
															<input type="number" name="CantiMov" id="CantiMov" class="form-control">
															<span class="help-block"></span>						
														</div>
													</div>
													<div class="row form-group text-center">
														<div class="col-md-12">	

															<button type="submit" class="btn btn-success" value="Guardar" id="Guardar" name="boton"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar</button>
														</div>
												</div>
												</form>
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
 
 // se llamará a la función que redirecciona después de 10 minutos (600.000 segundos)
//var temp = setTimeout(FinalSesion, 600000);
var temp = setTimeout(FinalSesion, 595000);

// cuando se pulse en cualquier parte del documento
document.addEventListener("click", function() {
     //borrar el temporizador que redireccionaba
    clearTimeout(temp);
     //y volver a iniciarlo
    temp = setTimeout(FinalSesion, 595000);
});

function FinalSesion() {
  swal({
  title: 'Alerta de cierre sesión automático!',
  text: 'Cerraré en 5 segundos.',
  timer: 5000,
  onOpen: () => {
    swal.showLoading()
  }
}).then((result) => {
  if (result.dismiss === 'timer') {  
   // window.location.href = "Salir.php";
   	var Inactivo = true;
  	$.ajax({
					type: "POST",
					url: "cerrar.php",
					data: "Inactivo="+Inactivo,
					error: function(){
						alert("Error de conexion al servidor");
					},
					success: function(){ 									
						 window.location.href = "login.php";
					}
			});
  }
})
}
 </script>
 <script type="text/javascript">

    	var FormProduc = document.getElementById("FormProduc");
    	window.onload = iniciar;

    function iniciar(){

    		document.getElementById("Guardar").addEventListener('click', validacion, false);
    		document.getElementById("Modificar").addEventListener('click', validacion, false);
    	}

	    function ValidaPro(){

    	var idPro = document.getElementById("idPro").selectedIndex;
    	if( idPro == null || idPro == 0 ) {
    		$("#IcoValida").remove();
    		$("#idPro").parent().parent().attr("class", "form-group has-error has-feedback");
			$("#idPro").parent().children("span").text("Debe seleccionar un Producto");
			$("#idPro").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
    		
  		return false;

		}
		$("#IcoValida").remove();
		$("#idPro").parent().parent().attr("class", "form-group has-success has-feedback");
		$("#idPro").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
		return true;
    }
    function ValidaCantiMov(){

    		var CantiMov = document.getElementById("CantiMov").value;

    		if( CantiMov == null || CantiMov.length == 0 || /^\s+$/.test(CantiMov) ){

    			$("#IcoValida").remove();
				$("#CantiMov").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#CantiMov").parent().children("span").text("Este campo no puede estar vacio");
				$("#CantiMov").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');

				
				return false;
			}
			else if (!(/^\d*$/.test(CantiMov))){
				$("#IcoValida").remove();
				$("#CantiMov").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#CantiMov").parent().children("span").text("Este campo no puede contener (a-zA-Z/!.*+-)");
				$("#CantiMov").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				
			  	return false;
			}
				$("#IcoValida").remove();
				$("#CantiMov").parent().parent().attr("class", "form-group has-success has-feedback");
				$("#CantiMov").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				
			return true;
    	}
    
	function validacion(e){

			if( ValidaPro() && ValidaCantiMov()){

				return true;
			}else{

				e.preventDefault();
				return false;
			}
	}
</script>
</body>
</html>