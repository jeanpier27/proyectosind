<?php 
$id= $_GET['id'];
require_once("fpdf/fpdf.php");
 require_once('login/conexion.php');
$sqlingreso=$conexion->query("SELECT tb_facturasxcobrar.*,tb_proveedores.* from tb_facturasxcobrar inner join tb_proveedores on tb_facturasxcobrar.id_proveedores=tb_proveedores.id_proveedores where tb_facturasxcobrar.n_retenc=".$id); 

 $pdf=new FPDF('P','mm','A4');
 $pdf->AddPage();
  $meses=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
while($consultasocio=mysqli_fetch_array($sqlingreso)){
  $pdf->setXY(155,35);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(20,5,'Naranjal, '.date('d',strtotime($consultasocio['fecha_re']))." de ".$meses[date('n',strtotime($consultasocio['fecha_re']))]." de ". date('Y',strtotime($consultasocio['fecha_re'])),0,1);
  if($consultasocio['fac_ntv']=='f'){
  $pdf->setXY(155,40); 
  $pdf->Cell(75,5,'FACTURA',0,1,'L');
  }
  if($consultasocio['fac_ntv']=='n'){
  $pdf->setXY(155,40); 
  $pdf->Cell(75,5,'NOTA DE VENTA',0,1,'L');
  }
  if($consultasocio['fac_ntv']=='l'){

  $pdf->SetFont('Arial','',8);
  $pdf->setXY(155,40); 
  $pdf->Cell(75,5,'LIQ. PREST. DE SERVICIO O COMPRA',0,1,'L');
  }
  $pdf->SetFont('Arial','',10);

  $pdf->setXY(155,45); 
  $pdf->Cell(75,5,$consultasocio['n_factura_ntv'],0,1,'L');
  
  $pdf->setXY(30,35);
  $pdf->Cell(75,5,utf8_decode($consultasocio['nombres']),0,1,'L');

  $pdf->setXY(30,40); 
  $pdf->Cell(75,5,$consultasocio['ruc'],0,1,'L');

  $pdf->setXY(30,45); 
  $pdf->Cell(75,5,$consultasocio['direccion'],0,1,'L');

  $pdf->setXY(20,65); 
  $pdf->Cell(75,5,date('Y',strtotime($consultasocio['fecha_re'])),0,1,'L');

  $pdf->setXY(50,65); 
  $pdf->Cell(75,5,number_format(($consultasocio['subtotal']+$consultasocio['subtotal_c']),2),0,1,'L');

  $pdf->setXY(90,65); 
  $pdf->Cell(75,5,'RENTA',0,1,'L');

   $pdf->setXY(140,65); 
  $pdf->Cell(75,5,(number_format($consultasocio['porc_renta'])).'%',0,1,'L');

   $pdf->setXY(170,65); 
  $pdf->Cell(75,5,number_format((($consultasocio['subtotal']+$consultasocio['subtotal_c'])*(number_format($consultasocio['porc_renta']))*0.01),2),0,1,'L');
if($consultasocio['porc_iva']>0){
  $pdf->setXY(20,70); 
  $pdf->Cell(75,5,date('Y',strtotime($consultasocio['fecha_re'])),0,1,'L');

  $pdf->setXY(50,70); 
  $pdf->Cell(75,5,number_format((($consultasocio['subtotal']+$consultasocio['subtotal_c'])*($consultasocio['iva'])*0.01),2),0,1,'L');

  $pdf->setXY(90,70); 
  $pdf->Cell(75,5,'IVA',0,1,'L');

   $pdf->setXY(140,70); 
  $pdf->Cell(75,5,(number_format($consultasocio['porc_iva'])).'%',0,1,'L');

   $pdf->setXY(170,70); 
   $ivas=(($consultasocio['subtotal']+$consultasocio['subtotal_c'])*($consultasocio['iva'])*0.01);
  $pdf->Cell(75,5,number_format(($ivas*($consultasocio['porc_iva']*0.01)),2),0,1,'L');

}



}


 $pdf->Output();



 ?>