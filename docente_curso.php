<?php 
ob_start();
date_default_timezone_set('America/Bogota');
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
// echo $cedula;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>DOCENTES</title>
   <?php 
        require_once('meta.php');
        require_once('login/conexion.php');
     ?>
 </head>
 <body>

 <?php   
 if(isset($_POST['registra'])){
                $Id_docente = $_POST['docente_seleccionado'];
                $Id_materia = $_POST["materia_seleccionada"];
                

                    $add_table_asignatura_docente = "insert into tb_asignatura_docente (id_docente, id_asignatura) values (".$Id_docente.", ".$Id_materia.")";    
                    $ingreso_table_asignatura_docente = mysqli_query($conexion,$add_table_asignatura_docente);


                    if (!$ingreso_table_asignatura_docente) {                     
                       header('location: docente_materia.php?msg=error'); 
                   } else {
                      header('location: docente_materia.php?msg=ss');
                  } 
              }

            ?>

 

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
        <section>
          <form autocomplete="" action="" method="post" id="formreg" name="formreg"> 
                
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Docentes Cursos</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT `tb_personas`.`id_persona` as cod, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_estudiantes`.`id_persona` FROM `tb_personas` LEFT JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona`");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">

                            <div class="group-material">
                                <span>Seleccione Docente</span> 
                               
                          <select class="selectpicker" name="docente_seleccionado" id="docent" data-live-search="true" onchange="carga_bienes()" required="">
                          <option value="0">Seleccione Docente</option>
                           <?php
                           $Doce = isset($_REQUEST["doce"]) ? $_REQUEST["doce"]: 0;
                           $sqldocente=$conexion->query("SELECT `tb_docente`.`id_docente`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_docente`.`estado`, `tb_usuarios`.`contraseña` FROM `tb_personas` INNER JOIN `tb_usuarios` ON `tb_usuarios`.`id_persona` = `tb_personas`.`id_persona` INNER JOIN `tb_docente` ON `tb_docente`.`id_usuarios` = `tb_usuarios`.`id_usuarios` ORDER BY `tb_personas`.`apellido` ASC");

                            while($row=$sqldocente->fetch_array()){ 
                              $id_docente1 = $row['id_docente'];
                              $nombre1 = $row['nombre'];
                              $apellido1 = $row['apellido'];

                                ?>

                              <option value="<?php echo $id_docente1; ?>"  <?php if($id_docente1 == $Doce){echo "selected='selected'";}?>   ><?php echo $apellido1.' '.$nombre1; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>


                            <div class="group-material">
                                <span>Seleccione tipo curso</span> 
                                <select class="tooltips-general material-control" data-toggle="tooltip" onchange="carga_bienes()" data-placement="top" title="Elige el tipo del usuario correspondiente"  required id="tipo_curso">
                                    <option value="0">Selecciona tipo de inscripcion</option>
                                        <?php
                                         $Tipo_inscripcion = $_REQUEST["pl"];
                                         $sqlb=$conexion->query("select `tb_pago_licencia`.`id_tipo_licencia`, `tb_pago_licencia`.`tipo_licencia`, `tb_pago_licencia`.`valor`, `tb_pago_licencia`.`fecha`, `tb_pago_licencia`.`estado` FROM `tb_pago_licencia` order by tipo_licencia ");
                                          while($f = $sqlb->fetch_array()){
                                          $pi = $f['id_tipo_licencia']; 
                                          $pp = $f['tipo_licencia'];
                                          $pg = $f['valor'];
                                          ?>  
                                            <option value="<?php echo $pi;?>"    <?php if($pi == $Tipo_inscripcion){echo "selected='selected'";}?>    >  <?php echo $pp; ?></option>
                                          <?php  
                                            } 
                                        ?> 
                                </select>
                            </div>

                            <div class="group-material">
                                <span>Seleccione Materia</span> 
                               
                          <select class="tooltips-general material-control" data-toggle="tooltip" name="materia_seleccionada" id="materi" onchange="carga_bienes()" required="">
                          <option value="0">Seleccione Materia</option>
                           <?php
                           $Pl = isset($_REQUEST["pl"]) ? $_REQUEST["pl"]: 0;
                           $Mater = isset($_REQUEST["mate"]) ? $_REQUEST["mate"]: 0;

                           $sqlmate=$conexion->query("SELECT `tb_asignaturas`.`id_asignatura`, `tb_asignaturas`.`asignatura`, `tb_asignaturas`.`estado`, `tb_asignaturas`.`descripcion` FROM `tb_asignaturas` WHERE `tb_asignaturas`.`id_tipo_licencia` = ".$Pl." ORDER BY `tb_asignaturas`.`asignatura` ASC");

                            while($row=$sqlmate->fetch_array()){ 
                              $id_asignatura2 = $row['id_asignatura'];
                              $asignatura2 = $row['asignatura'];
                              
                                ?>

                              <option value="<?php echo $id_asignatura2; ?>"  <?php if($id_asignatura2 == $Mater){echo "selected='selected'";}?>   ><?php echo $asignatura2; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>                            

                            
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>






                <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">

                       <center><th><p><h1>Cursos Asignados al Docente</h1></p></th></center>

                        <form autocomplete="" action="" method="post" id="" name="">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos2">
                                <thead>
                                    <tr  class="info">

                                      <th>Id</th>
                                      <th>Docente</th>
                                      <th>Materias</th>                                                                                                                                      
                                      <th>Actualizar</th>
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              $i = 0;

                              $Id_docen = $_REQUEST["doce"];
                              if ($Id_docen == '') {
                                 $Id_docen = 0;
                               }                           

                                                          

                              $sqldocente_materia=$conexion->query("SELECT `tb_asignatura_docente`.`id_asignatura_docente`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_asignaturas`.`asignatura`, `tb_docente`.`estado`, `tb_usuarios`.`estado` FROM `tb_personas` INNER JOIN `tb_usuarios` ON `tb_usuarios`.`id_persona` = `tb_personas`.`id_persona`
    INNER JOIN `tb_docente` ON `tb_docente`.`id_usuarios` = `tb_usuarios`.`id_usuarios` INNER JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_docente` = `tb_docente`.`id_docente` INNER JOIN `tb_asignaturas` ON `tb_asignatura_docente`.`id_asignatura` = `tb_asignaturas`.`id_asignatura` WHERE `tb_docente`.`id_docente`=".$Id_docen);

                              $numero_asignaciones = mysqli_num_rows($sqldocente_materia);


                               while($consultadocente_materia=mysqli_fetch_array($sqldocente_materia)){                                
                                // tabla estudiante
                                $Id = $consultadocente_materia['id_asignatura_docente'];
                                $Nombre = $consultadocente_materia['nombre'];
                                $Apellido = $consultadocente_materia['apellido'];
                                $Asignatura = $consultadocente_materia['asignatura'];
   
                               ?>

                                <tr>
<td><input name="id_asignatura_docente<?php echo $i;?>" readonly value="<?php echo $Id; ?>" style="width:80px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><p style="width:200px;"><?php echo $Apellido.' '.$Nombre; ?></p></td>                               
<td>
<select name="asignatura<?php echo $i;?>" style="width:300px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<?php 
$sqlmateria=$conexion->query("SELECT * from tb_asignaturas");

                               while($consulta_materia=mysqli_fetch_array($sqlmateria)){                        
                                $Id_asig = $consulta_materia['id_asignatura'];
                                $Asigna = $consulta_materia['asignatura'];
                                
 ?>
<option value="<?php echo $Id_asig; ?>" <?php if ($Asigna == $Asignatura) { ?> selected <?php } ?> > <?php echo $Asigna; ?> </option>
<?php } ?>
</select>
</td>
<td>
<button  name="registro<?php echo $i;?>" id="registro" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></button>
<?php 

                              if (isset($_POST['registro'.$i.''])){
                               
                               $Id_asignatura_docente1 = $_POST['id_asignatura_docente'.$i.''];                                
                               $Asignatura1 = $_POST['asignatura'.$i.''];
                               $Docente = isset($_REQUEST["doce"]) ? $_REQUEST["doce"]: "";                               

                               $update_table_asignatura_docente = "update tb_asignatura_docente set id_docente='".$Docente."', id_asignatura='".$Asignatura1."' where id_asignatura_docente =".$Id_asignatura_docente1;    
                               $actualizacion_asignatura_docente = mysqli_query($conexion,$update_table_asignatura_docente);

                               if ($actualizacion_asignatura_docente) {
                                 header('location: docente_materia.php?msg=yes&doce='.$Docente); 
                               } else {
                                 header('location: docente_materia.php?msg=no&doce='.$Docente);
                               }
                     }  
 ?>
</td>


                               <?php 
                               $i++;
                               } ?>
                               </tr>

                              </tbody>
                              </table>
                              </div>                    

                              <center><button  name="registro_actualizar" id="" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i>      Actualizar Todo</button></center>
                              <?php 

                              if (isset($_POST['registro_actualizar'])){
                              
                                for ($i=0; $i < $numero_asignaciones; $i++) { 
                               $Id_asignatura_docente2 = $_POST['id_asignatura_docente'.$i.''];                                
                               $Asignatura2 = $_POST['asignatura'.$i.''];
                               $Docente2 = isset($_REQUEST["doce"]) ? $_REQUEST["doce"]: ""; 

                               // echo '<script language="javascript">alert("'.$Id_asignatura_docente2.'");</script>';
                             

                               $update_table_asignatura_docente2 = "update tb_asignatura_docente set id_docente='".$Docente2."', id_asignatura='".$Asignatura2."' where id_asignatura_docente =".$Id_asignatura_docente2;    
                               $actualizacion_asignatura_docente2 = mysqli_query($conexion,$update_table_asignatura_docente2);                               
                                }

                                if ($actualizacion_asignatura_docente2) {
                                 header('location: docente_materia.php?msg=yes&doce='.$Docente2); 
                               } else {
                                 header('location: docente_materia.php?msg=no&doce='.$Docente2);
                               }
                          
                             }  
                             ?>
                        </form>

                       </div>











            </form> 
        </section>
 </body>
 </html>

<?php require_once('login/cerrar_conexion.php'); ?>
            <script type="text/javascript">
                $(document).ready(function(){
                   
                    $('input[name=fecha_nacimiento]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        locale: {
                          cancelLabel: 'Clear',
                          format: 'YYYY-MM-DD',
                          "separator": " - ",
                          "applyLabel": "Aceptar",
                          "cancelLabel": "Cancelar",
                          "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                          "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo",
                          "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre",
                          "Diciembre"]
                      }
                  });

                    $('input[name=fecha_ingreso]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        locale: {
                          cancelLabel: 'Clear',
                          format: 'YYYY-MM-DD',
                          "separator": " - ",
                          "applyLabel": "Aceptar",
                          "cancelLabel": "Cancelar",
                          "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                           "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo",
                          "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre",
                          "Diciembre"]
                      }
                  });


                $('select[name=nombres]').change(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('select[name=nombres]').val();
                        
                            // $.post("controler/verificar_socio.php",{cedula:id_persona},function(data,status){
                            //     if(data=='ok'){
                            //         console.log(data);
                            //         console.log(status);
                            //     }else{
                            //         console.log(data);
                            //         console.log(status);
                            //         swal({
                            //             title: "Advertencia?",
                            //           text: "Ya se encuentra registrado!",
                            //           type: "warning",
                            //           confirmButtonColor: "#DD6B55",
                            //           confirmButtonText: "Aceptar!"
                            //       },
                            //       function(){
                            //             location.href="addsocio.php";
                                      
                            //       });
                            //     }
                               
                            // });
                       
                    
                });

                $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
                });

                $(".letras").keypress(function (key) {
                    window.console.log(key.charCode)
            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 32) //espacio
                 // && (key.charCode != 225) //á
                 // && (key.charCode != 233) //é
                 // && (key.charCode != 237) //í
                 // && (key.charCode != 243) //ó
                 // && (key.charCode != 250) //Ú   0928493659
                 // && (key.charCode != 193) //Á
                 // && (key.charCode != 201) //É
                 // && (key.charCode != 205) //Í
                 // && (key.charCode != 211) //Ó
                 // && (key.charCode != 218) //Ú

                 )
                return false;
        });

       var comprob = '<?php echo $Comprob = isset($_REQUEST["ingreso"]) ? $_REQUEST["ingreso"]: "nada"; ?>';
        if (comprob != "nada") {
            VentanaCentrada('comprobante_ingreso_sind.php?id='+comprob,'Recaudaciones','','1000','500','true');
        }


            function VentanaCentrada(theURL,winName,features, myWidth, myHeight, isCenter) { 
                if(window.screen)if(isCenter)if(isCenter=='true'){
                  var myLeft = (screen.width-myWidth)/2;
                  var myTop = (screen.height-myHeight)/2;
                  features+=(features!='')?',':'';
                  features+=',left='+myLeft+',top='+myTop;
              }
              window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
            } 



                // $('#registra').click(function(e){
                //         var id=$('form').serializeArray();
                //         e.preventDefault();
                        
                        
                //         $.post("controler/insert_socio.php",id,function(data,status){
                //             console.log(data);
                //             console.log(status);
                //         });
                // });
                
               
            });
</script>

                            <script>
                                function carga_bienes() {
                                    var x = document.getElementById("docent").value;
                                    var a = document.getElementById("tipo_curso").value;
                                    var y = document.getElementById("materi").value;
                                    location.href="docente_materia.php?doce="+x+"&pl="+a+"&mate="+y;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script>
<?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='yes') {
    
    echo '<script type="text/javascript">swal("OK", "Asignacion de materia exitosa", "success")</script>';

} elseif ($MSG=='no') {
    
    echo '<script type="text/javascript">swal("Error!", "Asignacion de materia fallida", "error")</script>';

} elseif ($MSG=='nada') {

}

ob_end_flush();

 ?> 