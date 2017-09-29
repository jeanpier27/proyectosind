<?php
session_start();
$usuario=$_POST['usuario'];
$clave=$_POST['password'];
	require_once("conexion.php"); 

	$sql=mysqli_query($conexion,"SELECT tb_usuarios.*,tb_personas.cedula_ruc,tb_personas.nombre, tb_personas.apellido,tb_tipo_usuario.tipo_usuario FROM `tb_usuarios` inner JOIN tb_personas on tb_usuarios.id_persona=tb_personas.id_persona inner join tb_tipo_usuario on tb_tipo_usuario.id_tipo_usuario=tb_usuarios.id_tipo_usuario where tb_personas.cedula_ruc like '%".$usuario."%' and tb_usuarios.estado='ACTIVO'");
	 $rowcount=mysqli_num_rows($sql);
	 if($rowcount==1){
	 	while($consulta=mysqli_fetch_array($sql)){
	 		if($clave==$consulta['contraseña']){
	 			session_start();
	 			$_SESSION['tipo_usuario'] = $consulta['tipo_usuario'];
	 			$_SESSION['acceso'] = $consulta['acceso'];
	 			$_SESSION['usuario']=$usuario;
	 			$_SESSION['nombres']=$consulta['nombre'].' '.$consulta['apellido'];
	 			$_SESSION['id_usuario']=$consulta['id_usuarios'];
	 			echo 'ok';
	 		}else{
	 			echo 'error';	
	 		}
	 	}
	 }else{
	 	echo 'error';
	 }


require_once('cerrar_conexion.php');
	

?>
