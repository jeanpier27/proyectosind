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

                            $sqlsocio=$conexion->query("SELECT `tb_personas`.`id_persona`as id_per, `tb_personas`.`cedula_ruc`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_personas`.`telefono1`, `tb_personas`.`telefono2`, `tb_personas`.`telefono3`, `tb_personas`.`direccion`, `tb_personas`.`correo`, `tb_personas`.`estado_civil`, `tb_socio`.* FROM `tb_personas` LEFT JOIN `tb_socio` ON `tb_socio`.`id_persona` = `tb_personas`.`id_persona` where tb_socio.estado='ACTIVO'");   
                         ?>
                         <center>
                         <form method="post">
        <div class="group-material">

                                <span>Seleccione al Socio </span> <br>
                               
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sqlsocio->fetch_array()){ 
                                $consulre=$conexion->query("SELECT ifnull(max(cast(mes as unsigned)),0) FROM `tb_recaudaciones` WHERE id_persona='".$row['id_per']."' and id_pagos_socio=2");
                               $resp=mysqli_fetch_array($consulre);
                               if($resp[0]==0){
                                ?>

                              <option value="<?php echo $row['id_per']; ?>"><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  
                               }
                            }
                            ?>
                          </select>

                            </div>

                            <div class="group-material">    
                              <span>Año </span> 
                                <br>
                               
                          <select class="selectpicker material-control" name="año" required="">
                          <option selected="" disabled>Seleccione </option> 
                             <?php 
                                // $sqlcuotas=$conexion->query("SELECT max(YEAR(fecha)) as year FROM `tb_recaudaciones` ");
                                // $resul=mysqli_fetch_array($sqlcuotas);
                                // // $hoy=date('Y');
                                // $atras=$resul[0]-15;
                                for($i=2017;$i>=2016;$i--){?>
                                     <option value="<?php echo $i; ?>"><?php echo ($i); ?></option>
 
                              <?php    }
                              ?>                      
                               </select>

                           <br> 
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
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Generar Cuotas</button> &nbsp;&nbsp;
                            </p>
</form>
      <?php 
      
      if(isset($_POST['registra'])){
        $id_per=$_POST['nombres'];
      $añoingreso=$_POST['año'];
      $mes=$_POST['mes'];
            // $sqlsocio=$conexion->query("select id_persona,fecha_ingreso from tb_socio where id_persona ='".$id_per."'"); 
            $mensualidad= $conexion->query("SELECT * FROM `tb_pagos_socio` WHERE descripcion='CUOTAS MENSUALES'"); 
            $cesantia=$conexion->query("SELECT * FROM `tb_pagos_socio` WHERE descripcion='FONDO DE CESANTIA'"); 

            while($consultamen=mysqli_fetch_array($mensualidad)){
                $mensua=$consultamen['id_pagos_socio'];
                $valormens=$consultamen['valor'];
            }

            while($consultacesa=mysqli_fetch_array($cesantia)){
                $cesan=$consultacesa['id_pagos_socio'];
                $valorcesa=$consultacesa['valor'];
            }
            $hoy=date('Y-m-d');
                $mesess=(int)$mes;
                for($j=(int)$añoingreso;$j<=2017;$j++){
                for($i=1;$i<=12;$i++){
                        if((int)$añoingreso==2016){
                    if($i>=(int)$mesess and $añoingreso==$j){
                        $insertar_recaudam=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$j."','".$i."','".$mensua."','','0','ACTIVO','','".$valormens."','' )");


                        $insertar_recaudac=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$j."','".$i."','".$cesan."','','0','ACTIVO','','".$valorcesa."','' )");
                            // echo $j.' '.$i.' '.$valormens.' '.$valorcesa.'-<br>';

                    } 

                    if($j>=2017){
                       // echo $j.' '.$i.' '.$valormens.' '.$valorcesa.'+<br>';
                        $insertar_recaudam=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$j."','".$i."','".$mensua."','','0','ACTIVO','','".$valormens."','' )");

                        $insertar_recaudac=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$j."','".$i."','".$cesan."','','0','ACTIVO','','".$valorcesa."','' )");

                    }
                    }else{
                         if($i>=(int)$mesess and $añoingreso==$j){
                        $insertar_recaudam=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$j."','".$i."','".$mensua."','','0','ACTIVO','','".$valormens."','' )");

                        $insertar_recaudac=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$hoy."','".$j."','".$i."','".$cesan."','','0','ACTIVO','','".$valorcesa."','' )");
                          // echo $j.' '.$i.' '.$valormens.' '.$valorcesa.'+<br>';

                    } 

                    }
                }

                }

                echo '<script type="text/javascript">swal({title: "ok", text: "Cuotas generadas con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="generarcuotasindividual.php";});</script>';


            // }
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

   
        });

 </script>
 </html>