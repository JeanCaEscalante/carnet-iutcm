<?php
date_default_timezone_set('America/Caracas');
	session_start();
	if(!isset($_SESSION["Usuario"]) and !isset($_SESSION["idNivel"])){ //Comprobacion de inicio de session

    	header('Location:login.php');
    	exit; 
	}
	
	include('ConfigBdd.php');

	$Buscador = $_POST['Buscador'];
	$Nombres = $_POST['Nombres'];
	
       if (isset($_POST['busca'])) {

				$sql = ("select alumcarnet.Cedula, nacion.Nacion as Nacionalidad,alumcarnet.Nombres, alumcarnet.Apellidos, sexo.Sexo, alumcarnet.telefono as Telefono,alumcarnet.correo As Correo ,carrera.Carrera, semestre.Semes as Semestre, turno.Turno,regcarnetalum.NPago, regcarnetalum.FechaSol, regcarnetalum.FechaEntre, regcarnetalum.FechaVen, estatus.Estatus from alumcarnet 
					INNER JOIN regcarnetalum ON alumcarnet.Cedula = regcarnetalum.Cedula
					INNER JOIN nacion ON alumcarnet.idNacion = nacion.idNacion
					INNER JOIN sexo ON alumcarnet.idSexo = sexo.idSexo
					INNER JOIN semestre ON regcarnetalum.CodSemes = semestre.CodSemes
					INNER JOIN carrera ON regcarnetalum.CodCarrera = carrera.CodCarrera
					INNER JOIN turno ON regcarnetalum.CodTurno = turno.CodTurno
					INNER JOIN estatus ON regcarnetalum.idEstatus = estatus.idEstatus
				 	where alumcarnet.Cedula LIKE '$Buscador%' OR 
				 	      alumcarnet.Nombres LIKE '$Buscador%' OR 
				 	      regcarnetalum.NPago LIKE '$Buscador%'");
					$busqueda=mysql_query($sql);

						if($datos=mysql_fetch_array($busqueda)){


										$Cedula = $datos["Cedula"];
										$Apellidos = $datos["Apellidos"];
										$Nombres = $datos["Nombres"];
										$Nacion = $datos["Nacionalidad"];
										$Sexo = $datos["Sexo"];
										$Telefono = $datos["Telefono"];
										$Correo = $datos["Correo"];

									echo '
							<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
							<script>

								$(document).ready(function(){
											var Resultado = document.getElementById("Resultado");

									if (Resultado.style.display == "none"){

											document.getElementById("Resultado").style.display = "block";
									}

								});

							     </script>';
	}else{
		echo '<script>setTimeout(function(){swal("Registro NO EXISTE en el Sistema");}, 250);</script>';
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
	       		<h2 class="text-center">Busqueda Estudiantes</h2>
	       				<br>
	       				<form class="form-horizontal" action="" method="post" name="BuscarRegEstu" id="BuscarRegEstu">
			                    					<div class="row form-group ">
														<div class="col-md-3 control-label">
															
														</div>
														<div class="col-md-6">
																<div class="input-group">
									                    			<input type="text" class="form-control search-query" name="Buscador" placeholder="Buscador"  id="Buscador">
																	<span class="input-group-btn">
																		<button type="submit" name="busca" class="btn btn-success">
																				<span class="glyphicon glyphicon-search"></span>
																				Buscar
																		</button>
																	</span>
																</div>
															<span class="help-block"></span>
														</div>
														
			                    					</div>
 	
	       				</form>
       				
					<div class="row form-group" id="Resultado" style="display: none;">
														<div class="col-md-3">
															<div class="thumbnail">
																<?php
															
																	$directorio = 'Fotos/Foto-Estudiantes';
																	echo '<img src="'.$directorio.'/'.$Cedula.'.png">';
														
																?>
							
															      <div class="caption">
															        <h3 class="text-center">Datos Personales</h3>
															        <p>Cedula:</p> <label><?php echo $Cedula; ?></label><br>
															       	<p>Nacionalidad:</p> <label><?php echo $Nacion; ?></label><br>
															       	<p>Nombres:</p> <label><?php echo $Nombres; ?></label><br>
															       	<p>Apellidos:</p> <label><?php echo $Apellidos; ?></label><br>
															       	<p>Sexo:</p> <label><?php echo $Sexo; ?></label><br>
															       	<p>Telefono:</p> <label><?php echo $Telefono; ?></label><br>
															       	<p>Correo:</p> <label><?php echo $Correo; ?></label>
															      </div>
															    </div>
														</div>
														<div class="col-md-9">
															<h3 class="text-center">Datos del Carnet</h3>
															<?php
																		echo "<table>";
																		
																		echo "<tr>";  
																		echo "<th>Carrera</th>"; 
																		echo "<th>Semestre</th>";
																		echo "<th>Turno</th>";
																		echo "<th>N° Pago</th>";
																		echo "<th>Fecha de Solicitud</th>";
																		echo "<th>Fecha de Entrega</th>";
																		echo "<th>Fecha de Vencimiento</th>";
																		echo "<th>Estado</th>";       
																		echo "</tr>"; 
															$busqueda2 = mysql_query($sql);
										       				while ($row = mysql_fetch_array($busqueda2)){
																		    
																		   	echo "<tr>";
																		    echo "<td>".$row["Carrera"]."</td>";
																		    echo "<td>".$row["Semestre"]."</td>";
																		    echo "<td>".$row["Turno"]."</td>";
																		    echo "<td>".$row["NPago"]."</td>";
																		    echo "<td>".$row["FechaSol"]."</td>";
																		    echo "<td>".$row["FechaEntre"]."</td>";
																		    echo "<td>".$row["FechaVen"]."</td>";
																		    echo "<td>".$row["Estatus"]."</td>";
																		    echo "</tr>";   
																		}
																		
																		echo "</table>"; 

										       				 ?>			
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


             $(document).ready(function(){			 
					  $("#VentInicio").modal("show");
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
</body>
</html>