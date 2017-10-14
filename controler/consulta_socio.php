<?php   
require_once('../login/conexion.php');
            $id_emple = $_POST['socio'];

             $sql2=mysqli_query($conexion,"SELECT 1 FROM `tb_socio` WHERE id_persona=".$id_emple." and estado='ACTIVO'");
                        
        $consult=mysqli_fetch_array($sql2);  
        if($consult[0]==1){
        	echo 'ok';
        }else{
        	echo 'error';
        }
    
              
require_once('../login/cerrar_conexion.php');
            ?>
