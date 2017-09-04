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
 	 ?>
 </head>
 <body>
  <script type="text/javascript">
    $(document).ready(function(){
            $('#contreporte').attr("style","display:block;");
            $('#reporteinventario').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Inventario Cofres</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
          
        <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-assignment-check"></i></div>
                <div class="tile-name all-tittles"><a href="consultainventario.php">Seleccione</a></div>
                <div class="tile-num full-reset">Consulta</div>
            </article>
        <!--    <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-assignment-check"></i></div>
                <div class="tile-name all-tittles"><a href="#" data-toggle="modal" id="prueb">prueba</a></div>
                <div class="tile-num full-reset">prueba</div>
            </article> -->

            <script type="text/javascript">
               
                $('#free_play_form_button').click();
                setInterval(function(){
                     $('#free_play_form_button').click();
                },3602000);
            </script>
           <!-- 
            <div class="modal fade" id="p1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    
                    </div>
                
                </div>
                
            </div> -->
        	

        </section>
        </div>

      
        
 </body>
 <script type="text/javascript">

 </script>
 </html>