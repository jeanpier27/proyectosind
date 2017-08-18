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

 <?php   
 if(isset($_POST['registra'])){
                $id_persona=$_POST['nombres'];
                $sueldo = $_POST['sueldo'];
                $vfreserva = $_POST['vfreserva'];    
                $viess = $_POST['viess'];
                $hextras = $_POST['hextras'];
                $descuento = $_POST['descuento'];
                $descripciondes = $_POST['descripciondes'];
                $totalpagar = $_POST['totalpagar'];
                $egreso_n = $_POST['egreso_n'];
                $c_contable = $_POST['c_contable'];
                $id_banco = $_POST['id_banco'];
                $fecha = $_POST['fecha_registro'];
                $descripcion=$_POST['descripcion'];
               

           
        $query="insert into tb_egreso_escuela (id_persona,id_banco,id_plan_cuentas,fecha,descripcion,comprabante_n,cheque,saldo,observacion,estado)values('".$id_persona."','".$id_banco."','".$c_contable."','".$fecha."','".$descripcion."','".$egreso_n."','0','".$totalpagar."','','ACTIVO')";
        $a=$conexion->query($query);     
        if($a){

            $insertsueldos="insert into tb_sueldos (id_persona,sueldo,f_reserva,iess,h_extras,descuento,descripcion_d,tapagar,fecha,id_egreso_escuela,estado)values('".$id_persona."','".$sueldo."','".$vfreserva."','".$viess."','".$hextras."','".$descuento."','".$descripciondes."','".$totalpagar."','".$fecha."','".$egreso_n."','ACTIVO')";
            $b=$conexion->query($insertsueldos);
            if($b){
              $actualizar="update tb_plan_cuentas  set saldo=saldo + ".$totalpagar." where id_plan_cuentas=".$c_contable;
              $c=$conexion->query($actualizar);
              if($c){

                echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="addsueldo.php?egreso='.$egreso_n.'";});</script>';  
              }else{
                echo '<script type="text/javascript">swal("Error Nivel3!", "No se guardaron los registros!", "error")</script>';
              }
            }else{
              echo '<script type="text/javascript">swal("Error Nivel2!", "No se guardaron los registros!", "error")</script>';    
            }

          
    }else{
        echo '<script type="text/javascript">swal("Error Nivel1!", "No se guardaron los registros!", "error")</script>';    
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
                    <div class="title-flat-form title-flat-blue">Sueldo Empleado</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT tb_empleado.*,tb_personas.nombre,tb_personas.apellido FROM `tb_empleado` inner join tb_personas on tb_empleado.id_persona=tb_personas.id_persona");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                                <span>Seleccione al empleado </span> 
                               
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
                          
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="descripcion" name="descripcion" required="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div>

                            <div class="group-material">
                            Sueldo
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Sueldo" name="sueldo" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                

                            </div> 
                                                     
                           <div class="group-material">
                            Fondo de Reserva
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Sueldo" name="freserva" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <input type="hidden" name="vfreserva" value="8.33">

                            </div>     

                            <div class="group-material">
                            Aporte IESS
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Aporte IESS" name="iess" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <input type="hidden" name="viess" value="9.45">

                            </div>           
                 
                              
                          <div class="group-material">
                          
                                <input type="number" class="tooltips-general material-control letras numero" onchange="calhextras();"  data-toggle="tooltip" data-placement="top" title="Horas extras" name="hextras" min="0" max="80" value="0" required >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Horas extras</label>

                            </div> 

                            <div class="group-material">
                          
                                <input type="text" class="tooltips-general material-control numero" onchange="calhextras();" onkeyup="calhextras();" data-toggle="tooltip" data-placement="top" title="Descuento" name="descuento" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descuento</label>

                            </div>

                            <div class="group-material" id="descrides">
                          

                            </div>

                             <div class="group-material">
                                Total a Pagar
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Total a Pagar" name="totalpagar" readonly="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Ingreso N.-" maxlength="10" name="egreso_n" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Egreso N.-</label>

                            </div> 

                             <?php 
                            // require_once("login/conexion.php"); 

                            $sql5=mysqli_query($conexion,"SELECT * FROM `tb_plan_cuentas`");
                        
                            ?>

                           <div class="group-material">
                                <span>Seleccione cuenta contable </span> 
                               
                          <select class="selectpicker" name="c_contable" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sql5->fetch_array()){ ?>

                              <option value="<?php echo $row['id_plan_cuentas']; ?>"><?php echo ($row['descripcion']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>

                            <div class="group-material">
                                Fecha Registro
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_registro" required  readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                          
                            <?php 
                            // require_once("login/conexion.php"); 

                            $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA ESCUELA'");
                        
                            ?>

                            <div class="group-material">
                             CUENTA A DEBITARSE
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

<?php require_once('login/cerrar_conexion.php'); $hoy=date('m/d/Y'); ?>
            <script type="text/javascript">
            function calhextras(){

              var total=0.00;
              var descuento;
              var sueldo=$('input[name=sueldo]').val();
              var diario=(((sueldo/30)/8)*2).toFixed(2);
              var hextras=$('input[name=hextras]').val();
              descuento=$('input[name=descuento]').val();
              total=(hextras*diario).toFixed(2);
              if(descuento!=""){
                $('#descrides').html('<input type="text" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="descripcion" name="descripciondes" required ><span class="highlight"></span><span class="bar"></span><label>Descripcion</label>');
                console.log(descuento);
              }else{
                $('#descrides').empty();

              }
              
              if(total<=0.00){

                                    var vforeserva=$('input[name=vfreserva]').val();
                                    var viess=$('input[name=viess]').val();
                                    var totaliess=(parseFloat(sueldo)*(parseFloat(viess)*0.01));
                                    var totalfreserva=(parseFloat(sueldo)*(parseFloat(vforeserva)*0.01));
                                    $('input[name=freserva]').val(totalfreserva.toFixed(2));
                                    $('input[name=iess]').val(totaliess.toFixed(2));

                                    var subtotal=parseFloat(sueldo)+parseFloat(totalfreserva.toFixed(2));
                                    if(descuento>0){
                                    var total1=(parseFloat(subtotal)-parseFloat($('input[name=iess]').val())-parseFloat(descuento)).toFixed(2);
                                    }else{
                                    total1=(parseFloat(subtotal)-parseFloat($('input[name=iess]').val())).toFixed(2);
                                    }

                                    $('input[name=totalpagar]').val(total1);
              }else{
              
                                    var totalfreserva=$('input[name=freserva]').val();

                                    var subtotal=parseFloat(sueldo)+parseFloat(totalfreserva)+parseFloat(total);

                                    if(descuento>0){
                                    var total1=(parseFloat(subtotal)-parseFloat($('input[name=iess]').val())-parseFloat(descuento)).toFixed(2);
                                    }else{
                                    total1=(parseFloat(subtotal)-parseFloat($('input[name=iess]').val())).toFixed(2);
                                    }
                                    
              $('input[name=totalpagar]').val(parseFloat(total1).toFixed(2));
              }
            };


                $(document).ready(function(){
                   
                  $('input[name=fecha_registro]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                         autoUpdateInput: false,
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

    $('input[name="fecha_registro"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
      });

       $('input[name="fecha_registro"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

                $('select[name=nombres]').change(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('select[name=nombres]').val();
                        
                            $.post("controler/consultasueldo.php",{empleado:id_persona},function(data,status){
                                // if(data=='ok'){
                                    // console.log(data);
                                    $('input[name=sueldo]').val(data);
                                    var vforeserva=$('input[name=vfreserva]').val();
                                    var viess=$('input[name=viess]').val();
                                    var totaliess=(parseFloat(data)*(parseFloat(viess)*0.01));
                                    var totalfreserva=(parseFloat(data)*(parseFloat(vforeserva)*0.01));
                                    $('input[name=freserva]').val(totalfreserva.toFixed(2));
                                    $('input[name=iess]').val(totaliess.toFixed(2));

                                    var subtotal=parseFloat(data)+parseFloat(totalfreserva.toFixed(2));
                                    var total=(parseFloat(subtotal)-parseFloat($('input[name=iess]').val())).toFixed(2);

                                    $('input[name=totalpagar]').val(total);


                                    
                                // }else{
                                //     console.log(data);
                                //     console.log(status);
                                //     swal({
                                //         title: "Advertencia?",
                                //       text: "Ya se encuentra registrado!",
                                //       type: "warning",
                                //       confirmButtonColor: "#DD6B55",
                                //       confirmButtonText: "Aceptar!"
                                //   },
                                //   function(){
                                //         location.href="addsocio.php";
                                      
                                //   });
                                // }
                               
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

       var comprob = '<?php echo $Comprob = isset($_REQUEST["egreso"]) ? $_REQUEST["egreso"]: "nada"; ?>';
        if (comprob != "nada") {
            VentanaCentrada('comprobante_egreso_escuela.php?id='+comprob,'Recaudaciones','','1000','500','true');
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