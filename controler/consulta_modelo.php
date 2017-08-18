<?php 
require_once("../login/conexion.php"); 
error_reporting(0);
$cedula=$_POST['cedula'];
$sql=mysqli_query($conexion,"SELECT * FROM tb_modelo where id_marca = '".$cedula."'");
while($resp=mysqli_fetch_array($sql)){
echo "<option value=".$resp['id_modelo'].">".$resp['descripcion']."</option>";
}
 ?>
 