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
            $('#contsocio').attr("style","display:block;");
            $('#rh').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Actualizar Empleado</small></h1>
            </div>
        </div>
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Actualizar Empleado</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <?php if(isset($_GET['id'])){ 
                          $sqlupd=$conexion->query("select tb_personas.*, tb_empleado.* from tb_personas inner join tb_empleado on tb_personas.id_persona=tb_empleado.id_persona where tb_empleado.id_persona=".$_GET['id']); 
                           while($consultasocioup=mysqli_fetch_array($sqlupd)){
                        ?>
                        <form action="" method="post">
                        <input type="hidden" name="id_person" value="<?php echo $_GET['id']; ?>">

                           <label>Nombre</label>
                           <input type="text" name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required class="letras" value="<?php echo $consultasocioup['nombre']; ?>">
                           <label>Apellido</label>
                           <input type="text" name="apellido" onkeyup="javascript:this.value=this.value.toUpperCase();" required class="letras" value="<?php echo $consultasocioup['apellido']; ?>">
                           <label>Telefono1</label>
                           <input type="text" name="telef1" maxlength="10" required class="numero" value="<?php echo $consultasocioup['telefono1']; ?>">
                           <label>Telefono2</label>
                           <input type="text" name="telef2" maxlength="10" required class="numero" value="<?php echo $consultasocioup['telefono2']; ?>">
                           <label>Telefono3</label>
                           <input type="text" name="telef3" maxlength="10" required class="numero" value="<?php echo $consultasocioup['telefono3']; ?>"><br>
                           <label>Direccion</label>
                           <input type="text" name="direccion" onkeyup="javascript:this.value=this.value.toUpperCase();" required value="<?php echo $consultasocioup['direccion']; ?>">
                           <label>Correo</label>
                           <input type="email" name="correo"  required value="<?php echo $consultasocioup['correo']; ?>">
                           <label>Estado Civil</label>                           
                           <select  name="estado_civil" >                                 
                                   <option value="SOLTERO/A" <?php if($consultasocioup['estado_civil']=='SOLTERO/A'){echo 'selected';} ?> >SOLTERO/A</option>
                                   <option value="CASADO/A" <?php if($consultasocioup['estado_civil']=='CASADO/A'){echo 'selected';} ?> >CASADO/A</option>
                                   <option value="VIUDO/A" <?php if($consultasocioup['estado_civil']=='VIUDO/A'){echo 'selected';} ?> >VIUDO/A</option>
                                   <option value="DIVORCIADO/A" <?php if($consultasocioup['estado_civil']=='DIVORCIADO/A'){echo 'selected';} ?> >DIVORCIADO/A</option>
                                   <option value="UNIDO/A" <?php if($consultasocioup['estado_civil']=='UNIDO/A'){echo 'selected';} ?> >UNIDO/A</option>
                                   <option value="OTRO" <?php if($consultasocioup['estado_civil']=='OTRO'){echo 'selected';} ?> >OTRO</option>
                               </select>
                         <br>
                            <label>Fecha de Inicio y Fecha de fin</label>
                           <input type="text" name="fecha_inicio" readonly="" value="<?php echo $consultasocioup['fecha_inicio'].' - '.$consultasocioup['fecha_fin']; ?>">

                           <label>Sueldo</label>
                           <input type="text" name="sueldo" class="numero" value="<?php echo $consultasocioup['sueldo']; ?>">
                           <label>Cargo</label>
                           <input type="text" name="cargo" readonly="" value="<?php echo $consultasocioup['cargo']; ?>">
                          
                           <label>Estado</label>
                          <select  name="estado" >                                 
                                   <option value="ACTIVO" <?php if($consultasocioup['estado']=='ACTIVO'){echo 'selected';} ?> >ACTIVO</option>
                                   <option value="INACTIVO" <?php if($consultasocioup['estado']=='INACTIVO'){echo 'selected';} ?> >INACTIVO</option>
                                  
                                   
                               </select>
                      
                           <label>Observacion</label>
                           <input type="text" name="observacion" onkeyup="javascript:this.value=this.value.toUpperCase();" required >
                           <input type="hidden" name="observacionbd" value="<?php echo $consultasocioup['observacion']; ?>">
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
                        $nombressocio = $_POST['nombre'];
                        $apellidossocio = $_POST['apellido'];
                        $telefonousocio= $_POST['telef1'];
                        $telefonodsocio= $_POST['telef2'];
                        $telefonotsocio= $_POST['telef3'];
                        $direccionsocio = $_POST['direccion']; 
                        $correo = $_POST['correo']; 
                        $estado_civil = $_POST['estado_civil']; 
                        $sueldo=$_POST['sueldo'];
                        $cargo=$_POST['cargo'];
                        $fecha_in = $_POST['fecha_inicio'];
                        $fecha1=substr($fecha_in, 0, -13);
                        $fecha2=substr($fecha_in, 13);
                        $fecha_inicio=$fecha1;
                        $fecha_fin=$fecha2;
                        $observacion = $_POST['observacion'];
                        $estado = $_POST['estado'];
                        $observacionbd = $_POST['observacionbd'];
                        $fecha=date('Y-m-d H:i:s');
                        $observaciontotal=$observacionbd.' ('.$fecha.' usuario: '.$_SESSION['nombres'].'.- '.$observacion.')';


                        $query="call actualizar_empleado('$id_per','$nombressocio','$apellidossocio','$telefonousocio','$telefonodsocio','$telefonotsocio', '$direccionsocio','$correo','$estado_civil','$fecha_inicio','$fecha_fin','$sueldo','$cargo','$observaciontotal','$estado')";


                        $a=$conexion->query($query);     
                        if($a){
                          echo '<script type="text/javascript">swal({title: "ok", text: "Actualizacion con exito...!", type: "success", showCancelButton: true,  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="updateempleado.php";});</script>';   
                        }else{
                          echo '<script type="text/javascript">swal("Error!", "No se pudo actualizar datos del socio!", "error")</script>';
                        }


                      }

                      ?>


                      
<?php 

    $sqlsocio=$conexion->query("SELECT tb_empleado.*,tb_personas.* FROM `tb_empleado` inner join tb_personas on tb_empleado.id_persona=tb_personas.id_persona order by tb_personas.apellido "); 

    ?>
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                        <th>Id</th>
                                      <th>Cedula</th>
                                      <th>Empleado</th>
                                      <th>Telefono</th>
                                      <th>Direccion</th>
                                      <th>Correo</th>
                                      <th>Fecha Inicio</th>
                                      <th>Fecha Fin</th>
                                      <th>Cargo</th>
                                      <th>Sueldo</th>
                                      <th>Estado</th>
                                      <th>Observacion</th>
                                      <th></th>

                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                        <th>Id</th>
                                      <th>Cedula</th>
                                      <th>Empleado</th>
                                      <th>Telefono</th>
                                      <th>Direccion</th>
                                      <th>Correo</th>
                                      <th>Fecha Inicio</th>
                                      <th>Fecha Fin</th>
                                      <th>Cargo</th>
                                      <th>Sueldo</th>
                                      <th>Estado</th>
                                      <th>Observacion</th>
                                      <th></th>
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                               ?>

                                <tr>
                                <td><?php echo($consultasocio['id_persona']); ?></td>
                                <td><?php echo($consultasocio['cedula_ruc']); ?></td>
                                <td><?php echo($consultasocio['apellido'].' '.$consultasocio['nombre']); ?></td>
                                <td><?php echo('1.-'.$consultasocio['telefono1'].'<br>2.-'.$consultasocio['telefono2'].'<br>3.-'.$consultasocio['telefono3']); ?></td>
                                <td><?php echo($consultasocio['direccion']); ?></td>
                                <td><?php echo($consultasocio['correo']); ?></td>
                                <td><?php echo($consultasocio['fecha_inicio']); ?></td>
                                <td><?php echo($consultasocio['fecha_fin']); ?></td>
                                <td><?php echo($consultasocio['cargo']); ?></td>
                                <td><?php echo($consultasocio['sueldo']); ?></td>
                                <td><?php echo($consultasocio['estado']); ?></td>
                                <td><?php echo($consultasocio['observacion']); ?></td>
                                <th><a class="btn btn-info" href="updateempleado.php?id=<?php echo $consultasocio['id_persona']; ?>"><i class="glyphicon glyphicon-pencil"></i></a></th>



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
                   
              $('input[name=fecha_inicio]').daterangepicker({
                         linkedCalendars: false,
                        autoUpdateInput: false,
                        showDropdowns: true,
                        locale: {
                          cancelLabel: 'Clear',
                          linkedCalendars: false,
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

                    $('input[name="fecha_inicio"]').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                  });

                    $('input[name="fecha_inicio"]').on('cancel.daterangepicker', function(ev, picker) {
                      $(this).val('');
                  });

 		
 	});
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
 
    },
 
    "oAria": { 
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente", 
        "sSortDescending": ": Activar para ordenar la columna de manera descendente" 
    } 
}
    } );


    $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
                });
} );



 </script>
 </html>