<?php 
require_once("../login/conexion.php"); 
error_reporting(0);
$fecha=$_POST['fecha'];
$sql=mysqli_query($conexion,"SELECT * FROM `tb_recaudaciones` WHERE id_pagos_socio=3 and fecha='".$fecha."' ");
$rowcount=mysqli_num_rows($sql);
if($rowcount>0){
		echo 'error';
}else{
	echo 'ok';
}
 ?>