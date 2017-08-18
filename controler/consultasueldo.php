<?php   
require_once('../login/conexion.php');
            $id_emple = $_POST['empleado'];

             $sql2=mysqli_query($conexion,"SELECT sueldo FROM `tb_empleado` WHERE id_persona=".$id_emple);
                        
        while($consult=mysqli_fetch_array($sql2)){     
        echo ($consult['sueldo']);   
    }
              
require_once('../login/cerrar_conexion.php');
            ?>
