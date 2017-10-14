<?php 
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
 ?>





 <!DOCTYPE html>
 <html>
 <head>
    <title>Sindicato</title>
    
    <?php 
    require_once('meta.php');
    require_once('login/conexion.php')
     ?>
    
    
 </head>
 <body>
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
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" > -->
            <div class="page-header">
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Configuracion</small></h1>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <div class="title-flat-form title-flat-blue">Seleccione las fechas para generar las cuotas</div>
              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");
               $meses=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

                            $sqlsocio=$conexion->query("SELECT `tb_personas`.`id_persona`as id_per, `tb_personas`.`cedula_ruc`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_socio`.* FROM `tb_personas` inner JOIN `tb_socio` ON `tb_socio`.`id_persona` = `tb_personas`.`id_persona` where tb_socio.estado='ACTIVO'");   
                         ?>
                         <center>
                         <form method="post">
                        

                            <div class="group-material">
                              <span>Año </span> 
                                <br>
                               
                                <select class="selectpicker material-control" name="año" required="">
                                <option selected="" disabled>Seleccione </option> 
                                   <?php 
                                      // $sqlcuotas=$conexion->query("SELECT max(YEAR(fecha)) as year FROM `tb_recaudaciones` ");
                                      // $resul=mysqli_fetch_array($sqlcuotas);
                                      $hoy=date('Y');
                                      // $atras=$resul[0]-15;
                                      for($i=2016;$i<=(int)$hoy;$i++){?>
                                           <option value="<?php echo $i; ?>"><?php echo ($i); ?></option>
       
                                <?php    }
                                ?>                      
                                 </select>
                            </div>

                            <div class="group-material" id="des_cuotas">

                                <span>Seleccione Tipo de cuota </span> <br>
                               
                                <select class="selectpicker" name="cuotas" required="">
                                <option selected="" disabled="">Seleccione </option>
                                 <?php  
                                  $squerycoutas=$conexion->query('select * from tb_pagos_socio ');
                                   while($row=$squerycoutas->fetch_array()){ 
                                      // $consulre=$conexion->query("SELECT ifnull(max(cast(mes as unsigned)),0) FROM `tb_recaudaciones` WHERE id_persona='".$row['id_per']."' and id_pagos_socio=2");
                                     // $resp=mysqli_fetch_array($consulre);
                                     if($row['descripcion']!='MULTAS'){
                                      ?>

                                    <option value="<?php echo $row['id_pagos_socio']; ?>"><?php echo ($row['descripcion']); ?></option>
                                     <?php  
                                     }
                                  }
                                  ?>
                                </select>

                            </div>

                            <div class="group-material" id="socio">

                                <span>Seleccione al Socio </span> <br>
                               
                                <select class="selectpicker" name="nombres" data-live-search="true" required="">
                                <option selected="" disabled="">Seleccione </option>
                                <?php 
                                    while($socio=mysqli_fetch_array($sqlsocio)){
                                 ?>

                                 <option value="<?php echo $socio['id_per']; ?>"><?php echo $socio['apellido'].' '.$socio['nombre']; ?></option>
                                <?php 
                                    }
                                 ?> 
                                </select>

                            </div>

                            

                            <div class="group-material" id="others_cuotas" style="display: none">    
                              
                              <span>Mes</span> 
                                <br>
                               
                                <select class="selectpicker material-control" name="mes" required="">
                                <option selected="" disabled>Seleccione </option> 
                                   <?php 
                                     
                                      for($i=12;$i>=1;$i--){?>
                                           <option value="<?php echo $i; ?>"><?php echo ($meses[$i]); ?></option>
       
                                    <?php    }
                                    ?>                      
                               </select>

                            </div>
                            </center>
                        
        
    
        
         
            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Generar Cuotas</button> &nbsp;&nbsp;
                            </p>
