  <?php 
session_start();
if(!isset($_SESSION['usuario'])){
require_once('../login/cerrar_sesion.php'); 
}
require_once("../login/conexion.php"); 
   ?>
   <form  action="" method="post">
 <div class="container-flat-form">
     <div class="title-flat-form title-flat-blue">Registro de Recaudaciones Mensuales</div>
      

                        <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            $sql=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT tb_socio.*,CONCAT_WS(' ', tb_personas.apellido,tb_personas.nombre)as nombre  FROM `tb_socio`inner join tb_personas on tb_socio.id_persona=tb_personas.id_persona");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                                <span>Seleccione codigo del Socio </span> 
                                <input type="text" name="nombres" id=nombres placeholder="Introduce el nombre" class="form-control" list="listado">
                            <datalist id="listado">
                              <?php  
                             while($row=$sqlsocio->fetch_array()){ ?>

                              <option value="<?php echo $row['id_socio']; ?>"><?php echo $row['nombre']; ?></option>

                              <?php  
                            }
                            ?>
                          </datalist>


                            </div>


                            <div class="group-material">
                                <span>Seleccione el Tipo de Recaudacion a realizar </span> 
                                <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige el tipo de Recaudación"  required name="recaudacion" id="recaudacion">
                                    <option value="" disabled="" selected="">Selecciona</option>
                                        <?php
                                          while($f = $sql->fetch_array()){ 
                                            echo '<option value="'.$f['id_pagos_socio'].'">'.$f['descripcion'].'</option>';
                                            } 
                                        ?> 
                                </select>
                            </div>    

                           

                          <div id="contenedor_recaudaciones"></div>
                         
                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button>
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;  
                            </p>
                       </div>
                   </div>
                </div>
            </form>

<script language="javascript">
  $(document).ready(function(){
    $('#recaudacion').change(function(){
      // alert('hola');
      var id;
      id=$(this).val();
      console.log(id);
        $.post("vistas/tipo_recaudaciones.php",{recaudacion:id},function(data,status){
          $("#contenedor_recaudaciones").html(data);
              console.log(data);
              console.log(status);
        });
        
    });
  });
</script>