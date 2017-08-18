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
                    <div class="title-flat-form title-flat-blue">Actualizar Datos</div>
                    <div class="row">

                   
                   <center>
                   <div class="group-material">
                                <span>Seleccione Promocion</span> 
                               
                          <select class="selectpicker" name="" id="promociones" data-live-search="true" onchange="carga_bienes(this.value)" required="">
                          <option value="0">Seleccione Promocion</option>
                           <?php
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 00000000000;
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
                                <span>Seleccione Estudiante </span> 
                               
                          <select class="selectpicker" name="" id="persona_dato" data-live-search="true" onchange="carga_bienes(this.value)" required="">
                          <option value="">Seleccione estudiante</option>
                           <?php

                           $Id_per = isset($_REQUEST["est"]) ? $_REQUEST["est"]: 00000000000;
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 00000000000;

                           $sqlsocio=$conexion->query("SELECT DISTINCT  `tb_personas`.`id_persona`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_promocion`.`id_promocion`, `tb_promocion`.`fecha_inicio`, `tb_promocion`.`fecha_fin` FROM `tb_personas` INNER JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_persona` = `tb_personas`.`id_persona` INNER JOIN `tb_promocion` ON `tb_estudiantes`.`id_promocion` = `tb_promocion`.`id_promocion` where `tb_promocion`.`id_promocion`=".$Promo);

                            while($row=$sqlsocio->fetch_array()){ 
                              $personita = $row['id_persona'];
                                ?>

                              <option value="<?php echo $personita; ?>"  <?php if($personita == $Id_per){echo "selected='selected'";}?>   ><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                            </div>
                            </center>
                        


                       <div class="col-xs-12 col-sm-12 col-sm-offset-0 col-xs-offset-0">

                       <center><th><p><h1>MATRICULAS REGISTRADAS DEL ALUMNO</h1></p></th></center>

                        <form autocomplete="" action="" method="post" id="formreg" name="formreg">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos2">
                                <thead>
                                    <tr  class="info">                                    
                                      
                                      <th>Id Matricula</th>
                                      <th>Fecha Matricula</th>
                                      <th>Estado Matricula</th>
                                      <th>Observacion Matricula</th>
                                      <th>Tipo De Inscripcion</th>
                                      <th>Total Curso</th>
                                      <th>Curso</th>
                                      <th>Promocion Matricula</th>                                      
                                      <th>Editar</th>
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              $i = 0;

                              $Id_perrr = $_REQUEST["est"];
                              if ($Id_perrr == '') {
                                 $Id_perrr = 0;
                               }

                               $Promooo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0; 
                              

                              $sqlestudiante=$conexion->query("SELECT `tb_estudiantes`.`id_persona`, `tb_estudiantes`.`descripcion`, `tb_estudiantes`.`id_estudiante`, `tb_estudiantes`.`fecha`, `tb_estudiantes`.`observacion`, `tb_estudiantes`.`total_curso`, `tb_estudiantes`.`curso`, `tb_promocion`.`fecha_inicio`, `tb_promocion`.`fecha_fin`, `tb_estudiantes`.`estado` FROM `tb_promocion`
                             INNER JOIN `tb_estudiantes` ON `tb_estudiantes`.`id_promocion` = `tb_promocion`.`id_promocion` where `tb_estudiantes`.`id_persona` = ".$Id_perrr." and `tb_promocion`.`id_promocion` = ".$Promooo." ORDER BY `tb_estudiantes`.`fecha` DESC"); 

                                
                               while($consultaestudiante=mysqli_fetch_array($sqlestudiante)){                                
                                // tabla estudiante
                                $abc = $consultaestudiante['id_estudiante'];
                                $kkk = $consultaestudiante['fecha']; 
                                $lll = $consultaestudiante['estado'];
                                $mmm = $consultaestudiante['observacion'];
                                $nnn = $consultaestudiante['total_curso'];
                                $abd = $consultaestudiante['curso'];                                
                                $ooo = $consultaestudiante['fecha_inicio']; 
                                $ppp = $consultaestudiante['fecha_fin'];
                                $aaa = $consultaestudiante['descripcion'];

                                
                               ?>

                                <tr>
                                
<td><input name="id_estudiante<?php echo $i;?>" class="numero" pattern="[0-9]{1,20}" readonly maxlength="10" value="<?php echo $abc; ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><p style="width:100px;"><?php echo $kkk; ?></p></td>
<td><select name="estado_matricula<?php echo $i;?>" style="width:100px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="ACTIVO" <?php if ($lll == 'ACTIVO') { ?> selected <?php } ?> >ACTIVO</option>
<option value="INACTIVO" <?php if ($lll == 'INACTIVO') { ?> selected <?php } ?> >INACTIVO</option>
</select></td>
<td><input name="Observaciones_matricula<?php echo $i;?>" title="" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $mmm; ?>" style="width:400px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><p style="width:200px;"><?php echo $aaa; ?></p></td>
<td><p style="width:80px;"><?php echo $nnn; ?></p></td>
<td><p style="width:50px;"><?php echo $abd; ?></p></td>
<td><p style="width:120px;"><?php echo $ooo.' - '.$ppp; ?></p></td>
<td>
<button  name="registro<?php echo $i;?>" id="registro" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></button>
<?php 

                              if (isset($_POST['registro'.$i.''])){
                               
                               $Id_estudiante = $_POST['id_estudiante'.$i.'']; 
                               $Estado_matricula = $_POST['estado_matricula'.$i.'']; 
                               $Observaciones_matricula = $_POST['Observaciones_matricula'.$i.''];

                               $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                               $Id_perrr = $_REQUEST["est"];
                              if ($Id_perrr == '') {
                                 $Id_perrr = 0;
                               }

                               $update_table_estudiante = "update tb_estudiantes set observacion='".$Observaciones_matricula."', estado='".$Estado_matricula."' where id_estudiante =".$Id_estudiante;    
                               $actualizacion_estudiante = mysqli_query($conexion,$update_table_estudiante);

                               if ($actualizacion_estudiante) {
                                 header('location: updatematricula.php?msg=updateyes&promo='.$Promo.'&est='.$Id_perrr); 
                               } else {
                                 header('location: updatematricula.php?msg=updateno&promo='.$Promo.'&est='.$Id_perrr);
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


                        <center><th><p><h1>ABONOS DE CURSO</h1></p></th></center>


                    <form autocomplete="" action="" method="post" id="formreg" name="formreg">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">                                    
                                      
                                      <th>Id Detalle</th>
                                      <th>Tipo De Inscripcion</th>
                                      <th>Abono</th>
                                      <th>Comprobante Ingreso</th>
                                      <th>Comprobante Banco</th>
                                      <th>Cuenta Bancaria</th>
                                      <th>Factura</th>
                                      <th>Fecha Pago</th>
                                      <th>Estado pago</th>
                                      <th>Observaciones</th>                                      
                                      <th>Editar</th>
                                      
                                  </tr>
                              </thead>                              

                              <tbody>
                              <?php 
                              $i = 0;

                              $Id_perrr = $_REQUEST["est"];
                              if ($Id_perrr == '') {
                                 $Id_perrr = 0;
                               } 
                              
                              $Promooo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0; 

                              $sqldetalleestudiante=$conexion->query("SELECT `tb_detalle_estudiantes`.`id_detalle_estudiante`, `tb_bancos`.`n_cuenta`, `tb_detalle_estudiantes`.`descripcion`, `tb_detalle_estudiantes`.`fecha`, `tb_detalle_estudiantes`.`valor`, `tb_detalle_estudiantes`.`comprabante_ingreso`, `tb_detalle_estudiantes`.`comprobante_bco`, `tb_detalle_estudiantes`.`factura`, `tb_detalle_estudiantes`.`estado` as estado_detalle, `tb_detalle_estudiantes`.`observacion` as observacion_detalle, `tb_estudiantes`.`id_promocion`, `tb_estudiantes`.`id_persona` FROM `tb_bancos` INNER JOIN `tb_detalle_estudiantes` ON `tb_detalle_estudiantes`.`id_banco` = `tb_bancos`.`id_banco` INNER JOIN `tb_estudiantes` ON `tb_detalle_estudiantes`.`id_estudiante` = `tb_estudiantes`.`id_estudiante` where `tb_estudiantes`.`id_promocion` =".$Promooo." and `tb_estudiantes`.`id_persona` = ".$Id_perrr." ORDER BY `tb_detalle_estudiantes`.`fecha` DESC"); 

                                
                               while($consultadetalleestudiante=mysqli_fetch_array($sqldetalleestudiante)){                                
                                // tabla estudiante
                                $Id_detalle_estudiante = $consultadetalleestudiante['id_detalle_estudiante'];
                                $Descripcion = $consultadetalleestudiante['descripcion'];                               
                                $Valor = $consultadetalleestudiante['valor'];
                                $Comprabante_ingreso = $consultadetalleestudiante['comprabante_ingreso'];                                
                                $Comprobante_bco = $consultadetalleestudiante['comprobante_bco'];
                                $N_cuenta = $consultadetalleestudiante['n_cuenta']; 
                                $Factura = $consultadetalleestudiante['factura'];
                                $Fecha = $consultadetalleestudiante['fecha'];
                                $Estado = $consultadetalleestudiante['estado_detalle'];
                                $Observacion = $consultadetalleestudiante['observacion_detalle'];
                                $Id_promocion = $consultadetalleestudiante['id_promocion'];
                                $Id_persona = $consultadetalleestudiante['id_persona'];
                                ?>

                                <tr>
                                
<td><input name="id_detalle_estudiante<?php echo $i;?>" readonly value="<?php echo $Id_detalle_estudiante; ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><p style="width:200px;"><?php echo $Descripcion; ?></p></td>
<td><p style="width:80px;"><?php echo $Valor; ?></p></td>
<td><input name="comprobante_ingreso<?php echo $i;?>" class="numero" pattern="[0-9]{1,20}" maxlength="10" value="<?php echo $Comprabante_ingreso; ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="comprobante_banco<?php echo $i;?>" class="numero" pattern="[0-9]{1,20}" maxlength="10" value="<?php echo $Comprobante_bco; ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="" class="numero" pattern="[0-9]{1,20}" readonly maxlength="10" value="<?php echo $N_cuenta; ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><input name="factura<?php echo $i;?>" class="numero" pattern="[0-9]{1,20}" maxlength="10" value="<?php echo $Factura; ?>" style="width:70px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td><p style="width:100px;"><?php echo $Fecha; ?></p></td>
<td><select name="estado_detalle<?php echo $i;?>" style="width:100px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
<option value="ACTIVO" <?php if ($Estado == 'ACTIVO') { ?> selected <?php } ?> >ACTIVO</option>
<option value="INACTIVO" <?php if ($Estado == 'INACTIVO') { ?> selected <?php } ?> >INACTIVO</option>
</select></td>
<td><input name="Observaciones_detalle<?php echo $i;?>" title="" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $Observacion; ?>" style="width:400px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" type="text"></td>
<td>
<button  name="registra<?php echo $i;?>" id="registra" type="submit" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></button>
<?php 

                              if (isset($_POST['registra'.$i.''])){                              
                               
                               $Id_detalle_estudiante = $_POST['id_detalle_estudiante'.$i.''];
                               $Comprobante_ingreso = $_POST['comprobante_ingreso'.$i.'']; 
                               $Comprobante_banco = $_POST['comprobante_banco'.$i.'']; 
                               $Factura = $_POST['factura'.$i.''];
                               $Observaciones_detalle = $_POST['Observaciones_detalle'.$i.'']; 
                               $Estado_detalle = $_POST['estado_detalle'.$i.'']; 

                               $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 00000000000;
                               $Id_perrr = $_REQUEST["est"];
                              if ($Id_perrr == '') {
                                 $Id_perrr = 0;
                               }

                               
                               $update_table_detalle_estudiante = "update tb_detalle_estudiantes set comprabante_ingreso='".$Comprobante_ingreso."', comprobante_bco='".$Comprobante_banco."', factura='".$Factura."', estado='".$Estado_detalle."', observacion ='".$Observaciones_detalle."' where id_detalle_estudiante =".$Id_detalle_estudiante;    
                               $actualizacion_detalle_estudiante = mysqli_query($conexion,$update_table_detalle_estudiante);

                               if ($actualizacion_detalle_estudiante) {
                                 header('location: updatematricula.php?msg=updateyes&promo='.$Promo.'&est='.$Id_perrr); 
                               } else {
                                 header('location: updatematricula.php?msg=updateno&promo='.$Promo.'&est='.$Id_perrr);
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

if ($MSG=='updateyes') {
    
    echo '<script type="text/javascript">swal("OK", "Actualizacion de Matricula Estudiante exitosa", "success")</script>';

} elseif ($MSG=='updateno') {
    
    echo '<script type="text/javascript">swal("Error!", "Actualizacion de Matricula Estudiante fallida", "error")</script>';

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
<script>
                                function carga_bienes() {
                                    var x = document.getElementById("promociones").value;
                                    var a = document.getElementById("persona_dato").value;
                                    location.href="updatematricula.php?promo="+x+"&est="+a;
                                    //location.href="updatestudiante.php?est="+a;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script> 