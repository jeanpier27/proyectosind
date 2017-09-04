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
    require_once('login/conexion.php');
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Bienvenido</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
        <?php if($_SESSION['tipo_usuario']=='SECRETARIO_GENERAL' or $_SESSION['tipo_usuario']=='SECRETARIO_FINANCIERO'){  ?>
        	<h1>USTED TIENE EL ACCESO A TODAS LAS CONFIGURACIONES Y ACCIONES</h1>

        	<article class="tile">
        		<div class="tile-icon full-reset"><i class="zmdi zmdi-book"></i>   
        			&nbsp;&nbsp;<i class="zmdi zmdi-trending-up"></i>&nbsp;  <i class="zmdi zmdi-male-female"></i>
        			&nbsp;<i class="zmdi zmdi-male-alt"></i>
        		</div>  

        	</article>
        <?php }else{  ?>
            <center>
                
               <img src="assets/img/logo.png" width="400" height="500" >
            </center>

        <?php } ?>

        </section>
        </div>

      
        
 </body>
 <script type="text/javascript">
 	$(document).ready(function(){

 		$('#inicio').click(function(){
 			$('#contenedor').load('vistas/inicio.php');
 		});
 		
 	});

 </script>
 </html>