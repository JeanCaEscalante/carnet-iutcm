<?php
	date_default_timezone_set('America/Caracas');
	session_start();
	include('ConfigBdd.php');
$Cont = $_POST['Cont'];
$ReCont = $_POST['ReCont'];
$Usuario = $_SESSION['Usuario'];

if ($_POST['clave']) {
		
		if	($Cont === $ReCont){

				$Cripto = sha1(md5($Cont));
				
				$sql="update login set Cont='$Cripto' where Usuario='$Usuario'";
				if(mysql_query($sql)){
					
							echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
								  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Datos Guardados",type:"success"}).then(function() {window.location.href = "Carnet-Estudiantes.php";})});</script>';

				}else{
					echo '<script>setTimeout(function(){swal("OOPSS!","Datos no pudieron ser GUARDADOS","error");}, 250);</script>';
				}
				
				echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Clave modificada",type:"success"}).then(function() {window.location.href = "login.php";})});</script>';
		}else{

				echo '<script>setTimeout(function(){swal("Clave no conincide","por favor, vuelva a intentarlo","error");}, 250);</script>';
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
		                     <h1><strong>Nueva clave</strong></h1>
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
			                    <form name="frm"  action="" method="POST" class="NuevaCont-form" id="frmNuevaCont">
			                    	<div class="form-group">
			                        	<input type="text" name="Usuario"  value="<?php echo  $_SESSION['Usuario']; ?>" class="form-control" disabled>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="Cont" id="Cont" placeholder="Ingrese clave" class="form-control">
			                        	<span class="help-block"></span>
			                        </div>
			                        <div class="form-group">
			                        	<input type="password" name="ReCont" id="ReCont" placeholder="Repita su clave" class="form-control">
			                        	<span class="help-block"></span>
                    				</div>
                    				<div class="form-group row">
			                        	<div class="col-md-3">
			                        		<input name="clave" type="submit" class="btn btn-success btn-lg" value="Cambiar" />
			                        	</div>
					                    <div class="col-md-9 text-right gl">
					                        	<a href="login.php"><h3><i class="glyphicon glyphicon-chevron-left"></i>&nbsp;&nbsp;Regresar</h3></a>
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
var frmNuevaCont = document.getElementById("frmNuevaCont");
	window.onload = iniciar;

		function iniciar() {

			document.getElementById("Guardar").addEventListener('click', validacion, false);
			

		}

		function ValidaCont() {
			
			var Cont = document.getElementById("Cont").value;

			if (Cont == null || Cont.length == 0 || /^\s+$/.test(Cont)){

				$("#IcoValida").remove();
				$("#Cont").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#Cont").parent().children("span").text("Este campo no puede estar vacio");
				$("#Cont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
			}
			$("#IcoValida").remove();
			$("#Cont").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#Cont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			return true;
    	}
    	function ValidaReCont() {
			
			var ReCont = document.getElementById("ReCont").value;

			if (ReCont == null || ReCont.length == 0 || /^\s+$/.test(ReCont)){

				$("#IcoValida").remove();
				$("#ReCont").parent().parent().attr("class", "form-group has-error has-feedback");
				$("#ReCont").parent().children("span").text("Este campo no puede estar vacio");
				$("#ReCont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			  	return false;
			}
			$("#IcoValida").remove();
			$("#ReCont").parent().parent().attr("class", "form-group has-success has-feedback");
			$("#ReCont").parent().append('<span id="IcoValida" class="glyphicon glyphicon-ok form-control-feedback"></span>');
			return true;
    	}
		
		function validacion(e) {
			if (ValidaCargo() && ValidaReCont()) {

				return true;
			}else{

				e.preventDefault();
				return false;
			}
		}
</script>
</body>
</html>