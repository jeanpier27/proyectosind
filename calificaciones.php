<?php 
ob_start();
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
 ?>





 <!DOCTYPE html>
 <html>
 <head>
 	<title>ESTUDIANTES</title>
    
 	<?php 
 	require_once('meta.php');
    require_once('login/conexion.php');
    error_reporting(0);
 	 ?>
    
    
 </head>
 <body>
 <script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#calificaciones').attr("style","background-color:#E75A5A;");
              
            });
</script>

     <script type="text/javascript">
                                       function carga_bienes() {
                                    var a = document.getElementById("promociones").value;
                                    // var b = document.getElementById("curso").value;
                                    var c = document.getElementById("jornadita").value;
                                    var d = document.getElementById("paralelo").value;
                                    var e = document.getElementById("docente").value;
                                    var f = document.getElementById("materi").value;
                                    location.href="calificaciones.php?promo="+a+"&jor="+c+"&para="+d+"&doce="+e+"&mate="+f;
                                    // location.href="calificaciones.php?promo="+a+"&cur="+b+"&jor="+c+"&para="+d+"&doce="+e+"&mate="+f;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }

                                
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
            
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Califaciones</div>
                    <div class="row">

                   
                   <center>
                   <div class="group-material">
                               <div class="group-material">
                                <span>Seleccione Promocion</span> 
                               <form autocomplete="OFF" action="" method="post" id="formreg" name="formreg">
                          <select class="selectpicker" name="promocion" id="promociones" data-live-search="true" onchange="carga_bienes();" required="">
                          <option value="0">Seleccione Promocion</option>
                           <?php
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                           $sqlpromo=$conexion->query("SELECT id_promocion, descripcion, fecha_inicio, fecha_fin FROM `tb_promocion` order by id_promocion");

                            while($row=$sqlpromo->fetch_array()){ 
                              $Id_promo = $row['id_promocion'];
                              $Ff_inicio = $row['fecha_inicio'];
                              $Ff_fin = $row['fecha_fin'];

                                ?>

                              <option value="<?php echo $Id_promo; ?>"  <?php if($Id_promo == $Promo){echo "selected='selected'";}?>   ><?php echo $row['descripcion'].' '.$Ff_inicio.' / '.$Ff_fin; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>


                          <div class="group-material">
                                <span>Seleccione Jornada </span> 
                               
                          <select class="selectpicker" name="jornada" id="jornadita" data-live-search="true" onchange="carga_bienes(this.value);" required="">
                          <option value="">Seleccione Tipo De Jornada</option>
                           <?php

                          
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                           $sqljorna=$conexion->query("SELECT distinct horario FROM `tb_estudiantes` where id_promocion='".$Promo."' ORDER BY horario ASC");

                            while($row=$sqljorna->fetch_array()){ 
                              $jornadita = $row['horario'];                             
                                ?>

                              <option value="<?php echo $jornadita; ?>"  <?php if($jornadita == $Jor){echo "selected='selected'";}?>   ><?php echo $jornadita; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>

                            <div class="group-material">
                                <span>Seleccione Paralelo </span> 
                               
                          <select class="selectpicker" name="paralelo_seleccionado" id="paralelo" data-live-search="true" onchange="carga_bienes(this.value);" required="">
                          <option value="0">Seleccione Paralelo</option>
                           <?php
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                          $Id_cur = isset($_REQUEST["cur"]) ? $_REQUEST["cur"]: 0;
                           $paralelo = isset($_REQUEST["para"]) ? $_REQUEST["para"]: 0;
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                           $sqlcurso=$conexion->query("SELECT tb_estudiantes.id_curso,tb_curso.curso FROM `tb_estudiantes` inner join tb_curso on tb_estudiantes.id_curso=tb_curso.id_curso WHERE tb_estudiantes.id_promocion='".$Promo."' and tb_estudiantes.horario='".$Jor."' group by tb_estudiantes.id_curso");

                            while($row=$sqlcurso->fetch_array()){ 

                              $cursito = $row['curso'];                             
                                ?>

                              <option value="<?php echo $row['id_curso']; ?>"  <?php if($row['id_curso'] == $paralelo){echo "selected='selected'";}?>   ><?php echo $cursito; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>

                                <div class="group-material">
                                <span>Seleccione Materia</span> 
                               
                          <select class="selectpicker" data-live-search="true" name="materia_seleccionada" id="materi" onchange="carga_bienes(this.value);" required="">
                          <option value="0">Seleccione Materia</option>
                           <?php
                           $Pl = isset($_REQUEST["pl"]) ? $_REQUEST["pl"]: 0;
                           $Mater = isset($_REQUEST["mate"]) ? $_REQUEST["mate"]: 0;
                           $paralelo = isset($_REQUEST["para"]) ? $_REQUEST["para"]: 0;

                           $sqlmate=$conexion->query("SELECT `tb_asignatura_docente`.`id_asignatura`, `tb_asignatura_docente`.`id_asignatura_docente`, `tb_asignaturas`.`asignatura`, `tb_curso`.`id_curso` FROM `tb_curso` inner JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_curso` = `tb_curso`.`id_curso` inner JOIN `tb_asignaturas` ON `tb_asignatura_docente`.`id_asignatura` = `tb_asignaturas`.`id_asignatura` where tb_curso.id_curso='".$paralelo."'");

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

                            <div class="group-material">
                                <span>Seleccione Docente</span> 
                               
                          <select class="selectpicker" name="docente_seleccionado" id="docente" data-live-search="true" onchange="carga_bienes(this.value);" required="">
                          <option value="0">Seleccione Docente</option>
                           <?php
                           $Doce = isset($_REQUEST["doce"]) ? $_REQUEST["doce"]: 0;                           
                           $paralelo = isset($_REQUEST["para"]) ? $_REQUEST["para"]: 0;
                           $sqldocente=$conexion->query("SELECT `tb_docente`.`id_docente`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_usuarios`.`id_usuarios`, `tb_asignatura_docente`.`id_curso` FROM `tb_personas` inner JOIN `tb_usuarios` ON `tb_usuarios`.`id_persona` = `tb_personas`.`id_persona` inner JOIN `tb_docente` ON `tb_docente`.`id_usuarios` = `tb_usuarios`.`id_usuarios` inner JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_docente` = `tb_docente`.`id_docente` where tb_asignatura_docente.id_curso='".$paralelo."'");

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

                              <div class="group-material" id="info">
                               
                            </div>

                            
                        
                            </center>
                        


                       <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">

                       
                        
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos2">
                                <thead>
                                    <tr  class="info">

                                      <th>Id_estudiante</th>
                                      <th>Nº</th>
                                      <th>Apellidos Nombres</th>
                                      <th>Nota</th>
                                      <th>Estado</th>                                      
                                      
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              

                              if($_GET['para']!=0 and $_GET['doce']!=0 and $_GET['mate']!=0){ 
                               $paralelo=$_GET['para'];
                               $docente=$_GET['doce'];
                               $materia=$_GET['mate'];
                               // echo ("<script type='text/javascript'>alert('".$materia."');</script>");

                               $sqlestudiante =mysqli_query($conexion,"SELECT `tb_estudiantes`.`id_estudiante`, `tb_personas`.`nombre`, `tb_personas`.`apellido`FROM `tb_personas` inner JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona` where tb_estudiantes.id_promocion='".$Promo."' and tb_estudiantes.horario='".$Jor."' and tb_estudiantes.id_curso='".$paralelo."'");
                               // $sqlestudiant=mysqli_fetch_array($sqlestudiante);
                            
                               while($consultaestudiante=mysqli_fetch_array($sqlestudiante)){
                            
                               
                               $i++; ?>
                               <tr>
                              
                               <input type="hidden" name="id_estudian[<?php echo($consultaestudiante['id_estudiante']); ?>]" value="<?php echo($consultaestudiante['id_estudiante']); ?>">
                                <td><?php echo($consultaestudiante['id_estudiante']); ?></td>
                                <td><?php echo $i; ?></td>
                                <td><?php echo($consultaestudiante['apellido'].' '.$consultaestudiante['nombre']); ?></td>
                                <?php 
                                $consul_id_asig_doce=$conexion->query("select id_asignatura_docente from tb_asignatura_docente where id_docente='".$Doce."' and id_asignatura='".$Mater."' and id_promocion='".$Promo."' and horario='".$Jor."' and id_curso='".$paralelo."'");
                              
                              $id_asig_docentes=mysqli_fetch_array($consul_id_asig_doce);

                                  $consulta_notas=$conexion->query("select * from tb_notas where id_asignatura_docente='".$id_asig_docentes[0]."' and id_estudiante='".$consultaestudiante['id_estudiante']."'");
                                  $bandera=0;
                                  while($resp=mysqli_fetch_array($consulta_notas)){
                                    $bandera++;
                                    
                                  
                                 ?>

                                <td style="color:<?php if($resp['nota']<16){ echo 'red'; } ?>"><input type="text" readonly="" maxlength="5" class="numero" style="width:40px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" name="nota[<?php echo($consultaestudiante['id_estudiante']); ?>]" value="<?php echo $resp['nota']; ?>" ></td>
                                <td style="color:<?php if($resp['nota']<16){ echo 'red'; } ?>"><?php echo($resp['estado']); ?></td>

                                <?php 
                                  }
                                  if($bandera==0){


                                 ?>
                                  <td><input type="text" required maxlength="5" class="numero" style="width:40px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" name="nota[<?php echo($consultaestudiante['id_estudiante']); ?>]" ></td>
                                <td></td>
                                <?php 
                                } ?>

                              

                      <?php 
                        }  
                        ?>
                         </tr>
                         <?php 
                         }  
                         
                      ?>                            

                              </tbody>
                              </table>
                              </div>    
                              <?php 
                                if($bandera==0){
                               ?>             
                              
                              <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="insertar_notas" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                            <?php 
                                }else{ ?>
                                 <script type="text/javascript">
                                 $('#info').html('<div class="alert alert-warning" role="alert"><strong>Advertencia</strong> Ya se encuentra asignadas las notas para editar haga clik <a href="#">AQUÍ</a> </div>');

                               </script>
                               <?php } ?>

                               </form>
                              
                              <?php 

                              if (isset($_POST['insertar_notas'])){                                

                                $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                          $Id_cur = isset($_REQUEST["cur"]) ? $_REQUEST["cur"]: 0;
                           $paralelo = isset($_REQUEST["para"]) ? $_REQUEST["para"]: 0;
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";
                           $Mater = isset($_REQUEST["mate"]) ? $_REQUEST["mate"]: 0;
                           $Doce = isset($_REQUEST["doce"]) ? $_REQUEST["doce"]: 0; 

                           if($Promo!=0 and $Id_cur!=0 and $paralelo!=0 and $Jor!=0 and $Mater!=0 and $Doce!=0){

                           
                               
                                 // echo ("<script type='text/javascript'>console.log('".$Doce.' '.$Mater.' '.$Promo.' '.$Jor.' '.$paralelo."');</script>");

                                $consul_id_asig_doce=$conexion->query("select id_asignatura_docente from tb_asignatura_docente where id_docente='".$Doce."' and id_asignatura='".$Mater."' and id_promocion='".$Promo."' and horario='".$Jor."' and id_curso='".$paralelo."'");
                              
                              $id_asig_docente=mysqli_fetch_array($consul_id_asig_doce);
                              

                              foreach ($_POST['id_estudian'] as $value) {
                                // echo ("<script type='text/javascript'>alert('".$id_asig_docente[0].' '.$_POST['nota'][$value]."');</script>");
                                $id=$_POST['id_estudian'][$value];
                                $notas=$_POST['nota'][$value];
                                if($notas>=16){
                                  $estado='APROBADO';
                                }else{
                                   $estado='REPROBADO';
                                }
                                // echo ("<script type='text/javascript'>alert('".$id.' '.$notas."');</script>");
                                 $insertar_notas=$conexion->query("insert into tb_notas (id_asignatura_docente,id_estudiante,nota,estado,observacion)values('".$id_asig_docente[0]."','".$id."','".$notas."','".$estado."','')");
                                }
                                                         
                                                       

                                if ($insertar_notas) {
                                 header('location: calificaciones.php?msg=yes'); 
                               } else {
                                 header('location: calificaciones.php?msg=no');
                               }
                             }else{
                              echo '<script type="text/javascript">swal("Error!", "Debe seleccionar todos los campos!", "warning")</script>';
                             }
                          }
                             
                             ?>
                       

                       </div>
                       </div>
        	

        <!-- </section> -->
        </div>

<script type="text/javascript">
                                   

                $(document).ready(function(){
                       

                $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57)  || (key==8) || (key==46)) 
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
               
            });
</script> 
        
 </body>

 </html>


 <?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='yes') {
    
    echo '<script type="text/javascript">swal("OK", "Califaciones registradas con exito", "success")</script>';

} elseif ($MSG=='no') {
    
    echo '<script type="text/javascript">swal("Error!", "Califaciones no se guardaron", "error")</script>';

} elseif ($MSG=='nada') {

}

ob_end_flush();
?>