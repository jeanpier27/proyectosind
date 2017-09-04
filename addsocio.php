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
                $valor = $_POST['inscripcion'];
                $abono = $_POST['abono'];
                $fecha_registro = $_POST['fecha_registro'];
                $descripcion = $_POST['descripcion'];
                $ingreso_n = $_POST['ingreso_n'];
                $comproante_bco = $_POST['comproante_bco'];
                $id_banco = $_POST['id_banco'];
                $beneficiario = $_POST['beneficiario'];
                $pla_cuent=70;

                $sqlcompro=$conexion->query("select 1 from tb_ingreso_sindicato where comprabante_n=".$ingreso_n);
                $respcom=mysqli_fetch_array($sqlcompro);
                if($respcom[0]!=1){
           
        $query="call insertar_socio('$id_per','$tipo_licenciansocio','$fecha_naci','$fecha_ingreso','$valor','$abono', '$fecha_registro','$descripcion','$ingreso_n','$comproante_bco','$id_banco','$beneficiario','$pla_cuent')";
        $a=$conexion->query($query);     
        if($a){
            $sqlsocio=$conexion->query("select id_persona,fecha_ingreso from tb_socio where id_persona ='".$id_per."'"); 
            $mensualidad= $conexion->query("SELECT * FROM `tb_pagos_socio` WHERE descripcion='CUOTAS MENSUALES'"); 
            $cesantia=$conexion->query("SELECT * FROM `tb_pagos_socio` WHERE descripcion='FONDO DE CESANTIA'"); 

            while($consultamen=mysqli_fetch_array($mensualidad)){
                $mensua=$consultamen['id_pagos_socio'];
                $valormens=$consultamen['valor'];
            }

            while($consultacesa=mysqli_fetch_array($cesantia)){
                $cesan=$consultacesa['id_pagos_socio'];
                $valorcesa=$consultacesa['valor'];
            }
            $hoy=date('Y-m-d');
            $añoactual=date('Y');
            $mesactual=date('n');

            while($consult=mysqli_fetch_array($sqlsocio)){  
                $mes=date('n',strtotime($consult['fecha_ingreso']));
                $año=date('Y',strtotime($consult['fecha_ingreso']));
                $mesess=(int)$mes;
                for($i=1;$i<=12;$i++){
                    if($i>=(int)$mesess and $año>=2017){
                        $insertar_recaudam=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$consult['id_persona']."','".$consult['fecha_ingreso']."','".$añoactual."','".$i."','".$mensua."','','0','ACTIVO','','".$valormens."','' )");

                        $insertar_recaudac=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$consult['id_persona']."','".$consult['fecha_ingreso']."','".$añoactual."','".$i."','".$cesan."','','0','ACTIVO','','".$valorcesa."','' )");

                    }
                    if($año<2017){
                        $insertar_recaudam=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$consult['id_persona']."','".$consult['fecha_ingreso']."','".$añoactual."','".$i."','".$mensua."','','0','ACTIVO','','".$valormens."','' )");

                        $insertar_recaudac=$conexion->query("INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$consult['id_persona']."','".$consult['fecha_ingreso']."','".$añoactual."','".$i."','".$cesan."','','0','ACTIVO','','".$valorcesa."','' )");

                    }
                }
              


            }

        echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="addsocio.php?ingreso='.$ingreso_n.'";});</script>';    
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>';    
    }
            }  else{
                echo '<script type="text/javascript">swal("Error!", "Ya se encuentra registrado ese comprobante socio!", "error")</script>'; 
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
                            <?php 
                            require_once("login/conexion.php"); 

                            $sql=mysqli_query($conexion,"SELECT * FROM `tb_pagos_socio` WHERE descripcion='INSCRIPCION'");
                        
                            ?>

                            <div class="group-material">
                             Valor de la Inscripcion
                            <?php while($consulta=mysqli_fetch_array($sql)){ $valorpa=$consulta['valor']; ?>  
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Valor Inscripcion" name="" required value="<?php echo $consulta['valor']; ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="inscripcion" value="<?php echo $consulta['id_pagos_socio']; ?>">
                            <?php } 
                                             // require_once('login/cerrar_conexion.php'); 
                                             ?>

                             <div class="group-material">
                                
                                <input type="number" class="tooltips-general material-control numero" step="0.01" max="<?php echo $valorpa; ?>" data-toggle="tooltip" data-placement="top" title="Valor Abonar" name="abono" required  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Abonar</label>

                            </div> 

                            <div class="group-material">
                                Fecha Registro
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_registro" required value="<?php echo date('Y-m-d'); ?>" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                            <div class="group-material">
                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" required value="INGRESO POR NUEVO SOCIO" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Beneficiario" name="beneficiario" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Beneficiario</label>

                            </div> 

                            <div class="group-material">
                            <?php 
                            $conuslt=$conexion->query("select max(comprabante_n)as comp from tb_ingreso_sindicato"); 
                            $res=mysqli_fetch_array($conuslt);?>

                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Ingreso N.-" maxlength="10" name="ingreso_n" placeholder="<?php echo($res[0]); ?>" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Ingreso N.-</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Banco N.-" maxlength="15" name="comproante_bco" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Deposito de Banco N.-</label>

                            </div> 
                            <?php 
                            // require_once("login/conexion.php"); 

                            $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA ADMINISTRATIVA'");
                        
                            ?>

                            <div class="group-material">
                             BANCO A ACREDITARSE
                            <?php while($consult=mysqli_fetch_array($sql2)){ ?>  
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Cuenta Bancaria" name="" required value="<?php echo $consult['descripcion'].' N.-'.$consult['n_cuenta']; ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="id_banco" value="<?php echo $consult['id_banco']; ?>">
                            <?php } 
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
                    var hoys="<?php echo $hoy; ?>";
                    $('input[name=fecha_ingreso]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minDate:hoys,
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


                $('select[name=nombres]').change(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('select[name=nombres]').val();
                        
                            $.post("controler/verificar_socio.php",{cedula:id_persona},function(data,status){
                                if(data=='ok'){
                                    console.log(data);
                                    console.log(status);
                                }else{
                                    console.log(data);
                                    console.log(status);
                                    swal({
                                        title: "Advertencia?",
                                      text: "Ya se encuentra registrado!",
                                      type: "warning",
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                        location.href="addsocio.php";
                                      
                                  });
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