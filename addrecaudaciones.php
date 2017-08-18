<?php 
  ob_start();
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

 <?php   

$id_per=$_GET['nombres'];

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
                    <div class="title-flat-form title-flat-blue">Recaudaciones</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                           $sqlsocio=$conexion->query("SELECT tb_socio.id_persona, tb_personas.nombre, tb_personas.apellido FROM `tb_socio` inner join tb_personas on tb_socio.id_persona=tb_personas.id_persona WHERE tb_socio.estado='ACTIVO' and tb_socio.id_persona='".$id_per."'" );   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                                <span>Socio </span> 
                               
                          <!-- <select class="selectpicker" name="nombres" data-live-search="true" required=""> -->
                          <!-- <option selected="" disabled="">Seleccione </option> -->
                           <?php  

                             while($row=$sqlsocio->fetch_array()){ ?>
                                <input class="tooltips-general material-control" readonly type="text" name="" value="<?php echo ($row['apellido'].' '.$row['nombre']); ?>">
                              
                               <?php  
                            }
                            ?>
                          <!-- </select> -->
                          <input type="hidden" name="id_socio" value="<?php echo $row['id_persona']; ?>">

                            </div>
                           
                            <div class="group-material">
                                Fecha Registro
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_registro" required value="<?php echo date('Y-m-d'); ?>" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                            <div class="group-material">
                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div> 
                           
                            <?php 
                            // require_once("login/conexion.php"); 
                            

                            if(isset($_GET['INSCRIPCION'])){
                                $socioinsc=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_per." and id_pagos_socio=1");
                                while ($ins=$socioinsc->fetch_array()){ 
                                  $insc=$ins['abonos']+$insc;
                                  $consulta10=$conexion->query("SELECT valor FROM `tb_pagos_socio` WHERE id_pagos_socio='".$ins['id_pagos_socio']."'");
                                  while($consu=$consulta10->fetch_array()){
                                    $val=$consu['valor'];
                                  }
                                }

                                $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA ADMINISTRATIVA'");                
                            }

                            if(isset($_GET['MENSUALIDADES'])){
                              $consultabeneficio=$conexion->query("SELECT fecha_ingreso FROM `tb_socio` WHERE id_persona=".$id_per." ");
                                while($benefi=$consultabeneficio->fetch_array()){
                                  $bene=$benefi['fecha_ingreso'];
                                }
                                $fechab = date('Y');
                                $nuevafecha = strtotime ( '-20 year' , strtotime ( $fechab ) ) ;
                                $nuevafecha =  date ( 'Y' , $nuevafecha );
                                $fecha_socio= date('Y',strtotime($bene));
                                $sociomen=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_per." and id_pagos_socio=2 and verificacion=0");
                                while($mens=$sociomen->fetch_array()){
                                  $totalme=$mens['valor']+$totalme;
                                  }
                                  if($fecha_socio<=$nuevafecha){
                                    $totalme=($totalme/2);
                                  }
                                $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA ADMINISTRATIVA'");
                            }

                            if(isset($_GET['CESANTIA'])){
                              $sociocesan=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_per." and id_pagos_socio=4 and verificacion=0");
                              while($cesan=$sociocesan->fetch_array()){
                                $totalcesan=$cesan['valor']+$totalcesan;
                              }
                               $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA FONDO DE CESANTIA'");
                            }
                            
                            if(isset($_GET['MULTA'])){
                               $sociocmultas=$conexion->query("SELECT * FROM `tb_recaudaciones` WHERE id_persona=".$id_per." and id_pagos_socio=3 and verificacion=0");
                               while($mult=$sociocmultas->fetch_array()){
                                $totalmultas=$mult['valor']+$totalmultas;
                              }

                                 $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA MULTAS'");
                            }
                        
                            ?>

                            <div class="group-material">
                             Valor de la Deuda
                           <?php if(isset($_GET['INSCRIPCION'])){ ?>
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Valor Inscripcion" name="" required value="<?php echo ($val-$insc); ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="deuda" value="1">
                           <?php } ?>

                           <?php if(isset($_GET['MENSUALIDADES'])){ ?>
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Valor Inscripcion" name="" required value="<?php echo ($totalme); ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="deuda" value="2">
                           <?php } ?>

                           <?php if(isset($_GET['CESANTIA'])){ ?>
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Valor Inscripcion" name="" required value="<?php echo ($totalcesan); ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="deuda" value="4">
                           <?php } ?>

                           <?php if(isset($_GET['MULTA'])){ ?>
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Valor Inscripcion" name="" required value="<?php echo ($totalmultas); ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="deuda" value="4">
                           <?php } ?>

                           <?php if(isset($_GET['INSCRIPCION'])){ ?> 

                             <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero "  data-toggle="tooltip" data-placement="top" title="Valor Abonar" id="valor_abonar" name="abono" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Abonar</label>

                            </div>
                            <?php }else{  ?>
                                <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero letras"  data-toggle="tooltip" data-placement="top" title="Valor Abonar" id="valor_abonar" name="abono" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Abonar</label>

                            </div>

                            <?php } ?>

                            <?php  
                            if(isset($_GET['MENSUALIDADES'])){
                            ?> 

                            <div class="acciones">
                                <?php
                                

                                 $pension=mysqli_query($conexion,"SELECT valor FROM `tb_recaudaciones` where id_pagos_socio = 2");
                                 $consulta_pension=mysqli_fetch_array($pension);
                                 $valor_pagar = $consulta_pension['valor'];
                                 if($fecha_socio<=$nuevafecha){
                                  $valor_pagar = ($valor_pagar/2) ;
                                }
                                 
                                 ?>
                                <div>Pensiones, valor mensual: $<?php echo $valor_pagar.' '.''; ?></div>


                                <?php 
                                $res = mysqli_query($conexion,"SELECT id_recaudaciones,mes,año,id_persona,id_pagos_socio,estado FROM tb_recaudaciones where verificacion = 0 and id_pagos_socio = 2 and id_persona = ".$id_per);
                                $c=0;
                                while($row = mysqli_fetch_array($res)){
                                 $mess[$c] = $row['mes'];
                                $año[$c]= $row['año'];
                                $id_recaudacion[$c]=$row['id_recaudaciones'];
                                 $c++;
                               }  

                               $meses_c=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');                            

                               for($f=0; $f<$c; $f++){
                                if($mess[$f] !=0){?>
                                <br><div><input type="checkbox" onClick="calcular()" class="" value="<?php echo $id_recaudacion[$f]; ?>" name="meses[]"/> <?php echo $año[$f].' '.$meses_c[$mess[$f]]; ?></div>
                                            
                                <?php }         
                              }

                              ?>                             


                                <br><br>                         
                                <span class="highlight"></span>
                                <span class="bar"></span>                                                            

                            </div>  
                           <?php } ?>



                           <?php  
                            if(isset($_GET['CESANTIA'])){
                            ?> 

                            <div class="acciones">
                                <?php
                                 $pension=mysqli_query($conexion,"SELECT valor FROM `tb_recaudaciones` where id_pagos_socio = 4");
                                 $consulta_pension=mysqli_fetch_array($pension);
                                 $valor_pagar = $consulta_pension['valor'];
                                 ?>
                                <div>Pensiones, valor mensual: $<?php echo $valor_pagar; ?></div>

                                <?php 
                                $res = mysqli_query($conexion,"SELECT id_recaudaciones,mes,año,id_persona,id_pagos_socio,estado FROM tb_recaudaciones where verificacion = 0 and id_pagos_socio = 4 and id_persona = ".$id_per);
                                $c=0;
                                while($row = mysqli_fetch_array($res)){
                                 $mess[$c] = $row['mes'];
                                 $año[$c]= $row['año'];
                                 $id_recaudacion[$c]=$row['id_recaudaciones'];
                                
                                 $c++;
                               }  

                               $meses_c=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');                            

                               for($f=0; $f<$c; $f++){
                                if($mess[$f] !=0){?>
                                <br><div><input type="checkbox" onClick="calcular()" class="" value="<?php echo $id_recaudacion[$f]; ?>" name="meses[]"/> <?php echo $año[$f].' '.$meses_c[$mess[$f]]; ?></div>
                                           
                                <?php }         
                              }

                              ?>                             


                                <br><br>                         
                                <span class="highlight"></span>
                                <span class="bar"></span>                                                            

                            </div>  
                           <?php } ?>




                            <?php  
                            if(isset($_GET['MULTA'])){
                            ?> 

                            <div class="acciones">
                                <?php
                                 $pension=mysqli_query($conexion,"SELECT valor FROM `tb_recaudaciones` where id_pagos_socio = 3");
                                 $consulta_pension=mysqli_fetch_array($pension);
                                 $valor_pagar = $consulta_pension['valor'];
                                 ?>
                                <div>Multa por faltas, valor de la multa: $<?php echo $valor_pagar; ?></div>

                                <?php 
                                $res = mysqli_query($conexion,"SELECT id_recaudaciones,fecha,mes,año,id_persona,id_pagos_socio,estado FROM tb_recaudaciones where verificacion = 0 and id_pagos_socio = 3 and id_persona = ".$id_per);
                                
                                while($row = mysqli_fetch_array($res)){
                                 
                                 ?>

                                 <br>
                                 <div>
                                   <input type="checkbox" value="<?php echo $row['id_recaudaciones']; ?>" onClick="calcular()" name="mesesm[]"><?php echo $row['fecha']; ?>
                                 </div>


                                <?php  
                               
                                  }

                              ?>                             


                                <br><br>                         
                                <span class="highlight"></span>
                                <span class="bar"></span>                                                            

                            </div>  
                           <?php } ?>







                          <script type="text/javascript">                          
                            
                            function calcular(){                              
                              var numero_marcas=0;                              
                              var cuota = '<?php echo $valor_pagar; ?>'; 
                              numerito = ($(".acciones input:checked").length);
                              total = numerito * cuota;
                              $("#valor_abonar").val(""+total.toFixed(2));
                            };

                          </script>



                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Ingreso N.-" name="ingreso_n" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Ingreso N.-</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Banco N.-" name="comproante_bco" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Deposito de Banco N.-</label>

                            </div> 
                            <?php 
                            // require_once("login/conexion.php"); 

                            // $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA ADMINISTRATIVA'");
                        
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
                                              ?>


                            
                           
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>

                <?php

                 if (isset($_POST['registra'])){
                  $id_per=$_GET['nombres'];
                  $comprobante_ingreso=$_POST['ingreso_n'];
                  $Id_banco=$_POST['id_banco'];                 
                  $Fecha=$_POST['fecha_registro'];
                  $Descripcion=$_POST['descripcion'];
                  $Comprobante_banco=$_POST['comproante_bco'];
                  $Saldo=$_POST['abono'];                  
                  $Estado="ACTIVO";


                  $consulta3 = "update tb_bancos set saldo = saldo + ".$Saldo." where id_banco = ".$Id_banco;    
                  $ingreso3 = mysqli_query($conexion,$consulta3);

                  if(isset($_GET['INSCRIPCION'])){
                    $id_plan_c=70;
                  }
                  if(isset($_GET['MENSUALIDADES'])){
                    $id_plan_c=71;
                  }
                  if(isset($_GET['CESANTIA'])){
                    $id_plan_c=48;
                  }
                  if(isset($_GET['MULTA'])){
                    $id_plan_c=75;
                  }

                  $consulta2 = "insert into tb_ingreso_sindicato (id_persona, id_banco, fecha, descripcion, comprabante_n, comprabante_banco, saldo, estado,id_plan_cuentas) values (".$id_per.", ".$Id_banco.", '".$Fecha."', '".$Descripcion."', '".$comprobante_ingreso."', '".$Comprobante_banco."', ".$Saldo.", '".$Estado."','".$id_plan_c."')";    
                  $ingreso2 = mysqli_query($conexion,$consulta2);
                   
                   if(isset($_GET['INSCRIPCION'])){
                      $consulta4="INSERT INTO tb_recaudaciones(id_persona, fecha, año,mes, id_pagos_socio, comprabante_n, verificacion, estado,observacion,valor,abonos)VALUES('".$id_per."','".$Fecha."','','','1','".$comprobante_ingreso."','1','ACTIVO','','','".$Saldo."')";
                      $ingreso4= mysqli_query($conexion,$consulta4);
                      if($ingreso4){
                        header('location: recaudaciones.php?msg=yes&ingreso='.$comprobante_ingreso);
                      }else{
                        header('location: addrecaudaciones.php?msg=error&nombres='.$id_per.'&INSCRIPCION=INSCRIPCION'); 
                      }
                      
                   }
                                      

                   if($_POST['meses'] != ""){

                      if (is_array($_POST['meses'])) {
                            while (list($key,$valor) = each($_POST['meses'])) {      
                                                                   
                                                                                        
                                $consulta = "update tb_recaudaciones set comprabante_n=".$comprobante_ingreso.", verificacion=1 where id_recaudaciones = ".$valor;    
                                $ingreso = mysqli_query($conexion,$consulta);
                                
                            }
                      }
                  }

       
                  if($_POST['mesesm'] != ""){
                    
                      if (is_array($_POST['mesesm'])) {
                            while (list($key,$valor) = each($_POST['mesesm'])) {                             
                                                                      
                                $consultamulta = "update tb_recaudaciones set comprabante_n=".$comprobante_ingreso.", verificacion=1 where id_recaudaciones = ".$valor; 
                                $ingresomulta = mysqli_query($conexion,$consultamulta);
                                
                            }
                      }

                       if (!$ingresomulta) {
                 header('location: addrecaudaciones.php?msg=error&nombres='.$id_per.'&MULTA=MULTA'); 
                 } else {
                 header('location: recaudaciones.php?msg=yes&ingreso='.$comprobante_ingreso);   
                }      
                  }


                if(isset($_GET['CESANTIA']) or isset($_GET['MENSUALIDADES'])){
                 if (!$ingreso) {
                 header('location: addrecaudaciones.php?msg=error&nombres='.$id_per.'&MENSUALIDADES=MENSUALIDADES'); 
                 } else {
                 header('location: recaudaciones.php?msg=yes&ingreso='.$comprobante_ingreso);   
                }                  

              }
              }

                ?>

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



<?php 
require_once('login/cerrar_conexion.php'); ?>
<?php
   
    ?>


























