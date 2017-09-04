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
            <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Configuracion</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                       <?php if(isset($_GET['id'])){ 
                          $sqlupd=$conexion->query("select * from tb_pagos_contable where id_pagos_contable=".$_GET['id']); 
                           while($consultasocioup=mysqli_fetch_array($sqlupd)){
                        ?>
                        <form action="" method="post">
                        <input type="hidden" name="id_person" value="<?php echo $_GET['id']; ?>">
                         
                         

                           <label>Descripcion</label>
                           <input type="text" name="descripcion" readonly value="<?php echo $consultasocioup['descripcion']; ?>">
                           
                            <label>Valor</label>
                            <input type="text" name="valor" class="numero" required value="<?php echo $consultasocioup['valor']; ?>">    
                      
                           
                           <br>
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="actualizar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Actualizar</button> &nbsp;&nbsp;
                            </p>
                           
                          </form>

                       <?php }} ?>
                      <br><br>

                      <?php 
                      if(isset($_POST['actualizar'])){
                        $id_per=$_POST['id_person'];
                        $descripcion = $_POST['descripcion'];
                        $tipo = $_POST['valor'];         
                       
                        $query="update tb_pagos_contable set valor='".$tipo."' where id_pagos_contable=".$id_per;
                        $a=$conexion->query($query);     
                        if($a){
                          echo '<script type="text/javascript">swal({title: "ok", text: "Actualizacion con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="confcontable.php";});</script>';   
                        }else{
                          echo '<script type="text/javascript">swal("Error!", "No se pudo actualizar datos!", "error")</script>';
                        }


                      }

                      ?>
<?php 
// if(isset($_GET['consultar'])){ 

    $sqlproducto=$conexion->query("select * from tb_pagos_contable"); 

 
    ?>
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                    
                                      <th>Id</th>
                                      <th>Descripcion</th>
                                      <th>Valor</th>                                  
                                      
                                      <th></th>
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                  
                                     
                                      
                                      <th>Id</th>
                                      <th>Descripcion</th>
                                      <th>Valor</th>                                  
                                                                        
                                      
                                      <th></th>
                                      


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlproducto)){
                               ?>

                                <tr>
                                
                                <td><?php echo($consultasocio['id_pagos_contable']); ?></td>
                                <td><?php echo($consultasocio['descripcion']); ?></td>
                               
                                <td><?php echo($consultasocio['valor'].' %'); ?></td>
                                <th><a class="btn btn-info" href="confcontable.php?id=<?php echo $consultasocio['id_pagos_contable']; ?>"><i class="glyphicon glyphicon-pencil"></i></a></th>



                               <?php } ?>
                               </tr>
                              </tbody>

                              </table>
                              </div>
<?php 
// } 
?>

                       </div>
                       </div>
            

        <!-- </section> -->
        </div>

      
        
 </body>
 <script type="text/javascript">

$(document).ready(function(){
            $('#contconfig').attr("style","display:block;");
            $('#confcontable').attr("style","background-color:#E75A5A;");

    $('#tabladatos').DataTable({
    
        "language": { 
    "sProcessing":     "Procesando...", 
    "sLengthMenu":     "Mostrar _MENU_ registros", 
    "sZeroRecords":    "No se encontraron resultados", 
    "sEmptyTable":     "Ningún dato disponible en esta tabla", 
    "sInfo":           "Mostrando registros del  _START_  al _END_ de un total de _TOTAL_ registros", 
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", 
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", 
    "sInfoPostFix":    "", 
    "sSearch":         "Buscar:", 

    "sUrl":            "", 
    "sInfoThousands":  ",", 
    "sLoadingRecords": "Cargando...", 
    "oPaginate": {
 
        "sFirst":    "Primero", 
        "sLast":     "Último",
        "sNext":     "Siguiente", 
        "sPrevious": "Anterior"
 
    }
  }
    } );
} );

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

 </script>
 </html>