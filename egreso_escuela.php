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
    require_once('login/conexion.php')
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> -Pago de Facturas</small></h1>
            </div>
        </div>
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Facturas</div>
                    <div class="row">
                       <?php 
                        if(isset($_POST['guardar'])){
                            $id_proveed=$_POST['id_pro'];
                            $id_banco=$_POST['id_banco'];
                            $descripcion=$_POST['descripcion'];
                            $v_egreso=$_POST['valor'];
                            $comp_egre=$_POST['egreso_n'];
                            $c_contable=$_POST['c_contable'];
                            $fecha=$_POST['fecha_registro'];
                            $cheque=$_POST['cheque'];
                            

                            foreach ($_POST['id_factu'] as $value) {
                              $updatefactura="update tb_facturasxcobrar set estado='PAGADO' where id_facturasxcobrar=".$_POST['id_factu'][$value];
                                $u=$conexion->query($updatefactura);
                              $insertdetalle="insert into tb_detalle_egreso_escuela (comp_egreso_escuela,id_facturasxcobrar) values('".$comp_egre."','".$_POST['id_factu'][$value]."')";
                              $d=$conexion->query($insertdetalle);
                              }

                              $updatebanco="update tb_bancos set saldo=saldo-$v_egreso where id_banco=".$id_banco;
                              $banc=$conexion->query($updatebanco);

                            $insertegre="insert into tb_egreso_escuela (id_proveedor,id_banco,id_plan_cuentas,fecha,descripcion,comprabante_n,cheque,saldo,observacion,estado)values('".$id_proveed."','".$id_banco."','".$c_contable."','".$fecha."','".$descripcion."','".$comp_egre."','".$cheque."','".$v_egreso."','','ACTIVO')";
                            $g=$conexion->query($insertegre);
                            if($g){
                                 echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="egreso_escuela.php?egreso='.$comp_egre.'";});</script>'; 
                            }else{
                                echo '<script type="text/javascript">swal("Error !", "No se guardaron los registros!", "error")</script>';
                            }

                        }



                        ?>

                       
                         <?php 
if(isset($_POST['registra'])){
$a=$_POST['fact'];
if($a==""){
echo '<script type="text/javascript">swal({
  title: "Error?",
  text: "Debe elegir una factura para poder continuar!",
  type: "error",
  confirmButtonText: "Aceptar!",
  closeOnConfirm: false
},
function(){
  location.href="egreso_sindicato.php";
});</script>';
exit;
}
$count=0;
foreach ($a as $value) {
    $total=number_format($total+$_POST['valor_p'][$value],2);
    if($count==0){
        $vprove=$_POST['idproveedor'][$value];
    }
    $count++;
    if($vprove==$_POST['idproveedor'][$value]){
      $verifi='ok';
    }else{
      $verifi='no';
    }
    if($verifi=='no'){
      echo '<script type="text/javascript">swal({
  title: "Error?",
  text: "No puede elegir dos proveedores para realizar un egreso!",
  type: "error",
  confirmButtonText: "Aceptar!",
  closeOnConfirm: false
},
function(){
  location.href="egreso_sindicato.php";
});</script>';
exit;
    }
    } ?>
<div class="col-xs-12 col-sm-8 col-sm-offset-2">
    <form action="" method="post">                  

                           
                            <div class="group-material">
                                Proveedor
                                <?php 
                                 $sqlprove=$conexion->query("select nombres,id_proveedores from tb_proveedores where id_proveedores=".$vprove);
                                  while($consultapro=mysqli_fetch_array($sqlprove)){
                                    $nombproveedores=$consultapro['nombres'];
                               ?>

                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Proveedor" name="" required value="<?php echo $consultapro['nombres']; ?>" readonly>
                                <input type="hidden" name="id_pro" value="<?php echo $consultapro['id_proveedores']; ?>">
                                
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <?php } 
                                  foreach ($a as $value) {
                                ?>
                                <input type="hidden" name="id_factu[<?php echo $a[$value]; ?>]" value="<?php echo $a[$value]; ?>">
                                <?php } ?>
                            </div> 

                            <div class="group-material">
                          
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="descripcion" name="descripcion" required="" value="PAGO A <?php echo $nombproveedores; ?>" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div>

                             <div class="group-material">
                               Valor Egreso
                                <input type="text" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Valor Egreso" name="valor" readonly="" value="<?php echo $total; ?>" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                

                            </div>

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Egreso N.-" maxlength="10" name="egreso_n" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Egreso N.-</label>

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Cheque N.-" maxlength="10" name="cheque" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cheque N.-</label>

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
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_registro" required  readonly value="<?php echo date('Y-m-d'); ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                               <?php 
                            // require_once("login/conexion.php"); 

                            $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA ESCUELA'");
                        
                            ?>

                            <div class="group-material">
                             BANCO A ACREDITARSE
                            <?php while($consult=mysqli_fetch_array($sql2)){ ?>  
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Cuenta Bancaria" name="" required value="<?php echo $consult['descripcion'].' N.-'.$consult['n_cuenta']; ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="id_banco" value="<?php echo $consult['id_banco']; ?>">
                            <?php }  ?>




                             <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="guardar" id="guardar" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>

      
    </form>

