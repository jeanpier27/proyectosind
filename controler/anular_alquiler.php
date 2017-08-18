<?php 
require_once("../login/conexion.php"); 
error_reporting(0);
$Id_alquiler=$_POST['id_alquiler'];


$sql=mysqli_query($conexion,"select * FROM tb_alquiler where id_alquiler='".$Id_alquiler."' AND estado = 'PAGADO' ");
$rowcount=mysqli_num_rows($sql);
if($rowcount>0){
		echo 'pagado';
		exit;
}


$sql=mysqli_query($conexion,"update tb_alquiler  set estado = 'ANULADO' where id_alquiler=".$Id_alquiler);
$rowcount=mysqli_num_rows($sql);
if($rowcount>0){
		echo 'error';
}else{
	echo 'ok';
}
 ?>