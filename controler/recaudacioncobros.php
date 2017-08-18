<?php 
require_once("../login/conexion.php"); 
$id_persona=$_POST['id'];
$consultabeneficio=$conexion->query("SELECT fecha_ingreso FROM `tb_socio` WHERE id_persona=".$id_persona." ");
$socioinsc=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_persona." and id_pagos_socio=1");
$sociomen=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_persona." and id_pagos_socio=2 and verificacion=0");
$sociocesan=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_persona." and id_pagos_socio=4 and verificacion=0");
$sociocmultas=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_persona." and id_pagos_socio=3 and verificacion=0");

while($benefi=$consultabeneficio->fetch_array()){
 		$bene=$benefi['fecha_ingreso'];
 	}
 	$fecha = date('Y');
$nuevafecha = strtotime ( '-20 year' , strtotime ( $fecha ) ) ;
$nuevafecha =  date ( 'Y' , $nuevafecha );
$fecha_socio= date('Y',strtotime($bene));

 while ($ins=$socioinsc->fetch_array()){ 

 	$insc=$ins['abonos']+$insc;
 	$consulta1=$conexion->query("SELECT valor FROM `tb_pagos_socio` WHERE id_pagos_socio='".$ins['id_pagos_socio']."'");
 	while($consult=$consulta1->fetch_array()){
 		$val=$consult['valor'];
 	}
 	
 }



while($mens=$sociomen->fetch_array()){
$totalme=$mens['valor']+$totalme;
}

 if($fecha_socio<=$nuevafecha){
	$totalme=($totalme/2);
}

while($cesan=$sociocesan->fetch_array()){
$totalcesan=$cesan['valor']+$totalcesan;
}

while($mult=$sociocmultas->fetch_array()){
$totalmultas=$mult['valor']+$totalmultas;
}

 if($val!=$insc){?>


<input type="submit" class="btn btn-info" name="INSCRIPCION" value="INSCRIPCION $<?php echo ($val-$insc); ?>">

<?php $total=$total+($val-$insc); }  ?>

 <?php   if($totalme!=0){  ?>

<input type="submit" class="btn btn-info" name="MENSUALIDADES" value="MENSUALIDADES $<?php echo ($totalme); ?>" >

  <?php $total=$total+($totalme); }?>

   <?php   if($totalcesan!=0){  ?>

<input type="submit" class="btn btn-info" name="CESANTIA" value="FONDO DE CESANTIA $<?php echo ($totalcesan); ?>" >
  <?php $total=$total+($totalcesan);  }?>

   <?php   if($totalmultas!=0){  ?>

<input type="submit" class="btn btn-info" name="MULTA" value="MULTAS $<?php echo ($totalmultas); ?>" >
  <?php $total=$total+($totalmultas); }?>
<br><br><br>
  <a href="#" class="btn btn-success">Total a Pagar $<?php echo $total; ?></a>



