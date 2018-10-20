<?PHP 
	date_default_timezone_set('America/Caracas');
	session_start();
	if(!isset($_SESSION["Usuario"]) and !isset($_SESSION["idNivel"])){ //Comprobacion de inicio de session

    	header('Location:login.php');
    	exit; 
	}
	//realizar la conexion desde otro archivo
	include('ConfigBdd.php');

	$boton=$_POST["boton"];

	//Variables
		$Carrera = $_POST['Carrera'];
		$Cargo = $_POST['Cargo'];
	//Variables de Formato
		$Formato =$_FILES['images']['name'];
		$tipo = $_FILES['images']['type'];
		

		$ruta = $_SERVER['DOCUMENT_ROOT'].'/carnet-iutcm/Formatos/Estudiante/';

if($boton=="Guardar"){

		move_uploaded_file($_FILES['images']['tmp_name'], $ruta .$Formato);

		$sql="insert into formatcarnet (FormatCarnet) values ('$Formato')";

	if(mysql_query($sql)){	
			$idFormato = mysql_insert_id();

			$sql="insert into carrera (Carrera, idFormato) values ('$Carrera', '$idFormato')";
			mysql_query($sql);
		
				echo '<script>setTimeout(function(){swal({title:"Buen trabajo!!!",text:"Datos Guardados",type:"success"}, 
															function(isConfirm){location.href="Formato-Carnet-Estudiantes.php";});}, 100);</script>';
	


	}else{
		echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser GUARDADOS","error");}, 250);</script>';
	}
	
}
if($boton=="Buscar"){

				$sql = ("select
							  carrera.Carrera,
							  formatcarnet.idFormato,
							  formatcarnet.FormatCarnet
							FROM
							  carrera
							INNER JOIN
							  formatcarnet
							ON
							  formatcarnet.idFormato = carrera.idFormato
							WHERE
							  carrera.Carrera LIKE '$Carrera%'");
					$busqueda=mysql_query($sql);

						if($datos=mysql_fetch_array($busqueda)){

										$Carrera = $datos["Carrera"];
										$FormaBus = $datos["FormatCarnet"];
										$idFormato = $datos["idFormato"];

									
									
	}else{
		echo '<script>setTimeout(function(){swal("Registro NO EXISTE en el Sistema");}, 250);</script>';
	}
	
}


// Modificar los datos
if($boton=="Modificar"){

	if($Formato!=""){

			unlink('Formatos/Estudiante/'.$FormaBus.'');
            $sql="update formatcarnet set FormatCarnet='$Formato' where idFormato ='idFormato'";

						if(mysql_query($sql)){
								
  
								    move_uploaded_file($_FILES['images']['tmp_name'], $ruta .$Formato);

										echo '<script>setTimeout(function(){swal({title:"Buen trabajo!!!",text:"Datos Modificados Correctamente",type:"success"}, function(isConfirm){ window.location = "Formato-Carnet-Estudiantes.php";});}, 100);</script>';

							}else{
								echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser Modificados","error");}, 250);</script>';
							}


	}else{
		
		echo '<script>setTimeout(function(){swal({title:"OOPSS!",text:"Para poder Modificadar debe Realizar una busqueda",type:"error"}, 
													function(isConfirm){ window.location = "Registro-Estudiantes.php";});}, 100);</script>';
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
	       				<h2 class="text-center">Formatos Carnet Estudiantes</h2>
	       				<br>
	       		<form class="form-horizontal" action="" method="post" id="FormCarnetEstu" enctype="multipart/form-data">
														<div class="row form-group">
															<div class="col-md-4 control-label">
																<label>Carrera</label>
															</div>
															<div class="col-md-5">
																      <input type="text" class="form-control" name="Carrera" id="Carrera" placeholder="Carrera" value="<?php echo $Carrera; ?>">
															</div>
															<span class="help-block"></span>
														</div>
														<div class="row form-group">
															<div class="col-md-4 control-label">
																<label>Formato</label>
															</div>
															<div class="col-md-5">
													            <div class="input-group">
													            	<input type="text" class="form-control" readonly>
													                <label class="input-group-btn">
													                    <span class="btn btn-primary">
													                         <input type="file" style="display: none;" 
													                        name="images" id="file">
													                         <i class="glyphicon glyphicon-file"></i> Buscar	
													                    </span>
													                </label>
													            </div>
													            <span class="help-block">
													                Seleccione el formato para agregar
													            </span>
													        </div>
														</div>
														<div class="row form-group text-center">
													<div class="col-md-12">	
															<button type="submit" class="btn btn-success" value="Guardar" id="Guardar" name="boton">Guardar</button>
															<button type="submit" class="btn btn-info" value="Buscar" id="Buscar" name="boton">Buscar</button>
														    <button type="submit" class="btn btn-primary" value="Modificar" id="Modificar" name="boton">Modificar</button>
													</div>
												</div>

			    </form>
	<div class="row">
		<br>
		<br>
	
	       		<?php
							$directorio = 'Formatos/Estudiante';
							$formato_img=array('jpg','jpeg','gif','png');
							$archivo=array();
							$ext='';
							$NombreImg='';
							$i=0;

							if ($FormaBus ==""){

									$dir = @opendir($directorio) or die("Hay un error con el directorio de imágenes!");
								
									while ($file = readdir($dir)){

											if($file=='.' || $file == '..') continue;
			
										
									
											$archivo = explode('.',$file);
											$ext = strtolower(array_pop($archivo));

											$NombreImg = implode('.',$archivo);
											$NombreImg = htmlspecialchars($NombreImg);

											$nomargin='';

										if(in_array($ext,$formato_img)){

											if(($i+1)%3==0) $nomargin='nomargin';

											
											echo "<div class='col-md-5 col-md-offset-1'>";
											echo '<a href="'.$directorio.'/'.$file.'" class="thumbnail" data-lightbox="galeria" title="'.$NombreImg.'" target="_blank"><img src="'.$directorio.'/'.$file.'"></a>';
											echo "</div>";
											

											$i++;
										}
									}

									closedir($dir);

						}else{

							echo "<div class='col-md-5 col-md-offset-4'>";
									echo '<a href="'.$directorio.'/'.$FormaBus.'" class="thumbnail" data-lightbox="galeria" title="'.$NombreImg.'" target="_blank"><img src="'.$directorio.'/'.$FormaBus.'"></a>';
									echo "</div>";
						}

				?>
	       	</div>						
       </div>
       <footer class="text-center"><p>&copy; 2018 Jean Carlos Escalante Lara</p></footer>
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

	var FormCarnetEstu = document.getElementById("FormCarnetEstu");
	window.onload = iniciar;

	function iniciar(){
		document.getElementById("Guardar").addEventListener('click', validacion, false);
		document.getElementById("Modificar").addEventListener('click', validacion, false);
	}

	function ValidaCarrera(){

				var Carrera = document.getElementById("Carrera").value;

				if( Carrera == null || Carrera.length == 0 || /^\s+$/.test(Carrera) ){
						$("#Carrera").parent().parent().attr("class", "form-group has-error has-feedback");
						$("#Carrera").parent().children("span").text("Este campo no puede estar vacio");
					  	return false;
				}
					else if (!(/^[a-zA-Z\s]*$/.test(Carrera))){

						$("#Carrera").parent().parent().attr("class", "form-group has-error has-feedback");
						$("#Carrera").parent().children("span").text("Este campo no puede contener números");
						return false;
					}
			
					$("#Carrera").parent().parent().attr("class", "form-group has-success has-feedback");
						

					return true;
    	}

    function ValidaFormato(){

			    var fileInput = document.getElementById('file');
			    var filePath = fileInput.value;
			    var formato = /(.jpg|.jpeg|.png)$/i;

			        if(!formato.exec(filePath)){
			        alert('El formato debe ser .jpeg/.jpg/.png');
			        fileInput.value = '';
			        return false;
			    }

			    	return true;

    }

	function validacion(e){
		if ( ValidaCarrera() && ValidaFormato()){

			return true;

		}
		else{

			e.preventDefault();
			return false;

		}
	}
</script>
</body>
</html>