<?php 
}else{
?>
<div class="col-xs-12 col-sm-12 ">
                      <form method="GET" action="">
                            <div class="group-material">
                                Fecha de Consulta
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha Consulta" name="fecha_consulta" required value="" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                             <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="consultar" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; CONSULTAR</button> &nbsp;&nbsp;
                            </p>
                            </form>

<?php 
// if(isset($_GET['consultar'])){ 

// $fecha=$_GET['fecha_consulta'];
// $fecha1=substr($fecha, 0, -13);
// $fecha2=substr($fecha, 13);
// echo ($fecha1.$fecha2);
if(isset($_GET['consultar'])){
$fecha=$_GET['fecha_consulta'];
$fecha1=substr($fecha, 0, -13);
$fecha2=substr($fecha, 13);
$sqlsocio=$conexion->query("SELECT tb_facturasxcobrar.*,tb_proveedores.nombres FROM `tb_facturasxcobrar` inner join tb_proveedores on tb_facturasxcobrar.id_proveedores=tb_proveedores.id_proveedores where tb_facturasxcobrar.fecha_fac1>='".$fecha1."' and tb_facturasxcobrar.fecha_fac1<='".$fecha2."' and tb_facturasxcobrar.estado='ACTIVO'");   
}else{
    $sqlsocio=$conexion->query("SELECT tb_facturasxcobrar.*,tb_proveedores.nombres FROM `tb_facturasxcobrar` inner join tb_proveedores on tb_facturasxcobrar.id_proveedores=tb_proveedores.id_proveedores where tb_facturasxcobrar.estado='ACTIVO' "); 
}
 
    ?>

    <form method="post" action="">
                            <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                      <th>Id</th>
                                      <th>Tipo Factura</th>
                                      <th>Proveedor</th>
                                      <th>Factura</th>                                      
                                      <th>Descripcion</th>
                                      <th>Valor a Pagar</th>                                     
                                      <th>Seleccione</th>

                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                      <th>Id</th>
                                      <th>Tipo Factura</th>
                                      <th>Proveedor</th>
                                      <th>Factura</th>                                      
                                      <th>Descripcion</th>
                                      <th>Valor a Pagar</th>                                     
                                      <th>Seleccione</th>
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                                while($consultasocio=mysqli_fetch_array($sqlsocio)){
                               ?>
                                <tr>
                                <td><?php echo($consultasocio['id_facturasxcobrar']); ?></td>
                                <td><?php if($consultasocio['fac_ntv']=='f'){echo'FACTURA';} if($consultasocio['fac_ntv']=='n'){echo'NOTA DE VENTA';} if($consultasocio['fac_ntv']=='l'){echo'LIQ. PREST. SERVICIO O COMPRA';}?></td>
                                <input type="hidden" name="idproveedor[<?php echo ($consultasocio['id_facturasxcobrar']);?>]" value="<?php echo($consultasocio['id_proveedores']); ?>">
                                <td><?php echo($consultasocio['nombres']); ?></td>
                                <td><?php echo($consultasocio['n_factura_ntv']); ?></td>
                                <td><?php echo($consultasocio['descripcion']); ?></td>
                                <td><?php echo($consultasocio['valor_pagar']); ?></td>
                                <input type="hidden" name="valor_p[<?php echo ($consultasocio['id_facturasxcobrar']);?>]" value="<?php echo($consultasocio['valor_pagar']); ?>">
                                <td><input type="checkbox" class="" value="<?php echo ($consultasocio['id_facturasxcobrar']);?>" name="fact[<?php echo ($consultasocio['id_facturasxcobrar']);?>]"/></td>



                               <?php } ?>
                               </tr>
                              </tbody>

                              </table>
                              </div>
                              <p class="text-center">
                                
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Pagar Facturas</button> &nbsp;&nbsp;
                            </p>
                             <p class="text-center">
                                <a href="egreso_escuela_otrs.php" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i>&nbsp;&nbsp;  Otros Egresos</a>
                               

                            </p>
                              </form>
                      
<?php } ?>

                       </div>
                       </div>
        	

        <!-- </section> -->
        </div>

      
        
 </body>
 <script type="text/javascript">

 var comprob = '<?php echo $Comprob = isset($_REQUEST["egreso"]) ? $_REQUEST["egreso"]: "nada"; ?>';
        if (comprob != "nada") {
            VentanaCentrada('comprobante_egreso_escuela1.php?id='+comprob,'Recaudaciones','','1000','500','true');
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
    $('input[name=fecha_consulta]').daterangepicker({
                        autoUpdateInput: false,
                        showDropdowns: true,
                        locale: {
                          cancelLabel: 'Clear',
                          linkedCalendars: false,
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

                    $('input[name="fecha_consulta"]').on('apply.daterangepicker', function(ev, picker) {
                      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                  });

                    $('input[name="fecha_consulta"]').on('cancel.daterangepicker', function(ev, picker) {
                      $(this).val('');
                  });
                   
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
 		
 	});
$(document).ready(function(){
    $('#tabladatos').DataTable({
       initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        "language": { 
    "sProcessing":     "Procesando...", 
    "sLengthMenu":     "Mostrar _MENU_ registros", 
    "sZeroRecords":    "No se encontraron resultados", 
    "sEmptyTable":     "Ningún dato disponible en esta tabla", 
    "sInfo":           "Mostrando registros del  _START_  al _END_ de un total de _TOTAL_ registros", 
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros", 
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)", 
    "sInfoPostFix":    "", 
    "sSearch":         "Buscar:", 

    "sUrl":            "", 
    "sInfoThousands":  ",", 
    "sLoadingRecords": "Cargando...", 
    "oPaginate": {
 
        "sFirst":    "Primero", 
        "sLast":     "Último",
        "sNext":     "Siguiente", 
        "sPrevious": "Anterior"
 
    },
 
    "oAria": { 
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente", 
        "sSortDescending": ": Activar para ordenar la columna de manera descendente" 
    } 
}
    } );
} );



 </script>
 </html>