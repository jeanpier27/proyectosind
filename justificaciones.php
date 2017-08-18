<!DOCTYPE html>
<html>
<head>
    <title>SOCIOS</title>
    <?php 
    session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
        require_once('meta.php');
        require_once('login/conexion.php');
     ?>
</head>
<body>
<script type="text/javascript">
    $(document).ready(function(){
            $('#contsocio').attr("style","display:block;");
            $('#socio').attr("style","background-color:#E75A5A;");
              
            });
</script>
<div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                SINDICATO
            </div>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="assets/img/logo.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
                </figure>
                <p class="text-center" style="padding-top: 15px;">Bienvenido/a <?php   echo$_SESSION['tipo_usuario'];?></p>
            </div>
   <?php require_once('menu.php'); ?>
    </div>
    </div>




     <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="assets/img/logo.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles"> <?php echo $_SESSION['nombres']; ?> </span>
                </li>
                <li  class="tooltips-general exit-system-button" data-href="login/cerrar_sesion.php" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li> <i class="zmdi zmdi-search"></i>
                
                <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
        </nav>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Justicaciones</small></h1>
            </div>
            <section class="full-reset text-center" style="padding: 40px 0;">
            <?php 
            if(isset($_POST['registra'])){
                $id_reunion=$_POST['id_re'];
                $id_socio=$_POST['nombres'];
                $descripcion=$_POST['descripcion'];
                // echo $id_reunion.' '.$id_socio.' '. $descripcion;
               
                 $queryinsert="insert into tb_justificacion (id_reunion,id_persona,descripcion,estado,observacion,id_usuarios)values('". $id_reunion."','".$id_socio."','".$descripcion."','ACTIVO','','".$_SESSION['id_usuario']."')";
             $resultinsert = mysqli_query($conexion, $queryinsert); 

                                 if($resultinsert)
                                 {
                                       echo '<script>jQuery(function(){swal({title:"Ok",text:"Registro exitoso",type:"success",confirmButtonText:"Aceptar"},function(){location.href="Justificaciones.php";});});</script>';
                                   } else 
                                        {
                                       echo '<script>jQuery(function(){sweetAlert("Error...", "No se pudo guardar los registros!", "error");});</script>'; 
                                     
            }
        }
         ?>
            <form autocomplete="" action="" method="post" id="formreg" name="formreg"> 
                
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Justificaciones</div>
                    
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");
                              $sqlreunion=$conexion->query("SELECT * FROM `tb_reunion` WHERE verificado='0'"); 
                           
                            $sqlsocio=$conexion->query("SELECT tb_socio.id_persona, tb_personas.nombre, tb_personas.apellido FROM `tb_socio` inner join tb_personas on tb_socio.id_persona=tb_personas.id_persona WHERE tb_socio.estado='ACTIVO' order by tb_personas.apellido");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  

                       <div class="group-material">
                          <span>Seleccione al fecha de Asamblea a Justificar </span> 
                          <br>
                           <select class="selectpicker" name="id_re" class="material-control" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>

                                <?php  

                             while($rows=$sqlreunion->fetch_array()){ ?>

                              <option value="<?php echo $rows['id_reunion']; ?>"><?php echo ($rows['fecha']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div> 

                            <div class="group-material">

                             <span>Seleccione al Socio </span> 
                               <br>
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sqlsocio->fetch_array()){ ?>

                              <option value="<?php echo $row['id_persona']; ?>"><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>
                           

                            <div class="group-material">
                                <span>Descripcion</span>
                                <br>
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" id="descripcion" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <!-- <label>Descripcion</label> -->

                            </div> 


                           
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                
            </form> 
            <?php 
            $just=$conexion->query("SELECT tb_justificacion.*, tb_reunion.fecha,tb_personas.nombre,tb_personas.apellido  FROM  tb_justificacion inner join tb_reunion on tb_justificacion.id_reunion=tb_reunion.id_reunion inner join tb_personas on tb_justificacion.id_persona=tb_personas.id_persona order by tb_reunion.fecha"); 
             ?>
            <div class="table-responsive col-md-10 col-md-offset-1">

              <table class="table table-hover table-striped table-border display nowrap" id="tablaempleado">
                <thead>
                    <tr  class="info">
                      <th>Codigo</th>
                      <th>Fecha Asamblea</th>
                      <th>Socio</th>
                      <th>Descripcion</th>
                      

                  </tr>
              </thead>

              <tbody>

                <?php  

                while($rowss=$just->fetch_array()){ 
                    $id=$rowss['id_justificacion'];

                    ?>
                    <tr>
                      <!-- dia -->
                      <td>
                        <?php
                        echo($id);
                        ?>

                    </td>
                    <!-- fecha -->
                    <td>
                        <?php 
                        echo $rowss['fecha']; 
                        ?>

                    </td>
                    <td>
                        <?php 
                        echo $rowss['nombre'].' '.$rowss['apellido']; 
                        ?>

                    </td>
                    <td>
                        <?php 
                        echo $rowss['descripcion']; 
                        ?>
                    </td>
            

                  <?php  
              }

              ?>

          </tr>
      </tbody>

  </table>

<br><br><br>
</div>

</section>
</div>


</body>
</html>

<script type="text/javascript">
    $('#tablaempleado').DataTable( {
           "language": { 
            "sProcessing":     "Procesando...", 
            "sLengthMenu":     "Mostrar _MENU_ registros", 
            "sZeroRecords":    "No se encontraron resultados", 
            "sEmptyTable":     "Ningún dato disponible en esta tabla", 
            "sInfo":           "Mostrando registros del  _START_  al _END_ de un total de _TOTAL_ registros", 
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", 
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", 
            "sInfoPostFix":    "", 
            "sSearch":         "Buscar:", 

            "sUrl":            "", 
            "sInfoThousands":  ",", 
            "sLoadingRecords": "Cargando...", 
            "oPaginate": {

                "sFirst":    "Primero", 
                "sLast":     "Último",
                "sNext":     "Siguiente", 
                "sPrevious": "Anterior"

            },

            "oAria": { 
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente", 
                "sSortDescending": ": Activar para ordenar la columna de manera descendente" 
            } 
        },
    } );
        
</script>