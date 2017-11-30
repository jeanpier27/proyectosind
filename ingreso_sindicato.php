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
            $('#contcontable').attr("style","display:block;");
            $('#ingresos').attr("style","background-color:#E75A5A;");
              
            });
</script>
 <?php   
 if(isset($_POST['registra'])){
                $id_per=$_POST['nombres'];   
                $abono = $_POST['abono'];
                $fecha_registro = $_POST['fecha_registro'];
                $descripcion = $_POST['descripcion'];
                $ingreso_n = $_POST['ingreso_n'];
                $comproante_bco = $_POST['comproante_bco'];
                $id_banco = $_POST['id_banco'];
                $c_contable = $_POST['c_contable'];
                $fecha=date('Y-m-d H:i:s');
                $observaciontotal='('.$fecha.' usuario: '.$_SESSION['nombres'].'.- Ingreso)';

           $sqlcompro=$conexion->query("select 1 from tb_ingreso_sindicato where comprabante_n=".$ingreso_n);
                $respcom=mysqli_fetch_array($sqlcompro);
                if($respcom[0]!=1){

        $query="insert into tb_ingreso_sindicato (id_persona,id_banco,fecha,descripcion,comprabante_n,comprabante_banco,saldo,observacion,estado,id_plan_subcuentas)values('".$id_per."','".$id_banco."','".$fecha_registro."','".$descripcion."','".$ingreso_n."','".$comproante_bco."','".$abono."','".$observaciontotal."','ACTIVO','".$c_contable."')";
        $a=$conexion->query($query);     
        if($a){
        echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="ingreso_sindicato.php?ingreso='.$ingreso_n.'";});</script>';    
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>';    
    }
              
 }  else{
                echo '<script type="text/javascript">swal("Error!", "Ya se encuentra registrado ese comprobante !", "error")</script>'; 
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
                    <div class="title-flat-form title-flat-blue">Ingresos Sindicato</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT * from tb_personas order by apellido");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                            <center>
                                <span>Seleccione  </span> 
                               <br>
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sqlsocio->fetch_array()){ ?>

                              <option value="<?php echo $row['id_persona']; ?>"><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>
                          </center>

                            </div>
                           
                 
                      
                             <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Valor Abonar" name="abono" required value="" >
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
                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" required >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div> 
                

                            <div class="group-material">
                                <?php 
                            $conuslt=$conexion->query("select max(comprabante_n)as comp from tb_ingreso_sindicato"); 
                            $res=mysqli_fetch_array($conuslt);?>
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Ingreso N.-" maxlength="10" name="ingreso_n"  placeholder="<?php echo($res[0]); ?>" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Ingreso N.-</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Banco N.-" maxlength="15" name="comproante_bco"  value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Deposito de Banco N.-</label>

                            </div> 

                              <div class="group-material">
                                <center>
                                  <span>Seleccione cuenta contable </span> <br>
                                 
                                    <select class="selectpicker" name="c_contable" data-live-search="true" required="">
                                        <option selected="" disabled="">Seleccione </option>
                                     <?php  
                                       $sql5=mysqli_query($conexion,"SELECT * FROM `tb_plan_subcuentas`");
                                       while($row=$sql5->fetch_array()){ ?>

                                        <option value="<?php echo $row['id_plan_subcuentas']; ?>"><?php echo ($row['descripcion']); ?></option>
                                         <?php  
                                      }
                                      ?>
                                    </select>
                          <!-- <button class="btn btn-primary" id="agregar_cta">Agregar</button> -->
                                </center>
                              </div>

                            <style>
                              #contenedor_cta{

                                  width: 50%;
                                  height: 350px;
                                  background: red;
                                  position: fixed;
                                  top:15px;
                                  /*right: 25%;*/
                                  
                                }
                             </style>

                          <!--   <div id="contenedor_cta" style="display: none;">
                              <button id="cerrar_cta">Cerrar</button>
                            </div> -->


                            <?php 
                            // require_once("login/conexion.php"); 

                            $sqlbanco=mysqli_query($conexion,"SELECT * FROM tb_bancos where descripcion!='CUENTA ESCUELA'");
                        
                            ?>

                            <div class="group-material">
                            <center>
                            <span>Seleccione Cuenta Bancaria </span> <br>
                             <select class="selectpicker" name="id_banco" data-live-search="true" required >
                            <option selected="" disabled="">Seleccione </option>
 
                            <?php while($row=mysqli_fetch_array($sqlbanco)){ ?>  
                                <option value="<?php echo $row['id_banco']; ?>"><?php echo ($row['descripcion'].' N.-'.$row['n_cuenta']); ?></option>     
                            <?php } 
                                ?>
                            </select>
                            </center>
                            </div> 

                            
                           
                            <p class="text-center">
                         
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                </div>
            </form> 
        </section>
 </body>
 </html>

<?php require_once('login/cerrar_conexion.php'); ?>
            <script type="text/javascript">

              $('#agregar_cta').on('click',function(e){
                e.preventDefault();
                $('#contenedor_cta').attr('style','display:block;');
              });

              $('#cerrar_cta').on('click',function(e){
                e.preventDefault();
                $('#contenedor_cta').attr('style','display:none;');
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