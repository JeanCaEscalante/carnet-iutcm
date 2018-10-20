<?php
		session_start();
		/* genero un string largo, y como parametro 
	 * le paso la fecha actual con microsegundos (microtime).
	 * luego con substr lo acorto a seis caracteres
	 */
		$captcha = substr( sha1( microtime() ),0,6); 

		/**Se guarda en variable para validar la sesion**/
				$_SESSION['captcha'] = $captcha; 

		//Crear imagen
				$width = 255;
				$height = 46;
				$font_size = 15;
				$font = 'Archaic-Asian-Inks.ttf';
				
				$img =  imagecreate($width , $height);
				$color = imagecolorallocate($img, 255, 255, 255);
				imagefilledrectangle($img, 4, 4, 255, 25, $color);
		//Color del texto
				$blanco = imagecolorallocate($img, 0, 0, 0);
		//Ubicacion del texto
				$x = 45;
				$y = 35;
		//Genera la imagen
				
				imagettftext($img, $font_size, 0, $x, $y, $blanco, $font, $captcha);

				header("Content-Type: image/jpeg"); 
		        ImageJpeg($img);
		

?>