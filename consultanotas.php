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
            $('#contreporte').attr("style","display:block;");
            $('#reportenotas').attr("style","background-color:#E75A5A;");
              
            });
</script>

 <script type="text/javascript">
                                       function carga_bienes() {
                                    var a = document.getElementById("promociones").value;
                                    // var b = document.getElementById("curso").value;
                                    var c = document.getElementById("jornadita").value;
                                    var d = document.getElementById("paralelo").value;
                                    // var e = document.getElementById("docente").value;
                                    // var f = document.getElementById("materi").value;
                                    location.href="consultanotas.php?promo="+a+"&jor="+c+"&para="+d;
                                    // location.href="calificaciones.php?promo="+a+"&cur="+b+"&jor="+c+"&para="+d+"&doce="+e+"&mate="+f;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }

                                
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Consultar Notas</small></h1>
            </div>
        </div>
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Consulta de Notas</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <form method="GET" action="">
                       <center>

                           <!--  <div class="group-material">
                                Fecha de Consulta
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Consulta" name="fecha_consulta" required value="" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div>  -->
                             <!-- <p class="text-center"> -->
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <!-- <button  name="consultar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; CONSULTAR</button> &nbsp;&nbsp; -->
                            <!-- </p> -->
                            <div class="group-material">
                                <span>Seleccione Promocion</span> 
                               <form autocomplete="OFF" action="" method="post" id="formreg" name="formreg">
                          <select class="selectpicker" name="promocion" id="promociones" data-live-search="true" onchange="carga_bienes();" required="">
                          <option value="0">Seleccione Promocion</option>
                           <?php
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                           $sqlpromo=$conexion->query("SELECT id_promocion, descripcion, fecha_inicio, fecha_fin FROM `tb_promocion` order by id_promocion");

                            while($row=$sqlpromo->fetch_array()){ 
                              $Id_promo = $row['id_promocion'];
                              $Ff_inicio = $row['fecha_inicio'];
                              $Ff_fin = $row['fecha_fin'];

                                ?>

                              <option value="<?php echo $Id_promo; ?>"  <?php if($Id_promo == $Promo){echo "selected='selected'";}?>   ><?php echo $row['descripcion'].' '.$Ff_inicio.' / '.$Ff_fin; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>


                          <div class="group-material">
                                <span>Seleccione Jornada </span> 
                               
                          <select class="selectpicker" name="jornada" id="jornadita" data-live-search="true" onchange="carga_bienes(this.value);" required="">
                          <option value="">Seleccione Tipo De Jornada</option>
                           <?php

                          
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                           $sqljorna=$conexion->query("SELECT distinct horario FROM `tb_estudiantes` where id_promocion='".$Promo."' ORDER BY horario ASC");

                            while($row=$sqljorna->fetch_array()){ 
                              $jornadita = $row['horario'];                             
                                ?>

                              <option value="<?php echo $jornadita; ?>"  <?php if($jornadita == $Jor){echo "selected='selected'";}?>   ><?php echo $jornadita; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>

                            <div class="group-material">
                                <span>Seleccione Paralelo </span> 
                               
                          <select class="selectpicker" name="paralelo_seleccionado" id="paralelo" data-live-search="true" onchange="carga_bienes(this.value);" required="">
                          <option value="0">Seleccione Paralelo</option>
                           <?php
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                          $Id_cur = isset($_REQUEST["cur"]) ? $_REQUEST["cur"]: 0;
                           $paralelo = isset($_REQUEST["para"]) ? $_REQUEST["para"]: 0;
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                           $sqlcurso=$conexion->query("SELECT tb_estudiantes.id_curso,tb_curso.curso FROM `tb_estudiantes` inner join tb_curso on tb_estudiantes.id_curso=tb_curso.id_curso WHERE tb_estudiantes.id_promocion='".$Promo."' and tb_estudiantes.horario='".$Jor."' group by tb_estudiantes.id_curso");

                            while($row=$sqlcurso->fetch_array()){ 

                              $cursito = $row['curso'];                             
                                ?>

                              <option value="<?php echo $row['id_curso']; ?>"  <?php if($row['id_curso'] == $paralelo){echo "selected='selected'";}?>   ><?php echo $cursito; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>
                              </center>
                            </form>
<?php 
if($Promo!=0 and $Jor!="" and $paralelo!=0){
  $consulidasignaturadocente=$conexion->query("select id_asignatura_docente from tb_asignatura_docente where id_promocion='".$Promo."' ");
  $resultid=mysqli_fetch_array($consulidasignaturadocente);

// $consulidasignaturadocente=$conexion->query("select id_asignatura_docente where id_promocion='".$Promo."' and horario='".$jor."' and id_curso='".$paralelo."'");
$consultnotas=$conexion->query("SELECT `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_estudiantes`.`id_estudiante`, `tb_notas`.`nota`, `tb_asignatura_docente`.`id_asignatura_docente` FROM `tb_personas` inner JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona` inner JOIN `tb_notas` ON `tb_notas`.`id_estudiante` = `tb_estudiantes`.`id_estudiante` inner JOIN `tb_asignatura_docente` ON `tb_notas`.`id_asignatura_docente` = `tb_asignatura_docente`.`id_asignatura_docente` where tb_asignatura_docente.id_promocion='".$Promo."' and tb_asignatura_docente.horario='".$Jor."' and tb_asignatura_docente.id_curso='".$paralelo."' group by `tb_estudiantes`.`id_estudiante` order by `tb_personas`.`apellido` ASC");

// if(isset($_GET['consultar'])){ 

// $fecha=$_GET['fecha_consulta'];
// $fecha1=substr($fecha, 0, -13);
// $fecha2=substr($fecha, 13);
// // echo ($fecha1.$fecha2);
// if(isset($_GET['consultar'])){
// $fecha=$_GET['fecha_consulta'];
// $fecha1=substr($fecha, 0, -13);
// $fecha2=substr($fecha, 13);
// $sqlsocio=$conexion->query("SELECT tb_inventario_historico.*,tb_producto.* FROM `tb_inventario_historico` inner join tb_producto on tb_inventario_historico.id_producto=tb_producto.id_producto WHERE date(fecha)>='".$fecha1."' and date(fecha)<='".$fecha2."'");   

// $sqlsocio=$conexion->query("SELECT tb_inventario_historico.*,tb_producto.* FROM `tb_inventario_historico` inner join tb_producto on tb_inventario_historico.id_producto=tb_producto.id_producto WHERE date(fecha)>='".$fecha1."' and date(fecha)<='".$fecha2."'");  
// }else{
    // $sqlsocio=$conexion->query("select * from tb_docente"); 
// }
 
    ?>
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                      <th>Id</th>
                                      <th>Nombres</th>
                                      <?php 
                                      $consultmaterias=$conexion->query("SELECT `tb_asignaturas`.`asignatura`, `tb_asignatura_docente`.`id_asignatura_docente`, tb_notas.id_notas FROM `tb_asignaturas`inner JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_asignatura` = `tb_asignaturas`.`id_asignatura` inner join tb_notas on tb_asignatura_docente.id_asignatura_docente=tb_notas.id_asignatura_docente where tb_asignatura_docente.id_promocion='".$Promo."' and tb_asignatura_docente.id_curso='".$paralelo."' GROUP BY tb_asignatura_docente.id_asignatura"); 
                                      while($row=mysqli_fetch_array($consultmaterias)){?>
                                      <th><?php echo $row['asignatura']; ?></th>
                                      
                                      <?php } ?>

                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                     <th>Id</th>
                                      <th>Nombres</th>
                                     <?php 
                                      $consultmaterias=$conexion->query("SELECT `tb_asignaturas`.`asignatura`, `tb_asignatura_docente`.`id_asignatura_docente`, tb_notas.id_notas FROM `tb_asignaturas`inner JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_asignatura` = `tb_asignaturas`.`id_asignatura` inner join tb_notas on tb_asignatura_docente.id_asignatura_docente=tb_notas.id_asignatura_docente where tb_asignatura_docente.id_promocion='".$Promo."' and tb_asignatura_docente.id_curso='".$paralelo."' GROUP BY tb_asignatura_docente.id_asignatura"); 
                                      while($row=mysqli_fetch_array($consultmaterias)){?>
                                      <th><?php echo $row['asignatura']; ?></th>
                                      
                                      <?php } ?>
                                      
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($consultnotas)){
                               ?>

                                <tr>
                                <td><?php echo($consultasocio['id_estudiante']); ?></td>
                                <td><?php echo($consultasocio['apellido'].' '.$consultasocio['nombre']); ?></td>
                                <?php 
                                $consulnot=$conexion->query("SELECT `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_estudiantes`.`id_estudiante`, `tb_notas`.`nota`, `tb_asignatura_docente`.`id_asignatura_docente` FROM `tb_personas` inner JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona` inner JOIN `tb_notas` ON `tb_notas`.`id_estudiante` = `tb_estudiantes`.`id_estudiante` inner JOIN `tb_asignatura_docente` ON `tb_notas`.`id_asignatura_docente` = `tb_asignatura_docente`.`id_asignatura_docente` where tb_asignatura_docente.id_promocion='".$Promo."' and tb_asignatura_docente.horario='".$Jor."' and tb_notas.id_estudiante=".$consultasocio['id_estudiante']); 
                                while($rows=mysqli_fetch_array($consulnot)){?>
                                <td <?php if($rows['nota']<16){echo ('style="color:red"');} ?>><?php echo($rows['nota']); if($rows['nota']<16){echo ('  (REPROBADO)');}else{echo ('  (APROBADO)');}; ?></td>
                              

                               <?php 
                                  }
                               } 
                               ?>
                               </tr>
                              </tbody>

                              </table>
                              </div>
<?php 
}
?>
<br><br><br><br><br><br><br>
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
                 message: 'Datos de Notas',
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