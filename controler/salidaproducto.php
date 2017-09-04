<?php 
require_once("../login/conexion.php");
$cantidad=$_POST['cant'];
$id=$_POST['id'];
$id_persona=$_POST['id_persona'];
$descripcion=$_POST['descripcion'];
$comprobante_n=$_POST['comprobante_n'];
$deposito=$_POST['deposito'];
$id_banco=$_POST['id_banco'];
$totalapagar=$_POST['totalapagar'];
$fecha=$_POST['fecharegistro'];
$count=0;
$sqlcompro=$conexion->query("select 1 from tb_ingreso_sindicato where comprabante_n=".$ingreso_n);
                $respcom=mysqli_fetch_array($sqlcompro);
                if($respcom[0]!=1){
$consuln=$conexion->query("select nombre,apellido from tb_personas where id_persona=".$id_persona); 
	while($consultasocio=mysqli_fetch_array($consuln)){
		$nombres_comp=$consultasocio['nombre'].' '.$consultasocio['apellido'];
	}
foreach ($id as $ids) {
	if($cantidad[$count]!=0){
	$cant=$cantidad[$count];
	$query="call salida_inventario('$ids','$cant','$nombres_comp')";
        $a=$conexion->query($query);     
        if($a){
          $resul= 'ok';  
    }else{
        $resul='error';    
    }
	
}

$count=$count+1;
}
if($resul=='ok'){

$insert="insert into tb_ingreso_sindicato(id_persona,id_banco,fecha,descripcion,comprabante_n,comprabante_banco,saldo,observacion,estado)values('".$id_persona."','".$id_banco."','".$fecha."','".$descripcion."','".$comprobante_n."','".$deposito."','".$totalapagar."','','ACTIVO')";
$b=$conexion->query($insert); 
if($b){
          echo 'ok';  
    }else{
        echo 'error';    
    }
    }
}else{
                echo 'errorrep'; 
            }

 ?>