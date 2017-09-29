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
 <script type="text/javascript">
   $(document).ready(function(){
            $('#contconfig').attr("style","display:block;");
            $('#usuarios').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Cargos </small></h1>
            </div>
        </div>
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Cargos </div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <?php if(isset($_GET['id'])){ 
                          $sqlupd=$conexion->query("SELECT * FROM `tb_tipo_usuario` where id_tipo_usuario='".$_GET['id']."'"); 
                           while($consultasocioup=mysqli_fetch_array($sqlupd)){
                        ?>
                        <form action="" method="post">
                          <center>  
                        <input type="hidden" name="id_person" value="<?php echo $_GET['id']; ?>">
                         
                         

                           <label>Cargo</label>
                           <input type="text" name="descripcion" required value="<?php echo $consultasocioup['tipo_usuario']; ?>">
                                        
                           
                           <br>
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="actualizar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Actualizar</button> &nbsp;&nbsp;
                            </p>
                           </center>
                          </form>

                       <?php }} ?>
                      <br><br>

                      <?php 
                      if(isset($_POST['actualizar'])){
                        $id_per=$_POST['id_person'];
                        $descripcion = $_POST['descripcion'];
                        $tipo = $_POST['tipo_usuario'];                       
                        $estado = $_POST['estado'];
                       
                        $query="update tb_tipo_usuario set tipo_usuario='".$descripcion."'  where id_tipo_usuario=".$id_per;
                        $a=$conexion->query($query);     
                        if($a){
                          echo '<script type="text/javascript">swal({title: "ok", text: "Actualizacion con exito...!", type: "success", showCancelButton: true,  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="cargos.php";});</script>';   
                        }else{
                          echo '<script type="text/javascript">swal("Error!", "No se pudo actualizar datos!", "error")</script>';
                        }


                      }

                      ?>
<?php 
// if(isset($_GET['consultar'])){ 

    $sqlproducto=$conexion->query("SELECT * FROM `tb_tipo_usuario`"); 

 
    ?>

                              <div class="form-inline">
                                <a class="btn btn-success pull-right" href="cargos.php?nuevo"><span class="glyphicon glyphicon-list-alt" ></span> Nuevo Cargo</a>
                              </div>
                              <br><br>
                              <?php 
                                if(isset($_GET['nuevo'])){?>
                                
                                <form action="" method="post">
                                  <center>
                                    <label >Nuevo Cargo</label>
                                    <input type="text" name="cargo" required=""><br>
                                    <a href="cargos.php" class="btn btn-warning">CANCELAR</a>
                                    <input type="submit" class="btn btn-success" name="gcargo" value="GUARDAR">
                                  </center>
                                </form>


                              <?php if(isset($_POST['gcargo'])){
                                $cargo=$_POST['cargo'];

                                $sql=$conexion->query("insert into tb_tipo_usuario (tipo_usuario)values('".$cargo."')");
                                if($sql){
                          echo '<script type="text/javascript">swal({title: "ok", text: "Guardado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="cargos.php";});</script>';   
                        }else{
                          echo '<script type="text/javascript">swal("Error!", "No se pudo guardar datos!", "error")</script>';
                        }

                              } ?>


                             <?php  }?>   


                               
                              <br><br><br><br>
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                    
                                      <th>Id</th>
                                      <th>Cargo</th>                                   
                                      
                                      <th></th>
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                  
                                     
                                      
                                      <th>Id</th>
                                      <th>Cargo</th>                                 
                                      
                                      <th></th>
                                      


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlproducto)){
                               ?>

                                <tr>
                                
                                <td><?php echo($consultasocio['id_tipo_usuario']); ?></td>
                               
                                <td><?php echo($consultasocio['tipo_usuario']); ?></td>
                                <th><a class="btn btn-info" href="cargos.php?id=<?php echo $consultasocio['id_tipo_usuario']; ?>"><i class="glyphicon glyphicon-pencil"></i></a></th>



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