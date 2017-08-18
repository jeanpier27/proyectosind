<?php 
require_once('../login/conexion.php');
error_reporting(0);
if(isset($_POST['fecha'])){
  $fecha=$_POST['fecha'];
  $descripcion=$_POST['descripcion'];
  $c=new datetime($fecha);
  $fechac=date_format($c,'Y-m-d');

  $fech="SELECT * FROM `tb_reunion` WHERE date(fecha)='".$fechac."'";
  $b=$conexion->query($fech); 

  $rowcount=mysqli_num_rows($b);

  if($rowcount<1){
  $query="insert into tb_reunion (fecha,descripcion,estado,observacion,verificado)values('".$fecha."','".$descripcion."','ACTIVO','','0')";
 // echo "<script type='text/javascript'> alert('si');</script>";
  // $codigo=htmlspecialchars($_POST['cedula'],ENT_QUOTES,'UTF-8');
  // $nombres=htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8');
 $a=$conexion->query($query); 
 if($a){
  // echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success", showCancelButton: true,  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="reuniones.php";});</script>';
  // echo '<script type="text/javascript"> location.href="reuniones.php?msj=success";</script>';
  echo "ok";
 }else{
  // echo '<script type="text/javascript">swal({title: "Error", text: "Ah ocurrido un error al guardar...!", type: "error", showCancelButton: true,  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="reuniones.php?msj=error";});</script>';
   // echo '<script type="text/javascript"> location.href="reuniones.php?msj=error";</script>';
  echo "error";
 }
 

}else{
	echo 'registrado';
}
}
 ?>