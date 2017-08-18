<?php 
session_start();
if(!isset($_SESSION['usuario'])){
require_once('../login/cerrar_sesion.php'); 
}
// echo $cedula;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <title>Registrar Socio</title>
   <?php 
    session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
        require_once('meta.php');
     ?>
 </head>
 <body>

 <?php   
 if(isset($_POST['registra'])){
require_once('login/conexion.php');
            $cedulasocio = $_POST['cedula'];
            $nombressocio = $_POST['nombressocio'];
            $apellidossocio = $_POST['apellidossocio'];
            $telefonousocio= $_POST['telefono1socio'];
            $telefonodsocio= $_POST['telefono2socio'];
            $telefonotsocio= $_POST['telefono3socio'];
            $direccionsocio = $_POST['direccionsocio']; 
            $correo = $_POST['correo']; 
            $estado_civil = $_POST['estado_civil']; 
    $tipo_licenciansocio = $_POST['tipo_licenciansocio'];
    $fecha_naci = $_POST['fecha_nacimiento'];    
                $fecha_ingreso = $_POST['fecha_ingreso'];
                $valor = $_POST['inscripcion'];

           
        $query="call insertar_socio('$cedulasocio','$nombressocio','$apellidossocio','$telefonousocio','$telefonodsocio','$telefonotsocio', '$direccionsocio','$correo','$estado_civil','$tipo_licenciansocio','$fecha_naci','$fecha_ingreso',$valor)";
        $a=$conexion->query($query);     
        if($a){
        echo '<script type="text/javascript">swal("Ok!", "Socio agregado con exito!", "success")</script>';    
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>';    
    }
              
require_once('login/cerrar_conexion.php');
            ?>

 }


 <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile custom-scroll-containers">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
                SINDICATO
            </div>
            <div class="full-reset" style="background-color:#2B3D51; padding: 10px 0; color:#fff;">
                <figure>
                    <img src="assets/img/user02.png" alt="Biblioteca" class="img-responsive center-box" style="width:55%;">
                </figure>
                <p class="text-center" style="padding-top: 15px;">Bienvenido/a <?php   echo$_SESSION['tipo_usuario'];?></p>
            </div>
    <div class="full-reset nav-lateral-list-menu">
        <ul class="list-unstyled">
          <li><a href="sindnaranjal.php" id="inicio"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
             <li>
                <div class="dropdown-menu-button"><i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp; ADMINISTRATIVO <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                 <ul class="list-unstyled">
                <li><a href="socios.php" id="socio"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp; Socios</a></li>
                <li><a href="#" id="vehiculo"><i class="zmdi zmdi-truck zmdi-hc-fw"></i>&nbsp;&nbsp; Vehículos</a></li> 
                <li><a href="#" id="alquiler"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>&nbsp;&nbsp;  Beneficios</a></li>
                <li><a href="#" id="usuarios"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>&nbsp;&nbsp; Usuarios</a></li>
         <li><a href="#" id="rh"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>&nbsp;&nbsp; Recursos humanos</a></li>
                </ul>
            </li>
            <li>
                <div class="dropdown-menu-button"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; EDUCATIVO <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                <ul class="list-unstyled">
                    <li><a href="#"><i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Docentes</a></li>
                    <li><a href="#"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Estudiantes</a></li>
                    <li><a href="#"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp; Asignaturas</a></li> 
                </ul>
            </li>
            <li>
                <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; CONTABLE <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                <ul class="list-unstyled">
                    <li><a href="#"><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp; Inventario</a></li>
                    <li><a href="#"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Ingresos/Egresos</a></li>
                    <li><a href="#"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Cuentas por cobrar/pagar</a></li>
                </ul>
            </li>
        <li>
          <div class="dropdown-menu-button"><i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; REPORTES <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
            <ul class="list-unstyled">
                <li><a href="#"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Inventario</a></li>
                <li> <a href="#"><i class="zmdi zmdi-time-restore zmdi-hc-fw"></i>&nbsp;&nbsp; Docentes </a> </li>
                <li>  <a href="#"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Notas </a> </li> 
                <li>
                    <a href="#"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Certificados </a></li>
            </ul>
        </li>
                   
            </ul>
        </div>
    </div>
    </div>
     <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="assets/img/user02.png" alt="user-picture" class="img-responsive img-circle center-box">
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
                    <div class="title-flat-form title-flat-blue">Nuevo Socio</div>
                    <div class="row"><h3 style="color: #E75A5A">DESPU&Eacute;S DE REGISTRAR UN SOCIO NUEVO REGISTRAR&Aacute; SU INGRESO RESPECTIVO</h3>
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong>Información básica</strong></legend><br> 
                           
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí la C&eacute;dula de Identidad del socio" 
                                pattern="[0-9]{1,20}" required="" 
                                onblur="" maxlength="10" id="ced"
                                 data-toggle="tooltip" data-placement="top" title="Escribe el n&uacute;mero de cedula del socio, solamente números" name="cedula">
                                <span class="highlight"></span>
                                <span class="bar"></span> C&eacute;dula de Identidad 
                                
                                <!-- 
                                 <div id="flotante" style="display:none;  margin: 0 5px;
                                padding: 0 5px;
                                font-size: 14px;
                                color: #fff;
                                background-color: #E34724;
                                border-radius: 4px;
                                font-weight: normal;
                                float: left;">Cédula Inválida</div>
                                <div id="flotante2" style="display:none;  margin: 0 5px;
                                padding: 0 5px;
                                font-size: 14px;
                                color: #fff;
                                background-color: #E34724;
                                border-radius: 4px;
                                font-weight: normal;
                                float: left;">Cédula Válida</div>
                                <div id="flotante3" style="display:none;  margin: 0 5px;
                                padding: 0 5px;
                                font-size: 14px;
                                color: #fff;
                                background-color: #E34724;
                                border-radius: 4px;
                                font-weight: normal;
                                float: left;">Ingrese una cédula válida</div> -->
                                
                                
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control letras" placeholder="Escribe aquí los nombres del socio" required="" 
                                 maxlength="40" data-toggle="tooltip" onkeyup="javascript:this.value=this.value.toUpperCase();" data-placement="top" title="Escribe los nombres del socio" name="nombressocio"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombres</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control letras" placeholder="Escribe aquí los Apellidos del socio" required="" maxlength="40" data-toggle="tooltip" data-placement="top"  onkeyup="javascript:this.value=this.value.toUpperCase();" title="Escribe los apellidos del socio" name="apellidossocio">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Apellidos</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí el número de teléfono" pattern="[0-9]{1,20}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Escribe el número para contactar al socio en algún caso, solamente números" name="telefono1socio" maxlength="10"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>1er Tel&eacute;fono de Cont&aacute;cto</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí el número de teléfono" pattern="[0-9]{1,20}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Escribe el número para contactar al socio en algún caso, solamente números" name="telefono2socio" maxlength="10"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>2do Tel&eacute;fono de Cont&aacute;cto</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí el número de teléfono" pattern="[0-9]{1,20}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Escribe el número para contactar al socio en algún caso, solamente números" name="telefono3socio" maxlength="10"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>3er Tel&eacute;fono de Cont&aacute;cto</label>
                            </div>
                            <div class="group-material"> 
                                 <select style="color:red;" name="tipo_licenciansocio" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                   <option value="C" selected="">C</option>
                                   <option value="D">D</option>
                                   <option value="E">E</option> 
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí la dirección domiciliaria del socio" required="" maxlength="40" data-toggle="tooltip" data-placement="top"  onkeyup="javascript:this.value=this.value.toUpperCase();" title="Escriba la dirección" name="direccionsocio">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Direcci&oacute;n Domiciliaria</label>
                            </div>
                            <div class="group-material">
                                <input type="email" class="tooltips-general material-control" placeholder="Escribe aquí la dirección domiciliaria del socio" required="" maxlength="40" data-toggle="tooltip" data-placement="top" title="Escriba la dirección de correo" name="correo">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Direcci&oacute;n de correo </label>
                            </div>
                            <div class="group-material">
                               <select style="color:red;" name="estado_civil" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                   <option value="" disabled="" selected="">Seleccione el estado civíl</option>
                                   <option value="SOLTERO/A">SOLTERO/A</option>
                                   <option value="CASADO/A">CASADO/A</option>
                                   <option value="VIUDO/A">VIUDO/A</option>
                                   <option value="DIVORCIADO/A">DIVORCIADO/A</option>
                                   <option value="DIVORCIADO/A">UNIDO/A</option>
                                   <option value="DIVORCIADO/A">OTRO</option>
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span> 
                           </div>                    
                              
                          <div class="group-material">
                          Fecha de Nacimiento
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha de Nacimiento" name="fecha_nacimiento" required value="01/01/1990" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div> 

                           <div class="group-material">
                           Fecha de Ingreso
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Ingreso" name="fecha_ingreso" required value="" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div> 
                            <?php 
                            require_once("../login/conexion.php"); 

                            $sql=mysqli_query($conexion,"SELECT * FROM `tb_pagos_socio` WHERE descripcion='INSCRIPCION' and fecha=(SELECT MAX(fecha) FROM tb_pagos_socio)");
                        
                            ?>

                            <div class="group-material">
                             Valor de la Inscripcion
                            <?php while($consulta=mysqli_fetch_array($sql)){ ?>  
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Valor Inscripcion" name="" required value="<?php echo $consulta['valor']; ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="inscripcion" value="<?php echo $consulta['id_pagos_socio']; ?>">
                            <?php } 
                                             require_once('../login/cerrar_conexion.php'); ?>

                            
                           
                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button>
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


                $('input[name=cedula]').focusout(function(){
                        // alert($('input[name=apellido]').val());
                        var cedula=$('input[name=cedula]').val();
                        // console.log=(cedula);
                        if (cedula!=""){
                            // console.log(cedula);
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
                            
                            $.post("controler/verificar_cedula.php",{cedula:cedula},function(data,status){
                                if(data=='ok'){
                                    
                                }else{
                                    swal({
                                        title: "Advertencia?",
                                      text: "Ya se encuentra registrado!",
                                      type: "warning",
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
                })

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