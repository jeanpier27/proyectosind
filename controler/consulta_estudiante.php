<?php   
require_once('../login/conexion.php');
            $id_emple = $_POST['promo'];

              $sqlestudiante=$conexion->query("SELECT tb_estudiantes.*,tb_personas.nombre, tb_personas.apellido FROM `tb_estudiantes` inner join tb_personas on tb_estudiantes.id_persona=tb_personas.id_persona where tb_estudiantes.estado='ACTIVO' and tb_estudiantes.id_promocion=".$id_emple." order by tb_personas.apellido"); 
                        
        while($consult=mysqli_fetch_array($sqlestudiante)){     
        echo ('<option value="'.$consult['id_estudiante'].'">'.$consult['apellido'].' '.$consult['nombre'].'</option>');   
    }
              
require_once('../login/cerrar_conexion.php');
            ?>