<?PHP 
	date_default_timezone_set('America/Caracas');
	session_start();
	if(!isset($_SESSION["Usuario"]) and !isset($_SESSION["idNivel"])){ //Comprobacion de inicio de session

    	header('Location:login.php');
    	exit; 
	}

	//realizar la conexion desde otro archivo
	include('ConfigBdd.php');



	//recibir el boton	
	$boton=$_POST["boton"];
	
	//recibir los datos del formulario
	$CedulaPerso = $_POST['CedulaPerso'];
	$idNacion = $_POST["Nacion"];
	$Nombres= $_POST['Nombres'];
	$Apellidos= $_POST['Apellidos'];
	$idSexo = $_POST["Sexo"];
	$telefono = $_POST["Telefono"];
	$correo = $_POST["Correo"];
	$FechaReg = date("y-m-d");



// Almacenar los datos
if($boton=="Guardar"){
	$sql="insert into personalcarnet(CedulaPerso, idNacion, Nombres, Apellidos, idSexo, telefono, correo, FechaReg) 
	values('$CedulaPerso', '$idNacion', '$Nombres', '$Apellidos', '$idSexo', '$telefono', '$correo', '$FechaReg')";
	if(mysql_query($sql)){
		
				
				echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos Guardados",type:"success"}).then(function() {window.location.href = "Carnet-Personal.php";})});</script>';

	}else{
		echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser GUARDADOS","error");}, 250);</script>';
	}
	
}

// Buscar los datos
if($boton=="Buscar"){
	$sql="select * from personalcarnet where CedulaPerso='$CedulaPerso' ";
	$busqueda=mysql_query($sql);
	if($registro=mysql_fetch_array($busqueda)){
		$CedulaPerso = $registro['CedulaPerso'];
		$idNacion = $registro['idNacion'];
		$Nombres = $registro['Nombres'];
		$Apellidos = $registro['Apellidos'];
		$idSexo = $registro['idSexo'];
		$Telefono = $registro['telefono'];
		$Correo = $registro['correo'];
		$FechaReg = $registro['FechaReg'];


		}else{
		echo '<script>setTimeout(function(){swal("Registro NO EXISTE en el Sistema");}, 250);</script>';
	}
	
}


if($boton=="Limpiar"){
echo "<script>window.location='Registro-Personal.php'</script>";
}

// Eliminar los datos
if($boton=="Eliminar"){

	if($CedulaPerso!=""){
		$sql="delete from personalcarnet where CedulaPerso='$CedulaPerso'";
		if (mysql_query($sql)){

		echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos ELIMINADOS Correctamente",type:"success"}).then(function() {window.location.href = "Registro-Personal.php";})});</script>';
		}
	}else{

		echo '<script>setTimeout(function(){swal({title:"OOPSS!",text:"Para poder ELIMINAR debe Realizar una busqueda",type:"error"}, 
													function(isConfirm){ window.location = "Registro-Personal.php";});}, 100);</script>';

	}
	
}

