<?php 
  ob_start();
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
            $('#egreso').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Facturas por PAGAR</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
        
           <?php 
                if(isset($_GET['msg'])){
                    if($_GET['msg']=='error'){ 
                    ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Error!</strong> No se guardaron los datos.
                        </div>

                     <?php
                        }  
                    } ?>
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">FACTURAS POR PAGAR</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                       <div class="form-inline">
                     <!--   <form method="get">
        <button type='submit' name="nuevo" class="btn btn-success pull-right" data-toggle="modal" data-target="#asambleas" id="n_asamblea"><span class="glyphicon glyphicon-list-alt" ></span> Nueva Factura</button>
        </div>
        </form> -->

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");
                               
                            $sqlproveedor=$conexion->query("SELECT *  FROM  tb_proveedores where estado='ACTIVO' order by nombres ");   
                         ?>
                 
 <form autocomplete="off" action="" method="post" id="formreg" name="formreg" > 
                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                                <span>Seleccione al Proveedor </span> 
                               
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <?php 
                                if(isset($_GET['proveedor'])){
                                    $id_prov=$_GET['proveedor'];

                                }
                           ?>
                          <option <?php if(isset($_GET['proveedor'])){}else{echo 'selected';}  ?> disabled>Seleccione </option>
                           <?php  

                             while($row=$sqlproveedor->fetch_array()){ ?>

                              <option <?php if($id_prov==$row['id_proveedores']){echo 'selected';} ?>  value="<?php echo $row['id_proveedores']; ?>"><?php echo ($row['nombres']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>

                            <div class="group-material">
                                <h3>Factura, Nota de Venta, Liquidacion de compra o servicio</h3> <br>
                                <table class="table table-hover table-bordered table-responsive order-table" aling="center">
                                <thead>
                                    <tr>
                                       <!--  <th>FACTURA</th>
                                        <th>NOTA DE VENTA</th> -->
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <th>FACTURA  <input type="radio" name="tipo" required checked="" value="f" ></th>
                                            <th>NOTA DE VENTA   <input type="radio" name="tipo" required value="n" ></th>
                                            <th>LIQUIDACION DE COMPRA O SERVICIO   <input type="radio" name="tipo"  value="l" ></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <br> <br>
                                
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                

                            </div> 
                            <script type="text/javascript">
                            $('input[name=tipo]').change(function () {   
                                    var a=$('input:radio[name=tipo]:checked').val();
                                    if(a==='f' || a==='l'){
                                        if(a==='f'){
                                            $('#ltipo').html('N.- Factura');
                                        }
                                        if(a==='l'){
                                            $('#ltipo').html('N.- Liquidacion');
                                        }
                                        
                                        $('#n_retencion').attr("required","true");
                                        $('#n_retencion').removeAttr("disabled","disabled");
                                        $('input[name=renta]').attr("required");
                                        $('input[name=renta]').removeAttr("disabled","disabled");

                                                                               
                                    }else{
                                        $('#ltipo').html('N.- Venta');
                                        $('#n_retencion').val("");
                                        $('#n_retencion').removeAttr("required");
                                        $('#n_retencion').attr("disabled","disabled"); 
                                        $('input[name=renta]').val("");
                                        $('input[name=renta]').removeAttr("required");
                                        $('input[name=renta]').attr("readonly","true");
                                    }
                                });

                            </script>
                           
                 
                             <div class="group-material">
                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" required="" data-placement="top" title="N.- Factura" name="n_factura"  value="<?php if(isset($_GET['n_factura'])){echo $_GET['n_factura'];} ?>" maxlength="20">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label id="ltipo">N.- Factura</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" required="" title="Aut. SRI" name="aut_sri"  value="" maxlength="10">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Aut. SRI</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" required="" data-placement="top" title="Aut. SRI" name="fecha_factura1"  value="<?php if(isset($_GET['fecha_fact'])){echo $_GET['fecha_fact'];} ?>" >

                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Fecha de factura</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" required="" data-placement="top" title="Aut. SRI" name="fecha_factura"  value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Factura Valida Hasta</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control letras"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" required value="<?php if(isset($_GET['descripcion'])){echo $_GET['descripcion'];} ?>" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="numeros" onchange="calcul();" onkeyup="calcul();" data-toggle="tooltip" data-placement="top" title="Subtotal" name="subtotal"  value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Subtotal</label>

                            </div> 
                           

                            <div class="group-material">
                                
                                <input type="text" class="numero" onchange="calcul();" onkeyup="calcul();"  data-toggle="tooltip" data-placement="top" title="Subtotal 0%" name="subtotal_cero"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Subtotal 0%</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="numero" onchange="calcul();" onkeyup="calcul();"  data-toggle="tooltip" data-placement="top" title="Descuento" name="descuento"   >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descuento</label>

                            </div> 

                            <div class="group-material">
                                <?php 
                                 $sqliva=$conexion->query("select valor from tb_pagos_contable where descripcion='IVA'");
                                $resultiva=mysqli_fetch_array($sqliva);  ?>
                                <input type="text" name="val_iva" readonly="" required="" name="">
                                <input type="hidden" name="iva"  value="<?php echo intval($resultiva[0]); ?>" >%
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>IVA <?php echo intval($resultiva[0]); ?>%</label>

                            </div>

                            <div class="group-material">
                                
                                <input type="text" name="totalpagar" readonly="" required="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Total</label>

                            </div>

                            <h3>RETENCION</h3>
                            <?php 
                                $consul=$conexion->query("select max(n_retenc)as retencion from tb_facturasxcobrar");
                                $resp=mysqli_fetch_array($consul);
                             ?>
                                
                            <div class="group-material">
                                
                                <input type="text" class="material-control numero" id="n_retencion" onkeyup="javascript:this.value=this.value.toUpperCase();activar();" placeholder="<?php echo $resp[0]; ?>"  onkeyup="activar();"  name="numero_ret" required maxlength="10">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label >N.- Retencion</label>
                                

                            </div>

                            <div class="group-material">
                                
                                <input type="number" class="numero" onchange="retencion();" onkeyup="retencion();" data-toggle="tooltip" data-placement="top" title="Total a Pagar" name="renta" step="1" min="1" max="100"  readonly="" maxlength="3" >%
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>RENTA</label>
                                <input type="hidden" name="valorrentab">

                            </div>
                            <div class="group-material">
                                
                                <input type="text" class="numero"  data-toggle="tooltip" data-placement="top" title="Total a Pagar" name="valorrenta" readonly="" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Renta</label>

                            </div>

                            <div class="group-material">
                                
                                <input type="checkbox" name="siva" id="siva"  value="1" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Se Retiene el IVA</label>

                            </div>


                            <div class="group-material">
                                
                                <input type="number" class="numero" onchange="retencioniva();" onkeyup="retencioniva();" data-toggle="tooltip" data-placement="top" title="Total a Pagar" name="iva_p" step="1" min="1" max="100" readonly="" maxlength="3" >%
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Iva</label>
                                <input type="hidden" name="valorivab">

                            </div>

                            <div class="group-material">
                                
                                <input type="text" class="numero"  data-toggle="tooltip" data-placement="top" name="iva_total" readonly="" =""  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Iva</label>

                            </div>

                            <div class="group-material">
                                
                                <input type="text" class="numero"  data-toggle="tooltip" data-placement="top" title="Total a Pagar" name="total_egres" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor A Pagar</label>

                            </div>

                            

                            <div class="group-material">
                                Fecha Registro
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_registro" required value="<?php echo date('Y-m-d'); ?>" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                            <script type="text/javascript">
                            function totalegreso (){
                                var totalf=$('input[name=totalpagar]').val();
                                if(totalf!=""){
                                var renta=$('input[name=valorrenta]').val();
                                var ivar=$('input[name=iva_total]').val();
                                if(renta==="" && ivar===""){
                                    $('input[name=total_egres]').val($('input[name=totalpagar]').val());
                                }else{
                                     $('input[name=total_egres]').val("");
                                }
                                if(renta!="" && ivar===""){
                                    $('input[name=total_egres]').val(($('input[name=totalpagar]').val())-($('input[name=valorrenta]').val()));
                                }
                                
                                if(renta!="" && ivar!=""){
                                    var rete=(parseFloat($('input[name=valorrenta]').val())+parseFloat($('input[name=iva_total]').val()));
                                    var t=(parseFloat($('input[name=totalpagar]').val())-parseFloat(rete));
                                    $('input[name=total_egres]').val(t.toFixed(2));
                                }

                                }else{
                                    $('input[name=total_egres]').val("");
                                }
                            }
                                

                            </script>

                                                  
                            <?php 
                            $hoy=date('Y/m/d');
                               
                                              ?>


                            
                           
                            <p class="text-center">
                                
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                             </form> 
                            
                       </div>
                   </div>
                </div>
                <?php 
if(isset($_POST['registra'])){

    $id_proveedor=$_POST['nombres'];
    $tipo_fact=$_POST['tipo'];
    $n_fact_nv=$_POST['n_factura'];
    $aut_sri=$_POST['aut_sri'];
    $fecha_factu=$_POST['fecha_factura'];
    $fecha_factu1=$_POST['fecha_factura1'];
    $descripcion=$_POST['descripcion'];
    $subtotal=$_POST['subtotal'];
    $subtotal_cero=$_POST['subtotal_cero'];
    $descuento=$_POST['descuento'];
    $ivas=$_POST['iva'];
    $totalpagar=$_POST['totalpagar'];
    $n_retencion=$_POST['numero_ret'];
    $porc_renta=$_POST['renta'];
    $valor_renta=$_POST['valorrentab'];
    $porc_iva=$_POST['iva_p'];
    $valor_iva=$_POST['valorivab'];
    $totalegreso=$_POST['total_egres'];
    $fecha_registro=$_POST['fecha_registro'];

    $sqlbusca=$conexion->query("select IFNULL(sum(total),0) from tb_facturasxcobrar where id_proveedores='".$id_proveedor."' and n_factura_ntv='".$n_fact_nv."'");
    $consulbus=mysqli_fetch_array($sqlbusca);
    if($consulbus[0]<=0){
  
     $queryinsert="insert into tb_facturasxcobrar (id_proveedores,fac_ntv,n_factura_ntv,fecha_fac1,aut_sri,fecha_fact,descripcion,subtotal,sobtotal_c,descuento,iva,total,n_retenc,porc_renta,valor_renta,porc_iva,valor_iva,valor_pagar,estado,observacion,id_usuarios,fecha_re)values('".$id_proveedor."','".$tipo_fact."','".$n_fact_nv."','".$fecha_factu1."','".$aut_sri."','".$fecha_factu."','".$descripcion."','".$subtotal."','".$subtotal_cero."','".$descuento."','".$ivas."','".$totalpagar."','".$n_retencion."','".$porc_renta."','".$valor_renta."','".$porc_iva."','".$valor_iva."','".$totalegreso."','ACTIVO','','".$_SESSION['id_usuario']."','".$fecha_registro."')";
             $resultinsert = mysqli_query($conexion, $queryinsert); 
             if($resultinsert){
                    // echo ("<script type='text/javascript'>alert('ok');</script>");
                    if($n_retencion!=""){
                        header('location: facturas_x_cobrar.php?msg=yes&tipo='.$tipo_fact.'&nu_factura='.$n_fact_nv.'&n_rentencion='.$n_retencion);
            
                    }else{
                     echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){ location.href="facturas_x_cobrar.php";});</script>'; } 
            
                     }else{
                    // echo ("<script type='text/javascript'>alert('error');</script>");

                    header('location: facturas_x_cobrar.php?msg=error');
             }


    }else{
        echo '<script type="text/javascript">swal({title: "Advertencia", text: "Ya se encuentra registrada esta factura...!", type: "warning",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){ location.href="facturas_x_cobrar.php";});</script>'; }
    

    }
 ?>
           

        </section>
        </div>

 
     


 </body>
 <script type="text/javascript">
 var val_retencion;
 var valo_iva=0;

    var comprob = '<?php echo $Comprob = isset($_REQUEST["n_rentencion"]) ? $_REQUEST["n_rentencion"]: "nada"; ?>';
        if (comprob != "nada") {
            VentanaCentrada('comprobante_retencion.php?id='+comprob,'Recaudaciones','','1000','500','true');
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

   function calcul(){
    if(($('input[name=subtotal]').val())!=""){

    
      var sub=  $('input[name=subtotal]').val();
      var iva= parseFloat(($('input[name=iva]').val()))*0.01;
      var sub_ce= $('input[name=subtotal_cero]').val();
      var desc=$('input[name=descuento]').val();
      
      if(sub_ce==="" && desc===""){
        $('input[name=val_iva]').val("");
        $('input[name=val_iva]').val((parseFloat((sub*iva))).toFixed(2));
        $('input[name=totalpagar]').val("");
        $('input[name=totalpagar]').val((parseFloat((sub*iva))+parseFloat(sub)).toFixed(2));
        val_retencion=sub;
        valo_iva=$('input[name=val_iva]').val();
        // $('input[name=renta]').val("");
        retencion();
        totalegreso();
      }

      if(sub_ce!="" && desc===""){
        $('input[name=val_iva]').val("");
        $('input[name=val_iva]').val((parseFloat((sub*iva))).toFixed(2));
        $('input[name=totalpagar]').val("");
        $('input[name=totalpagar]').val((parseFloat((sub*iva))+(parseFloat(sub))+parseFloat(sub_ce)).toFixed(2));
        val_retencion=(parseFloat(sub)+parseFloat(sub_ce)).toFixed(2);
        valo_iva=$('input[name=val_iva]').val();
        // $('input[name=renta]').val("");
        retencion();
        totalegreso();
      }

      if(sub_ce!="" && desc!=""){
        var su=(parseFloat(sub)-parseFloat(desc)).toFixed(2);
        $('input[name=val_iva]').val("");
        $('input[name=val_iva]').val((parseFloat((su*iva))).toFixed(2));
        $('input[name=totalpagar]').val("");
        $('input[name=totalpagar]').val((parseFloat((su*iva))+(parseFloat(su))+parseFloat(sub_ce)).toFixed(2));
        val_retencion=((parseFloat(sub)+parseFloat(sub_ce))-parseFloat(desc)).toFixed(2);
        valo_iva=$('input[name=val_iva]').val();
        // $('input[name=renta]').val("");
        retencion();
        totalegreso();

      }

      if(sub_ce==="" && desc!=""){
        var subtot=(parseFloat(sub)-parseFloat(desc).toFixed(2));
        $('input[name=val_iva]').val("");
        $('input[name=val_iva]').val((parseFloat((subtot*iva))).toFixed(2));
        $('input[name=totalpagar]').val("");
        $('input[name=totalpagar]').val((parseFloat((subtot*iva))+parseFloat(subtot)).toFixed(2));
        val_retencion=(parseFloat(subtot)).toFixed(2);
        valo_iva=$('input[name=val_iva]').val();
        // $('input[name=renta]').val("");
        retencion();
        totalegreso();
      }



      // $('input[name=renta]').val("");
      // $('input[name=renta]').val($('input[name=subtotal]').val());

      
}else{
    if(($('input[name=subtotal_cero]').val())!=""){
        var a =$('input[name=subtotal_cero]').val();
        $('input[name=val_iva]').val("");
        $('input[name=totalpagar]').val("");
        $('input[name=totalpagar]').val(parseFloat(a).toFixed(2));
        val_retencion=parseFloat(a).toFixed(2);
        valo_iva=0;
        // alert( $('input[name=totalpagar]').val());
        retencion();
        totalegreso();

      }else{
            $('input[name=totalpagar]').val("");
            $('input[name=val_iva]').val("");
            valo_iva=0;
             totalegreso();
    }
    totalegreso();
}
    };

    function activar(){

        var activar=$('input[name=numero_ret]').val();

        if(activar!=""){
            
            $('input[name=renta]').removeAttr("readonly");
        }else{
            $('input[name=valorrenta]').val("");
            $('input[name=numero_ret]').val("");
            $('input[name=valorrentab]').val("");
            $('input[name=renta]').val("");
            $('input[name=renta]').attr("readonly","true");
        }
    };

        function retencion(){
        var renta=$('input[name=renta]').val();
        if(renta!=""){
            $('input[name=valorrenta]').val("");
            $('input[name=valorrenta]').val(((parseFloat(renta)*0.01)*parseFloat(val_retencion)).toFixed(2));
            $('input[name=valorrentab]').val("");
            $('input[name=valorrentab]').val(((parseFloat(renta)*0.01)*parseFloat(val_retencion)).toFixed(2));
            totalegreso();
        }else{
            $('input[name=valorrenta]').val("");
            $('input[name=valorrentab]').val("");
            totalegreso();
        }


     };

     function retencioniva(){
        var reteniva=$('input[name=iva_p]').val();
        // alert(valo_iva);
        if(reteniva!=""){
        $('input[name=iva_total]').val("");
        $('input[name=iva_total]').val(((parseFloat(reteniva)*0.01)*parseFloat(valo_iva)).toFixed(2));
        // alert($('input[name=iva_total]').val());
        $('input[name=valorivab]').val("");
        $('input[name=valorivab]').val(((parseFloat(reteniva)*0.01)*parseFloat(valo_iva)).toFixed(2));
        totalegreso();
        }else{
            $('input[name=iva_total]').val("");
            $('input[name=valorivab]').val("");
            totalegreso();
        }
     };
      
 	$(document).ready(function(){
            var hoys="<?php echo ($hoy); ?>";
            
            // console.log(hoys);
            
        $('input[name=fecha_factura]').daterangepicker({

                        singleDatePicker: true,
                        showDropdowns: true,
                        minDate: hoys,
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

$('input[name=fecha_factura1]').daterangepicker({

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


 $('#siva').click(function(){
    var valo_iva=$('#siva').val();
    // alert('h');
    if(valo_iva!=0){
        if( $('#siva').prop('checked') ) {
            $('input[name=iva_p]').removeAttr('readonly');
            $('input[name=iva_p]').attr('required',true);
    // alert('Seleccionado');
        }else{
            $('input[name=iva_p]').attr('readonly','true');
            $('input[name=iva_p]').removeAttr('required');
            $('input[name=iva_p]').val("");
            $('input[name=iva_total]').val("");
            $('input[name=valorivab]').val("");
        // alert('no Seleccionado');
        }
        totalegreso();
}
 });
 		
 	});

 </script>
 </html>

 <?php 
require_once('login/cerrar_conexion.php');
 ob_end_flush();
 ?> 