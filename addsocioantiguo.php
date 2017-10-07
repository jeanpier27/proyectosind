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
            $('#socio').attr("style","background-color:#E75A5A;");
              
            });
</script> 
 <?php   
 if(isset($_POST['registra'])){
                $id_per=$_POST['nombres'];
                $tipo_licenciansocio = $_POST['tipo_licenciansocio'];
                $fecha_naci = $_POST['fecha_nacimiento'];    
                $fecha_ingreso = $_POST['fecha_ingreso'];
                $beneficiario=$_POST['beneficiario'];


           $update=$conexion->query("update tb_personas set fecha_n='".$fecha_naci."' where id_persona=".$id_per);
        $query="insert into tb_socio (id_persona,tipo_licencia,fecha_ingreso,estado,id_pagos_socio,fecha_naci,fecha_registro,beneficiario)values('".$id_per."','".$tipo_licenciansocio."','".$fecha_ingreso."','ACTIVO','1','".$fecha_naci."','".$fecha_ingreso."','')";

        $a=$conexion->query($query);  
        if($update){

        if($a){
            
        echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="addsocioantiguo.php";});</script>';    
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>';    
    }
  }else{
      echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>'; 
  }
              

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
                    <div class="title-flat-form title-flat-blue">Socio</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT `tb_personas`.`id_persona`as id_per, `tb_personas`.`cedula_ruc`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_personas`.`telefono1`, `tb_personas`.`telefono2`, `tb_personas`.`telefono3`, `tb_personas`.`direccion`, `tb_personas`.`correo`, `tb_personas`.`estado_civil`, `tb_socio`.* FROM `tb_personas` LEFT JOIN `tb_socio` ON `tb_socio`.`id_persona` = `tb_personas`.`id_persona` where tb_socio.id_persona is null order by tb_personas.apellido");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                                <span>Seleccione al nuevo Socio </span> 
                               
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sqlsocio->fetch_array()){ ?>

                              <option value="<?php echo $row['id_per']; ?>"><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>
                           
                 
                            <div class="group-material"> 
                             <span>Seleccione tipo de licencia </span> 
                                 <select style="color:red;" name="tipo_licenciansocio" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                   <option value="C" selected="">C</option>
                                   <option value="D">D</option>
                                   <option value="E">E</option> 
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div>
                 
                              
                          <div class="group-material">
                          Fecha de Nacimiento
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha de Nacimiento" name="fecha_nacimiento" required value="2000-01-01" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div> 

                           <div class="group-material">
                           Fecha de Ingreso
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Ingreso" name="fecha_ingreso" required value="" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div> 
                            <div class="group-material">
                          Beneficiario
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Beneficiario" name="beneficiario" >
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div> 
                           

                        
                            <?php 
                                             require_once('login/cerrar_conexion.php'); ?>


                            
                           
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

<?php require_once('login/cerrar_conexion.php');
$hoy=date('Y/m/d');
 ?>

            <script type="text/javascript">
                $(document).ready(function(){
                   
                    $('input[name=fecha_nacimiento]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
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
                    $('input[name=fecha_ingreso]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
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

                    $('input[name=fecha_registro]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
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

                // $('input[name=fecha_nacimiento]').change(function(){
                //     console.log($(this).val());
                // });



                $('select[name=nombres]').change(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('select[name=nombres]').val();
                        
                            $.post("controler/verificar_socio.php",{cedula:id_persona},function(data,status){
                                if(data!='no'){
                                    // console.log(data);
                                    // console.log(status);
                                    $('input[name=fecha_nacimiento]').val(data);
                                }else{
                                  $('input[name=fecha_nacimiento]').val("");
                                    // console.log(data);
                                    // console.log(status);
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
                                }
                               
                            });
                       
                    
                });



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

       var comprob = '<?php echo $Comprob = isset($_REQUEST["ingreso"]) ? $_REQUEST["ingreso"]: "nada"; ?>';
        if (comprob != "nada") {
            VentanaCentrada('comprobante_ingreso_sind.php?id='+comprob,'Recaudaciones','','1000','500','true');
        }


            function VentanaCentrada(theURL,winName,features, myWidth, myHeight, isCenter) { 
                if(window.screen)if(isCenter)if(isCenter=='true'){
                  var myLeft = (screen.width-myWidth)/2;
                  var myTop = (screen.height-myHeight)/2;
                  features+=(features!='')?',':'';
                  features+=',left='+myLeft+',top='+myTop;
              }
              window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
            } 



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