// Modificar los datos
if($boton=="Modificar"){
	if($CedulaPerso!=""){

            $sql="update personalcarnet set CedulaPerso='$CedulaPerso', idNacion='$idNacion', Nombres='$Nombres', 
            Apellidos ='$Apellidos', idSexo='$idSexo', telefono='$telefono', correo='$correo' where CedulaPerso='$CedulaPerso'";


						if(mysql_query($sql)){
								
										echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  							<script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos Modificados Correctamente",type:"success"}).then(function() {window.location.href = "Registro-Personal.php";})});</script>';
						

							}else{
								echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser Modificados","error");}, 250);</script>';
							}


	}else{
		
		echo '<script>setTimeout(function(){swal({title:"OOPSS!",text:"Para poder Modificadar debe Realizar una busqueda",type:"error"}, 
													function(isConfirm){ window.location = "Registro-Personal.php";});}, 100);</script>';
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
	       				<h2 class="text-center">Registro de Personal</h2>
	       				<br>
												<form class="form-horizontal" action="" method="post" id="FormRegPerso">
												<!-- Datos de los Estudiantes -->
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Cedula</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="CedulaPerso" placeholder="Cedula" value="<?php echo $CedulaPerso;  ?>" id="CedulaPerso">
															<span class="help-block" id="Existe"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Nacionalidad</label>
														</div>
														<div class="col-md-5">
															<select class="form-control" name="Nacion" id="Nacion">
																<option value="" selected="" disabled="">Seleccione</option>
																<?php

																		$nacionalidad ="Select * From nacion";
																		$result=mysql_query($nacionalidad);
																		while($row = mysql_fetch_array($result)) {
																				echo "<option value='".$row['idNacion']."'>".$row['Nacion']."</option>";
																		}
																?>
															</select>
															<span class="help-block"></span>						
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Nombres</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="Nombres" placeholder="Nombres" value="<?php echo $Nombres;  ?>" id="Nombres">
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Apellidos</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="Apellidos" placeholder="Apellidos" value="<?php echo $Apellidos;  ?>" id="Apellidos">
															<span class="help-block"></span>
														</div>		
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Sexo</label>
														</div>
														<div class="col-md-5">
															<select class="form-control" name="Sexo" id="idSexo">
																<option value="" selected="" disabled="">Seleccione</option>
																<?php

																		$sexo ="Select * From sexo";
																		$result=mysql_query($sexo);
																		while($row = mysql_fetch_array($result)) {
																				echo "<option value='".$row['idSexo']."'>".$row['Sexo']."</option>";
																		}
																?>
															</select>
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Telefono</label>
														</div>
														<div class="col-md-5">
															<input type="tel" class="form-control" name="Telefono" placeholder="Telefono" id="Telefono" value="<?php echo $Telefono;  ?>">
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Correo</label>
														</div>
														<div class="col-md-5">
															<input type="email" class="form-control" name="Correo" placeholder="Correo" id="Correo" value="<?php echo $Correo;  ?>">
															<span class="help-block"></span>
														</div>
													</div>
												<div class="row form-group text-center">
													<div class="col-md-12">	
															<button type="submit" class="btn btn-success" value="Guardar" id="Guardar" name="boton"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar</button>
															<button type="submit" class="btn btn-primary" value="Buscar" name="boton"><i class="glyphicon glyphicon-search"></i> Buscar</button>
														    <button type="submit" class="btn btn-danger" value="Limpiar" name="boton"><i class="glyphicon glyphicon-erase"></i> Limpiar</button>
														    <button type="submit" class="btn btn-danger" value="Eliminar" name="boton"><i class="glyphicon glyphicon-trash"></i>  Eliminar</button>
														    <button type="submit" class="btn btn-primary" value="Modificar" id="Modificar" name="boton"><i class="glyphicon glyphicon-saved"></i> Modificar</button>
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


