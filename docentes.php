<!DOCTYPE html>
<html lang="es">
<head>
    <title>DOCENTES</title>
    <?php 
    session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
        include('meta.php');
     ?>
</head>
<body>
 <script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#docentes').attr("style","background-color:#E75A5A;");
              
            });
</script>
<!-- ***********************************menu de opciones****************************** -->
<!-- ***********************************menu de opciones****************************** -->
<!-- ***********************************menu de opciones****************************** -->

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

<!-- ***********************************opciones de docentes****************************** -->
<!-- ***********************************opciones de docentes****************************** -->
<!-- ***********************************opciones de docentes****************************** -->



   
    <div class="content-page-container full-reset custom-scroll-containers">




        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="assets/img/logo.png" alt="user-picture" class="img-responsive img-circle center-box">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles"><?php echo $_SESSION['cuenta1'];  echo $_SESSION['cuenta2'];  ?></span>
                </li>
                <li  class="tooltips-general exit-system-button" data-href="../login/cerrar_sesion.php" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i> 
                <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
            </ul>
        </nav>





        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">SINDICATO DE CHOFERES DE NARANJAL <small> - Docentes</small></h1>
            </div>
        </div>




           
        <section class="full-reset text-center" style="padding: 40px 0;">
            <!-- <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-face"></i></div>
                <div class="tile-name all-tittles"><a href="../datos-docente.php">Seleccione</a></div>
                <div class="tile-num full-reset">Consulta</div>
            </article> -->
            <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-accounts"></i></div>
                <div class="tile-name all-tittles"><a href="adddocente.php">Seleccione</a></div>
                <div class="tile-num full-reset">Registro</div>
            </article>
            
            <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-delete"></i><i class="zmdi zmdi-time-restore"></i></div>
                <div class="tile-name all-tittles"><a href="updadocente.php">Seleccione</a></div>
                <div class="tile-num full-reset">Actualizar datos</div>
            </article> 

            <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-check-all"></i></div>
                <div class="tile-name all-tittles"><a href="docente_materia.php">Seleccione</a></div>
                <div class="tile-num full-reset">Materias Curso</div>
            </article>

            <!-- <article class="tile">
                <div class="tile-icon full-reset"><i class="zmdi zmdi-check-all"></i></div>
                <div class="tile-name all-tittles"><a href="docente_curso.php">Seleccione</a></div>
                <div class="tile-num full-reset">Asignar Cursos</div>
            </article>  -->    
        </section>
           
           
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    Todo el sistema esta hecho acorde a las necesidades del sindicato, cualquier duda o inconveniente, comunicarse con los desarrolladores del sistema. Gracias.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div> 
    </div>
</body>
</html>
<?php 
$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='ss') {
    
    echo '<script type="text/javascript">swal("OK", "docente registrado con exito", "success")</script>';

} elseif ($MSG=='tuerror') {
    
    echo '<script type="text/javascript">swal("Error!", "No se pudo registrar este docente", "error")</script>';

} elseif ($MSG=='nada') {

}elseif ($MSG=='tderror') {
    
    echo '<script type="text/javascript">swal("Error!", "No se pudo registrar este docente", "error")</script>';

}elseif($MSG=='repetido'){
    echo '<script type="text/javascript">swal("Error!", "Ya se encuentra registrado este docente", "warning")</script>';
}

 ?>