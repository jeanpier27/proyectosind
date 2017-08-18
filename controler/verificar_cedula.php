<?php 
require_once("../login/conexion.php"); 
error_reporting(0);
$cedula=$_POST['cedula'];
$sql=mysqli_query($conexion,"SELECT * FROM tb_personas where cedula_ruc like'%".$cedula."%'");
$rowcount=mysqli_num_rows($sql);
if($rowcount>0){
		while($resul=mysqli_fetch_assoc($sql)){
			$data["datos"][]=$resul;
		}
		echo json_encode($data);
}else{
	echo 'ok';
}
 ?>