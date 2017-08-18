<?php 
$id= $_GET['id'];
require_once("fpdf/fpdf.php");
 require_once('login/conexion.php');
$sqlingreso=$conexion->query("SELECT tb_egreso_escuela.*,tb_personas.nombre,tb_personas.apellido,tb_bancos.n_cuenta,tb_bancos.banco, tb_plan_cuentas.descripcion as des FROM `tb_egreso_escuela` inner join tb_personas on tb_egreso_escuela.id_persona=tb_personas.id_persona inner join tb_bancos on tb_egreso_escuela.id_banco=tb_bancos.id_banco inner join tb_plan_cuentas on tb_egreso_escuela.id_plan_cuentas=tb_plan_cuentas.id_plan_cuentas where tb_egreso_escuela.comprabante_n=".$id); 

 $pdf=new FPDF('P','mm','A4');
 $pdf->AddPage();
 $meses=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
while($consultasocio=mysqli_fetch_array($sqlingreso)){
  $pdf->setXY(175,15);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(20,5,$consultasocio['saldo'],0,1,'C');  
  $pdf->SetFont('Arial','',10);
  $pdf->setXY(160,23);
  $pdf->Cell(20,5,date('d',strtotime($consultasocio['fecha']))." de ".$meses[date('n',strtotime($consultasocio['fecha']))]." de ". date('Y',strtotime($consultasocio['fecha'])),0,1);
  // $pdf->setXY(40,30);
  $pdf->SetFont('Arial','',10);
  // $pdf->Cell(75,5,$consultasocio['nombre'].' '.$consultasocio['apellido'],0,1,'L'); 
  $pdf->setXY(30,45); 
  $pdf->MultiCell(150,5,$consultasocio['descripcion'],0,'L',0); 
  // $pdf->setXY(175,110); 
  // $pdf->Cell(25,5,$consultasocio['n_cuenta'],0,1,'L'); 

  $pdf->setXY(100,100); 
  $pdf->Cell(35,5,$consultasocio['banco'],0,1,'L');
  $pdf->setXY(125,115); 
  $pdf->Cell(35,5,'BANCO',0,1,'L');
  $pdf->setXY(175,115); 
  $pdf->Cell(15,5,$consultasocio['saldo'],0,1,'R');
    if($consultasocio['cheque']!=0){
  $pdf->setXY(45,100); 
  $pdf->Cell(35,5,$consultasocio['cheque'],0,1,'L'); 
  } 
  $pdf->setXY(20,115);   
  $pdf->Cell(35,5,$consultasocio['des'],0,1,'L');
  $consult=$conexion->query("select * from tb_sueldos where id_egreso_escuela=".$id);
  while($con=mysqli_fetch_array($consult)){
  $pdf->setXY(75,115);   
  $pdf->Cell(15,5,$con['sueldo'],0,1,'R'); 
  $pdf->setXY(20,120);   
  $pdf->Cell(35,5,'FONDO DE RESERVA',0,1,'L');
  $pdf->setXY(75,120);   
  $pdf->Cell(15,5,number_format(($con['sueldo']*($con['f_reserva']*0.01)),2),0,1,'R');  
  $pdf->setXY(20,125);   
  $pdf->Cell(35,5,'HORAS EXTRAS',0,1,'L');
  $pdf->setXY(75,125);   
  $pdf->Cell(15,5,$con['h_extras'],0,1,'R'); 
  $pdf->setXY(125,120); 
  $pdf->Cell(35,5,'IESS',0,1,'L');
  $pdf->setXY(175,120); 
  $pdf->Cell(15,5,number_format(($con['sueldo']*($con['iess']*0.01)),2),0,1,'R');

  }

}


 $pdf->Output();



 ?>