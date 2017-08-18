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
 	<title>Sindicato</title>
    
 	<?php 
 	require_once('meta.php');
    require_once('login/conexion.php')
 	 ?>
    
    
 </head>
 <body>
  <script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#docentes').attr("style","background-color:#E75A5A;");
              
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
                       <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">
                        

                   <form autocomplete="" action="" method="post" id="formreg" name="formreg">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                    
                                      <th>Id</th>
                                      <th>Cedula</th>
                                      <th hidden="" style="width:400px;">...</th>
                                      <th>Nombres</th>
                                      <th>Apellido</th>                                      
                                      <th>Telefono1</th>
                                      <th>Telefono2</th>
                                      <th>Telefono3</th>                                      
                                      <th>Direccion</th>
                                      <th>Correo</th>
                                      <th>E. Civil</th>
                                      <th>Salario</th>
                                      <th>Fecha Ingreso</th>
                                      <th>Fecha salida</th>
                                      <th>Contraseña</th>
                                      <th hidden="">Id usu</th>
                                      <th>Observaciones</th>
                                      <th>Estado</th>
                                      <th>Editar</th>                                    
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                  
                                      <th>Id</th>
                                      <th>Cedula</th>
                                      <th hidden="" style="width:400px;">...</th>
                                      <th>Nombres</th>
                                      <th>Apellido</th>                                      
                                      <th>Telefono1</th>
                                      <th>Telefono2</th>
                                      <th>Telefono3</th>                                      
                                      <th>Direccion</th>
                                      <th>Correo</th>
                                      <th>E. Civil</th>
                                      <th>Salario</th>
                                      <th>Fecha Ingreso</th>
                                      <th>Fecha salida</th>
                                      <th>Contraseña</th>
                                      <th hidden="">Id usu</th>
                                      <th>Observaciones</th>
                                      <th>Estado</th>
                                      <th>Editar</th>                                    
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                              $i = 0;

                              $sqlsocio=$conexion->query("SELECT `tb_personas`.`id_persona`, `tb_personas`.`cedula_ruc`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_personas`.`telefono1`, `tb_personas`.`telefono2`, `tb_personas`.`telefono3`, `tb_personas`.`direccion`, `tb_personas`.`correo`, `tb_personas`.`estado_civil`, `tb_docente`.`sueldo`, `tb_docente`.`estado`, `tb_docente`.`fecha_ingreso`, `tb_docente`.`fecha_salida`, `tb_usuarios`.`contraseña`, `tb_docente`.`id_usuarios`, `tb_docente`.`observaciones` FROM `tb_personas` INNER JOIN `tb_usuarios` ON `tb_usuarios`.`id_persona` = `tb_personas`.`id_persona` INNER JOIN `tb_docente` ON `tb_docente`.`id_usuarios` = `tb_usuarios`.`id_usuarios` order by `tb_personas`.`apellido`"); 

                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                                $estadito = $consultasocio['estado'];
                                $estadito_civil = $consultasocio['estado_civil'];
                                $id_personita = $consultasocio['id_persona']; 
                                $observa = $consultasocio['observaciones'];
                               ?>

                                <tr>
                                
