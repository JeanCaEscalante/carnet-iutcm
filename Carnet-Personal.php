<?PHP 
	date_default_timezone_set('America/Caracas');
	session_start();
	if(!isset($_SESSION["Usuario"]) and !isset($_SESSION["idNivel"])){ //Comprobacion de inicio de session

    	header('Location:login.php');
    	exit; 
	}
	//realizar la conexion desde otro archivo
	include('ConfigBdd.php');

	 // funcion para gusrfdar la imagen base64 en el servidor
    // el nombre debe tener la extension
    function uploadImgBase64 ($base64, $name){
        // decodificamos el base64
        $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        // definimos la ruta donde se guardara en el server
        $path= $_SERVER['DOCUMENT_ROOT'].'/carnet-iutcm/Fotos/Foto-Personal/'.$name;
        // guardamos la imagen en el server
        if(!file_put_contents($path, $datosBase64)){
            // retorno si falla
            return false;
        }
        else{
            // retorno si todo fue bien
            return true;
        }
    }
    

	//recibir el boton	
	$boton=$_POST["boton"];
	
	//recibir los datos del formulario
	$CedulaPerso = $_POST['CedulaPerso'];
	$idTipoCarg = $_POST["tipocargo"];
	$CodCargo = $_POST["CodCargo"];
	$FechaSol = date("y-m-d");
	$idEstatus = 1;

	$Foto= $_SERVER['DOCUMENT_ROOT'].'/carnet-iutcm/Fotos/Foto-Personal/'. $_POST['CedulaPerso'];

if (isset($_POST['busca'])) {
	
		$sql = ("select * from personalcarnet where CedulaPerso ='$CedulaPerso'");
		$respu = mysql_query($sql);

			if ($fila = mysql_fetch_array($respu)){
				$CedulaPerso = $fila['CedulaPerso'];
				$Nombres = $fila['Nombres']; 
				$Apellidos = $fila['Apellidos'];

				echo '<script>setTimeout(function(){swal("Registre los datos solicitados");}, 250);</script>';
				
		}else{ 

		echo '<script>setTimeout(function(){swal("OOPSS!","Registro no encontrado","error");}, 250);</script>';
	}

}


// Almacenar los datos
if($boton=="Guardar"){
	$sql="insert into regcarnetper (CedulaPerso, CodCargo, idTipoCarg, FechaSol, idEstatus, Foto) values
	('$CedulaPerso', '$CodCargo', '$idTipoCarg', '$FechaSol', '$idEstatus','$Foto')";
	if(mysql_query($sql)){

		$idCarnetPer = mysql_insert_id();
		$sql="update personalcarnet set idCarnetPer = '$idCarnetPer' where CedulaPerso='$CedulaPerso'";
		
		mysql_query($sql);
			
		    // llamamos a la funcion uploadImgBase64( img_base64, Cedula.png) 
		    uploadImgBase64($_POST['imagen'], $_POST['CedulaPerso'].'.png' );
		
				echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos Guardados",type:"success"}).then(function() {window.location.href = "Generar-Carnet-Personal.php";})});</script>';

	}else{
		echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser GUARDADOS","error");}, 250);</script>';
	}
	
}


if($boton=="Limpiar"){
echo "<script>window.location='Registro-Personal.php'</script>";
}

