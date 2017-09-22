<?php 
$id= $_GET['id'];
require_once("fpdf/fpdf.php");
 require_once('login/conexion.php');
$sqlingreso=$conexion->query("SELECT `tb_personas`.`id_persona`, `tb_personas`.`cedula_ruc`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_personas`.`telefono1`, `tb_personas`.`direccion`, `tb_factura`.*FROM `tb_personas` INNER JOIN `tb_factura` ON `tb_factura`.`id_persona` = `tb_personas`.`id_persona` where tb_factura.n_factura=".$id); 
require_once('prueba2.php');
 $pdf=new FPDF('P','mm','A4');
 $pdf->AddPage();
  $meses=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
while($consultasocio=mysqli_fetch_array($sqlingreso)){

  $subtot=$consultasocio['subtotal'];
  $subtotalcero=$consultasocio['subtotalcero'];
  $descuento=$consultasocio['descuento'];
  $iva=$consultasocio['iva'];
  $subt=$subtot-$descuento;
  if($subtot>0){
    $vistasubto=$subtot;
  }else{
  $vistasubto=$subtotalcero;
   }
  if($iva>0){
    if($subtotalcero>0){
      $total=number_format(($subt+(($iva*0.01)*$subt)+$subtotalcero),2);
    }else{
    $total=number_format($subt+(($iva*0.01)*$subt),2);
    }
  }else{
    $total=number_format($subt+$subtotalcero,2);
  }
  $entero= explode('.',$total);
  $con=conversion($entero[0]);   
  $pdf->SetFont('Arial','',10);
  $pdf->setXY(29,50);
  $pdf->Cell(75,5,$consultasocio['nombre'].' '.$consultasocio['apellido'],0,1,'L'); 
  $pdf->setXY(30,58); 
  $pdf->Cell(25,5,$consultasocio['direccion'],0,1,'L'); 
  $pdf->setXY(150,50); 
  $pdf->Cell(25,5,$consultasocio['cedula_ruc'],0,1,'L'); 
  $pdf->setXY(150,58); 
  $pdf->Cell(25,5,$consultasocio['telefono1'],0,1,'L'); 
  $pdf->setXY(30,66); 
  $pdf->Cell(25,5,date('Y-m-d',strtotime($consultasocio['fecha'])),0,1,'L');
  $pdf->setXY(30,80); 
  $pdf->MultiCell(90,5,$consultasocio['descripcion'],0,'L',0); 
  $pdf->setXY(150,80); 
  $pdf->Cell(25,5,$vistasubto,0,1,'L'); 
  $pdf->setXY(170,155); 
  $pdf->Cell(15,5,$subtot,0,1,'R'); 
  $pdf->setXY(170,160); 
  $pdf->Cell(15,5,$subtotalcero,0,1,'R'); 
  $pdf->setXY(170,165); 
  $pdf->Cell(15,5,$descuento,0,1,'R'); 
  $pdf->setXY(170,175); 
  $pdf->Cell(15,5,number_format((($iva*0.01)*$subt),2),0,1,'R'); 
  $pdf->setXY(170,180); 
  $pdf->Cell(15,5,$total,0,1,'R');
 
  
  $pdf->setXY(40,155);  
  $pdf->MultiCell(90,5,$con.' CON '.$entero[1].'/100 DOLARES',0,'L',0); 
}


 $pdf->Output();



 ?>