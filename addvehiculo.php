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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Vehiculos</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
        	 <div class="container-fluid">
            
            
            <form autocomplete="" action="" method="post">
                            
                 
                <div class="container-flat-form">
 



                    <div class="title-flat-form title-flat-blue">Nuevo Veh&iacute;culo</div> 
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2"> 
                       <?php   

    if(isset($_POST['registra'])){
                    $fechas= $_POST['fecha_fin_poliza'];                  
                    $n_factura=$_POST['n_factura'];
                    $fecha_factura= $_POST['fecha_factura'];
                    $placa      = $_POST['placa'];
                    $marca      = $_POST['marca'];
                    $modelo      = $_POST['modelo'];
                    $motor      = $_POST['motor'];
                    $chasis      = $_POST['chasis'];
                    $ano_produc       = $_POST['año_produccion'];
                    $fecha_ini_poli     = substr($fechas, 0, -13); 
                    $fecha_fin_poli     = substr($fechas, -10); 
                    $id_proveed     = $_POST['id_proveedores'];                    
                    $fecha_venci_matri   =$_POST['venci_matricula'];
                    $aseguradora   =$_POST['aseguradora'];


                    if($id_proveed!="" and $aseguradora!="" and $marca!=0 and $modelo!="" and $ano_produc!="" and $fechas!="" and $fecha_venci_matri!=""){
                  
                    $sql=$conexion->query("SELECT * FROM tb_vehiculo WHERE(placa='".$placa."')"); 
                        if($f = $sql->fetch_array()){
                            if($placa==$f['placa'] or $modelo==$f['id_modelo'] or $marca==$f['id_marca']){
                                        echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Esta placa ya fue registrada",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="addvehiculo.php";});});</script>';
                                }
                              }else{               
                        $query ="INSERT INTO tb_vehiculo (fecha_factura,placa,id_marca,id_modelo,motor,chasis,año_produccion,fecha_inicio_poliza,fecha_fin_poliza,id_proveedores,fecha_venci_matricula,estado,observacion,aseguradora) VALUES ('".$fecha_factura."','".$placa."','".$marca."','".$modelo."','".$motor."','".$chasis."','".$ano_produc."','".$fecha_ini_poli."','".$fecha_fin_poli."',".$id_proveed.",'".$fecha_venci_matri."','ACTIVO','','".$aseguradora."')";

                        $resultado = $conexion->query($query); 
                        if($resultado){

                               echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="addvehiculo.php";});});</script>';

                      }else{
                         echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="addvehiculo.php";});});</script>';
                      }
                  }
                    }else{
                       echo '<script>jQuery(function(){swal({title:"Error..!!",text:"Debe seleccionar todos los campos",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="addvehiculo.php";});});</script>';
                    }
                   }
                  ?>       

                              <div class="group-material">
                                <span>Seleccione Proveedor </span> 
                                <br>
                               
                          <select class="selectpicker material-control" name="id_proveedores" data-live-search="true" required="">
                          <option selected="" disabled>Seleccione </option>

                           <?php  
                             $sqlproveedor=$conexion->query("SELECT *  FROM  tb_proveedores where estado='ACTIVO' and (activi_comercial like '%VEHICULO%' OR activi_comercial LIKE '%AUTOMOVIL%') ");
                             while($rows=$sqlproveedor->fetch_array()){ ?>

                              <option value="<?php echo $rows['id_proveedores']; ?>"><?php echo ($rows['nombres']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>

                            <!--  <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="N.- de Factura" title="Describa la factura" name="n_factura">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>N.- Factura</label>
                            </div> -->

                            <div class="group-material">
                                Fecha de Compra
                                <input type="text" class="tooltips-general material-control" name="fecha_factura" required="" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                

                            </div> 
 

                            <div class="group-material">
                            
                            
                                 <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="material-control tooltips-general check-representative" required="" data-toggle="tooltip" maxlength="8" data-placement="top" placeholder="Escribe la PLACA o RAMV" name="placa" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>PLACA o RAMV</label>
                            </div>
                             


                            <div class="group-material">
                                <span>Seleccione Marca </span> 
                                 <select name="marca" id="marca" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                  <option value="0">Seleccione</option>
                                 <?php 
                                  $selecmarca=$conexion->query("select * from tb_marca");
                                  while($marcas=mysqli_fetch_array($selecmarca)){ 
                                  ?>
                                   <option value="<?php echo $marcas['id_marca']; ?>"><?php echo $marcas['descripcion']; ?></option>
                                   <?php } ?>
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div> 

                            <div class="group-material">
                                <span>Seleccione Modelo </span> 
                                 <select name="modelo" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                 
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div> 


                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="Escribe el numero de motor del Vehículo" title="Describa el motor" name="motor">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Motor</label>
                            </div>

                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="Escribe el chasis del Vehículo" title="Describa el chasis" name="chasis">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Chasis</label>
                            </div>
                             <div class="group-material">    
                              <span>Año de produccion </span> 
                                <br>
                               
                          <select class="selectpicker material-control" name="año_produccion" required="">
                          <option selected="" disabled>Seleccione </option> 
                             <?php 
                                $hoy=date('Y');
                                $atras=$hoy-15;
                                for($i=$hoy;$i>=$atras;$i--){?>
                                     <option value="<?php echo $i; ?>"><?php echo ($i); ?></option>
 
                              <?php    }
                              ?>                      
                               </select>

                            </div>

                         
                            <div class="group-material">
                            Fecha de inicio y fin Poliza
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="Fecha de inicio y fin de Poliza " readonly="" title="Describa la fecha" name="fecha_fin_poliza" required="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div>
                            <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                              
                         ?>

                            <div class="group-material">
                                <span>Seleccione la aseguradora </span> 
                                <br>
                               
                          <select class="selectpicker material-control" name="aseguradora" data-live-search="true" required="">
                          <option selected="" disabled>Seleccione </option>

                           <?php  
                           $sqlproveedore=$conexion->query("SELECT *  FROM  tb_proveedores where estado='ACTIVO' and activi_comercial like '%SEGURO%' ");
                             
                             while($row=$sqlproveedore->fetch_array()){ ?>

                              <option value="<?php echo $row['id_proveedores']; ?>"><?php echo ($row['nombres']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>

                     <div class="group-material">
                     Fecha de Vencimiento Matricula
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20"  data-toggle="tooltip" data-placement="top"  placeholder="Escribe Vencimiento de matricula del Vehículo" title="Fecha matricula" readonly="" name="venci_matricula" required="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            
                          
                          
                            <div class="group-material" hidden="hidden">
                                <span>Fecha de registro</span> 
                                  <input type="" class="tooltips-general material-control"  required="" data-toggle="tooltip" data-placement="top" readonly name="fecha_registro" value="<?php echo date("Y-m-d");?>" >
                            </div>
                              
                            <p class="text-center">
                               <!--  <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;  
                            </p>
                       </div>

                   </div>
                </div>
            </form>  
        </div> 
        	

        </section>
        </div>
   
      
        
 </body>
<script type="text/javascript">
$(document).ready(function(){


  $('select[name=marca]').change(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('select[name=marca]').val();
                        
                            $.post("controler/consulta_modelo.php",{cedula:id_persona},function(data,status){
                                
                                    console.log(data);
                                    console.log(status);
                                    $('select[name=modelo]').html(data);
                               
                                  //   swal({
                                  //       title: "Advertencia?",
                                  //     text: "Ya se encuentra registrado!",
                                  //     type: "warning",
                                  //     confirmButtonColor: "#DD6B55",
                                  //     confirmButtonText: "Aceptar!"
                                  // },
                                  // function(){
                                  //       location.href="addsocio.php";
                                      
                                  // });
                                
                               
                            });
                       
                    
                });

   $('input[name=fecha_factura]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                         autoUpdateInput: false,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 30,
                        locale: {
                          cancelLabel: 'Clear',
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

    $('input[name="fecha_factura"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

       $('input[name="fecha_factura"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });


        $('input[name=venci_matricula]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        drops:"up",
                         autoUpdateInput: false,
                        locale: {
                          cancelLabel: 'Clear',
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

    $('input[name="venci_matricula"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

       $('input[name="venci_matricula"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

              $('input[name=fecha_inicio_poliza]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                         autoUpdateInput: false,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 30,
                        locale: {
                          cancelLabel: 'Clear',
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

    $('input[name="fecha_inicio_poliza"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

       $('input[name="fecha_inicio_poliza"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

                     $('input[name=fecha_fin_poliza]').daterangepicker({
                        showDropdowns: true,
                         autoUpdateInput: false,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 30,
                        locale: {
                          cancelLabel: 'Clear',
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

    $('input[name="fecha_fin_poliza"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD')+ ' - ' + picker.endDate.format('YYYY-MM-DD'));
  });

       $('input[name="fecha_fin_poliza"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

 $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
                });

// $('#registra').click(function(e){
//     e.preventDefault();
//     alert('h');
// });

});
</script>
 </html>