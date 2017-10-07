<?php 
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
 ?>


<?php 
$id= $_GET['id'];
require_once("fpdf/fpdf.php");
 require_once('login/conexion.php');

$sqlingreso=$conexion->query("SELECT fecha,tipo_reunion from tb_reunion where id_reunion=".$id); 

class PDF extends FPDF
{
	
	function Header()
	{
     

		$this->Image('assets/img/logo.png',10,10,-900);
		$this->Image('assets/img/logo.png',175,10,-900);
    $this->SetFont('Arial','',14);
    $this->setX(45);
    $this->MultiCell(120,7,utf8_decode('SINDICATO DE CHOEFERES PROFESIONALES DEL CANTÓN NARANJAL'),0,'C',0);
   
    $this->ln(20);
	}

	function Footer()
	{
    
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print centered page number
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	}
}





 $pdf=new PDF('P','mm','A4');
 $pdf->AliasNbPages();
 $pdf->AddPage();
 $meses=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
  $dias=array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
 while($consultasocio=mysqli_fetch_array($sqlingreso)){
  $pdf->setXY(45,30);
  $pdf->MultiCell(120,7,'ASISTENCIA '.$consultasocio['tipo_reunion'],0,'C',0);  
  $pdf->setX(45);
  $pdf->MultiCell(120,7,utf8_decode('Día ').utf8_decode($dias[date('w',strtotime($consultasocio['fecha']))]).' '.date('d',strtotime($consultasocio['fecha']))." de ".$meses[date('n',strtotime($consultasocio['fecha']))]." de ". date('Y',strtotime($consultasocio['fecha'])),0,'C',0);

}

$querysocio=$conexion->query("SELECT `tb_socio`.`id_socio`, `tb_personas`.`cedula_ruc`, `tb_personas`.`nombre`, `tb_personas`.`apellido`
FROM `tb_personas`  INNER JOIN `tb_socio` ON `tb_socio`.`id_persona` = `tb_personas`.`id_persona` WHERE `tb_socio`.`estado`='ACTIVO' ORDER BY tb_personas.apellido");
$pdf->Cell(10,6,'N.-',1,0,'C');
$pdf->Cell(30,6,'Cedula',1,0,'C');
$pdf->Cell(80,6,'Nombres',1,0,'C');
$pdf->Cell(65,6,'Firma',1,1,'C');
$pdf->SetFont('Arial','',10);
$i=1;
while($resp=mysqli_fetch_array($querysocio)){
$pdf->Cell(10,10,$i++,1,0,'C');
$pdf->Cell(30,10,$resp['cedula_ruc'],1,0,'C');
$pdf->Cell(80,10,utf8_decode($resp['apellido'].' '.$resp['nombre']),1,0,'L');
$pdf->Cell(65,10,'',1,1,'C');

}


 $pdf->Output();





?>
 <head>
   <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/sindi.ico" />
 </head>