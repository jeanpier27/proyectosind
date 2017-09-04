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
            $('#contcontable').attr("style","display:block;");
            $('#inventario').attr("style","background-color:#E75A5A;");
              
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
          <div class="container-fluid">
        <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li><a href="addingreproducto.php">Nuevos Cofres</a></li>
                      <li class="active">Salida de Cofres</li>
                    </ol>
                </div>
            </div>
  </div> 
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
           <div class="container-flat-form">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <form method="post">
                         <div class="title-flat-form title-flat-blue">Salida de Cofres</div> 

                        <br><br>
                        <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT * from tb_personas order by apellido");   
                         ?>

                        <div class="group-material">
                                <span>Seleccione al Cliente </span> 
                               
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

                          <!--  <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="N.- de Factura" title="Describa la factura" name="n_factura">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>N.- Factura</label>
                            </div>  -->

                            <div class="group-material">
                                Fecha de Registro
                                <input type="text" class="tooltips-general material-control" name="fecharegistro" required="" value="<?php echo date('Y-m-d'); ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                

                            </div> 

                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="Descripcion" title="Descripcion" name="descripcion" value="INGRESO POR VENTA DE COFRES">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>
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
                                <label>Deposito N.-</label>

                            </div> 

                            <?php 
                            // require_once("login/conexion.php"); 

                            $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA COFRES'");
                        
                            ?>

                             <div class="group-material">
                             BANCO A ACREDITARSE
                            <?php while($consult=mysqli_fetch_array($sql2)){ ?>  
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Cuenta Bancaria" name="" required value="<?php echo $consult['descripcion'].' N.-'.$consult['n_cuenta']; ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="id_banco" value="<?php echo $consult['id_banco']; ?>">
                            <input type="hidden" name="totalapagar">
                            <?php } 
                                           ?>



                            <?php 
                            $sqlproducto=$conexion->query("SELECT tb_producto.*,tb_inventario.*  FROM tb_producto  inner join tb_inventario on tb_producto.id_producto=tb_inventario.id_producto where tb_producto.estado='ACTIVO'");   
                            ?>
                            

                            <div class="group-material">
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                      <th>Id</th>
                                      <th>Cofre</th>
                                      <!-- <th>Valor Compra</th> -->
                                      <th>Valor de Venta</th>
                                      <th>Stock</th>                                      
                                      <th>Cantidad</th>
                                    <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                               <tbody>
                                                                                         
                                  <?php  

                                  while($row=$sqlproducto->fetch_array()){ ?>
                                  <tr> 
                                  <?php if($row['cantidad']>0){  ?> 
                                  <input type="hidden" name="id" value ="<?php echo $row['id_producto']; ?>">
                                  <td><?php echo $row['id_producto']; ?></td> 
                                  <td><?php echo $row['descripcion']; ?></td>                                  
                                  <!-- <td><?php echo '$'.$row['valor_compra']; ?></td> -->
                                  <?php 
                                  $sqlganancia=$conexion->query("select valor from tb_pagos_contable where descripcion='GANANCIA COFRE'");
                                    $resultgana=mysqli_fetch_array($sqlganancia);
                                    $compra=$row['valor_compra'];
                                    $total=($row['valor_compra']*($resultgana[0]*0.01))+$row['valor_compra'];
                                   ?>
                                  <td><?php echo '$'.$total; ?></td>
                                  <input type="hidden" name="precio_producto" value="<?php echo $total; ?>">
                                  <td><?php echo $row['cantidad']; ?></td>  
                                  <td><input type="number" style="width:40px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;"  class="numero" min="0"  max="<?php echo $row['cantidad']; ?>" onkeyup="calcular()" onchange="calcular()" onfocus="calcular()" name="cantidad_producto_agregado" value="0"></td>
                                  <?php  
                              }}
                              ?>
                         
                                </tr>
                              </table>

                      </div>
                    <div >
                     <p> <h4 id="subtotal" >Subtotal: $0</h4> </p>                     
                     <p> <h4 id="ivaTotal" >IVA: 0%</h4> </p>
                     <p> <h4 id="total">Total: $<input type="text" id="val_total" value="0" style="border: 0px;" readonly></h4> </p>
                   </div>

                    <p class="text-center">
                        <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                        <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                    </p>
                    </form>                    
                    
                       </div>
                         

<!-- <label></label><input type="" name=""> -->

                    </div>
            </div>
          

        </section>
        </div>

      <?php 
      $sqliva=$conexion->query("select valor from tb_pagos_contable where descripcion='IVA'");
      $resultiva=mysqli_fetch_array($sqliva); ?>
        
 </body>
 <script type="text/javascript">
   function calcular(){   

    subtotal_obtenido=0;
    count=0;
    iva = <?php echo $resultiva[0]; ?>;
    cantidades = [];
    $("[name=cantidad_producto_agregado]").each(function(){
      cantidades.push( $(this).val() );
    });    
    $("[name=precio_producto]").each(function(){
      subtotal_obtenido= subtotal_obtenido + ( parseFloat( $(this).val() )*cantidades[count]);      
      count++;
    });

    
    console.log(subtotal_obtenido);
    $("#subtotal").empty();
    $("#subtotal").append("Subtotal sin iva: $ "+ subtotal_obtenido);    
    $("#ivaTotal").empty();
    $("#ivaTotal").append("IVA: "+ iva +"%");    
    total = subtotal_obtenido + (subtotal_obtenido * iva /100);
    val_totales=total;
    $("#val_total").val(""+total.toFixed(2));
    $('input[name=totalapagar]').val(""+total.toFixed(2));
      };




  $(document).ready(function(){

    $('input[name^="cantidad"]').change(function() {
    // alert($(this).val());
    //  console.log(this);
    // console.log($(this).val());
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


    $('#registra').click(function(e){
        e.preventDefault();
        var cant=[];
        var id=[];
        $("[name=cantidad_producto_agregado").each(function(){
          cant.push( $(this).val() );
        });
        $("[name=id").each(function(){
          id.push( $(this).val() );
        });

        var id_persona =$('select[name=nombres]').val();
        var descripcion=$('input[name=descripcion]').val();
        var comprobante_n=$('input[name=ingreso_n]').val();
        var deposito=$('input[name=comproante_bco]').val();
        var id_banco=$('input[name=id_banco]').val();
        var totalapagar=$('input[name=totalapagar]').val();
        var fecharegistro=$('input[name=fecharegistro]').val();
        console.log(id_persona);
        if(id_persona===null || descripcion==="" || comprobante_n===""){
          sweetAlert("Error..", "Debe rellenar todos los campos!", "warning");
        }else{
        $.post("controler/salidaproducto.php",{cant:cant,id:id,id_persona:id_persona,descripcion:descripcion,comprobante_n:comprobante_n,deposito:deposito,id_banco:id_banco,totalapagar:totalapagar,fecharegistro:fecharegistro},function(data,status){
                                // console.log(data);
                                // console.log(status);
                                if(data=='ok'){
                                  swal({
                                        title: "Ok?",
                                      text: "Registros guardados!",
                                      type: "success",
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                        location.href="addsalidaproducto.php?msg=yes&ingreso="+comprobante_n;
                                      
                                  });
                                }
                                else if(data=='error'){
                                    sweetAlert("Error..", "No se guardaron los datos!", "error");
                                    
                                }else{
                                  sweetAlert("Error..", "Se encuentra repetido el Comprobante de ingreso!", "error");
                                }
                               
                            });
        }

    });



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
 });
 </script>
 </html>