</form>
      <?php 

       if(isset($_POST['INSCRIPCION'])){
        $id_per=$_POST['nombres'];
        // $añoingreso=$_POST['año'];
        $cuotas=$_POST['cuotas'];
        $valor=$_POST['valor_inscripcion'];
        $hoy=date('Y-m-d');

        if($id_per!='' and $cuotas!=''){
          $consul=$conexion->query("SELECT 1 from tb_recaudaciones where id_pagos_socio='".$cuotas."' and id_persona=".$id_per." GROUP BY 1");
          $r=mysqli_fetch_array($consul);
          if($r[0]==0){


          // echo '<script type="text/javascript">alert("'.$hoy.'");</script>';
          $inscripcion=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','','','".$cuotas."','','1','ACTIVO','','".$valor."',0)");

                  if($inscripcion){
                        echo '<script type="text/javascript">swal({title: "ok", text: "Cuota generadas con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="generarcuotasindividual.php";});</script>';
                      // $conexion->rollback();
                  }else{
                       // $conexion->commit();
                        echo '<script type="text/javascript">swal({title: "Error", text: "Error al generar cuotas...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="generarcuotasindividual.php";});</script>';

                  }
        }else{
          echo '<script type="text/javascript">swal({title: "Error", text: "Ya se encuentra registrada esta cuota...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: true},function(){  });</script>';

        }
      }else{
           echo '<script type="text/javascript">swal({title: "Error", text: "Debe Seleccionar todos los campos...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: true},function(){  });</script>';

      }

}
      
      if(isset($_POST['MENSUALIDAD'])){
        $id_per=$_POST['nombres'];
        $añoingreso=$_POST['año'];
        $mes=$_POST['mes'];
              // $sqlsocio=$conexion->query("select id_persona,fecha_ingreso from tb_socio where id_persona ='".$id_per."'"); 
        if($id_per!='' and $añoingreso!='' and $mes!=''){
              $mensualidad= $conexion->query("SELECT * FROM `tb_pagos_socio` WHERE descripcion='CUOTAS MENSUALES'"); 
              
              while($consultamen=mysqli_fetch_array($mensualidad)){
                  $mensua=$consultamen['id_pagos_socio'];
                  $valormens=$consultamen['valor'];
              }
            $consul=$conexion->query("SELECT 1 from tb_recaudaciones where id_pagos_socio='".$mensua."' and id_persona=".$id_per." and año='".$añoingreso."' GROUP BY 1");
            $r=mysqli_fetch_array($consul);
             // echo '<script type="text/javascript">alert('.$r[0].');</script>';
          if($r[0]==0){

           
            $hoy=date('Y-m-d');
                $mesess=(int)$mes;
                for($i=1;$i<=12;$i++){
                  
                    $conexion->autocommit(false);
                    $error=0;
                    if($i>=(int)$mesess){
                        $insertar_recaudam=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$añoingreso."','".$i."','".$mensua."','','0','ACTIVO','','".$valormens."','' )");

                        if(!$insertar_recaudam){
                          $error=1;
                        }
                       

                    } 

  
                }

                if($error){
                    $conexion->rollback();
                }else{
                     $conexion->commit();
                      echo '<script type="text/javascript">swal({title: "ok", text: "Cuotas generadas con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="generarcuotasindividual.php";});</script>';
                }
              }else{
                 echo '<script type="text/javascript">swal({title: "Error", text: "Ya se encuentra registrada esta cuota...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: true},function(){  });</script>';
              }
            }else{
              echo '<script type="text/javascript">swal({title: "Error", text: "Debe Seleccionar todos los campos...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: true},function(){  });</script>';

            }

}

      if(isset($_POST['CESANTIA'])){
        $id_per=$_POST['nombres'];
      $añoingreso=$_POST['año'];
      $mes=$_POST['mes'];
            // $sqlsocio=$conexion->query("select id_persona,fecha_ingreso from tb_socio where id_persona ='".$id_per."'"); 
      if($id_per!='' and $añoingreso!='' and $mes!=''){
            $cesantia=$conexion->query("SELECT * FROM `tb_pagos_socio` WHERE descripcion='FONDO DE CESANTIA'"); 

            while($consultacesa=mysqli_fetch_array($cesantia)){
                $cesan=$consultacesa['id_pagos_socio'];
                $valorcesa=$consultacesa['valor'];
            }

             $consul=$conexion->query("SELECT 1 from tb_recaudaciones where id_pagos_socio='".$mensua."' and id_persona=".$id_per." and año='".$añoingreso."' GROUP BY 1");
             $r=mysqli_fetch_array($consul);
          if($r[0]==0){
            $hoy=date('Y-m-d');
                $mesess=(int)$mes;
                for($i=1;$i<=12;$i++){
                  
                    $conexion->autocommit(false);
                    $error=0;
                    if($i>=(int)$mesess){

                        $insertar_recaudac=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$añoingreso."','".$i."','".$cesan."','','0','ACTIVO','','".$valorcesa."','' )");

                        if(!$insertar_recaudac){
                          $error=1;
                        }
                       

                    } 

  
                }

                if($error){
                    $conexion->rollback();
                }else{
                     $conexion->commit();
                      echo '<script type="text/javascript">swal({title: "ok", text: "Cuotas generadas con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="generarcuotasindividual.php";});</script>';

                }
                 }else{
                 echo '<script type="text/javascript">swal({title: "Error", text: "Ya se encuentra registrada esta cuota...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: true},function(){  });</script>';
              }

                }else{
                  echo '<script type="text/javascript">swal({title: "Error", text: "Debe Seleccionar todos los campos...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: true},function(){  });</script>';

            }

}

       ?>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
            
        <!-- </section> -->
        </div>


        
 </body>
 <script type="text/javascript">

$(document).ready(function(){
            $('#contconfig').attr("style","display:block;");
            $('#confcuotassocio').attr("style","background-color:#E75A5A;");

   $('select[name=cuotas]').change(function(){
    var descrip=$('select[name=cuotas] option:selected').text();

      if(descrip=='INSCRIPCION'){
         $('#registra').attr('name',descrip);
        $('#des_cuotas').after('<div class="group-material" id="valor_insc">Valor de Inscripcion<br><input type="number" min=0 required="" name="valor_inscripcion"></div>');
                              
      }else{
        $('#valor_insc').remove();
      }
      if(descrip=='CUOTAS MENSUALES' || descrip=='FONDO DE CESANTIA'){
        $('#others_cuotas').css('display','block');
      }else{
        $('#others_cuotas').css('display','none');
      }
      if(descrip=='CUOTAS MENSUALES'){
        $('#registra').attr('name','MENSUALIDAD');
      }
      if(descrip=='FONDO DE CESANTIA'){
        $('#registra').attr('name','CESANTIA');
      }
     
   });
        });

 </script>
 </html>