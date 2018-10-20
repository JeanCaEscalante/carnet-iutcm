<?php
date_default_timezone_set('America/Caracas');
	session_start();
	if(!isset($_SESSION["Usuario"]) and !isset($_SESSION["idNivel"])){ //Comprobacion de inicio de session

    	header('Location:login.php');
    	exit; 
	}

	include('ConfigBdd.php');
	//recibir el boton	
	$boton=$_POST["boton"];
	
	//recibir los datos del formulario

	$Nombre= $_POST['Nombre'];
	$Descrip= $_POST['Descrip'];


// Almacenar los datos
if($boton=="Guardar"){
	$sql="insert into producto(Nombre, Descrip) values ('$Nombre', '$Descrip')";
	if(mysql_query($sql)){
		
				echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos Guardados",type:"success"}).then(function() {window.location.href = "Entrada-Producto.php";})});</script>';

	}else{
		echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser GUARDADOS","error");}, 250);</script>';
	}
	
}

// Buscar los datos
if($boton=="Buscar"){
	$sql="select * from producto where Nombre='$Nombre' ";
	$busqueda=mysql_query($sql);
	if( $row=mysql_fetch_array($busqueda)){

		$Nombre = $row['Nombre'];
		$Descrip = $row['Descrip'];

		}else{
		echo '<script>setTimeout(function(){swal("Registro NO EXISTE en el Sistema");}, 250);</script>';
	}
	
}


if($boton=="Limpiar"){
echo "<script>window.location='Registro-Producto.php'</script>";
}

// Eliminar los datos
if($boton=="Eliminar"){

	if($Nombre!=""){

		$sql="delete from producto where Nombre='$Nombre'";
		
		if (mysql_query($sql)){

			echo '<script>setTimeout(function(){swal({title:"Buen trabajo!!!",text:"Datos ELIMINADOS Correctamente",type:"success"}, 
				  function(isConfirm){ window.location.href = "Registro-Producto.php";});}, 100);</script>';
		}
		
	}else{

		echo '<script>setTimeout(function(){swal({title:"OOPSS!",text:"Para poder ELIMINAR debe Realizar una busqueda",type:"error"}, 
													function(isConfirm){ window.location = "Registro-Producto.php";});}, 100);</script>';

	}
	
}

// Modificar los datos
if($boton=="Modificar"){
	if($Nombre!=""){

            $sql="update producto set Nombre='$Nombre', Descrip='$Descrip' where Nombre='$Nombre'";

						if(mysql_query($sql)){
								

										echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos Modificados",type:"success"}).then(function() {window.location.href = "Registro-Producto.php";})});</script>';

							}else{
								echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser Modificados","error");}, 250);</script>';
							}


	}else{
		
		echo '<script>setTimeout(function(){swal({title:"OOPSS!",text:"Para poder Modificadar debe Realizar una busqueda",type:"error"}, 
													function(isConfirm){ window.location.href = "Registro-Producto.php";});}, 100);</script>';
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
	       			<h2 class="text-center">Registro de Material Carnetizacion</h2>
	       				<br>
												<form class="form-horizontal" action="" method="post" id="FormProduc">
												<!-- Datos de los Estudiantes -->
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Nombre</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="Nombre" placeholder="Nombre" value="<?php echo $Nombre;  ?>" id="Nombre">
															<span class="help-block" id="Existe"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Descripción</label>
														</div>
														<div class="col-md-5">
															<textarea name="Descrip" id="Descrip" class="form-control" cols="133" rows="07">
																<?php echo $Descrip;  ?>
															</textarea>
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
		
    function ValidaNombrePro(){

    		var Nombre = document.getElementById("Nombre").value;

			if( Nombre == null || Nombre.length == 0 || /^\s+$/.test(Nombre) ){
				$("#IcoValida").remove();
				$("#Nombre").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Nombre").parent().children("span").text("Este campo no puede estar vacio");
				$("#Nombre").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}

			$("#IcoValida").remove();
			$("#Nombre").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#Nombre").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');

			return true;
    	}
    function ValidaDescrip(){

    		var Descrip = document.getElementById("Descrip").value;

			if( Descrip == null || Descrip.length == 0 || /^\s+$/.test(Descrip) ){
				$("#IcoValida").remove();
				$("#Descrip").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Descrip").parent().children("span").text("Este campo no puede estar vacio");
				$("#Descrip").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
		}

			$("#IcoValida").remove();
			$("#Descrip").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#Descrip").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			return true;
    	}

    
	function validacion(e){

			if( ValidaNombrePro() && ValidaDescrip()){

				return true;
			}else{

				e.preventDefault();
				return false;
			}
	}
</script>
</body>
</html>