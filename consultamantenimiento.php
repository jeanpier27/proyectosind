<?php 
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Mantenimiento Vehículos</title>
<?php 	require_once('meta.php');  ?>
 </head>
 <body background="assets/fotos/logo.png">

 <?php 
require_once('login/conexion.php');
$id_v=$_GET['id_vehi'];
$sqlsocio=$conexion->query("select tb_mantenimiento_vehiculo.id_mant_vehiculo,tb_mantenimiento_vehiculo.n_factura,tb_mantenimiento_vehiculo.fecha_fact,tb_mantenimiento_vehiculo.descripcion,tb_mantenimiento_vehiculo.valor,tb_mantenimiento_vehiculo.id_proveedor as proveed,tb_vehiculo.* from tb_mantenimiento_vehiculo inner join tb_vehiculo on tb_mantenimiento_vehiculo.id_vehiculo=tb_vehiculo.id_vehiculo where tb_mantenimiento_vehiculo.id_vehiculo=".$id_v.""); 



 ?>
 <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                	<tr class="info"><td colspan="7" align="center" >DATOS MANTENIMIENTO DE VEHÍCULO</td></tr>
                                    <tr  class="info">

                                     <th>Id</th>
                                      <th>Vehículo</th>
                                      <th>Proveedor</th>
                                      <th>Fecha Factura</th>
                                      <th>N.- Factura</th>
                                      <th>Descripcion</th>
                                      <th>Valor</th>
                                      <!-- <th>Motor</th>
                                      <th>Chasis</th>
                                      <th>Año Produccion</th>
                                      <th>Fecha inicio poliza</th>
                                      <th>Fecha fin poliza</th>
                                      <th>Fecha vencimiento matricula</th>
                                      <th>Estado</th>
                                      <th>Observacion</th>
                                      <th></th> -->
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                      <th>Id</th>
                                      <th>Vehículo</th>
                                      <th>Proveedor</th>
                                      <th>Fecha Factura</th>
                                      <th>N.- Factura</th>
                                      <th>Descripcion</th>
                                      <th>Valor</th>
                                      <!-- <th>Motor</th>
                                      <th>Chasis</th>
                                      <th>Año Produccion</th>
                                      <th>Fecha inicio poliza</th>
                                      <th>Fecha fin poliza</th>
                                      <th>Fecha vencimiento matricula</th>
                                      <th>Estado</th>
                                      <th>Observacion</th>
                                      <th></th> -->
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                               ?>

                                <tr>
                                 <?php 
                                $consultamarca=$conexion->query("select descripcion from tb_marca where id_marca=".$consultasocio['id_marca']);
                                $marca=mysqli_fetch_array($consultamarca);
                                $consultamodelo=$conexion->query("select descripcion from tb_modelo where id_modelo=".$consultasocio['id_modelo']);
                                $modelo=mysqli_fetch_array($consultamodelo);
                                $consultaproveedor=$conexion->query("select nombres from tb_proveedores where id_proveedores=".$consultasocio['proveed']);
                                $proveedor=mysqli_fetch_array($consultaproveedor);
                                 ?>
                                <td><?php echo($consultasocio['id_mant_vehiculo']); ?></td>
                               
                                <td><?php echo($consultasocio['placa'].' - '.$marca[0].' - '.$modelo[0]); ?></td>
                                <td><?php echo($proveedor[0]); ?></td>
                                <td><?php echo($consultasocio['fecha_fact']); ?></td>
                                <td><?php echo($consultasocio['n_factura']); ?></td>
                                <td><?php echo($consultasocio['descripcion']); ?></td>
                                <td><?php echo($consultasocio['valor']); ?></td>
                                
                                



                               <?php } ?>
                               </tr>
                              </tbody>

                              </table>
                              </div>
 
 </body>
 </html>

 <script type="text/javascript">
 $(document).ready(function(){
    $('#tabladatos').DataTable({
      // initComplete: function () {
      //       this.api().columns().every( function () {
      //           var column = this;
      //           var select = $('<select><option value=""></option></select>')
      //               .appendTo( $(column.footer()).empty() )
      //               .on( 'change', function () {
      //                   var val = $.fn.dataTable.util.escapeRegex(
      //                       $(this).val()
      //                   );
 
      //                   column
      //                       .search( val ? '^'+val+'$' : '', true, false )
      //                       .draw();
      //               } );
 
      //           column.data().unique().sort().each( function ( d, j ) {
      //               select.append( '<option value="'+d+'">'+d+'</option>' )
      //           } );
      //       } );
      //   },
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