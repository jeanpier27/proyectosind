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
   <title>Registro Recurso Humano</title>
   <?php 
        require_once('meta.php');
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
require_once('login/conexion.php'); ?>

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
          <form autocomplete="off" action="" method="post" id="formreg" name="formreg"> 
                
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Recurso Humano</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong>Información básica</strong></legend><br> 
                           
                            <div class="group-material">
                            <input type="hidden" name="id_persona">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí la C&eacute;dula de Identidad" 
                                pattern="[0-9]{1,20}" required="" 
                                onblur="" maxlength="13" id="ced"
                                 data-toggle="tooltip" data-placement="top" title="Escribe el n&uacute;mero de cedula, solamente números" name="cedula">
                                <span class="highlight"></span>
                                <span class="bar"></span> C&eacute;dula de Identidad 
                             
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control letras" placeholder="Escribe aquí los nombres" required="" maxlength="40" data-toggle="tooltip" onkeyup="javascript:this.value=this.value.toUpperCase();" data-placement="top" title="Escribe los nombres" name="nombressocio"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control letras" placeholder="Escribe aquí los Apellidos" required="" maxlength="40" data-toggle="tooltip" data-placement="top"  onkeyup="javascript:this.value=this.value.toUpperCase();" title="Escribe los apellidos" name="apellidossocio">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí el número de teléfono" pattern="[0-9]{1,20}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Escribe el número para contactar, solamente números" name="telefono1socio" maxlength="10"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>1er Tel&eacute;fono de Cont&aacute;cto</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí el número de teléfono" pattern="[0-9]{1,20}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Escribe el número para contactar, solamente números" name="telefono2socio" maxlength="10"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>2do Tel&eacute;fono de Cont&aacute;cto</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí el número de teléfono" pattern="[0-9]{1,20}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Escribe el número para contactar, solamente números" name="telefono3socio" maxlength="10"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>3er Tel&eacute;fono de Cont&aacute;cto</label>
                            </div>
                           
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí la dirección domiciliaria" required="" maxlength="40" data-toggle="tooltip" data-placement="top"  onkeyup="javascript:this.value=this.value.toUpperCase();" title="Escriba la dirección" name="direccionsocio">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Direcci&oacute;n Domiciliaria</label>
                            </div>
                            <div class="group-material">
                                <input type="email" class="tooltips-general material-control" placeholder="Escribe aquí la dirección domiciliaria"  maxlength="40" data-toggle="tooltip" data-placement="top" title="Escriba la dirección de correo" name="correo">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Direcci&oacute;n de correo </label>
                            </div>
                            <div class="group-material">
                               <select style="color:red;" name="estado_civil" id="estado_civil" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                   <option value="0" disabled="" selected="">Seleccione el estado civíl</option>
                                   <option value="SOLTERO/A">SOLTERO/A</option>
                                   <option value="CASADO/A">CASADO/A</option>
                                   <option value="VIUDO/A">VIUDO/A</option>
                                   <option value="DIVORCIADO/A">DIVORCIADO/A</option>
                                   <option value="UNIDO/A">UNIDO/A</option>
                                   <option value="OTRO">OTRO</option>
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span> 
                           </div>       

                           <div class="group-material">
                                  Fecha Nacimiento
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí fecha de nacimiento" data-toggle="tooltip" data-placement="top" title="Escriba fecha de nacimiento" name="fecha_n" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <!-- <label>Direcci&oacute;n de correo </label> -->
                            </div>

                           <div class="group-material">
                               <select style="color:red;" name="sexo" id="sexo" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                   <option value="0" disabled="" selected="">Seleccione Sexo</option>
                                   <option value="HOMBRE">HOMBRE</option>
                                   <option value="MUJER">MUJER</option>
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span> 
                           </div>                 
                  
                           
                            <p class="text-center">
                            <a href="addrecursohumano.php" class="btn btn-info"><i class="zmdi zmdi-floppy"></i> LIMPIAR</a>
                                
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>
            </form> 
        </section>
 </body>
 </html>
 <?php   
 if(isset($_POST['registra'])){
            $cedulasocio = $_POST['cedula'];
            $nombressocio = $_POST['nombressocio'];
            $apellidossocio = $_POST['apellidossocio'];
            $telefonousocio= $_POST['telefono1socio'];
            $telefonodsocio= $_POST['telefono2socio'];
            $telefonotsocio= $_POST['telefono3socio'];
            $direccionsocio = $_POST['direccionsocio']; 
            $correo = $_POST['correo']; 
            $estado_civil = $_POST['estado_civil']; 
            $fecha_n = $_POST['fecha_n']; 
            $sexo = $_POST['sexo']; 


            if($estado_civil!="" and $fecha_n!="" and $sexo!=""){

              
        $query="call insertar_persona('$cedulasocio','$nombressocio','$apellidossocio','$telefonousocio','$telefonodsocio','$telefonotsocio', '$direccionsocio','$correo','$estado_civil','$fecha_n','$sexo')";
        $a=$conexion->query($query);     
        if($a){
        echo '<script type="text/javascript">swal("Ok!", "Agregado con exito!", "success")</script>';    
        header('Location: addrecursohumano.php');
            
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>';    
    }
  }else{
    echo '<script type="text/javascript">swal("Error!", "Debe seleccionar todos los campos!", "error")</script>'; 
  }
  }
 
 if(isset($_POST['actualizar'])){
            $id_persona = $_POST['id_persona'];
            $cedulasocio = $_POST['cedula'];
            $nombressocio = $_POST['nombressocio'];
            $apellidossocio = $_POST['apellidossocio'];
            $telefonousocio= $_POST['telefono1socio'];
            $telefonodsocio= $_POST['telefono2socio'];
            $telefonotsocio= $_POST['telefono3socio'];
            $direccionsocio = $_POST['direccionsocio']; 
            $correo = $_POST['correo']; 
            $estado_civil = $_POST['estado_civil']; 
            $fecha_n = $_POST['fecha_n']; 
            $sexo = $_POST['sexo'];
              
        $query="update tb_personas set nombre='".$nombressocio."',apellido='".$apellidossocio."',telefono1='".$telefonousocio."',telefono2='".$telefonodsocio."',telefono3='".$telefonotsocio."',direccion= '".$direccionsocio."',correo='".$correo."',estado_civil='".$estado_civil."',fecha_n='".$fecha_n."',sexo='".$sexo."' where id_persona='".$id_persona."'";
        $a=$conexion->query($query);     
        if($a){
        echo '<script type="text/javascript">swal("Ok!", "Actualizado con exito!", "success")</script>';  
        header('Location: addrecursohumano.php') ; 
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo ctualizar el socio!", "error")</script>';    
    }
              
require_once('login/cerrar_conexion.php');}

            ?>

            <script type="text/javascript">
                $(document).ready(function(){

                  $('input[name=fecha_n]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        drops: "up",
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
                   
                

                $('input[name=cedula]').focusout(function(){
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
                                  $('button[name=actualizar]').attr("name","registra");
                                    $('button[name=registra]').attr("name","registra");
                                    // $('input[name=cedula]').val('');
                                      $('input[name=nombressocio]').val('');
                                      $('input[name=apellidossocio]').val('');
                                      $('input[name=telefono1socio]').val('');
                                      $('input[name=telefono2socio]').val('');
                                      $('input[name=telefono3socio]').val('');
                                      $('input[name=direccionsocio]').val('');     
                                      $('input[name=correo]').val('');
                                      $('input[name=estado_civil]').val('');
                                }else{
                                  swal("Advertencia!", "Ya se encuentra registrado solo podra editarlo!", "warning")
                                    var dato=JSON.parse(data);
                                   var dato=JSON.parse(data);
                                    // console.log(dato);
                                    for(var i in dato.datos){
                                      $('button[name=registra]').attr("name","actualizar");
                                      $('input[name=id_persona]').val(dato.datos[i].id_persona);
                                      $('input[name=cedula]').val(dato.datos[i].cedula_ruc);
                                      $('input[name=nombressocio]').val(dato.datos[i].nombre);
                                      $('input[name=apellidossocio]').val(dato.datos[i].apellido);
                                      $('input[name=telefono1socio]').val(dato.datos[i].telefono1);
                                      $('input[name=telefono2socio]').val(dato.datos[i].telefono2);
                                      $('input[name=telefono3socio]').val(dato.datos[i].telefono3);
                                      $('input[name=direccionsocio]').val(dato.datos[i].direccion);     
                                      $('input[name=correo]').val(dato.datos[i].correo);
                                      $("#estado_civil> option[value='"+dato.datos[i].estado_civil+"']").attr("selected",true);
                                      $('input[name=fecha_n]').val(dato.datos[i].fecha_n);
                                      $("#sexo> option[value='"+dato.datos[i].sexo+"']").attr("selected",true);


                                      // $("#estado_civil option[value="+dato.datos[i].estado_civil+"]").attr("selected",true);


                                    }
                                  //   swal({
                                  //       title: "Error?",
                                  //     text: "Ya se encuentra registrado!",
                                  //     type: "error",
                                  //     confirmButtonColor: "#DD6B55",
                                  //     confirmButtonText: "Aceptar!"
                                  // },
                                  // function(){
                                      
                                  //    location.href="addrecursohumano.php";
                                  // });
                                }
                               
                            });
                        }else{
                            console.log('incorrecto');
                            swal({
                                        title: "Error?",
                                      text: "Cedula invalida!",
                                      type: "error",
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                      
                                     location.href="addrecursohumano.php";
                                  });
                            
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