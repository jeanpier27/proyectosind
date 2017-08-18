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
              $('#contreporte').attr("style","display:block;");
            $('#reportecontable').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Ingresos-Egresos-Sindicato</small></h1>
            </div>
        </div>
     <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Consulta</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                       <form method="GET" action="">
                            <div class="group-material">
                                Fecha de Consulta

                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Consulta" name="fecha_consulta" required value="  <?php if(isset($_GET['fecha_consulta'])){ echo $_GET['fecha_consulta'];} ?>" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                             <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="consultar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; CONSULTAR</button> &nbsp;&nbsp;
                            </p>
                            </form>
                            </div>
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
$sqlsocio=$conexion->query("SELECT sum(tb_ingreso_sindicato.saldo)as valor,tb_plan_cuentas.descripcion FROM `tb_ingreso_sindicato` inner join tb_plan_cuentas on tb_ingreso_sindicato.id_plan_cuentas=tb_plan_cuentas.id_plan_cuentas where tb_ingreso_sindicato.fecha>='".$fecha1."' and tb_ingreso_sindicato.fecha<='".$fecha2."' GROUP by tb_ingreso_sindicato.id_plan_cuentas"); 

 
    ?>  
    <br><br><br><br><br>
                            <p class="text-center">
                            <center>
                              </center>
                                <!-- <button  name="consultar" id="registra" type="button" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; INGRESOS</button> &nbsp;&nbsp; -->
                            </p>
                            <p class="text-center">
                            <center>
                              <h1>INGRESOS<span id="ingr"></span></h1>
                              </center>
                                <!-- <button  name="consultar" id="registra" type="button" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; INGRESOS</button> &nbsp;&nbsp; -->
                            </p> 
                      
                            <div class="col-xs-12 col-sm-12" >
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                    <th></th>
                                      <th>Descripcion</th>
                                      <th>Valor</th>
                                      


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                  <th></th>
                                      <th>Descripcion</th>
                                      <th>Valor</th>

                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                               ?>

                                <tr>
                           
                             
                                <td></td>
                                <td><?php echo($consultasocio['descripcion']); ?></td>
                               
                                <td><?php echo($consultasocio['valor']); ?></td>
                                
                                  <?php 
                                    }
                                   ?>

                               </tr>
                              </tbody>

                              </table>
                              </div>



                                <p class="text-center">
                            <center>
                              <h1>EGRESOS <span id="egr"></span></h1>
                              </center>
                                <!-- <button  name="consultar" id="registra" type="button" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; INGRESOS</button> &nbsp;&nbsp; -->
                            </p>
                        
                            <div class="col-xs-12 col-sm-12" >
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos2">
                                <thead>
                                    <tr  class="info">
                                      <th>Descripcion</th>
                                      <th>Valor</th>


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                     <th>Descripcion</th>
                                      <th>Valor</th>


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                              
                              $sqlegreso=$conexion->query("SELECT sum(tb_egreso_sindicato.saldo)as valor,tb_plan_cuentas.descripcion FROM `tb_egreso_sindicato` inner join tb_plan_cuentas on tb_egreso_sindicato.id_plan_cuentas=tb_plan_cuentas.id_plan_cuentas where tb_egreso_sindicato.fecha>='".$fecha1."' and tb_egreso_sindicato.fecha<='".$fecha2."' GROUP by tb_egreso_sindicato.id_plan_cuentas");
                                while($consultasoci=mysqli_fetch_array($sqlegreso)){
                               ?>

                                <tr>
                             
                                <td><?php echo($consultasoci['descripcion'].' '.$facturas); ?></td>
                                <td><?php echo($consultasoci['valor']); ?></td>
                                


                               <?php } ?>
                               </tr>
                              </tbody>

                              </table>
                              </div>
<?php 
 }
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
                        linkedCalendars: false,
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
        }, "order": [[ 0, "desc" ]],
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
                 message: 'INGRESOS SINDICATO',
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


    $('#tabladatos2').DataTable({
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
        }, "order": [[ 0, "desc" ]],
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
                 message: 'EGRESOS SINDICATO',
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