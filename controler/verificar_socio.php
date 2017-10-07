<?php 
require_once("../login/conexion.php"); 
error_reporting(0);
$cedula=$_POST['cedula'];
$sql=mysqli_query($conexion,"SELECT fecha_n FROM tb_personas where id_persona='".$cedula."' ");
	$row=mysqli_fetch_array($sql);
	if(is_null($row[0])){
		echo 'no';
	}else{
		echo $row[0];
	}

		

 ?>