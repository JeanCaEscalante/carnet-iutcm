<?PHP 
	date_default_timezone_set('America/Caracas');
	session_start();
	//realizar la conexion desde otro archivo
	include('ConfigBdd.php');


	//recibir el boton	
	$boton=$_POST["boton"];
	
	//recibir los datos del formulario
	$Usuario = $_POST['Usuario'];
	$Cont = $_POST["Cont"];
	$PregSeg= $_POST['PregSeg'];
	$RegSeg= $_POST['RegSeg'];
	$Correo = $_POST["Correo"];
	$idNivel = $_POST["idNivel"];

// Almacenar los datos
if($boton=="Guardar"){

	$Cripto = sha1(md5($Cont));

	$sql="insert into login (Usuario, Cont, PregSeg, RespuSeg, Correo, idNivel) 
	values('$Usuario', '$Cripto', '$PregSeg', '$RegSeg', '$Correo', '$idNivel')";
	if(mysql_query($sql)){
		
				echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos Guardados",type:"success"}).then(function() {window.location.href = "NuevaCuenta.php";})});</script>';

	}else{
		echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser GUARDADOS","error");}, 250);</script>';
	}
	
}

if($boton=="Limpiar"){
echo "<script>window.location='Registro-Estudiantes.php'</script>";
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
							<li><a href="">Personal</a></li>
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
	       				<h2 class="text-center">Nueva Cuenta</h2>
	       				<br>
												<form class="form-horizontal" action="" method="post" id="FormRegCuenta">
												<!-- Datos de los Estudiantes -->
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Usuario</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="Usuario" placeholder="Usuario" id="Usuario">
															<span class="help-block" id="Existe"></span>
														</div>
													</div>
												
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Clave</label>
														</div>
														<div class="col-md-5">
															<input type="password" class="form-control" name="Cont" placeholder="Clave" id="Cont">
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Confirme Clave</label>
														</div>
														<div class="col-md-5">
															<input type="password" class="form-control" name="ConfirmCont" placeholder="Confirme Clave" id="ConfirmCont">
															<span class="help-block"></span>
														</div>		
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Pregunta Seguridad</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="PregSeg" placeholder="Pregunta Seguridad"  id="PregSeg">
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Respuesta Seguridad</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="RegSeg" placeholder="Respuesta Seguridad" id="ResSeg">
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Correo</label>
														</div>
														<div class="col-md-5">
															<input type="email" class="form-control" name="Correo" placeholder="Correo" id="Correo">
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Nivel</label>
														</div>
														<div class="col-md-5">
															<select class="form-control" name="idNivel" id="idNivel">
																<option value="" selected="" disabled="">Seleccione</option>
																<?php

																		$nivel ="Select * From nivel";
																		$result=mysql_query($nivel);
																		while($row = mysql_fetch_array($result)) {
																				echo "<option value='".$row['idNivel']."'>".$row['Nivel']."</option>";
																		}

																?>
															</select>
															<span class="help-block"></span>						
														</div>
													</div>
												<div class="row form-group text-center">
													<div class="col-md-12">	

															<button type="submit" class="btn btn-success" value="Guardar" id="Guardar" name="boton"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar</button>
														    <button type="submit" class="btn btn-danger" value="Limpiar" name="boton"><i class="glyphicon glyphicon-erase"></i> Limpiar</button>
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
	
    	var FormRegCuenta = document.getElementById("FormRegCuenta");
    	window.onload = iniciar;

    function iniciar(){

    		document.getElementById("Guardar").addEventListener('click', validacion, false);
    
    	}
		
    function ValidaUsuario(){

    		var Usuario = document.getElementById("Usuario").value;

    		if( Usuario == null || Usuario.length == 0 || /^\s+$/.test(Usuario) ){

    			$("#IcoValida").remove();
				$("#Usuario").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Usuario").parent().children("span").text("Este campo no puede estar vacio");
				$("#Usuario").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');

				
				return false;
			}
				$("#IcoValida").remove();
				$("#Usuario").parent().parent().attr("class", "form-group has-success has-feedback");
				$("#Usuario").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
				
			return true;
    	}

    function ValidaCont(){

    	var Cont = document.getElementById("Cont").value;
		var ConfirmCont = document.getElementById("ConfirmCont").value;

		if( Cont == null || Cont.length == 0 || /^\s+$/.test(Cont)){
				$("#IcoValida").remove();
				$("#Cont").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Cont").parent().children("span").text("Este campo no puede estar vacio");
				$("#Cont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				
			  	return false;
		}else if ( ConfirmCont == null || ConfirmCont.length == 0 || /^\s+$/.test(ConfirmCont)){
				$("#IcoValida").remove();
				$("#ConfirmCont").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#ConfirmCont").parent().children("span").text("Este campo no puede estar vacio");
				$("#ConfirmCont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				return false;
		}
		else if (Cont !== ConfirmCont){
				$("#IcoValida").remove();
				$("#Cont").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Cont").parent().children("span").text("Este campo no coincide");
				$("#Cont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				$("#IcoValida").remove();
				$("#ConfirmCont").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#ConfirmCont").parent().children("span").text("Este campo no coincide");
				$("#ConfirmCont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				return false;
		}
		return true;
    }
    function ValidaPregSeg(){

    		var PregSeg = document.getElementById("PregSeg").value;

			if( PregSeg == null || PregSeg.length == 0 || /^\s+$/.test(PregSeg) ){
				$("#IcoValida").remove();
				$("#PregSeg").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#PregSeg").parent().children("span").text("Este campo no puede estar vacio");
				$("#PregSeg").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}
			else if (!(/^[a-zA-Z\s]*$/.test(PregSeg))){
				$("IcoValida").remove();	 
				$("#PregSeg").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#PregSeg").parent().children("span").text("Este campo no puede contener números");
				$("#PregSeg").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				return false;
			}
			$("#IcoValida").remove();
			$("#PregSeg").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#PregSeg").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');

			return true;
    	}
    function ValidaRegSeg(){

    		var ResSeg = document.getElementById("ResSeg").value;

			if( ResSeg == null || ResSeg.length == 0 || /^\s+$/.test(ResSeg) ){
				$("#IcoValida").remove();
				$("#PregSeg").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#PregSeg").parent().children("span").text("Este campo no puede estar vacio");
				$("#PregSeg").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}
			else if (!(/^[a-zA-Z\s]*$/.test(ResSeg))){
				$("IcoValida").remove();	 
				$("#ResSeg").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#ResSeg").parent().children("span").text("Este campo no puede contener números");
				$("#ResSeg").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
				return false;
			}
			$("#IcoValida").remove();
			$("#ResSeg").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#ResSeg").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');

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
    function ValidaidNivel(){

    	idNivel = document.getElementById("idNivel").selectedIndex;
    	if( idNivel == null || idNivel == 0 ) {
    		$("#IcoValida").remove();
    		$("#idNivel").parent().parent().attr("class", "form-group has-error has-feedback");
			$("#idNivel").parent().children("span").text("Debe seleccionar un sexo");
    		$("#idNivel").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
  		return false;

		}
		$("#IcoValida").remove();
		$("#idNivel").parent().parent().attr("class", "form-group has-success has-feedback");
		$("#idNivel").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
		return true;
    }
   
    
	function validacion(e){

			if( ValidaUsuario() && ValidaCont() &&  ValidaPregSeg() && ValidaRegSeg() && ValidaCorreo() && ValidaidNivel() ){

				return true;
			}else{

				e.preventDefault();
				return false;
			}
	}
</script>
</body>
</html>