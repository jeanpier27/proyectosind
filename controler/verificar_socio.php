<?php 
require_once("../login/conexion.php"); 
error_reporting(0);
$cedula=$_POST['cedula'];
$sql=mysqli_query($conexion,"SELECT * FROM tb_socio where id_persona='".$cedula."' ");
$rowcount=mysqli_num_rows($sql);
if($rowcount>0){
		echo 'error';
}else{
	echo 'ok';
}
 ?>