// Modificar los datos
if($boton=="Modificar"){
	if($Cedula!=""){

            $sql="update alumcarnet set Cedula='$Cedula', idNacion='$idNacion', Nombres='$Nombres', Apellidos ='$Apellidos', idSexo='$idSexo', telefono='$telefono', correo='$correo' where Cedula='$Cedula'";
					mysql_query($sql);

						if(mysql_query($sql)){
								
										echo '<script>setTimeout(function(){swal({title:"Buen trabajo!!!",text:"Datos Modificados Correctamente",type:"success"}, function(isConfirm){ window.location = "Generar-Carnet-Personal.php";});}, 100);</script>';

							}else{
								echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser Modificados","error");}, 250);</script>';
							}


	}else{
		
		echo '<script>setTimeout(function(){swal({title:"OOPSS!",text:"Para poder Modificadar debe Realizar una busqueda",type:"error"}, 
													function(isConfirm){ window.location = "Generar-Carnet-Personal.php";});}, 100);</script>';
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
	       				<h2 class="text-center">Datos del Carnet Personal</h2>
	       				<br>
												<form class="form-horizontal" action="" method="post" id="FormCarnEstu">
													<div class="row form-group ">
														<div class="col-md-4 control-label">
															<label>Cedula</label>
														</div>
														<div class="col-md-5">
																<div class="input-group">
									                    			<input type="text" class="form-control search-query" name="CedulaPerso" placeholder="Cedula"  id="Cedula" value="<?php echo $CedulaPerso;  ?>">
																	<span class="input-group-btn">
																		<button type="submit" name="busca" class="btn btn-success">
																				<span class="glyphicon glyphicon-search"></span>
																				Buscar
																		</button>
																	</span>
																</div>
															<span class="help-block"></span>
														</div>
														<div class="col-md-3" >		
															<img id="Fotoprim" name="FotoCarnt" height="184" width="172" style="position: absolute;">	
			                    						</div>
			                    					</div>

			                    					
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Nombres</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="Nombres" placeholder="Nombres" value="<?php echo $Nombres;  ?>" id="Nombres" disabled>
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Apellidos</label>
														</div>
														<div class="col-md-5">
															<input type="text" class="form-control" name="Apellidos" placeholder="Apellidos" value="<?php echo $Apellidos;  ?>" id="Apellidos" disabled>
															<span class="help-block"></span>
														</div>		
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Tipo Personal</label>
														</div>
														<div class="col-md-5">
															<select class="form-control" name="tipocargo" id="tipocargo">
																<option value="" selected="" disabled="">Seleccione</option>
																<?php

																		$tipocargo ="Select * From tipocargo";
																		$result=mysql_query($tipocargo);
																		while($row = mysql_fetch_array($result)) {
																				echo "<option value='".$row['idTipoCarg']. "'>".$row['NomTipoCarg']."</option>";

																				
																		}

																		
																?>
															</select>
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Cargo</label>
														</div>
														<div class="col-md-5">
															<select class="form-control" name="CodCargo" id="CodCargo">
																<option value="" selected="" disabled="">Seleccione</option>
																
															</select>
															<span class="help-block"></span>
														</div>
													</div>
													<div class="row form-group">
														<div class="col-md-4 control-label">
															<label>Tomar Foto</label>
														</div>
														<div class="col-md-5">
															<button type="button" class="form-control btn btn-success" name="" value="Foto" id="Foto" data-toggle="ModalFoto"><i class="glyphicon glyphicon-facetime-video"></i> Foto</button>
															<span class="help-block"></span>
														</div>
													</div>
													<input type='hidden' name='imagen' id='imagen' />
												<div class="row form-group text-center">
													<div class="col-md-12">	
															<button type="submit" class="btn btn-success" value="Guardar" id="Guardar" name="boton"><i class="glyphicon glyphicon-floppy-saved"></i> Guardar</button>
														    <button type="submit" class="btn btn-danger" value="Limpiar" name="boton" ><i class="glyphicon glyphicon-erase"></i>  Limpiar</button>
														    <button type="submit" class="btn btn-primary" value="Modificar" id="Modificar" name="boton"><i class="glyphicon glyphicon-saved"></i> Modificar</button>
													</div>
												</div>
												  
									</form>
	       		</div>
	       		<footer class="text-center"><p>&copy; 2018 Jean Carlos Escalante Lara</p></footer>
       		</div>
       </div>

       <div class="modal fade" id="ventana1">
       		<div class="modal-dialog">
       			<div class="modal-content">
       				<div class="modal-header">
       					<button type="button" class="close" data-dismiss="modal" id="Cerrar">
       						<i class="glyphicon glyphicon-remove"></i>
       					</button>
       					<h4 class="modal-title text-center">Foto</h4>
       				</div>
       				<div class="modal-body">	
       							<video id="camara"></video>
       				</div>
       				<div class="modal-footer">
						<div class="row">
       						<div class="col-md-1">
       							<canvas id="canvas"  name="canvasFoto" style="display: none;"></canvas>
       							<img id="Fotomin" height="75" width="90"></a>
       						</div>
       						<div class="col-md-11">
       							<br>
       							<button type="submit" class="btn btn-success" id="TomarFoto"><i class="glyphicon glyphicon-camera"></i> Foto</button>
       							<button type="submit" class="btn btn-danger" id="Limpiar"><i class="glyphicon glyphicon-erase"></i> Limpiar</button>
								<button type="submit" class="btn btn-danger" id="Detener"><i class="glyphicon glyphicon-stop"></i> Detener</button>
       						</div>
       				</div>
       			</div>
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

             $("#Foto").on("click",function() {
  					$("#ventana1").modal("show");
			});
			
        //Definimos la Api del navegador para la webcam
        var streaming = false;
        var camara = document.querySelector('#camara');
        var canvas = document.querySelector('#canvas');
       	var width = 570;
       	var height = 0;
       	var TomarFoto = document.querySelector('#TomarFoto');
       	var  Fotomin  = document.querySelector('#Fotomin');
       	var  Fotoprim  = document.querySelector('#Fotoprim');
       	var  imagen  = document.querySelector('#imagen');

       	
  	
		navigator.camaraweb = ( navigator.msgetUserMedia || 
								navigator.webkitGetUserMedia || 
								navigator.mozGetUserMedia || 
								navigator.getUserMedia );

	  $('#Foto').on('click', function(e){
        
        navigator.camaraweb({video:true, audio:false}, 

        	function success(stream){


				camara.src = window.URL.createObjectURL(stream);
				localvideo = stream;
				camara.play();

			}, 		

			function error(error){

				alert("No se puede accesar a la camara");
				console.log(error);		
			});

			         camara.addEventListener('canplay', function(e){
			    if (!streaming) {
			      height = camara.videoHeight / (camara.videoWidth/width);
			      camara.setAttribute('width', width);
			      camara.setAttribute('height', height);
			      canvas.setAttribute('width', width);
			      canvas.setAttribute('height', height);
			      streaming = true;
			    }
			  }, false);

			  function CapturaFoto() {
			    canvas.width = width;
			    canvas.height = height;
			    canvas.getContext('2d').drawImage(camara, 0, 0, width, height);
			    var data = canvas.toDataURL('image/png');
			    Fotomin.setAttribute('src', data);
			    Fotoprim.setAttribute('src', data);
			    imagen.value= data; 
			  }

			  TomarFoto.addEventListener('click', function(ev){

			    CapturaFoto();
			    ev.preventDefault();

			  }, false);

    	});


 $('#Detener').on('click', function(e){	
            camara.pause;
            camara.src = "";
            localvideo.getVideoTracks()[0].stop();     
	 	});

 $('#Cerrar').on('click', function(e){	
            camara.pause;
            camara.src = "";
            localvideo.getVideoTracks()[0].stop();     
	 	});

 $('#Limpiar').on('click', function(e){	
            Fotomin.setAttribute('src', "");
	 	});

								


 $(document).ready(function(){
   $("#tipocargo").change(function () {
           $("#tipocargo option:selected").each(function () {
            idTipoCarg=$(this).val();
            $.post("ComboCargo.php", { idTipoCarg: idTipoCarg }, function(data){
            $("#CodCargo").html(data);
            });            
        });
   })
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

    	var FormRegEstu = document.getElementById("FormRegEstu");
    	window.onload = iniciar;

    function iniciar(){

    		document.getElementById("Guardar").addEventListener('click', validacion, false);
    		document.getElementById("Modificar").addEventListener('click', validacion, false);
    	}
		
    function ValidaCedula(){

    		var Cedula = document.getElementById("Cedula").value;

    		if( Cedula == null || Cedula.length == 0 || /^\s+$/.test(Cedula) ){

				$("#Cedula").parent().parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Cedula").parent().parent().children("span").text("Este campo no puede estar vacio");
				return false;
			}
			else if (!(/^\d*$/.test(Cedula))){

				$("#Cedula").parent().parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Cedula").parent().parent().children("span").text("Este campo no puede contener (a-zA-Z/!.*+-)");
			  	return false;
			}
				$("#Cedula").parent().parent().parent().attr("class", "form-group has-success has-feedback");
				
			return true;
    	}
	function ValidaCodCargo(){

    	CodCargo = document.getElementById("CodCargo").selectedIndex;
    	if( CodCargo == null || CodCargo == 0 ) {
    		$("#CodCargo").parent().parent().attr("class", "form-group has-error has-feedback");
			$("#CodCargo").parent().children("span").text("Debe seleccionar un cargo");
    		
  		return false;

		}

		$("#CodCargo").parent().parent().attr("class", "form-group has-success has-feedback");
		return true;
    }
    function Validatipocargo(){

    	tipocargo = document.getElementById("tipocargo").selectedIndex;
    	if( tipocargo == null || tipocargo == 0 ) {
    		$("#tipocargo").parent().parent().attr("class", "form-group has-error has-feedback");
			$("#tipocargo").parent().children("span").text("Debe seleccionar un tipo de personal");
    		
  		return false;

		}

		$("#tipocargo").parent().parent().attr("class", "form-group has-success has-feedback");
		return true;
    }

	function validacion(e){

			if(ValidaCedula()  && Validatipocargo() &&  ValidaCodCargo()){

				return true;
			}else{

				e.preventDefault();
				return false;
			}
	}
</script>
</body>
</html>