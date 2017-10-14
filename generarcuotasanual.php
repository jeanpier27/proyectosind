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
            <div class="page-header">
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Configuracion</small></h1>
            </div>
        </div>
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
        <?php 
        $sqlcuotas=$conexion->query("SELECT max(YEAR(fecha)) as year FROM `tb_recaudaciones` ");
        $resul=mysqli_fetch_array($sqlcuotas);
        if($resul[0]==date('Y')){echo '<div class="alert alert-danger" role="alert"><h3><strong>Nota:</strong> Ya se encuentra generadas las cuotas anuales de este año </h3></div>';}else{ 
        // if($resul[0]=='2018'){echo '<div class="alert alert-danger" role="alert"><h3><strong>Nota:</strong> Ya se encuentra generadas las cuotas anuales de este año </h3></div>';}else{ 

        ?>

            

        <?php } ?>
        </div>

        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
         
            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"  <?php if($resul[0]==date('Y')){echo 'disabled';} ?> ><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Generar Cuotas</button> &nbsp;&nbsp;
            </p>
            <br><br>
            <!-- <div class="row">
                <div class="col-md-12">
                    
                    <div class="progress">
                      <div class="progress-bar progress-bar-success progress-bar-striped" id="barra" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 2%;">
                        2%
                      </div>
                    </div>
                </div>
            </div> -->
        </div>

            
        
        </div>
        <?php 
        // for($i=1;$i<=10000;$i++){
        //     $total=($i*100)/10000;               
        //     echo "<script type='text/javascript'>$('#barra').empty();$('#barra').append('".$total."%Completado');$('#barra').attr('style','width:".$total."%;'); </script>";
           

        // }
         ?>
        

      <?php 
        if(isset($_POST['registra'])){
            $socio=$conexion->query("select * from tb_socio where estado='ACTIVO'");

                $conexion->autocommit(false);
                $error=0; 
            while($row=mysqli_fetch_array($socio)){
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
                $añoactual=date('Y');
                for($i=1;$i<=12;$i++){
                        $insertar_recaudam=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$row['id_persona']."','".$hoy."','".$añoactual."','".$i."','".$mensua."','','0','ACTIVO','','".$valormens."','' )");

                        $insertar_recaudac=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$row['id_persona']."','".$hoy."','".$añoactual."','".$i."','".$cesan."','','0','ACTIVO','','".$valorcesa."','' )");

                   
                    if(!$insertar_recaudam or !$insertar_recaudac){
                        $error=1;
                    }
                    
                }

            }

            if($error){
                    $conexion->rollback();
                }else{
                    $conexion->commit();
                    echo '<script type="text/javascript">swal({title: "ok", text: "Generadas cuotas con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="generarcuotasanual.php";});</script>';    

                     }

        }
       ?>
        
 </body>
 <script type="text/javascript">

$(document).ready(function(){
            $('#contconfig').attr("style","display:block;");
            $('#confcuotassocio').attr("style","background-color:#E75A5A;");
            // $('#a').click();
            // $('#progreso').attr('style','display:none;');
            // var bar=$('#barra');
            // bar.empty();
            // bar.append('7%'); 
            // bar.attr('style','width:7%;'); 
        });

 </script>
 </html>