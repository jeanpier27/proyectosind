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
            $('#asignaturas').attr("style","background-color:#E75A5A;");
              
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
                    <div class="title-flat-form title-flat-blue">Actualizar Datos</div>
                    <div class="row">

                   
                   <center>
                        
                            </center>
                        


                       <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">

                       <center><th><p><h1>Asignaturas</h1></p></th></center>

                        <form autocomplete="" action="" method="post" id="formreg" name="formreg">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="">
                                <thead>
                                    <tr  class="info">

                                      <th>Id</th>
                                      <th>Asignatura</th>
                                      <th>Descripcion</th>
                                      <th>Estado</th>                                                                                                                               
                                      <th>Editar</th>
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              $i = 0;

                              $Cur = $_REQUEST["cur"];
                              if ($Cur == '') {
                                 $Cur = 0;
                               }                               
                                                            

                              $sqlestudiante=$conexion->query("SELECT * from tb_asignaturas");

                              $numero_asignaturas = mysqli_num_rows($sqlestudiante);

                               while($consultaestudiante=mysqli_fetch_array($sqlestudiante)){                                
                                // tabla estudiante
                                $Id_asignatura = $consultaestudiante['id_asignatura'];
                                $Asignatura = $consultaestudiante['asignatura'];
                                $Descripcion = $consultaestudiante['descripcion']; 
                                $Prioridad = $consultaestudiante['prioridad'];
                                $Estado = $consultaestudiante['estado'];                                                           
   
                               ?>

                                <tr>
<td><input name="id<?php echo $i;?>" readonly value="<?php echo $Id_asignatura; ?>" style="width:80px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="asignatura<?php echo $i;?>" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $Asignatura; ?>" style="width:400px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="descripcion<?php echo $i;?>" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $Descripcion; ?>" style="width:400px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>

<td><select name="estado<?php echo $i;?>" style="width:80px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="ACTIVO" <?php if ($Estado == 'ACTIVO') { ?> selected <?php } ?> >ACTIVO</option>
<option value="INACTIVO" <?php if ($Estado == 'INACTIVO') { ?> selected <?php } ?> >INACTIVO</option>
</select></td>
<td>
<button  name="registro<?php echo $i;?>" id="registro" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></button>
<?php 

                              if (isset($_POST['registro'.$i.''])){
                               
                               $id1 = $_POST['id'.$i.'']; 
                               $asignatura1 = $_POST['asignatura'.$i.'']; 
                               $descripcion1 = $_POST['descripcion'.$i.''];
                               $prioridad1 = $_POST['prioridad'.$i.'']; 
                               $estado1 = $_POST['estado'.$i.''];

                               $Id_Curso = $_REQUEST["cur"];
                              if ($Id_Curso == '') {
                                 $Id_Curso = 0;
                               }                               

                               $update_table_asignatura = "update tb_asignaturas set asignatura='".$asignatura1."', descripcion='".$descripcion1."', estado='".$estado1."' where id_asignatura =".$id1;    
                               $actualizacion_asignatura = mysqli_query($conexion,$update_table_asignatura);

                               if ($actualizacion_asignatura) {
                                 header('location: updateasignatura.php?msg=yes&cur='.$Id_Curso); 
                               } else {
                                 header('location: updateasignatura.php?msg=no&cur='.$Id_Curso);
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
                              
                                for ($i=0; $i < $numero_asignaturas; $i++) { 
                               $id2 = $_POST['id'.$i.'']; 
                               $asignatura2 = $_POST['asignatura'.$i.'']; 
                               $descripcion2 = $_POST['descripcion'.$i.''];
                               $prioridad2 = $_POST['prioridad'.$i.'']; 
                               $estado2 = $_POST['estado'.$i.''];

                               $Id_Curso = $_REQUEST["cur"];
                              if ($Id_Curso == '') {
                                 $Id_Curso = 0;
                               }                               

                               $update_table_asignatura2 = "update tb_asignaturas set asignatura='".$asignatura2."', descripcion='".$descripcion2."', prioridad='".$prioridad2."', estado='".$estado2."' where id_asignatura =".$id2;    
                               $actualizacion_asignatura2 = mysqli_query($conexion,$update_table_asignatura2);                               
                                }

                                if ($actualizacion_asignatura2) {
                                 header('location: updateasignatura.php?msg=yes&cur='.$Id_Curso); 
                               } else {
                                 header('location: updateasignatura.php?msg=no&cur='.$Id_Curso);
                               }
                          
                             }  
                             ?>
                        </form>

                       </div>
                       </div>
        	

        <!-- </section> -->
        </div>

      
        
 </body>
 <script type="text/javascript">


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
            

 </script>
 </html>
 <?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='yes') {
    
    echo '<script type="text/javascript">swal("OK", "Actualizacion de materia exitosa", "success")</script>';

} elseif ($MSG=='no') {
    
    echo '<script type="text/javascript">swal("Error!", "Actualizacion de materia fallida", "error")</script>';

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
                                    var a = document.getElementById("curso").value;                                    
                                    //location.href="updateasignatura.php?promo="+x+"&cur="+a;
                                    location.href="updateasignatura.php?cur="+a;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script> 