<?php   
require_once('../login/conexion.php');
            $cedulasocio = $_POST['cedula'];
            $nombressocio = $_POST['nombressocio'];
            $apellidossocio = $_POST['apellidossocio'];
            $telefonousocio= $_POST['telefono1socio'];
            $telefonodsocio= $_POST['telefono2socio'];
            $telefonotsocio= $_POST['telefono3socio'];
            $direccionsocio = $_POST['direccionsocio']; 
            $correo = $_POST['correo']; 
            $estado_civil = $_POST['estado_civil']; 
    $tipo_licenciansocio = $_POST['tipo_licenciansocio'];
    $fecha_naci = $_POST['fecha_nacimiento'];    
                $fecha_ingreso = $_POST['fecha_ingreso'];
                $valor = $_POST['inscripcion'];

           
        $query="call insertar_socio('$cedulasocio','$nombressocio','$apellidossocio','$telefonousocio','$telefonodsocio','$telefonotsocio', '$direccionsocio','$correo','$estado_civil','$tipo_licenciansocio','$fecha_naci','$fecha_ingreso',$valor)";
        $a=$conexion->query($query);     
        if($a){
        echo 'ok';    
    }else{
        echo 'error';    
    }
              
require_once('../login/cerrar_conexion.php');
            ?>
