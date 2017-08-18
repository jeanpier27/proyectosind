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
    require_once('login/conexion.php')
 	 ?>
    
    
 </head>
 <body>
 <script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#estudiantes').attr("style","background-color:#E75A5A;");
              
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
        
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Cursos</div>
                    <div class="row">

                   
                   <center>
                   <div class="group-material">
                                <span>Seleccione Promocion</span> 
                               
                          <select class="selectpicker" name="" id="promociones" data-live-search="true" onchange="carga_bienes(this.value)" required="">
                          <option value="0">Seleccione Promocion</option>
                           <?php
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                           $sqlpromo=$conexion->query("SELECT id_promocion, fecha_inicio, fecha_fin FROM `tb_promocion` order by id_promocion");

                            while($row=$sqlpromo->fetch_array()){ 
                              $Id_promo = $row['id_promocion'];
                              $Ff_inicio = $row['fecha_inicio'];
                              $Ff_fin = $row['fecha_fin'];

                                ?>

                              <option value="<?php echo $Id_promo; ?>"  <?php if($Id_promo == $Promo){echo "selected='selected'";}?>   ><?php echo $Ff_inicio.' - '.$Ff_fin; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>

                    <div class="group-material">
                                <span>Seleccione Tipo Curso </span> 
                               
                          <select class="selectpicker" name="" id="curso" data-live-search="true" onchange="carga_bienes(this.value)" required="">
                          <option value="0">Seleccione Tipo De Curso</option>
                           <?php

                           $Id_cur = isset($_REQUEST["cur"]) ? $_REQUEST["cur"]: 0;
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;

                           $sqlcur=$conexion->query("SELECT `tb_pago_licencia`.`id_tipo_licencia`, `tb_pago_licencia`.`tipo_licencia`, `tb_pago_licencia`.`estado` FROM `tb_pago_licencia` where `tb_pago_licencia`.`estado` = 'ACTIVO' and `tb_pago_licencia`.`tipo_licencia` != 'Psicosensometrico' ORDER BY `tb_pago_licencia`.`tipo_licencia` ASC");

                            while($row=$sqlcur->fetch_array()){ 
                              $cursito = $row['id_tipo_licencia'];
                              $tipo_cursito = $row['tipo_licencia'];
                              $Estadito = $row['estado'];
                                ?>

                              <option value="<?php echo $cursito; ?>"  <?php if($cursito == $Id_cur){echo "selected='selected'";}?>   ><?php echo $tipo_cursito; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>


                            <div class="group-material">
                                <span>Seleccione Jornada </span> 
                               
                          <select class="selectpicker" name="" id="jornadita" data-live-search="true" onchange="carga_bienes(this.value)" required="">
                          <option value="">Seleccione Tipo De Jornada</option>
                           <?php

                          $Id_cur = isset($_REQUEST["cur"]) ? $_REQUEST["cur"]: 0;
                           $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                           $sqljorna=$conexion->query("SELECT distinct horario FROM `tb_estudiantes` ORDER BY horario ASC");

                            while($row=$sqljorna->fetch_array()){ 
                              $jornadita = $row['horario'];                             
                                ?>

                              <option value="<?php echo $jornadita; ?>"  <?php if($jornadita == $Jor){echo "selected='selected'";}?>   ><?php echo $jornadita; ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>
                            </center>
                        


                       <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">

                       <center><th><p><h1>Distribucion de cursos</h1></p></th></center>

                        <form autocomplete="" action="" method="post" id="formreg" name="formreg">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos2">
                                <thead>
                                    <tr  class="info">

                                      <th hidden="">Id_estudiante</th>
                                      <th>nº</th>
                                      <th>Apellidos Nombres</th>
                                      <th>Horario</th>
                                      <th>Curso</th>                                      
                                      <!-- <th>Observaciones</th>                                                                                                  -->
                                      <th>Asignar</th>
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              $i = 0;


                              $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                              $Id_cur = isset($_REQUEST["cur"]) ? $_REQUEST["cur"]: 0;
                              $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                              $sqlestudiante=$conexion->query("SELECT `tb_estudiantes`.`id_estudiante`,`tb_estudiantes`.`horario`, `tb_personas`.`nombre`, `tb_personas`.`apellido`FROM `tb_personas`inner JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona` where tb_estudiantes.id_tipo_licencia='".$Id_cur."' and tb_estudiantes.horario='".$Jor."' and tb_estudiantes.id_promocion='".$Promo."' ");

                               // $numero_estudiantes = mysqli_num_rows($sqlestudiante);
                               
                               while($consultaestudiante=mysqli_fetch_array($sqlestudiante)){                                
                                // tabla estudiante
                                $Id = $consultaestudiante['id_estudiante'];
                                $Nombre = $consultaestudiante['nombre'];
                                $Apellido = $consultaestudiante['apellido']; 
                                $Curso = $consultaestudiante['curso'];
                                $Observacion = $consultaestudiante['observacion'];
                                $Descripcion = $consultaestudiante['horario'];                            
   
                               ?>

                                <tr>
<td hidden=""><input name="id_estudiante<?php echo $i;?>" value="<?php echo $Id; ?>" style="width:80px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><p style="width:10px;"><?php echo $i+1; ?></p></td>
<td><p style="width:200px;"><?php echo $Apellido.' '.$Nombre; ?></p></td>
<td><p style="width:100px;"><?php echo $Descripcion; ?></p></td>                                
<td>
<select name="curso<?php echo $i;?>" style="width:80px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="-">-</option>
<?php 
$Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";
$sqlcurso=$conexion->query("select * from tb_curso");
while($respue=mysqli_fetch_array($sqlcurso)){
 ?>

 <option value="<?php echo $respue['id_curso'];  ?>" <?php 
$sqlcon=$conexion->query("select 1 from tb_curso_detalle where id_estudiante=".$Id." and id_curso=".$respue['id_curso']);
$res=mysqli_fetch_array($sqlcon);
if($res[0]==1){echo 'selected';}

  ?> ><?php echo $respue['curso'];  ?></option>

 <?php } ?>
</select>
</td>

<td><button  name="registro<?php echo $i;?>" id="registro" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></button></td>

<?php 

                              if (isset($_POST['registro'.$i.''])){

                               $Id_estudiante = $_POST['id_estudiante'.$i.'']; 
                               $Curso_R = $_POST['curso'.$i.'']; 
                               $Observaciones_matricula = $_POST['Observaciones_matricula'.$i.''];
                               $estado = "ACTIVO";
                               // echo ("<script type='text/javascript'>alert('EST".$Id_estudiante.' CURSO'.$Curso_R.' OBSERVA'.$Observaciones_matricula."');</script>");
                               $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                               $Id_Curso = $_REQUEST["cur"]; if ($Id_Curso == '') { $Id_Curso = 0; }
                               $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";
                                // 
                               // $update_table_estudiante = "update tb_estudiantes set observacion='".$Observaciones_matricula."' where id_estudiante =".$Id_estudiante;    
                               // $actualizacion_estudiante = mysqli_query($conexion,$update_table_estudiante);

                               $busca_curso_existente =mysqli_query($conexion,"select * FROM tb_curso_detalle where id_estudiante =".$Id_estudiante." ");
                               // $despejar_curso=mysqli_fetch_array($busca_curso_existente);
                               // $curso = $despejar_curso['curso'];
                               $numero_curso = mysqli_num_rows($busca_curso_existente);
                               

                               if ($numero_curso == 0) {
                                 
                                $add_table_curso = "insert into tb_curso_detalle (id_curso,id_estudiante) values (".$Curso_R.", '".$Id_estudiante."')";    
                               $ingreso_table_curso = mysqli_query($conexion,$add_table_curso); 
                              
                               } else {
                                 
                                 $add_table_curso = "update tb_curso_detalle set id_curso ='".$Curso_R."' where id_estudiante =".$Id_estudiante;    
                               $ingreso_table_curso = mysqli_query($conexion,$add_table_curso);     
                               //    echo ("<script type='text/javascript'>alert('EST".$Id_estudiante.' CURSO'.$Curso_R.' resul'.$ingreso_table_curso."');</script>");
                               // exit;                       

                               }                       


                               if ($ingreso_table_curso) {
                                 header('location: distribuirestudiantes.php?msg=yes&promo='.$Promo.'&cur='.$Id_Curso.'&jor='.$Jor); 
                               } else {
                                 header('location: distribuirestudiantes.php?msg=no&promo='.$Promo.'&cur='.$Id_Curso.'&jor='.$Jor);
                               }
                     }  
 ?>
</td>


                               <?php 
                               $i++;
                               } ?>
                               </tr>

                              </tbody>
                              </table>
                              </div>                    

                              <center><button  name="registro_actualizar" id="" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i>      Actualizar Todo</button></center>
                              <?php 

                              if (isset($_POST['registro_actualizar'])){
                              
                                for ($i=0; $i < $numero_estudiantes; $i++) {

                                 $Id_estudiante = $_POST['id_estudiante'.$i.'']; 
                               $Curso_R = $_POST['curso'.$i.'']; 
                               $Observaciones_matricula = $_POST['Observaciones_matricula'.$i.''];
                               $estado = "ACTIVO";

                               $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                               $Id_Curso = $_REQUEST["cur"]; if ($Id_Curso == '') { $Id_Curso = 0; }
                               $Jor = isset($_REQUEST["jor"]) ? $_REQUEST["jor"]: "";

                               $update_table_estudiante = "update tb_estudiantes set observacion='".$Observaciones_matricula."' where id_estudiante =".$Id_estudiante;    
                               $actualizacion_estudiante = mysqli_query($conexion,$update_table_estudiante);

                               $busca_curso_existente =mysqli_query($conexion,"select * FROM tb_curso where id_estudiante =".$Id_estudiante);
                               $despejar_curso=mysqli_fetch_array($busca_curso_existente);
                               $curso = $despejar_curso['curso'];
                               $numero_curso = mysqli_num_rows($busca_curso_existente);
                               

                               if ($numero_curso == 0) {
                                 
                                $add_table_curso = "insert into tb_curso (id_estudiante, curso, estado) values (".$Id_estudiante.", '".$Curso_R."','".$estado."')";    
                               $ingreso_table_curso = mysqli_query($conexion,$add_table_curso); 

                               } else {

                                 $add_table_curso = "update tb_curso set curso ='".$Curso_R."' where id_estudiante =".$Id_estudiante;    
                               $ingreso_table_curso = mysqli_query($conexion,$add_table_curso);                               

                               }   
                                                              
                                }

                                if ($actualizacion_estudiante and $ingreso_table_curso) {
                                 header('location: distribuirestudiantes.php?msg=yes&promo='.$Promo.'&cur='.$Id_Curso.'&jor='.$Jor); 
                               } else {
                                 header('location: distribuirestudiantes.php?msg=no&promo='.$Promo.'&cur='.$Id_Curso.'&jor='.$Jor);
                               }
                          
                             }  
                             ?>
                        </form>ui

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

              $('input.datepicker').daterangepicker({
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

                    $('input.datepicker').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('YYYY-MM-DD'));
                  });

                    $('input.datepicker').on('cancel.daterangepicker', function(ev, picker) {
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


$(document).ready(function(){
    $('#tabladatos2').DataTable({
    
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

            

 </script>
 </html>
 <?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='yes') {
    
    echo '<script type="text/javascript">swal("OK", "Asignacion de curso exitosa", "success")</script>';

} elseif ($MSG=='no') {
    
    echo '<script type="text/javascript">swal("Error!", "Asignacion de curso fallida", "error")</script>';

} elseif ($MSG=='nada') {

}

ob_end_flush();
?>

<script type="text/javascript">
                $(document).ready(function(){

                $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8)) 
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
<script>
                                function carga_bienes() {
                                    var x = document.getElementById("promociones").value;
                                    var a = document.getElementById("curso").value;
                                    var y = document.getElementById("jornadita").value;
                                    location.href="distribuirestudiantes.php?promo="+x+"&cur="+a+"&jor="+y;
                                    //location.href="updatestudiante.php?est="+a;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script> 