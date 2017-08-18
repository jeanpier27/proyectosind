<?php 
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
// echo $cedula;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>Registrar Socio</title>
   <?php 
        require_once('meta.php');
        require_once('login/conexion.php');
     ?>
 </head>
 <body>
<script type="text/javascript">
    $(document).ready(function(){
            $('#contsocio').attr("style","display:block;");
            $('#rh').attr("style","background-color:#E75A5A;");
              
            });
</script>
 <?php   
 if(isset($_POST['registra'])){
                $id_per=$_POST['nombres'];
                $sueldo = $_POST['sueldo'];
                $cargo = $_POST['cargo'];    
                $fecha = $_POST['fecha_ingreso'];

$fecha1=substr($fecha, 0, -13);
$fecha2=substr($fecha, 13);
           
        $query="insert into tb_empleado (id_persona,sueldo,cargo,fecha_inicio,fecha_fin,estado,observacion)values('".$id_per."','".$sueldo."','".$cargo."','".$fecha1."','".$fecha2."','ACTIVO','')";
        $a=$conexion->query($query);     
        if($a){
           
        echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="addempleado.php";});</script>';    
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el empleado!", "error")</script>';    
    }
              
require_once('login/cerrar_conexion.php');
}

            ?>

 

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
        <section>
          <form autocomplete="" action="" method="post" id="formreg" name="formreg"> 
                
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Nuevo Empleado</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT tb_empleado.*,tb_personas.*  FROM  tb_personas left join tb_empleado on tb_empleado.id_persona=tb_personas.id_persona where tb_empleado.id_persona is null order by tb_personas.apellido");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                                <span>Seleccione al nuevo Empleado </span> 
                               
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sqlsocio->fetch_array()){ ?>

                              <option value="<?php echo $row['id_persona']; ?>"><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>
                           
                       
                             
                          
                           

                             <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Valor Abonar" name="sueldo" required  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Sueldo A Recibir</label>

                            </div> 


                             <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control letras" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top" title="Cargo" name="cargo" required  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cargo</label>

                            </div> 


                            <div class="group-material">
                           Fecha de Ingreso y de Salida del empleado
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Ingreso" name="fecha_ingreso" required value="" readonly="" required="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div>                   
                           
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>
            </form> 
        </section>
 </body>
 </html>


            <script type="text/javascript">
                $(document).ready(function(){
                   
                $('input[name=fecha_ingreso]').daterangepicker({
                         linkedCalendars: false,
                        autoUpdateInput: false,
                        showDropdowns: true,
                        drops: "up",
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

                    $('input[name="fecha_ingreso"]').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                  });

                    $('input[name="fecha_ingreso"]').on('cancel.daterangepicker', function(ev, picker) {
                      $(this).val('');
                  });


                // $('select[name=nombres]').change(function(){
                //         // alert($('select[name=nombres]').val());s
                //         var id_persona=$('select[name=nombres]').val();
                        
                //             $.post("controler/verificar_socio.php",{cedula:id_persona},function(data,status){
                //                 if(data=='ok'){
                //                     console.log(data);
                //                     console.log(status);
                //                 }else{
                //                     console.log(data);
                //                     console.log(status);
                //                     swal({
                //                         title: "Advertencia?",
                //                       text: "Ya se encuentra registrado!",
                //                       type: "warning",
                //                       confirmButtonColor: "#DD6B55",
                //                       confirmButtonText: "Aceptar!"
                //                   },
                //                   function(){
                //                         location.href="addsocio.php";
                                      
                //                   });
                //                 }
                               
                //             });
                       
                    
                // });

                $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
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

                // $('#registra').click(function(e){
                //         var id=$('form').serializeArray();
                //         e.preventDefault();
                        
                        
                //         $.post("controler/insert_socio.php",id,function(data,status){
                //             console.log(data);
                //             console.log(status);
                //         });
                // });
                
               
            });
</script>