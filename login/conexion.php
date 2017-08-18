<?php
$conexion = new mysqli("localhost","root","1234567890","sindicato2"); 
       if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>