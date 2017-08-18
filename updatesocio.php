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
            $('#socio').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Actualizar datos de Socio</small></h1>
            </div>
        </div>
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Actualizar Datos</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <?php if(isset($_GET['id'])){ 
                          $sqlupd=$conexion->query("select tb_personas.*, tb_socio.* from tb_personas inner join tb_socio on tb_personas.id_persona=tb_socio.id_persona where tb_socio.id_persona=".$_GET['id']); 
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
                           <input type="text" name="telef3" maxlength="10" required class="numero" value="<?php echo $consultasocioup['telefono3']; ?>">
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
                          <label>Tipo Licencia</label>
                          <select  name="tipo_licencia" >                                 
                                   <option value="C" <?php if($consultasocioup['tipo_licencia']=='C'){echo 'selected';} ?> >C</option>
                                   <option value="D" <?php if($consultasocioup['tipo_licencia']=='D'){echo 'selected';} ?> >D</option>
                                   <option value="E" <?php if($consultasocioup['tipo_licencia']=='E'){echo 'selected';} ?> >E</option>
                                   
                               </select>
                            <label>Fecha de Nacimiento</label>
                           <input type="text" name="fecha_naci" readonly="" value="<?php echo $consultasocioup['fecha_naci']; ?>">
                           <label>Fecha de Ingreso</label>
                           <input type="text" name="fecha_ingreso" readonly="" value="<?php echo $consultasocioup['fecha_ingreso']; ?>">
                          
                           <label>Beneficiario</label>
                           <input type="text" name="beneficiario" onkeyup="javascript:this.value=this.value.toUpperCase();" required value="<?php echo $consultasocioup['beneficiario']; ?>">

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
                        $tipo_licenciansocio = $_POST['tipo_licencia'];
                        $fecha_naci = $_POST['fecha_naci'];    
                        $fecha_ingreso = $_POST['fecha_ingreso'];
                        $beneficiario = $_POST['beneficiario'];
                        $observacion = $_POST['observacion'];
                        $estado = $_POST['estado'];
                        $observacionbd = $_POST['observacionbd'];
                        $fecha=date('Y-m-d H:i:s');
                        $observaciontotal=$observacionbd.' ('.$fecha.' usuario: '.$_SESSION['nombres'].'.- '.$observacion.')';
                        $query="call actualizar_socio('$id_per','$nombressocio','$apellidossocio','$telefonousocio','$telefonodsocio','$telefonotsocio', '$direccionsocio','$correo','$estado_civil','$tipo_licenciansocio','$fecha_naci','$fecha_ingreso','$beneficiario','$observaciontotal','$estado')";
                        $a=$conexion->query($query);     
                        if($a){
                          echo '<script type="text/javascript">swal({title: "ok", text: "Actualizacion con exito...!", type: "success",  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="updatesocio.php";});</script>';   
                        }else{
                          echo '<script type="text/javascript">swal("Error!", "No se pudo actualizar datos del socio!", "error")</script>';
                        }


                      }

                      ?>
<?php 
// if(isset($_GET['consultar'])){ 

    $sqlsocio=$conexion->query("select tb_personas.*, tb_socio.fecha_ingreso,tb_socio.fecha_naci,tb_socio.estado,tb_socio.observacion,tb_socio.beneficiario from tb_personas inner join tb_socio on tb_personas.id_persona=tb_socio.id_persona order by tb_personas.apellido,tb_socio.estado"); 

 
    ?>
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                    
                                      <th>Id</th>
                                      <th>Cedula</th>
                                      <th>Nombres</th>
                                      <th>Telefono</th>
                                      <th>Direccion</th>
                                      <th>Correo</th>
                                      <th>Fecha Ingreso</th>
                                      <th>Fecha Nacimiento</th>
                                      <th>Beneficiario</th>
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
                                      <th>Nombres</th>
                                      <th>Telefono</th>
                                      <th>Direccion</th>
                                      <th>Correo</th>
                                      <th>Fecha Ingreso</th>
                                      <th>Fecha Nacimiento</th>
                                      <th>Beneficiario</th>
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
                                <td><?php echo($consultasocio['fecha_ingreso']); ?></td>
                                <td><?php echo($consultasocio['fecha_naci']); ?></td>
                                <td><?php echo($consultasocio['beneficiario']); ?></td>
                                <td><?php echo($consultasocio['estado']); ?></td>
                                <td><?php echo($consultasocio['observacion']); ?></td>
                                <th><a class="btn btn-info" href="updatesocio.php?id=<?php echo $consultasocio['id_persona']; ?>"><i class="glyphicon glyphicon-pencil"></i></a></th>



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
                   
                    $('input[name=fecha_naci]').daterangepicker({
                        autoUpdateInput: false,
                        showDropdowns: true,
                        singleDatePicker: true,
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

                    $('input[name="fecha_naci"]').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('YYYY-MM-DD'));
                  });

                    $('input[name="fecha_naci"]').on('cancel.daterangepicker', function(ev, picker) {
                      $(this).val('');
                  });

              $('input[name=fecha_ingreso]').daterangepicker({
                        autoUpdateInput: false,
                        showDropdowns: true,
                        singleDatePicker: true,
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

                    $('input[name="fecha_ingreso"]').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('YYYY-MM-DD'));
                  });

                    $('input[name="fecha_ingreso"]').on('cancel.daterangepicker', function(ev, picker) {
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