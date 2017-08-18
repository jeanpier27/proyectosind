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
            $('#rh').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Proveedores</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
        	<form autocomplete="" action="" method="post" id="formreg" name="formreg"> 
                
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Proveedores</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            // $sqlsocio=$conexion->query("SELECT *  FROM  tb_personas ");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  

                         <div class="group-material">
                         <input type="hidden" name="id_proveed">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Ingrese el Ruc" name="ruc" required value="" maxlength="13">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>RUC</label>

                            </div> 

                             <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control letras"  data-toggle="tooltip" data-placement="top" title="Ingrese el Ruc" name="actividad_co" required value="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Actividad Comercial</label>

                            </div>
                            

                         <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control letras"  data-toggle="tooltip" data-placement="top" title="Ingrese Nombres Completos o Compañia" name="nombres" required value="" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres Completos o Compañia</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Ingrese Nombres Completos o Compañia" name="telefono" required value="" maxlength="10">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Ingrese Direccion" name="direccion" required value="" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección</label>

                            </div> 

                            <div class="group-material">
                                <input type="email" class="tooltips-general material-control" placeholder="Escribe aquí la dirección domiciliaria del socio" maxlength="40" data-toggle="tooltip" data-placement="top" title="Escriba la dirección de correo" name="correo">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Direcci&oacute;n de correo </label>
                            </div>
                          

                           <div class="group-material">
                           Fecha de Registro
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Ingreso" name="fecha_ingreso" required value="<?php echo date('Y-m-d'); ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div> 

                           
                            <p class="text-center">
                                
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>
            </form> 
        	

        </section>
        </div>

      <?php 
      if(isset($_POST['registra'])){
        $ruc=$_POST['ruc'];
        $nombres=$_POST['nombres'];
        $telefono=$_POST['telefono'];
        $diereccion=$_POST['direccion'];
        $fecha_ingreso=$_POST['fecha_ingreso'];
        $correo=$_POST['correo'];
        $actividad=$_POST['actividad_co'];


        $query="insert into tb_proveedores (ruc,nombres,telefono,direccion,correo,estado,id_usuario,activi_comercial) values ('".$ruc."','".$nombres."','".$telefono."','".$diereccion."','".$correo."','ACTIVO','".$_SESSION['id_usuario']."','".$actividad."')";
        $a=$conexion->query($query); 

        if($a){
            echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="proveedores.php";});</script>';
        }else{
            echo '<script type="text/javascript">swal({title: "Error", text: "Error...!", type: "error",  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="proveedores.php";});</script>';

        }
        require_once('login/cerrar_conexion.php');

      }

      if(isset($_POST['actualizar'])){
        $id_proveedor=$_POST['id_proveed'];
        $ruc=$_POST['ruc'];
        $nombres=$_POST['nombres'];
        $telefono=$_POST['telefono'];
        $diereccion=$_POST['direccion'];
        $fecha_ingreso=$_POST['fecha_ingreso'];
        $correo=$_POST['correo'];
        $actividad=$_POST['actividad_co'];


        $query="update tb_proveedores set nombres ='".$nombres."',telefono = '".$telefono."',direccion = '".$diereccion."',correo = '".$correo."' ,activi_comercial= '".$actividad."' where id_proveedores='".$id_proveedor."' ";
        $a=$conexion->query($query); 

        if($a){
            echo '<script type="text/javascript">swal({title: "ok", text: "Actualizado con exito...!", type: "success",  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="proveedores.php";});</script>';
        }else{
            echo '<script type="text/javascript">swal({title: "Error", text: "Error...!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="proveedores.php";});</script>';

        }
        require_once('login/cerrar_conexion.php');

      }

$hoy=date('Y-m-d');
       ?>
        
 </body>
 <script type="text/javascript">
 	$(document).ready(function(){

 		$('#inicio').click(function(){
 			$('#contenedor').load('vistas/inicio.php');
 		});
 	


                $('input[name=ruc]').focusout(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('input[name=ruc]').val();

                        
                            $.post("controler/verificar_proveedor.php",{cedula:id_persona},function(data,status){
                                if(data=='ok'){
                                    // console.log(data);
                                    // console.log(status);
                                    var hoyss='<?php echo $hoy; ?>';
                                    $('button[name=actualizar]').attr("name","registra");
                                    $('button[name=registra]').attr("name","registra");
                                     $('input[name=id_proveed]').val('');
                                      $('input[name=actividad_co]').val('');
                                      $('input[name=nombres]').val('');
                                      $('input[name=direccion]').val('');
                                      $('input[name=telefono]').val('');
                                      $('input[name=correo]').val('');
                                      $('input[name=fecha_ingreso]').val(hoyss);
                                }else{
                                    // console.log(data);
                                    // console.log(status);
                                      swal("Advertencia!", "Ya se encuentra registrado solo podra editarlo!", "warning")
                                    var dato=JSON.parse(data);
                                    // console.log(dato);
                                    for(var i in dato.datos){
                                      $('button[name=registra]').attr("name","actualizar");
                                      $('input[name=id_proveed]').val(dato.datos[i].id_proveedores);
                                      $('input[name=actividad_co]').val(dato.datos[i].activi_comercial);
                                      $('input[name=nombres]').val(dato.datos[i].nombres);
                                      $('input[name=direccion]').val(dato.datos[i].direccion);
                                      $('input[name=telefono]').val(dato.datos[i].telefono);
                                      $('input[name=correo]').val(dato.datos[i].correo);
                                      $('input[name=fecha_ingreso]').val(dato.datos[i].fecha_ingreso);


                                    }
                                  //   swal({
                                  //       title: "Advertencia?",
                                  //     text: "Ya se encuentra registrado este proveedor!",
                                  //     type: "warning",
                                  //     confirmButtonColor: "#DD6B55",
                                  //     confirmButtonText: "Aceptar!"
                                  // },
                                  // function(){
                                  //       location.href="proveedores.php";
                                      
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
                 && (key.charCode != 46)
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
 </html>