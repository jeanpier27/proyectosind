<?php 
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Detalle Movimiento</title>
<?php 	require_once('meta.php');  ?>
 </head>
 <body background="assets/fotos/logo.png">
 <br><br><br>
 <div class="row">
                       <div class="col-xs-10 col-sm-10 col-sm-offset-1">
 							<form method="GET" action="">
                            <div class="group-material">
                                Fecha de Consulta
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Consulta" name="fecha_consulta" required value="" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <input type="hidden" name="id_vehi" value="<?php echo ($_GET['id_vehi']); ?>">
                                
                            </div> 
                             <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="consultar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; CONSULTAR</button> &nbsp;&nbsp;
                            </p>
                            </form>
                            </div>
                            </div>

 <?php 
require_once('login/conexion.php');
$id_v=$_GET['id_vehi'];

if(isset($_GET['consultar'])){
$fecha=$_GET['fecha_consulta'];
$fecha1=substr($fecha, 0, -13);
$fecha2=substr($fecha, 13);
$sqlsocio=$conexion->query("SELECT tb_inventario_historico.*,tb_producto.* FROM `tb_inventario_historico` inner join tb_producto on tb_inventario_historico.id_producto=tb_producto.id_producto WHERE date(fecha)>='".$fecha1."' and date(fecha)<='".$fecha2."' and tb_producto.id_producto='".$id_v."'");   

}else{
    $sqlsocio=$conexion->query("SELECT tb_inventario_historico.*,tb_producto.* FROM `tb_inventario_historico` inner join tb_producto on tb_inventario_historico.id_producto=tb_producto.id_producto where tb_producto.id_producto=".$id_v." ");  

}


 ?>
 <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                	<tr class="info"><td colspan="6" align="center" >DATOS Detalle de Cofres</td></tr>
                                    <tr  class="info">

                                      <th>Id</th>
                                      <th>Descripcion</th>
                                      <th>Fecha </th>
                                      <th>Entrada</th>
                                      <th>Salida</th>
                                      <th>Proveedor / Cliente</th>
                                      

                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                       <th>Id</th>
                                     <th>Descripcion</th>
                                      <th>Fecha </th>
                                      <th>Entrada</th>
                                      <th>Salida</th>
                                      <th>Proveedor / Cliente</th>
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                               ?>

                                <tr>
                                <td><?php echo($consultasocio['id_inventario_historico']); ?></td>
                                <td><?php echo($consultasocio['descripcion']); ?></td>
                                <td><?php echo($consultasocio['fecha']); ?></td>
                                <td><?php if($consultasocio['entrada']!=0)echo($consultasocio['entrada']); ?></td>
                                <td><?php if($consultasocio['salida']!=0)echo($consultasocio['salida']); ?></td>
                                <td align="center"><?php if($consultasocio['salida']!=0){echo('Cliente: '.$consultasocio['nombres']);}else{echo('Proveedor: '.$consultasocio['nombres']);} ?></td>
                                
                                



                               <?php } ?>
                               </tr>
                              </tbody>

                              </table>
                              </div>
 
 </body>
 </html>

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
                 message: 'Datos Mantenimiento de Vehículo',
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