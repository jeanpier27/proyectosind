<?php 
ob_start();
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
 ?>





 <!DOCTYPE html>
 <html>
 <head>
 	<title>ESTUDIANTES</title>
    
 	<?php 
 	require_once('meta.php');
    require_once('login/conexion.php');
    error_reporting(0);
 	 ?>
    
    
 </head>
 <body>
 <script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#asistencia_estudiantes').attr("style","background-color:#E75A5A;");
              
            });
</script>

     <script type="text/javascript">
                                       function carga_bienes() {
                                    var a = document.getElementById("promociones").value;
                                    // var b = document.getElementById("curso").value;
                                    var c = document.getElementById("jornadita").value;
                                    var d = document.getElementById("paralelo").value;
                                    // var e = document.getElementById("docente").value;
                                    var f = document.getElementById("materi").value;
                                    location.href="consult_asist_estud.php?promo="+a+"&jor="+c+"&para="+d+"&mate="+f;
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
            
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Consulta Asistencia</div>
                    <div class="row">

                   
                   <center>
                   <div class="group-material">
                               <div class="group-material">
                                <span>Seleccione Promocion</span> 
                               <form autocomplete="OFF" action="" method="post" id="formreg" name="formreg">
                          <select class="selectpicker" name="promocion" id="promociones" data-live-search="true" onchange="carga_bienes();" required="">
                          <option value="0">Seleccione Promocion</option>
                           <?php
                           $id_docent=$_SESSION['id_usuario'];
                           $consuliddocente=$conexion->query("select id_docente from tb_docente where id_usuarios=".$id_docent);
                           $respiddocente=mysqli_fetch_array($consuliddocente);
                           $hoy=date('Y');
                          
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                           $sqlpromo=$conexion->query("SELECT tb_promocion.id_promocion, tb_promocion.descripcion, tb_promocion.fecha_inicio, tb_promocion.fecha_fin,tb_asignatura_docente.id_docente FROM `tb_promocion` inner join tb_asignatura_docente on tb_promocion.id_promocion=tb_asignatura_docente.id_promocion where tb_promocion.descripcion like '%".$hoy."%' and tb_asignatura_docente.id_docente='".$respiddocente[0]."' GROUP by tb_promocion.id_promocion order by tb_promocion.id_promocion");

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
                            <input type="hidden" name="id_docentes" value="<?php echo $respiddocente[0]; ?>">

                          <div class="group-material">
                                <span>Seleccione Jornada </span> 
                               
                          <select class="selectpicker" name="jornada" id="jornadita" data-live-search="true" onchange="carga_bienes(this.value);" required="">
                          <option value="">Seleccione Tipo De Jornada</option>
                           <?php

                          
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                           $sqljorna=$conexion->query("SELECT horario FROM `tb_asignatura_docente` where id_promocion='".$Promo."' and id_docente='".$respiddocente[0]."' GROUP by id_promocion");

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
                                <span>Seleccione Materia</span> 
                               
                          <select class="selectpicker" data-live-search="true" name="materia_seleccionada" id="materi" onchange="carga_bienes(this.value);" required="">
                          <option value="0">Seleccione Materia</option>
                           <?php
                           // $Pl = isset($_REQUEST["pl"]) ? $_REQUEST["pl"]: 0;
                           $Mater = isset($_REQUEST["mate"]) ? $_REQUEST["mate"]: 0;
                           $paralelo = isset($_REQUEST["para"]) ? $_REQUEST["para"]: 0;

                           $sqlmate=$conexion->query("SELECT tb_asignaturas.id_asignatura,tb_asignaturas.asignatura, tb_asignatura_docente.id_asignatura_docente FROM `tb_asignatura_docente` inner join tb_asignaturas on tb_asignatura_docente.id_asignatura=tb_asignaturas.id_asignatura where tb_asignatura_docente.id_promocion='".$Promo."' and tb_asignatura_docente.horario='".$jornadita."' and tb_asignatura_docente.id_docente='".$respiddocente[0]."' GROUP BY tb_asignaturas.asignatura");

                            while($row=$sqlmate->fetch_array()){ 
                              $id_asignatura2 = $row['id_asignatura'];
                              $asignatura2 = $row['asignatura'];
                              
                                ?>

                              <option value="<?php echo $id_asignatura2; ?>"  <?php if($id_asignatura2 == $Mater){echo "selected='selected'";}?>   ><?php echo $asignatura2; ?></option>
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

                           $sqlcurso=$conexion->query("SELECT `tb_curso`.`id_curso`, `tb_curso`.`curso`, `tb_asignatura_docente`.`id_asignatura_docente` FROM `tb_curso` inner JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_curso` = `tb_curso`.`id_curso`where tb_asignatura_docente.id_promocion='".$Promo."' and tb_asignatura_docente.horario='".$Jor."' and tb_asignatura_docente.id_docente='".$respiddocente[0]."'");

                            while($row=$sqlcurso->fetch_array()){ 

                              $cursito = $row['curso'];                             
                                ?>

                              <option value="<?php echo $row['id_curso']; ?>"  <?php if($row['id_curso'] == $paralelo){echo "selected='selected'";}?>   ><?php echo $cursito; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>   
                           <!--  <div class="group-material">
                              Fecha:
                              <input type="text" name="fecha" readonly="" value="<?php echo(date('Y-m-d')); ?>">
                            </div>    -->                      

                   

                              <!-- <div class="col-sm-12 col-sm-offset-1"> -->
                              <div  id="info"></div>
                              <!-- </div>  -->
                            

                            
                        
                            </center>
                        


                       <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">

                       
                        
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos2">
                                <thead>
                                    <tr  class="info">

                                      <th>Id_estudiante</th>
                                      <th>Nº</th>
                                      <th>Apellidos Nombres</th>
                                      <?php 
                                        $consultfecha=$conexion->query("SELECT `tb_asistencia_alumnos`.`fecha` FROM `tb_asistencia_alumnos`where `tb_asistencia_alumnos`.`id_promocion`='".$Promo."' and `tb_asistencia_alumnos`.`id_asignatura`='".$Mater."' and `tb_asistencia_alumnos`.`id_curso`='".$paralelo."' GROUP by fecha");
                                        // echo ("<script type='text/javascript'>alert('".$Mater.' '.$Promo.' '.$Id_cur."');</script>");
                                        while($row=mysqli_fetch_array($consultfecha)){ 
                                       ?>
                                      <th><?php echo($row['fecha']); ?></th>                                
                                      <?php } ?>
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              

                              if($_GET['para']!=0 and $_GET['mate']!=0){ 
                               $paralelo=$_GET['para'];
                               $docente=$_GET['doce'];
                               $materia=$_GET['mate'];
                               // echo ("<script type='text/javascript'>alert('".$materia."');</script>");

                               $sqlestudiante =mysqli_query($conexion,"SELECT `tb_estudiantes`.`id_estudiante`, `tb_personas`.`nombre`, `tb_personas`.`apellido`FROM `tb_personas` inner JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona` where tb_estudiantes.id_promocion='".$Promo."' and tb_estudiantes.horario='".$Jor."' and tb_estudiantes.id_curso='".$paralelo."' and tb_estudiantes.estado='ACTIVO'");
                               // $sqlestudiant=mysqli_fetch_array($sqlestudiante);
                            
                               while($consultaestudiante=mysqli_fetch_array($sqlestudiante)){
                            
                               
                               $i++; ?>
                               <tr>
                              
                               <input type="hidden" name="id_estudian[<?php echo($consultaestudiante['id_estudiante']); ?>]" value="<?php echo($consultaestudiante['id_estudiante']); ?>">
                                <td><?php echo($consultaestudiante['id_estudiante']); ?></td>
                                <td><?php echo $i; ?></td>
                                <td><?php echo($consultaestudiante['apellido'].' '.$consultaestudiante['nombre']); ?></td>
                                <?php 
                                  $consulrasist=$conexion->query("SELECT `tb_asistencia_alumnos`.`fecha`,asistencia FROM `tb_asistencia_alumnos`where `tb_asistencia_alumnos`.`id_promocion`='".$Promo."' and `tb_asistencia_alumnos`.`id_asignatura`='".$Mater."' and `tb_asistencia_alumnos`.`id_curso`='".$paralelo."' and id_estudiante=".$consultaestudiante['id_estudiante']);
                                  while($rows=mysqli_fetch_array($consulrasist)){ 
                                 ?>
                               <td <?php if($rows['asistencia']==0){echo('style="color:red;"');} ?> ><?php if($rows['asistencia']=='1'){echo('Asistio');}else{ echo('Falto'); }  ?></td>
                               
                               <?php } ?>
                              

                      <?php 
                            
                        }  
                        ?>
                         </tr>
                         </tr>
                         <?php 
                         }  
                         
                      ?>                            

                              </tbody>
                              </table>
                              </div>    
                              <?php 
                                if($bandera==0){
                               ?>             
                              
                              <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="insertar_notas" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                            <?php 
                                }else{ ?>
                                 <script type="text/javascript">
                                 $('#info').html('<div class="alert alert-warning" role="alert"><h3><strong>Advertencia</strong> Ya se encuentra asignadas las notas para poder guardar los cambios es obligatorio llenar el campo observacion </h3> </div>');

                               </script>
                                <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="actualizar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Actualizar</button> &nbsp;&nbsp;
                            </p>
                               <?php } ?>
                                
                               </form>
                              
                              <?php 


                              if (isset($_POST['insertar_notas'])){                                

                                $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                          // $Id_cur = isset($_REQUEST["cur"]) ? $_REQUEST["cur"]: 0;
                           $paralelo = isset($_REQUEST["para"]) ? $_REQUEST["para"]: 0;
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";
                           $Mater = isset($_REQUEST["mate"]) ? $_REQUEST["mate"]: 0;
                           $fecha=$_POST['fecha'];
                           // $Doce = isset($_REQUEST["doce"]) ? $_REQUEST["doce"]: 0; 
                           $iddocente=$_POST['id_docentes'];
                           
                           if($Promo!=0 and $paralelo!=0 and $Jor!="" and $Mater!=0 and $iddocente!=0){

                           
                               
                                 // echo ("<script type='text/javascript'>console.log('".$Doce.' '.$Mater.' '.$Promo.' '.$Jor.' '.$paralelo."');</script>");

                                // $consul_id_asig_doce=$conexion->query("select id_asignatura_docente from tb_asignatura_docente where id_docente='".$iddocente."' and id_asignatura='".$Mater."' and id_promocion='".$Promo."' and horario='".$Jor."' and id_curso='".$paralelo."'");
                              
                              // $id_asig_docente=mysqli_fetch_array($consul_id_asig_doce);
                              

                              foreach ($_POST['id_estudian'] as $value) {
                                // echo ("<script type='text/javascript'>alert('".$_POST['id_estudian'][$value].' '.$_POST['asisten'][$value]."');</script>");
                                $id=$_POST['id_estudian'][$value];
                                $asist=$_POST['asisten'][$value];
                                

                                $fecha=date('Y-m-d H:i:s');
                                $observaciontotal='('.$fecha.' usuario: '.$_SESSION['nombres'].'.- Ingreso)';
                                // echo ("<script type='text/javascript'>alert('".$id.' '.$notas."');</script>");
                                 $insertar_asist=$conexion->query("insert into tb_asistencia_alumnos (fecha,id_estudiante,asistencia,id_promocion,id_asignatura,id_curso,observacion)values('".$fecha."','".$id."','".$asist."','".$Promo."','".$Mater."','".$paralelo."','".$observaciontotal."')");
                                }
                                                         
                                                       

                                if ($insertar_asist) {
                                 header('location: calificaciones_docentes.php?msg=yes'); 
                               } else {
                                 header('location: calificaciones_docentes.php?msg=no');
                               }
                             }else{
                              echo '<script type="text/javascript">swal("Error!", "Debe seleccionar todos los campos!", "warning")</script>';
                             }
                          }


                             
                             ?>
                       

                       </div>
                       </div>
        	

        <!-- </section> -->
        </div>

<script type="text/javascript">
                                   

                $(document).ready(function(){

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
                 message: 'Datos de Socios',
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
                       

                $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57)  || (key==8) || (key==46)) 
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
               
            });
</script> 
        
 </body>

 </html>


 <?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='yes') {
    
    echo '<script type="text/javascript">swal("OK", "Asistencia registradas con exito", "success")</script>';

} elseif ($MSG=='no') {
    
    echo '<script type="text/javascript">swal("Error!", "Asistencia no se guardaron", "error")</script>';

} elseif ($MSG=='nada') {

}

ob_end_flush();
?>