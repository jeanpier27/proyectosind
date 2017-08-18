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
 



                    <div class="title-flat-form title-flat-blue">Mantenimiento Veh&iacute;culo</div> 
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2"> 
                       <?php   

    if(isset($_POST['registra'])){
                                   
                    $n_factura=$_POST['n_factura'];
                    $fecha_factura= $_POST['fecha_factura'];
                    $descripcion      = $_POST['descripcion'];
                    $id_vehiculo      = $_POST['nombres'];
                    $fecha=date('Y-m-d H:i:s');
                    $observaciontotal=$observacionbd.' ('.$fecha.' usuario: '.$_SESSION['nombres'].'.- Ingreso)';
                                
                        $query ="INSERT INTO tb_mantenimiento_vehiculo (id_vehiculo,n_factura,fecha_fact,descripcion,estado,observacion) VALUES ('".$id_vehiculo."','".$n_factura."','".$fecha_factura."','".$descripcion."','ACTIVO','".$observaciontotal."')";

                        $resultado = $conexion->query($query); 
                        if($resultado){

                               echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="facturas_x_cobrar.php?n_factura='.$n_factura.'&fecha_fact='.$fecha_factura.'&descripcion='.$descripcion.'";});});</script>';

                      }
                  
                   }
                  ?>       

                             <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="N.- de Factura" title="Describa la factura" name="n_factura">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>N.- Factura</label>
                            </div> 

                            <div class="group-material">
                                Fecha de Factura
                                <input type="text" class="tooltips-general material-control" name="fecha_factura" required="" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                

                            </div> 


                            <div class="group-material">
                            
                            
                                 <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="material-control tooltips-general check-representative" required="" data-toggle="tooltip" data-placement="top" placeholder="Descripcion" name="descripcion" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>
                            </div>
                               <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT *  FROM  tb_vehiculo ");   
                         ?>

                         <div class="group-material">
                                <span>Seleccione el vehículo </span> 
                               
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sqlsocio->fetch_array()){ ?>

                              <option value="<?php echo $row['id_vehiculo']; ?>"><?php echo ($row['placa']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

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
   $('input[name=fecha_factura]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
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

    $('input[name="fecha_factura"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

       $('input[name="fecha_factura"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });



});
</script>
 </html>