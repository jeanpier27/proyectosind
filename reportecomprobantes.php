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
     ?>
</head>
<body>
 <script type="text/javascript">
    $(document).ready(function(){
            $('#contreporte').attr("style","display:block;");
            $('#reportecomprobantes').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - INGRESOS - EGRESOS </small></h1>
            </div>
            <section class="full-reset text-center" style="padding: 40px 0;">
            <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-folder"></i></div>
                <div class="tile-name all-tittles"><a href="repconsultacompsindicato.php">Socios</a></div>
                <div class="tile-num full-reset">SINDICATO</div>
            </article>
            <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-folder"></i></div>
                <div class="tile-name all-tittles"><a href="repconsultacompescuela.php" id="addsocio">Socios</a></div>
                <div class="tile-num full-reset">ESCUELA</div>
           
           
           <!--  <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-book"></i></div>
                <div class="tile-name all-tittles" style="width: 90%;"><a href="../datos-cuota.php">Consulta</a></div>
                <div class="tile-num full-reset">Recaudaciones</div>
            </article>  -->
        </section>
        </div>

</body>
</html>

<script type="text/javascript">
    // $('#addsocio').click(function(){
    //      // alert('hola');
    //      $('#contenedor').load('vistas/addsocio.php');
    //     });
    // $('#addrecaudacion').click(function(){
    //      // alert('hola');
    //      $('#contenedor').load('vistas/recaudaciones.php');
    //     });
</script>