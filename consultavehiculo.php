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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Consultar Vehículo</small></h1>
            </div>
        </div>
     <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Consulta de Vehículo</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <form method="GET" action="">
                            <div class="group-material">
                                Fecha de Consulta
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Consulta" name="fecha_consulta" required value="" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                             <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="consultar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; CONSULTAR</button> &nbsp;&nbsp;
                            </p>
                            </form>
<?php 
// if(isset($_GET['consultar'])){ 

$fecha=$_GET['fecha_consulta'];
$fecha1=substr($fecha, 0, -13);
$fecha2=substr($fecha, 13);
// echo ($fecha1.$fecha2);
if(isset($_GET['consultar'])){
$fecha=$_GET['fecha_consulta'];
$fecha1=substr($fecha, 0, -13);
$fecha2=substr($fecha, 13);
$sqlsocio=$conexion->query("select * from tb_vehiculo where fecha_factura>='".$fecha1."' and fecha_factura<='".$fecha2."' order by fecha_factura");   
}else{
    $sqlsocio=$conexion->query("select * from tb_vehiculo order by fecha_factura"); 
}
 
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
                                      <!-- <th>Observacion</th> -->


                                      
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
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                               ?>

                                <tr>
                                <td><?php echo($consultasocio['id_vehiculo']); ?></td>
                                <td><?php echo($consultasocio['placa']); ?></td>
                                <?php  $consulmarca=$conexion->query("select descripcion from tb_marca where id_marca=".$consultasocio['id_marca']);
                                  $marc=mysqli_fetch_array($consulmarca);
                                  $consulmodelo=$conexion->query("select descripcion from tb_modelo where id_marca=".$consultasocio['id_marca']." and id_modelo=".$consultasocio['id_modelo']);
                                  $mode=mysqli_fetch_array($consulmodelo);

                                ?>
                                <td><?php echo($marc[0]); ?></td>
                                <td><?php echo($mode[0]); ?></td>
                                <td><?php echo($consultasocio['motor']); ?></td>
                                <td><?php echo($consultasocio['chasis']); ?></td>
                                <td><?php echo($consultasocio['año_produccion']); ?></td>
                                <td><?php echo($consultasocio['fecha_inicio_poliza']); ?></td>
                                <td><?php echo($consultasocio['fecha_fin_poliza']); ?></td>
                                <td><?php echo($consultasocio['fecha_venci_matricula']); ?></td>
                                <td><?php echo($consultasocio['estado']); ?></td>
                                <td><?php echo($consultasocio['observacion']); ?></td>
                                <th><a class="btn btn-primary"  onClick="window.open('consultamantenimiento.php?id_vehi=<?php echo($consultasocio['id_vehiculo']); ?>', 'prueba', 'width=800, height=600')"><i class="glyphicon glyphicon-search"></i></a></th>



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
      initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
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
},

        dom: 'Bfrtip',
       buttons: [
            {
                extend: 'print', text:'Imprimir',
                 message: 'Datos de Vehículos',
                exportOptions: {
                    columns: ':visible',
                    
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="http://www.ferreteriaquintana.com/sindicato/assets/fotos/thumbnail_escudo%20-%20copia.jpg" style="opacity: 0.2; position:absolute;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                    }
            },
            {
              extend:   'colvis',
              text:'Seleccione las Columnas a imprimir'
            },
            {
              extend:   'excel',
              text:'Exportar a Excel',
              exportOptions: {
                    columns: ':visible',
                    
                },
              
            },
            {
              extend:   'pdfHtml5',
              text:'Exportar a PDF',
              orientation: 'landscape',
                pageSize: 'A4',
              exportOptions: {
                    columns: ':visible',
                    
                },
                
              
            },
            

        ],
        columnDefs: [ {

            
            targets: 0,
            visible: false
        },

         ]
    } );
} );

 </script>
 </html>