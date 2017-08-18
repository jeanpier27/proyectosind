<?php 
$id= $_GET['id'];
require_once("fpdf/fpdf.php");
 require_once('login/conexion.php');
$sqlingreso=$conexion->query("SELECT tb_ingreso_sindicato.*,tb_personas.nombre,tb_personas.apellido,tb_bancos.n_cuenta,tb_bancos.banco FROM `tb_ingreso_sindicato` inner join tb_personas on tb_ingreso_sindicato.id_persona=tb_personas.id_persona inner join tb_bancos on tb_ingreso_sindicato.id_banco=tb_bancos.id_banco where tb_ingreso_sindicato.comprabante_n=".$id); 
require_once('prueba2.php');
 $pdf=new FPDF('P','mm','A4');
 $pdf->AddPage();
  $meses=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
while($consultasocio=mysqli_fetch_array($sqlingreso)){
  $pdf->setXY(175,30);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(20,5,$consultasocio['saldo'],0,1,'C'); 
  $entero= explode('.',$consultasocio['saldo']);
  $con=conversion($entero[0]);
  $pdf->SetFont('Arial','',10);
  $pdf->setXY(40,50);  
  $pdf->Cell(75,5,$con.' CON '.$entero[1].'/100 DOLARES',0,1,'L'); 
  $pdf->setXY(40,40);  
  $pdf->Cell(75,5,$consultasocio['nombre'].' '.$consultasocio['apellido'],0,1,'L'); 
  $pdf->setXY(30,70); 
  $pdf->MultiCell(150,5,$consultasocio['descripcion'],0,'L',0); 
  $pdf->setXY(175,115); 
  $pdf->Cell(25,5,$consultasocio['n_cuenta'],0,1,'L'); 
  $pdf->setXY(100,115); 
  $pdf->Cell(35,5,$consultasocio['banco'],0,1,'L'); 
  $pdf->setXY(35,115); 
  $pdf->Cell(35,5,$consultasocio['comprabante_banco'],0,1,'L'); 
  $pdf->setXY(35,130); 
  $pdf->Cell(20,5,' '.date('d',strtotime($consultasocio['fecha']))." de ".$meses[date('n',strtotime($consultasocio['fecha']))]." de ". date('Y',strtotime($consultasocio['fecha'])),0,1);
}


 $pdf->Output();



 ?>