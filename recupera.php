
<?php
	date_default_timezone_set('America/Caracas');
	session_start();
	include('ConfigBdd.php');
	
	$Correo = $_POST["Correo"];
	

	if (isset($_POST['busca'])) {
	
		$sql = ("select * from login where Correo ='$Correo'");
		$respu = mysql_query($sql);

			if ($fila = mysql_fetch_array($respu)){

			    $_SESSION['RespuSeg']  = $fila['RespuSeg'];
			    $_SESSION['Usuario'] = $fila['Usuario'];
				echo '<script>setTimeout(function(){swal("Debe responder la pregunta de seguridad");}, 250);</script>';
				
		}else{ 

		echo '<script>setTimeout(function(){swal("OOPSS!","Correo no existe","error");}, 250);</script>';
	}

}

$Res = $_POST["Res"];

	if ($_POST['desbloq']) {
		
		if	($Res == $_SESSION['RespuSeg']){


				echo '<script src="bootstrap-3.3.7/js/jquery-3.2.1.min.js"></script>
					  <script>$(document).ready(function() {swal({ title:"Buen trabajo!!!",text:"Correo Desbloqueado",type:"success"}).then(function() {window.location.href = "NuevaClave.php";})});</script>';
		}else{

				echo '<script>setTimeout(function(){swal("RESPUESTA INVALIDA","por favor, vuelva a intentarlo","error");}, 250);</script>';
		}

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">

	<title>Recuperación</title>

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
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<img src="css/images/Logotipo.png" height="100">
                        		</div>
                        		<div class="form-top-right" style="margin-top: 6px;">
                        			<i class="glyphicon glyphicon-user"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form name="frm"  action="" method="POST" class="login-form">
			                    	<div class="form-group input-group">
			                    		<input type="text" name="Correo" class="form-control search-query" placeholder="Ingrese Email" />
											<span class="input-group-btn">
												<button type="submit" name="busca" class="btn btn-success btn-lg">
														<span class="glyphicon glyphicon-search"></span>
														Buscar
												</button>
											</span>
			                    	</div>

			                    	<div class="form-group">
			                        	<input type="text" name="Pre" placeholder="¿Pregunta de seguridad?" value="<?php echo $fila['PregSeg']; ?>" class="form-control" disabled>
			                        </div>
			                        <div class="form-group">
			                        	<input type="text" name="Res" placeholder="Respuesta de seguridad" class="form-control">
			                        </div>
			                       
			                        <div class="form-group row">
			                        	<div class="col-md-3">
			                        		<input name="desbloq" type="submit" class="btn btn-success btn-lg" value="Recuperar" />
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
		</div>  
	</div>

<script type="text/javascript">

	$(function($){

		$('#btn-login-dark').on('click', function(e){
			$('body').css('background-image', 'url(css/images/blue-vector-oscuro.jpg)');
			
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
	
</script>
</body>
</html>