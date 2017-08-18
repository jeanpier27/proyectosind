<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
// echo $cedula;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>Registrar Estudiante</title>
   <?php 
        require_once('meta.php');
        require_once('login/conexion.php');
     ?>
 </head>
 <body>
<script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#estudiantes').attr("style","background-color:#E75A5A;");
              
            });
</script>
 <?php   
 if(isset($_POST['registra'])){
                $id_per=$_POST['nombres'];
                $promo = $_REQUEST["promo"];
                $fecha_registro = $_POST['fecha_registro'];
                $horario = $_POST['horario'];
                $total_pago = $_POST['total_pagar']; 
                $id_curso=$_POST['id_curso'];        
                $estado = 'ACTIVO';

                $sqlbusca=$conexion->query("select IFNULL(sum(valor),0) from tb_estudiantes where id_persona='".$id_per."' and id_promocion='".$promo."' and estado='ACTIVO'");
    $consulbus=mysqli_fetch_array($sqlbusca);
    if($consulbus[0]<=0){
                    
                    $add_table_estudiante = "insert into tb_estudiantes (id_persona, fecha, id_promocion, horario, valor, abono, observacion,estado,id_curso) values (".$id_per.", '".$fecha_registro."',".$promo.", '".$horario."',".$total_pago.",'','','".$estado."','".$id_curso."')";    
                    $ingreso_table_estudiante = mysqli_query($conexion,$add_table_estudiante);


                    if (!$ingreso_table_estudiante) {   

                       header('location: estudiantes.php?msg=teerror'); 
                   } else {
                  
                      header('location: estudiantes.php?msg=ss');
                                        
                
              }
}else{
  echo '<script type="text/javascript">swal("Error!", "Ya se encuentra registrado el alumno en esta promocion!", "warning")</script>';
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
                    <div class="title-flat-form title-flat-blue">Estudiantes</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT `tb_personas`.`id_persona` as cod, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_estudiantes`.`id_persona` FROM `tb_personas` LEFT JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona` order by `tb_personas`.`apellido`");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">

                            <div class="group-material">
                                <span>Seleccione al nuevo Estudiante </span> 
                               
                          <select class="selectpicker" name="nombres" id="persona_dato" data-live-search="true" onchange="carga_bienes(this.value);" required="">
                          <option  disabled="">Seleccione </option>
                           <?php

                           $Id_per = isset($_REQUEST["per"]) ? $_REQUEST["per"]: 0;
                            while($row=$sqlsocio->fetch_array()){ 
                              $personita = $row['cod'];
                                ?>

                              <option value="<?php echo $personita; ?>"  <?php if($personita == $Id_per){echo "selected='selected'";}?>   ><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>

                             <div class="group-material">                              
                         <span>Seleccione Promocion</span> 
                                <select class="tooltips-general material-control" data-toggle="tooltip" id="promocion" onchange="carga_bienes();" data-placement="top" title="" name="promocion" required >
                                    <option value="0" disabled="" selected="">Seleccione Promocion</option>
                                        <?php
                                         $promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                                         $sqlb=$conexion->query("SELECT `tb_promocion`.`id_promocion`, `tb_promocion`.`descripcion`, `tb_promocion`.`fecha_inicio`, `tb_promocion`.`fecha_fin` FROM `tb_promocion`");
                                          while($f = $sqlb->fetch_array()){
                                          $Id_promo = $f['id_promocion']; 
                                          $Fecha_ini = $f['fecha_inicio'];
                                          $Fecha_fin = $f['fecha_fin'];
                                          ?>  
                                            <option value="<?php echo $Id_promo;?>"    <?php if($Id_promo == $promo){echo "selected='selected'";}?>    >  <?php echo $f['descripcion'].' '.$Fecha_ini." / ".$Fecha_fin; ?></option>
                                          <?php  
                                            } 
                                        ?> 
                                </select>
                                </div>  
                            <div class="group-material">
                           <span>Horario</span>
                          <select  name="horario" id="horario" onchange="carga_bienes();" class="tooltips-general material-control" >   
                          <?php 
                            $horario = isset($_REQUEST["horar"]) ? $_REQUEST["horar"]: 0;
                           ?>                              
                                   <option value="NOCTURNO"  <?php if('NOCTURNO' == $horario){echo "selected='selected'";}?> >NOCTURNO</option>
                                   <option value="FIN DE SEMANA" <?php if('FIN DE SEMANA' == $horario){echo "selected='selected'";}?> >FIN DE SEMANA</option>
                                  
                                   
                               </select>
                            </div>                          

                            <div class="group-material">
                                Fecha Registro
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_registro" required value="<?php echo date("Y-m-d"); ?>" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div>

                           <!--  <div class="group-material">                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Observaciones" name="observaciones_inscripcion" required >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Observaciones sobre inscripcion</label>
                            </div>  -->

                            <div class="group-material">
                                <?php                
                            $tipo_pago = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0; 
                            $consulta_tipo_pago = $conexion->query("select valor from tb_promocion where id_promocion = ".$tipo_pago);
                                while ($encontrado_tipo_pago=$consulta_tipo_pago->fetch_array()){ 
                                  $Valor_p=$encontrado_tipo_pago['valor'];                                                                    
                                 } 
                                 ?>
                                <label>Total Pago</label><br><br>
                                <input type="text" readonly="" value="<?php echo $Valor_p;  ?>" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Total Pago" name="total_pagar" required >                               

                            </div> 
                 
                        

                           

                            <div class="group-material">
                                <?php       
                                $consultcurso=$conexion->query("select * from tb_curso");
                                while($resp=mysqli_fetch_array($consultcurso)){
                                   $consul_curso = $conexion->query("select id_curso FROM `tb_estudiantes`  where id_promocion='".$promo."'  and horario='".$horario."' and id_curso='".$resp['id_curso']."'");
                                    // $nume=$consul_curso->num_rows;
                                   $count=0;
                                    while($nume=mysqli_fetch_array($consul_curso)){
                                      $count++;
                                    }
                                    if($count<3){
                                      
                                      $cursovisible=$resp['curso'];
                                      $id_curso=$resp['id_curso'];
                                      break;
                                    }
                                }      
                           
                                 ?>
                                <label>Curso</label><br><br>  
                                <input type="text" readonly="" value="<?php echo $cursovisible;  ?>" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Total Pago" name="curso" required >
                                <input type="hidden" value="<?php echo $id_curso; ?>" name="id_curso">                               

                            </div> 
                  

                            
                           
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>
            </form> 
        </section>
 </body>
 </html>

<?php require_once('login/cerrar_conexion.php'); ?>
            <script type="text/javascript">
                $(document).ready(function(){
                   
                    $('input[name=fecha_registro]').daterangepicker({
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
                                    var x = document.getElementById("promocion").value;
                                    var a = document.getElementById("persona_dato").value;
                                    var c = document.getElementById("horario").value;
                                    location.href="addestudiantes.php?promo="+x+"&per="+a+"&horar="+c;
                                    // location.href="addestudiantes.php?promo="+x+"&per="+a;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script> 