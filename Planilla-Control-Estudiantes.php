    <?php error_reporting(0);
     
    require('fpdf/fpdf.php');
	
    //Conecto a la base de datos	
	include('ConfigBdd.php');

$idEstatus = $_POST["idEstatus"];
$fechaMin = $_POST["fechaMin"];
$fechaMax = $_POST["fechaMax"];
$CodCarrera = $_POST["CodCarrera"];
$CodSemes = $_POST["CodSemes"];
$CodTurno = $_POST["CodTurno"];

//Consulta la tabla Estudiantes que soliciten, entreguen o reclamen
   if ($idEstatus == 1){

        $resultado = mysql_query("select alumcarnet.Cedula, alumcarnet.Nombres, alumcarnet.Apellidos, carrera.Carrera, semestre.Semes as Semestre, turno.Turno, regcarnetalum.NPago, regcarnetalum.FechaSol, regcarnetalum.FechaEntre, estatus.Estatus 
        from alumcarnet 
                    INNER JOIN regcarnetalum ON alumcarnet.Cedula = regcarnetalum.Cedula
                    INNER JOIN semestre ON regcarnetalum.CodSemes = semestre.CodSemes
                    INNER JOIN carrera ON regcarnetalum.CodCarrera = carrera.CodCarrera
                    INNER JOIN turno ON regcarnetalum.CodTurno = turno.CodTurno
                    INNER JOIN estatus ON regcarnetalum.idEstatus = estatus.idEstatus 
                    where 
                    regcarnetalum.idEstatus = '$idEstatus' and  regcarnetalum.FechaSol BETWEEN '$fechaMin'  AND '$fechaMax'");
   }else if ($idEstatus == 2){

         $resultado = mysql_query("select alumcarnet.Cedula, alumcarnet.Nombres, alumcarnet.Apellidos, carrera.Carrera, semestre.Semes as Semestre, turno.Turno, regcarnetalum.NPago, regcarnetalum.FechaSol, regcarnetalum.FechaEntre, estatus.Estatus 
        from alumcarnet 
                    INNER JOIN regcarnetalum ON alumcarnet.Cedula = regcarnetalum.Cedula
                    INNER JOIN semestre ON regcarnetalum.CodSemes = semestre.CodSemes
                    INNER JOIN carrera ON regcarnetalum.CodCarrera = carrera.CodCarrera
                    INNER JOIN turno ON regcarnetalum.CodTurno = turno.CodTurno
                    INNER JOIN estatus ON regcarnetalum.idEstatus = estatus.idEstatus 
                    where 
                    regcarnetalum.idEstatus = '$idEstatus' and  regcarnetalum.FechaSol BETWEEN '$fechaMin'  AND '$fechaMax'");
   }
    
      

 class PDF extends FPDF{
// Cabecera de página
function Header(){
    // Logo
    $this->Image('css/images/Logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Planilla de Control Carnet IUTCM',1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


	//Instaciamos la clase para genrear el documento pdf
    $pdf=new FPDF('L','mm','Letter');
     
    //Agregamos la primera pagina al documento pdf
    $pdf->AddPage();

     
    //Seteamos el inicio del margen superior en 25 pixeles
     
    $y_axis_initial = 25;



    //Seteamos el tiupo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
    $pdf->SetFont('Arial','B',12);
     
    $pdf->Cell(40,6,'',0,0,'C');
    $pdf->Image('css/images/Logo.png',10,10,-300);
    $pdf->Ln(30);
    $pdf->Cell(250,6,'Planilla de Control Carnet IUTCM',0,0,'C');
     
    $pdf->Ln(10);
     
    //Creamos las celdas para los titulo de cada columna y le asignamos un fondo gris y el tipo de letra
    $pdf->SetFillColor(232,232,232);
     
    $pdf->SetFont('Arial','B',10);

    $pdf->Cell(25,6,'Cedula',1,0,'C',1);
    $pdf->Cell(52,6,'Nombres',1,0,'C',1);
    $pdf->Cell(52,6,'Apellidos',1,0,'C',1);
    $pdf->Cell(25,6,utf8_decode('N° Pago'),1,0,'C',1);
    $pdf->Cell(28,6,'Carrera',1,0,'C',1);
    $pdf->Cell(25,6,'Semestre',1,0,'C',1);
    $pdf->Cell(25,6,'Turno',1,0,'C',1);
    $pdf->Cell(30,6,'Fecha Solicitud',1,0,'C',1);
    $pdf->Ln();
     
    //Comienzo a crear las fiulas de productos según la consulta mysql
     
    while($fila = mysql_fetch_array($resultado))
    {
     

    $pdf->Cell(25,6,utf8_decode($fila['Cedula']),1,0,'C');
    $pdf->Cell(52,6,utf8_decode($fila['Nombres']),1,0,'C');
    $pdf->Cell(52,6,utf8_decode($fila['Apellidos']),1,0,'C');
    $pdf->Cell(25,6,utf8_decode($fila['NPago']),1,0,'C');
    $pdf->Cell(28,6,utf8_decode($fila['Carrera']),1,0,'C');
    $pdf->Cell(25,6,utf8_decode($fila['Semestre']),1,0,'C');
    $pdf->Cell(25,6,utf8_decode($fila['Turno']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($fila['FechaSol']),1,0,'C');
    $pdf->Ln();


     
    }
     
    mysql_close($enlace);
     
    //Mostramos el documento pdf
    $pdf->Output();
     
    ?>