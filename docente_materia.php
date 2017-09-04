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
 <script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#docentes').attr("style","background-color:#E75A5A;");
              
            });
</script>
 <?php   
 if(isset($_POST['registra'])){
                $promocion=$_POST['promocion'];
                $horario=$_POST['jornada'];
                $Id_docente = $_POST['docente_seleccionado'];
                $Id_materia = $_POST["materia_seleccionada"];
                $Id_paralelo = $_POST["paralelo_seleccionado"];


                $repetidos=$conexion->query("select 1 from tb_asignatura_docente where id_docente='".$Id_docente."' and id_asignatura='".$Id_materia."' and id_promocion='".$promocion."' and horario='".$horario."' and id_curso='".$Id_paralelo."'");
                $resulrepe=mysqli_fetch_array($repetidos);
                
                if(!$resulrepe[0]){          

                    $add_table_asignatura_docente = "insert into tb_asignatura_docente (id_docente, id_asignatura,id_promocion,horario,id_curso,estado) values (".$Id_docente.", ".$Id_materia.",".$promocion.",'".$horario."','".$Id_paralelo."', 'ACTIVO')";    
                    $ingreso_table_asignatura_docente = mysqli_query($conexion,$add_table_asignatura_docente);


                    if (!$ingreso_table_asignatura_docente) {                     
                       header('location: docente_materia.php?msg=error'); 
                   } else {
                      header('location: docente_materia.php?msg=ss');
                  } 
                  }else{
                    echo '<script type="text/javascript">swal("Error!", "Ya se encuentra asignado a esta promocion!", "warning")</script>';
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
                    <div class="title-flat-form title-flat-blue">MATERIAS ASIGNADAS AL DOCENTE</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                             
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">

                            <center>

                            <div class="group-material">
                                <span>Seleccione Promocion</span> 
                               
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

                              <option value="<?php echo $Id_promo; ?>"  <?php if($Id_promo == $Promo){echo "selected='selected'";}?>   ><?php echo $row['descripcion'].' '. $Ff_inicio.' / '.$Ff_fin; ?></option>
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
                                <span>Seleccione Docente</span> 
                               
                          <select class="selectpicker" name="docente_seleccionado" id="docente" data-live-search="true" onchange="carga_bienes(this.value);" required="">
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
                                <span>Seleccione Materia</span> 
                               
                          <select class="selectpicker" data-live-search="true" name="materia_seleccionada" id="materi" onchange="carga_bienes(this.value);" required="">
                          <option value="0">Seleccione Materia</option>
                           <?php
                           $Pl = isset($_REQUEST["pl"]) ? $_REQUEST["pl"]: 0;
                           $Mater = isset($_REQUEST["mate"]) ? $_REQUEST["mate"]: 0;

                           $sqlmate=$conexion->query("SELECT `tb_asignaturas`.`id_asignatura`, `tb_asignaturas`.`asignatura`, `tb_asignaturas`.`estado`, `tb_asignaturas`.`descripcion` FROM `tb_asignaturas` ORDER BY `tb_asignaturas`.`asignatura` ASC");

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
                            </center>                           

                            
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>



<?php if($_GET['para']!=0){  ?>


                <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">

                       <center><th><p><h1>Docentes materias</h1></p></th></center>

                        <form autocomplete="" action="" method="post" id="" name="">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos2">
                                <thead>
                                    <tr  class="info">

                                      <th>Id</th>
                                      <th>Docente</th>
                                      <th>Promocion</th> 
                                      <th>Horario</th> 
                                      <th>Curso</th> 
                                      <th>Materias</th>  
                                      <th>Estado</th>   
                                      <th>Observacion</th>                                                              
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              $i = 0;

                              $Id_docen = $_REQUEST["doce"];
                              if ($Id_docen == '') {
                                 $Id_docen = 0;
                               }                           
                               $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                               $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";
                                                          

                              $sqldocente_materia=$conexion->query("SELECT `tb_asignatura_docente`.`id_asignatura_docente`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_asignaturas`.`asignatura`, `tb_docente`.`estado`, `tb_usuarios`.`estado`, tb_asignatura_docente.horario, tb_asignatura_docente.id_curso, tb_asignatura_docente.id_promocion, tb_asignatura_docente.observacion, tb_promocion.descripcion,tb_asignatura_docente.estado as estados FROM `tb_personas` INNER JOIN `tb_usuarios` ON `tb_usuarios`.`id_persona` = `tb_personas`.`id_persona` INNER JOIN `tb_docente` ON `tb_docente`.`id_usuarios` = `tb_usuarios`.`id_usuarios` INNER JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_docente` = `tb_docente`.`id_docente` INNER JOIN `tb_asignaturas` ON `tb_asignatura_docente`.`id_asignatura` = `tb_asignaturas`.`id_asignatura`inner join tb_promocion on tb_asignatura_docente.id_promocion=tb_promocion.id_promocion WHERE `tb_asignatura_docente`.`id_docente`=".$Id_docen." and tb_asignatura_docente.id_promocion='".$Promo."' and tb_asignatura_docente.horario='".$Jor."'");

                              $numero_asignaciones = mysqli_num_rows($sqldocente_materia);


                               while($consultadocente_materia=mysqli_fetch_array($sqldocente_materia)){                                
                                // tabla estudiante
                                $Id = $consultadocente_materia['id_asignatura_docente'];
                                $Nombre = $consultadocente_materia['nombre'];
                                $Apellido = $consultadocente_materia['apellido'];
                                $Asignatura = $consultadocente_materia['asignatura'];
                                $observacion = $consultadocente_materia['observacion'];
                                $horario = $consultadocente_materia['horario'];
   
                               ?>

                                <tr>
                                <input type="hidden" name="id_docente" value="<?php echo $Id_docen; ?>">
                                <input type="hidden" name="id_promo" value="<?php echo $Promo; ?>">
<td><input name="id_asignatura_docente[<?php echo $Id;?>]" readonly value="<?php echo $Id; ?>" style="width:80px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><p style="width:200px;"><?php echo $Apellido.' '.$Nombre; ?></p></td>
<td><?php echo $consultadocente_materia['descripcion']; ?></td>   
<td>
<select name="horario[<?php echo $Id;?>]" style="width:120px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="NOCTURNO" <?php if($horario=="NOCTURNO"){echo "selected";} ?>> NOCTURNO </option>
<option value="FIN DE SEMANA" <?php if($horario=="FIN DE SEMANA"){echo "selected";} ?>> FIN DE SEMANA </option>
</select>
</td>  
<td>
<select name="curso[<?php echo $Id;?>]" style="width:40px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<?php 
$consultcurso=$conexion->query("select `tb_curso`.`curso`, `tb_estudiantes`.`id_curso` FROM `tb_curso` inner JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_curso` = `tb_curso`.`id_curso` GROUP by tb_estudiantes.id_curso");
while($conscurso=mysqli_fetch_array($consultcurso)){
 ?>
<option value="<?php echo $conscurso['id_curso']; ?>" <?php if($consultadocente_materia['id_curso']==$conscurso['id_curso']){echo "selected";} ?>> <?php echo $conscurso['curso']; ?> </option>

<?php } ?>
</select>
</td>                         
<td>
<select name="asignatura[<?php echo $Id;?>]" style="width:300px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
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
<select name="estado[<?php echo $Id;?>]" style="width:120px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="ACTIVO" <?php if($consultadocente_materia['estados']=="ACTIVO"){echo "selected";} ?>> ACTIVO </option>
<option value="INACTIVO" <?php if($consultadocente_materia['estados']=="INACTIVO"){echo "selected";} ?>> INACTIVO </option>
</select>
</td>
<td><input type="text"  name="observacion[<?php echo $Id;?>]" style="width:120px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" title="<?php echo $observacion; ?>" placeholder="<?php echo $observacion; ?>" ></td>
<input type="hidden" name="observacionbd[<?php echo $Id;?>]" value="<?php echo $observacion; ?>">



                               <?php 
                               $i++;
                               } ?>
                               </tr>

                              </tbody>
                              </table>
                              </div>                    

                              <center><button  name="registro_actualizar" id="" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i>      Actualizar</button></center>
                              <?php 

                              if (isset($_POST['registro_actualizar'])){
                                $id_docente=$_POST['id_docente'];
                                $id_promo=$_POST['id_promo'];
                            foreach ($_POST['id_asignatura_docente'] as $value) {                       
                            
                              if($_POST['observacion'][$value]!=""){
                                $id=$_POST['id_asignatura_docente'][$value];
                                $horario=$_POST['horario'][$value];
                                $curso=$_POST['curso'][$value];
                                $asignatura=$_POST['asignatura'][$value];
                                $estado=$_POST['estado'][$value];
                                $observacionbd=$_POST['observacionbd'][$value];                         
                                
                                $observa=$_POST['observacion'][$value];
                                $fecha=date('Y-m-d H:i:s');
                                $observaciontotal=$observacionbd.' ('.$fecha.' usuario: '.$_SESSION['nombres'].'.- '.$observa.')';

                                $repetidos=$conexion->query("select 1 from tb_asignatura_docente where id_docente='".$id_docente."' and id_asignatura='".$asignatura."' and horario='".$horario."' and id_curso='".$curso."' and id_promocion='".$id_promo."'");
                                $resulrepe=mysqli_fetch_array($repetidos);
                                if($resulrepe[0]!=1){

                                $sqlupdate=$conexion->query("update tb_asignatura_docente set horario='".$horario."', id_curso='".$curso."',estado='".$estado."', observacion='".$observaciontotal."',id_asignatura='".$asignatura."'  where id_asignatura_docente=".$id);
                              }else{

                              }
                            }
                          }
                              

                                if ($sqlupdate) {
                                 header('location: docente_materia.php?msg=yes'); 
                               } else {
                                 header('location: docente_materia.php?msg=no');
                               }
                          
                             }  
                             ?>
                        </form>

                       </div>



<?php } ?>







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
                                    var a = document.getElementById("promociones").value;
                                    // var b = document.getElementById("curso").value;
                                    var c = document.getElementById("jornadita").value;
                                    var d = document.getElementById("paralelo").value;
                                    var e = document.getElementById("docente").value;
                                    var f = document.getElementById("materi").value;
                                    // location.href="docente_materia.php?promo="+a+"&cur="+b+"&jor="+c+"&para="+d+"&doce="+e+"&mate="+f;
                                    location.href="docente_materia.php?promo="+a+"&jor="+c+"&para="+d+"&doce="+e+"&mate="+f;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script>
<?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='ss') {
    
    echo '<script type="text/javascript">swal("OK", "Asignacion de materia exitosa", "success")</script>';

} elseif ($MSG=='error') {
    
    echo '<script type="text/javascript">swal("Error!", "Asignacion de materia fallida", "error")</script>';

} elseif ($MSG=='nada') {

}

ob_end_flush();

 ?> 