<td><input name="id_persona<?php echo $i;?>" readonly value="<?php echo($consultasocio['id_persona']); ?>" style="width:40px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><?php echo($consultasocio['cedula_ruc']); ?></td>
<td hidden="" style="width:400px;"><?php echo($consultasocio['nombre'].' '.$consultasocio['apellido']); ?></td>
<td><input name="nombre<?php echo $i;?>" class="letras" required="" maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo($consultasocio['nombre']); ?>" style="width:100px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="apellido<?php echo $i;?>" class="letras" required="" maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo($consultasocio['apellido']); ?>" style="width:100px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="telefono1<?php echo $i;?>" class="numero" pattern="[0-9]{1,20}" required="" maxlength="10" value="<?php echo($consultasocio['telefono1']); ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="telefono2<?php echo $i;?>" class="numero" pattern="[0-9]{1,20}" required="" maxlength="10" value="<?php echo($consultasocio['telefono2']); ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="telefono3<?php echo $i;?>" class="numero" pattern="[0-9]{1,20}" required="" maxlength="10" value="<?php echo($consultasocio['telefono3']); ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="direccion<?php echo $i;?>" class="" required="" maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo($consultasocio['direccion']); ?>" style="width:200px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="correo<?php echo $i;?>" value="<?php echo($consultasocio['correo']); ?>" style="width:200px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="email"></td>
<td><select name="estado_civil<?php echo $i;?>" style="width:100px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="SOLTERO/A" <?php if ($estadito_civil == 'SOLTERO/A') { ?> selected <?php } ?> >SOLTERO/A</option>
<option value="CASADO/A" <?php if ($estadito_civil == 'CASADO/A') { ?> selected <?php } ?>>CASADO/A</option>
<option value="VIUDO/A" <?php if ($estadito_civil == 'VIUDO/A') { ?> selected <?php } ?>>VIUDO/A</option>
<option value="DIVORCIADO/A" <?php if ($estadito_civil == 'DIVORCIADO/A') { ?> selected <?php } ?>>DIVORCIADO/A</option>
<option value="UNIDO/A" <?php if ($estadito_civil == 'UNIDO/A') { ?> selected <?php } ?>>UNIDO/A</option>
<option value="OTRO" <?php if ($estadito_civil == 'OTRO') { ?> selected <?php } ?>>OTRO</option>
</select></td>
<td><input name="sueldo<?php echo $i;?>" class="numero" required="" maxlength="10" value="<?php echo($consultasocio['sueldo']); ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="fecha_ingreso<?php echo $i;?>" class="datepicker" value="<?php echo($consultasocio['fecha_ingreso']); ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="fecha_salida<?php echo $i;?>" class="datepicker" value="<?php echo($consultasocio['fecha_salida']); ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="contraseña<?php echo $i;?>" value="<?php echo($consultasocio['contraseña']); ?>" style="width:100px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="password"></td>
<td hidden=""><input name="id_usuarios<?php echo $i;?>" readonly value="<?php echo($consultasocio['id_usuarios']); ?>" style="width:40px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input required name="Observaciones<?php echo $i;?>" title="<?php echo $observa; ?>" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="<?php echo $observa; ?>" style="width:400px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><select name="estado<?php echo $i;?>" style="width:100px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="ACTIVO" <?php if ($estadito == 'ACTIVO') { ?> selected <?php } ?> >ACTIVO</option>
<option value="INACTIVO" <?php if ($estadito == 'INACTIVO') { ?> selected <?php } ?> >INACTIVO</option>
</select></td>
<td>
<button  name="registra<?php echo $i;?>" id="registra" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></button>
<?php 

                              if (isset($_POST['registra'.$i.''])){

                               $Id_persona = $_POST['id_persona'.$i.''];                         
                               $Nombres = $_POST['nombre'.$i.'']; 
                               $Apellido = $_POST['apellido'.$i.''];                                       
                               $Telefono1 = $_POST['telefono1'.$i.'']; 
                               $Telefono2 = $_POST['telefono2'.$i.'']; 
                               $Telefono3 = $_POST['telefono3'.$i.''];                                       
                               $Direccion = $_POST['direccion'.$i.'']; 
                               $Correo = $_POST['correo'.$i.''];                                
                               $Estado_civil = $_POST['estado_civil'.$i.'']; 
                               $Sueldo = $_POST['sueldo'.$i.'']; 
                               $Fecha_ingreso = $_POST['fecha_ingreso'.$i.'']; 
                               $Fecha_salida = $_POST['fecha_salida'.$i.'']; 
                               $Contraseña = $_POST['contraseña'.$i.'']; 
                               $Id_usu = $_POST['id_usuarios'.$i.''];
                               $Observaciones = '('.date("Y-m-d").', Usuario: '.$_SESSION['nombres'].' - '.$_POST['Observaciones'.$i.''].') '.$observa; 
                               $Estado = $_POST['estado'.$i.'']; 

                                


                               $update_table_persona = "update tb_personas set nombre='".$Nombres."', apellido='".$Apellido."', telefono1='".$Telefono1."', telefono2='".$Telefono2."', telefono3='".$Telefono3."', direccion='".$Direccion."', correo='".$Correo."', estado_civil='".$Estado_civil."' where id_persona =".$Id_persona;    
                               $actualizacion_persona = mysqli_query($conexion,$update_table_persona);

                               $update_table_usuario = "update tb_usuarios set contraseña='".$Contraseña."', estado='".$Estado."' where id_usuarios =".$Id_usu;    
                               $actualizacion_usuario = mysqli_query($conexion,$update_table_usuario);

                               $update_table_docente = "update tb_docente set sueldo='".$Sueldo."', estado='".$Estado."', fecha_ingreso='".$Fecha_ingreso."', fecha_salida='".$Fecha_salida."', observaciones='".$Observaciones."' where id_usuarios =".$Id_usu;    
                               $actualizacion_docente = mysqli_query($conexion,$update_table_docente);

                               if ($actualizacion_usuario and $actualizacion_persona and $actualizacion_docente) {
                                 header('location: updadocente.php?msg=updateyes');
                               } else {
                                 header('location: updadocente.php?msg=updateno');
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


                        </form>


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

            

 </script>
 </html>
 <?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='updateyes') {
    
    echo '<script type="text/javascript">swal("OK", "Actualizacion de docente exitosa", "success")</script>';

} elseif ($MSG=='updateno') {
    
    echo '<script type="text/javascript">swal("Error!", "Actualizacion de docente fallida", "error")</script>';

} elseif ($MSG=='nada') {

}

ob_end_flush();
?>

<script type="text/javascript">
                $(document).ready(function(){
                   

                $('input[name=cedulaaaaa]').focusout(function(){
                        // alert($('input[name=apellido]').val());
                        var cedula=$('input[name=cedula]').val();
                        
                        if (cedula!=""){
                            
                            var a=[10];
                            var b=[10];
                            var total=0;
                            for(var i=0;i<10;i++){
                                a[i]=cedula.charAt(i);
                                if((i%2)==1){
                                  b[i]=a[i];

                              }else{
                                  if((a[i]*2)>=10){
                                    b[i]=(a[i]*2)-9;
                                }else{
                                    b[i]=a[i]*2;
                                }
                            }

                        }

                        for(var i=0;i<9;i++){
                            total=parseInt(b[i])+parseInt(total);
                        }
                        var verificar=10-(total%10);

                        if(verificar==a[9] || verificar==10){
                            // console.log('ok');
                            var a=cedula.substr(0,10);
                            $.post("controler/verificar_cedula.php",{cedula:a},function(data,status){
                                if(data=='ok'){
                                    swal("Ok!", "Cedula Valida!", "success")
                                }else{
                                    swal({
                                        title: "Error?",
                                      text: "Ya se encuentra registrado!",
                                      type: "error",
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                      
                                      $('#ced').focus();
                                      $('#ced').val('');
                                  });
                                }
                               
                            });
                        }else{
                            console.log('incorrecto');
                            sweetAlert("Error", "La cedula ingresada es invalada!", "error");
                            
                        }
                    }
                });

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