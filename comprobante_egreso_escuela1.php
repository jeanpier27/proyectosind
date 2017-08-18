<?php 
$id= $_GET['id'];
require_once("fpdf/fpdf.php");
 require_once('login/conexion.php');
$sqlingreso=$conexion->query("SELECT tb_egreso_escuela.*,tb_proveedores.nombres,tb_bancos.n_cuenta,tb_bancos.banco, tb_plan_cuentas.descripcion as des FROM `tb_egreso_escuela` inner join tb_proveedores on tb_egreso_escuela.id_proveedor=tb_proveedores.id_proveedores inner join tb_bancos on tb_egreso_escuela.id_banco=tb_bancos.id_banco inner join tb_plan_cuentas on tb_egreso_escuela.id_plan_cuentas=tb_plan_cuentas.id_plan_cuentas where tb_egreso_escuela.comprabante_n=".$id); 
require_once('prueba2.php');
 $pdf=new FPDF('P','mm','A4');
 $pdf->AddPage();
 $meses=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
while($consultasocio=mysqli_fetch_array($sqlingreso)){
  $pdf->setXY(175,30);
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(20,5,$consultasocio['saldo'],0,1,'C'); 
  $entero= explode('.',$consultasocio['saldo']);
  $con=conversion($entero[0]);  
   
  $pdf->SetFont('Arial','',10);
  $pdf->setXY(30,75);
  $pdf->Cell(20,5,$con.' CON '.$entero[1].'/100 DOLARES',0,1);
  $pdf->setXY(160,40);
  $pdf->Cell(20,5,date('d',strtotime($consultasocio['fecha']))." de ".$meses[date('n',strtotime($consultasocio['fecha']))]." de ". date('Y',strtotime($consultasocio['fecha'])),0,1);
  // $pdf->setXY(40,30);
  $pdf->SetFont('Arial','',10);
  // $pdf->Cell(75,5,$consultasocio['nombre'].' '.$consultasocio['apellido'],0,1,'L'); 
  $consult=$conexion->query("select tb_detalle_egreso_escuela.*,tb_facturasxcobrar.n_factura_ntv,tb_facturasxcobrar.total,tb_facturasxcobrar.subtotal,tb_facturasxcobrar.sobtotal_c,tb_facturasxcobrar.porc_renta,tb_facturasxcobrar.valor_renta,tb_facturasxcobrar.valor_iva,tb_facturasxcobrar.porc_iva FROM `tb_detalle_egreso_escuela` inner join tb_facturasxcobrar on tb_detalle_egreso_escuela.id_facturasxcobrar=tb_facturasxcobrar.id_facturasxcobrar where tb_detalle_egreso_escuela.comp_egreso_escuela=".$id);
  while($con=mysqli_fetch_array($consult)){
    $factur=$factur.' '.$con['n_factura_ntv'];
    $renta=number_format(($renta +$con['valor_renta']),2);
    $reteiva=number_format(($reteiva +$con['valor_iva']),2);
    $total=number_format(($total+$con['total']),2);
  }
  $pdf->setXY(30,55); 
  $pdf->MultiCell(150,5,utf8_decode($consultasocio['descripcion']).' '.$factur,0,'L',0); 
  // $pdf->setXY(175,110); 
  // $pdf->Cell(25,5,$consultasocio['n_cuenta'],0,1,'L'); 

  $pdf->setXY(100,85); 
  $pdf->Cell(35,5,$consultasocio['banco'],0,1,'L');
  $pdf->setXY(125,100); 
  $pdf->Cell(35,5,'BANCO',0,1,'L');
  $pdf->setXY(175,100); 
  $pdf->Cell(15,5,$consultasocio['saldo'],0,1,'R');
    if($consultasocio['cheque']!=0){
  $pdf->setXY(45,85); 
  $pdf->Cell(35,5,$consultasocio['cheque'],0,1,'L'); 
  } 
  $pdf->SetFont('Arial','',8);
  $pdf->setXY(20,100);   
  $pdf->Cell(35,5,$consultasocio['des'],0,1,'L');
   $pdf->SetFont('Arial','',10);
  $pdf->setXY(75,100);   
  $pdf->Cell(15,5,$total,0,1,'R'); 
  
  if($renta>0){
  $pdf->setXY(125,105); 
  $pdf->Cell(35,5,'RETENCION FUENTE IR',0,1,'L');
  $pdf->setXY(175,105); 
  $pdf->Cell(15,5,number_format($renta,2),0,1,'R');
}

if($reteiva>0){
  $pdf->setXY(125,110); 
  $pdf->Cell(35,5,'RETENCION FUENTE IVA',0,1,'L');
  $pdf->setXY(175,110); 
  $pdf->Cell(15,5,number_format($reteiva,2),0,1,'R');
}
  // $consult=$conexion->query("select * from tb_sueldos where id_egreso_escuela=".$id);
  // while($con=mysqli_fetch_array($consult)){
  // $pdf->setXY(75,115);   
  // $pdf->Cell(15,5,$con['sueldo'],0,1,'R'); 
  // $pdf->setXY(20,120);   
  // $pdf->Cell(35,5,'FONDO DE RESERVA',0,1,'L');
  // $pdf->setXY(75,120);   
  // $pdf->Cell(15,5,number_format(($con['sueldo']*($con['f_reserva']*0.01)),2),0,1,'R');  
  // $pdf->setXY(20,125);   
  // $pdf->Cell(35,5,'HORAS EXTRAS',0,1,'L');
  // $pdf->setXY(75,125);   
  // $pdf->Cell(15,5,$con['h_extras'],0,1,'R'); 
  
  // }

}


 $pdf->Output();



 ?>