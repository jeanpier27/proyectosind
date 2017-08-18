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
 <script type="text/javascript">
    $(document).ready(function(){
            $('#contsocio').attr("style","display:block;");
            $('#vehiculo').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Actualizar Vehículo</small></h1>
            </div>
        </div>
     <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Actualizar Vehículo</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <?php if(isset($_GET['id'])){
                         $sqlupd=$conexion->query("select * from tb_vehiculo where id_vehiculo=".$_GET['id']); 
                           while($consultasocioup=mysqli_fetch_array($sqlupd)){
                        ?>
                        <form action="" method="post">
                        <input type="hidden" name="id_vehiculo" value="<?php echo $_GET['id']; ?>">

                           <label>PLACA O RAMV</label>
                           <input type="text" name="placa" onkeyup="javascript:this.value=this.value.toUpperCase();" required class="" value="<?php echo $consultasocioup['placa']; ?>">
                           <label>Marca</label>
                           <input type="text" name="marca" onkeyup="javascript:this.value=this.value.toUpperCase();" required class="letras" value="<?php echo $consultasocioup['marca']; ?>">
                           <label>Modelo</label>
                           <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" name="modelo" maxlength="10" required class="" value="<?php echo $consultasocioup['modelo']; ?>">
                           <label>Motor</label>
                           <input type="text" name="motor" maxlength="40" onkeyup="javascript:this.value=this.value.toUpperCase();" required class="" value="<?php echo $consultasocioup['motor']; ?>">
                           
                           <label>Chasis</label>
                           <input type="text" name="chasis" maxlength="40" onkeyup="javascript:this.value=this.value.toUpperCase();" required value="<?php echo $consultasocioup['chasis']; ?>">
                           <br>
                           <label>Año Produccion</label>
                          <select class="selectpicker " name="año_produccion" required="">
                            <?php 
                                $hoy=$consultasocioup['año_produccion'];;
                                $atras=$hoy-15;
                                $hasta=$hoy+5;
                                for($i=$hasta;$i>=$atras;$i--){?>
                                     <option <?php if($consultasocioup['año_produccion']==$i){echo 'selected';} ?> value="<?php echo $i; ?>"><?php echo ($i); ?></option>
 
                              <?php    }

                              ?>                      

                               </select>

                           <label>Fecha de inicio y fin Poliza</label> 
                           <input type="text"  required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="Fecha de fin de Poliza " readonly="" title="Describa la fecha" name="fecha_fin_poliza" value="<?php echo $consultasocioup['fecha_inicio_poliza'].' - '.$consultasocioup['fecha_fin_poliza']; ?>">                      
                        
                          <label>Fecha de Vencimiento Matricula</label>
                         <input type="text" required="" maxlength="20"  data-toggle="tooltip" data-placement="top"  placeholder="Escribe Vencimiento de matricula del Vehículo" title="Fecha Vehiculo" readonly="" name="venci_matricula" value="<?php echo $consultasocioup['fecha_venci_matricula']; ?>">

            
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
                       <?php 
                       if(isset($_POST['actualizar'])){
                        $id_vehic=$_POST['id_vehiculo'];
                        $fechas= $_POST['fecha_fin_poliza'];     
                        $placa      = $_POST['placa'];
                        $marca      = $_POST['marca'];
                        $modelo      = $_POST['modelo'];
                        $motor      = $_POST['motor'];
                        $chasis      = $_POST['chasis'];
                        $ano_produc       = $_POST['año_produccion'];
                        $fecha_ini_poli     = substr($fechas, 0, -13); 
                        $fecha_fin_poli     = substr($fechas, -10);                    
                        $fecha_venci_matri   =$_POST['venci_matricula'];
                        $estado=$_POST['estado'];
                        $observacion=$_POST['observacion'];
                        $observacionbd=$_POST['observacionbd'];
                        $fecha=date('Y-m-d H:i:s');
                        $observaciontotal=$observacionbd.' ('.$fecha.' usuario: '.$_SESSION['nombres'].'.- '.$observacion.')';
                        $query="call actualizar_vehiculo('$id_vehic','$placa','$marca','$modelo','$motor','$chasis', '$ano_produc','$fecha_ini_poli','$fecha_fin_poli','$fecha_venci_matri','$observaciontotal','$estado')";
                        $a=$conexion->query($query);     
                        if($a){
                          echo '<script type="text/javascript">swal({title: "ok", text: "Actualizacion con exito...!", type: "success", showCancelButton: true,  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="updatevehiculo.php";});</script>';   
                        }else{
                          echo '<script type="text/javascript">swal("Error!", "No se pudo actualizar datos del socio!", "error")</script>';
                        }

                      }



                        ?>
                     
<?php 
// if(isset($_GET['consultar'])){ 


    $sqlsocio=$conexion->query("select * from tb_vehiculo order by fecha_factura"); 

 
    ?>
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                      <th>Id</th>
                                      <th>Placa</th>
                                      <th>Marca</th>
                                      <th>Modelo</th>
                                      <th>Motor</th>
                                      <th>Chasis</th>
                                      <th>Año Produccion</th>
                                      <th>Fecha inicio poliza</th>
                                      <th>Fecha fin poliza</th>
                                      <th>Fecha vencimiento matricula</th>
                                      <th>Estado</th>
                                      <th>Observacion</th>
                                      <th></th>


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                      <th>Id</th>
                                      <th>Placa</th>
                                      <th>Marca</th>
                                      <th>Modelo</th>
                                      <th>Motor</th>
                                      <th>Chasis</th>
                                      <th>Año Produccion</th>
                                      <th>Fecha inicio poliza</th>
                                      <th>Fecha fin poliza</th>
                                      <th>Fecha vencimiento matricula</th>
                                      <th>Estado</th>
                                      <th>Observacion</th>
                                      <th></th>


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                               ?>

                                <tr>
                                <td><?php echo($consultasocio['id_vehiculo']); ?></td>
                                <td><?php echo($consultasocio['placa']); ?></td>
                                <td><?php echo($consultasocio['marca']); ?></td>
                                <td><?php echo($consultasocio['modelo']); ?></td>
                                <td><?php echo($consultasocio['motor']); ?></td>
                                <td><?php echo($consultasocio['chasis']); ?></td>
                                <td><?php echo($consultasocio['año_produccion']); ?></td>
                                <td><?php echo($consultasocio['fecha_inicio_poliza']); ?></td>
                                <td><?php echo($consultasocio['fecha_fin_poliza']); ?></td>
                                <td><?php echo($consultasocio['fecha_venci_matricula']); ?></td>
                                <td><?php echo($consultasocio['estado']); ?></td>
                                <td><?php echo($consultasocio['observacion']); ?></td>
                                <th><a class="btn btn-info" href="updatevehiculo.php?id=<?php echo $consultasocio['id_vehiculo']; ?>"><i class="glyphicon glyphicon-pencil"></i></a></th>



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
                   
                    $('input[name=fecha_consulta]').daterangepicker({
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

                    $('input[name="fecha_consulta"]').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                  });

                    $('input[name="fecha_consulta"]').on('cancel.daterangepicker', function(ev, picker) {
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

$('input[name=venci_matricula]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                         autoUpdateInput: false,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 30,
                        locale: {
                          cancelLabel: 'Clear',
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

    $('input[name="venci_matricula"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

       $('input[name="venci_matricula"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

  $('input[name=fecha_fin_poliza]').daterangepicker({
                        showDropdowns: true,
                         autoUpdateInput: false,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 30,
                        locale: {
                          cancelLabel: 'Clear',
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

    $('input[name="fecha_fin_poliza"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD')+ ' - ' + picker.endDate.format('YYYY-MM-DD'));
  });

       $('input[name="fecha_fin_poliza"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

} );

 </script>
 </html>