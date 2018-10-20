
<?php
	date_default_timezone_set('America/Caracas');
	session_start();
	include('ConfigBdd.php');
	
	$Usuario = $_POST['Usuario'];
	$Cont = $_POST['Cont'];
	$CodCaptha = $_POST['CodCaptha'];
	
	if ($_POST['acceso']) {

			if ($CodCaptha == $_SESSION['captcha']){
								$Cripto = sha1(md5($Cont));
						$sql = ("select * from login where Usuario ='$Usuario' and Cont = '$Cripto'");
						$respu = mysql_query($sql);

								if ($fila = mysql_fetch_array($respu)){

										if ($fila["Bloqueo"]==1){

											echo '<script>alert("Usuario Bloqueado");</script>';
											
										}else{

											$_SESSION['Usuario'] = trim($fila["Usuario"]);
											$_SESSION['idNivel'] = trim($fila["idNivel"]);

									// inicio la sesión
								    $_SESSION["autentificado"]= "SI";
								    //defino la sesión que demuestra que el usuario está autorizado
								    $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); 

												echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
												  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Bienvenido",type:"success"}).then(function() {window.location.href = "index.php";})});</script>';
											} 
								        
								}else{ 

									 $_SESSION['intentos'] = $_SESSION['intentos'] + 1;

										if ($_SESSION['intentos'] == 3){
											$sql = ("update login set Bloqueo=true where Usuario ='$Usuario'");
											$respu = mysql_query($sql);
												echo '<script>alert("Usuario Bloqueado");</script>';
										}else{

											echo '<script>setTimeout(function(){swal("OOPSS!","Combinación Usuario/Contraseña no Valida, lleva '.$_SESSION['intentos'].' intento/s","error");}, 250);</script>';
										}

									
								}

			}else{

					echo '<script>setTimeout(function(){swal("OOPSS!","Captha Invalido","error");}, 250);</script>';

			}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">

	<title>Login</title>

  <!-- Bootstrap -->
	<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
<!-- sweetalert -->
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/sweetalert/sweetalert.css">
  <!-- CSS -->
 	<link rel="stylesheet" href="css/estilogin.css">
  <!-- Javascript -->
    <script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
  <!-- sweetalert -->
    <script src="bootstrap-3.3.7/sweetalert/sweetalert.min.js"></script>
   
    
    
</head>
<body>
	<div class="container">
		<div class="inner-bg">
					<div class="row">
		                <div class="col-md-8 col-md-offset-2 text-center">
		                     <h1><strong>Bienvenido</strong></h1>
		                        <div class="titulo2">
		                         <p>
			                         Esta aplicación esta diseñada para el registro y control de carnet del IUTCM
		                         </p>
		                     </div>
		                </div>
		            </div>
		            <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<img src="css/images/Logotipo.png" height="100">
                        		</div>
                        		<div class="form-top-right" style="margin-top: 6px;">
                        			<i class="glyphicon glyphicon-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form name="frm"  action="" method="POST" class="login-form" onsubmit="return validacion();">
			                    	<div class="form-group">
			                    		
			                        	<input type="text" name="Usuario" id="Usuario" placeholder="Usuario" class="form-control">
			                        	<span class="help-block"></span>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="Cont" id="Cont" placeholder="Clave" class="form-control">
			                        	<span class="help-block"></span>
			                        </div>
			                        <div class="form-group row"> 
										  <div class="col-md-6"> 
										    <div class="thumbnail">
                    							<img src="captcha/captcha.php"/>
                							</div>
										  </div>
                						<div class="col-md-6">
                							<input type="text" name="CodCaptha" id="CodCaptha" placeholder="Captha" class="form-control">
                							<span class="help-block"></span>
                						</div>
			                        </div>
			                        <div class="form-group row">
			                        	<div class="col-md-3">
			                        		<input name="acceso" type="submit" id="acceso" class="btn btn-success btn-lg" value="Ingresar" />
			                        	</div>
					                    <div class="col-md-9 text-right gl">
					                        	<a href="recupera.php" id="gl1"><h3><i class="glyphicon glyphicon-chevron-right"></i>&nbsp;&nbsp;¿Olvido su Usuario y Clave?</h3></a>
					                    </div>
                    				</div>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <div class="navbar-fixed-top">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Oscuro</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Medio</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Claro</a>
								&nbsp; &nbsp; &nbsp;
					</div>
				<footer class="text-center"><p>&copy; 2018 Jean Carlos Escalante Lara</p></footer>
		</div>  
	</div>

<script type="text/javascript">

	$(function($){
		$('#btn-login-dark').on('click', function(e){
			$('body').css('background-image', 'url(css/images/blue-vector-oscuro.jpg)');
			$('')
			
		});

		$('#btn-login-blur').on('click', function(e){
			$('body').css('background-image', 'url(css/images/blue-vector-medio.jpg)');
			
		});

		$('#btn-login-light').on('click', function(e){
			$('body').css('background-image', 'url(css/images/blue-vector-white.jpg)');
		});
	});

</script>
 <script type="text/javascript">

    	var FormLogin = document.getElementById("FormLogin");
    	window.onload = iniciar;

    function iniciar(){

    		document.getElementById("acceso").addEventListener('click', validacion, false);
    	}
		
    function ValidaUsuario(){

    		var Usuario = document.getElementById("Usuario").value;

    		if( Usuario == null || Usuario.length == 0 || /^\s+$/.test(Usuario) ){

				$("#Usuario").parent().attr("class", "form-group has-error has-feedback");
				$("#Usuario").parent().children("span").text("Este campo no puede estar vacio");
			  	return false;
		}
			$("#Usuario").parent().attr("class", "form-group has-success");
			return true;
    	}
    function ValidaClave(){

    		var Cont = document.getElementById("Cont").value;

			if( Cont == null || Cont.length == 0 || /^\s+$/.test(Cont) ){

				$("#Cont").parent().attr("class", "form-group has-error");
				$("#Cont").parent().children("span").text("Este campo no puede estar vacio");
			  	return false;
		}
			$("#Cont").parent().attr("class", "form-group has-success");
			return true;
    	}
    function ValidaCaptcha(){

    		var Captha = document.getElementById("CodCaptha").value;
    		
			if( Captha == null || Captha.length == 0 || /^\s+$/.test(Captha) ){
				
				$("#CodCaptha").parent().parent().attr("class", "form-group row has-error");
				$("#CodCaptha").parent().children("span").text("Este campo no puede estar vacio");
			  	return false;
			}
			else if (Captha.length > 6 || Captha.length < 6  ){

				$("#CodCaptha").parent().parent().attr("class", "form-group row has-error");
				$("#CodCaptha").parent().children("span").text("Este campo acepta 6 caracteres");
				return false;
			}

			
			$("#CodCaptha").parent().parent().attr("class", "form-group row has-success");
			return true;
    	}

	function validacion(e){

			if(ValidaUsuario() && ValidaClave() && ValidaCaptcha()){

				return true;
			}else{

				e.preventDefault();
				return false;
			}
	}
</script>
</body>
</html>