$(document).ready(function(){
		 		
	var CedulaPerso;
		
	//hacemos focus
	$("#CedulaPerso").focus();
								
	//comprobamos si se pulsa una tecla
	$("#CedulaPerso").keyup(function(e){
		 //obtenemos el texto introducido en el campo
		 CedulaPerso = $("#CedulaPerso").val();
						 
		 //hace la búsqueda
		 $("#Existe").delay(1000).queue(function(n) { 

				$.ajax({
					type: "POST",
					url: "Cedula-Personal.php",
					data: "CedulaPerso="+CedulaPerso,
					error: function(){
						alert("Error de conexion al servidor");
					},
					success: function(data){ 									
						$("#Existe").html(data);
						n();
					}
			});
							
		 });
					 
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

    	var FormRegPerso = document.getElementById("FormRegPerso");
    	window.onload = iniciar;

    function iniciar(){

    		document.getElementById("Guardar").addEventListener('click', validacion, false);
    		document.getElementById("Modificar").addEventListener('click', validacion, false);
    	}
		
    function ValidaCedula(){

    		var CedulaPerso = document.getElementById("CedulaPerso").value;

    		if( CedulaPerso == null || CedulaPerso.length == 0 || /^\s+$/.test(CedulaPerso) ){

    			$("#IcoValida").remove();
				$("#CedulaPerso").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#CedulaPerso").parent().children("span").text("Este campo no puede estar vacio");
				$("#CedulaPerso").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');

				
				return false;
			}
			else if (!(/^\d*$/.test(CedulaPerso))){
				$("#IcoValida").remove();
				$("#CedulaPerso").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#CedulaPerso").parent().children("span").text("Este campo no puede contener (a-zA-Z/!.*+-)");
				$("#CedulaPerso").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				
			  	return false;
			}
				$("#IcoValida").remove();
				$("#CedulaPerso").parent().parent().attr("class", "form-group has-success has-feedback");
				$("#CedulaPerso").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				
			return true;
    	}

    function ValidaNacion(){

    	nacion = document.getElementById("Nacion").selectedIndex;
    	if( nacion == null || nacion == 0 ) {
    		$("#IcoValida").remove();
    		$("#Nacion").parent().parent().attr("class", "form-group has-error has-feedback");
			$("#Nacion").parent().children("span").text("Debe seleccionar una nacionalidad");
			$("#Nacion").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
    		
  		return false;

		}
		$("#IcoValida").remove();
		$("#Nacion").parent().parent().attr("class", "form-group has-success has-feedback");
		$("#Nacion").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
		return true;
    }
    function ValidaNombres(){

    		var Nombres = document.getElementById("Nombres").value;

			if( Nombres == null || Nombres.length == 0 || /^\s+$/.test(Nombres) ){
				$("#IcoValida").remove();
				$("#Nombres").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Nombres").parent().children("span").text("Este campo no puede estar vacio");
				$("#Nombres").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}
			else if (!(/^[a-zA-Z\s]*$/.test(Nombres))){
				$("IcoValida").remove();	 
				$("#Nombres").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Nombres").parent().children("span").text("Este campo no puede contener números");
				$("#Nombres").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				return false;
			}
			$("#IcoValida").remove();
			$("#Nombres").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#Nombres").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');

			return true;
    	}
    function ValidaApellidos(){

    		var Apellidos = document.getElementById("Apellidos").value;

			if( Apellidos == null || Apellidos.length == 0 || /^\s+$/.test(Apellidos) ){
				$("#IcoValida").remove();
				$("#Apellidos").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Apellidos").parent().children("span").text("Este campo no puede estar vacio");
				$("#Apellidos").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}
			else if (!(/^[a-zA-Z\s]*$/.test(Apellidos))){
				$("#IcoValida").remove();
				$("#Apellidos").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Apellidos").parent().children("span").text("Este campo no puede contener números");
				$("#Apellidos").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				return false;
			}
			$("#IcoValida").remove();
			$("#Apellidos").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#Apellidos").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			return true;
    	}
    function ValidaSexo(){

    	sexo = document.getElementById("idSexo").selectedIndex;
    	if( sexo == null || sexo == 0 ) {
    		$("#IcoValida").remove();
    		$("#idSexo").parent().parent().attr("class", "form-group has-error has-feedback");
			$("#idSexo").parent().children("span").text("Debe seleccionar un sexo");
    		$("#idSexo").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
  		return false;

		}
		$("#IcoValida").remove();
		$("#idSexo").parent().parent().attr("class", "form-group has-success has-feedback");
		$("#idSexo").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
		return true;
    }
    function ValidaTelefono(){

    		var Telefono = document.getElementById("Telefono").value;

			if( Telefono == null || Telefono.length == 0 || /^\s+$/.test(Telefono) ){
				$("#IcoValida").remove();
				$("#Telefono").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Telefono").parent().children("span").text("Este campo no puede estar vacio");
				$("#Telefono").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}
			else if( !(/^\d{4}-\d{7}$/.test(Telefono))){
				$("#IcoValida").remove();
				$("#Telefono").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Telefono").parent().children("span").text("Debe contener el formato '0000-0000000'");
				$("#Telefono").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}
				$("#IcoValida").remove();
				$("#Telefono").parent().parent().attr("class", "form-group has-success has-feedback");
				$("#Telefono").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				return true;
    	}
    function ValidaCorreo(){

    		var Correo = document.getElementById("Correo").value;

			if( Correo == null || Correo.length == 0 || /^\s+$/.test(Correo) ){
				$("#IcoValida").remove();
				$("#Correo").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Correo").parent().children("span").text("Este campo no puede estar vacio");
				$("#Correo").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}
			else if ( !(/^([a-z]+[a-z1-9._-]*)@{1}([a-z1-9\.]{2,})\.([a-z]{2,3})$/.test(Correo)) ) {
				$("#IcoValida").remove();
				$("#Correo").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Correo").parent().children("span").text("Debe contener el formato 'ejemplo@example.com'");
				$("#Correo").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				return false;

		}
			$("#IcoValida").remove();
			$("#Correo").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#Correo").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			return true;
    	}
    
	function validacion(e){

			if( ValidaCedula() && ValidaNacion() && ValidaNombres() && ValidaApellidos() && ValidaSexo() && ValidaTelefono() && ValidaCorreo() ){

				return true;
			}else{

				e.preventDefault();
				return false;
			}
	}
</script>
</body>
</html>