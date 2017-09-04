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
                            

                            // foreach ($_POST['id_factu'] as $value) {
                            //   $updatefactura="update tb_facturasxcobrar set estado='PAGADO' where id_facturasxcobrar=".$_POST['id_factu'][$value];
                            //     $u=$conexion->query($updatefactura);
                            //   $insertdetalle="insert into tb_detalle_egreso_escuela (comp_egreso_escuela,id_facturasxcobrar) values('".$comp_egre."','".$_POST['id_factu'][$value]."')";
                            //   $d=$conexion->query($insertdetalle);
                            //   }

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

                       
                        
<div class="col-xs-12 col-sm-8 col-sm-offset-2">
    <form action="" method="post">                  

                           
                            <div class="group-material" style="display: none;">
                               

                                <input type="hidden" name="id_pro" value="1">
                                
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                            <div class="group-material">
                          
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="descripcion" name="descripcion" required="" value="PAGO A <?php echo $nombproveedores; ?>" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div>

                             <div class="group-material">
                               
                                <input type="text" class="tooltips-general material-control numero" data-toggle="tooltip" data-placement="top" title="Valor Egreso" name="valor" required="" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Egreso</label>

                            </div>

                            <div class="group-material">
                                <?php 
                                $sqlconsul=$conexion->query("select max(comprabante_n) as comp from tb_egreso_escuela "); 
                                $resultcomp=mysqli_fetch_array($sqlconsul);?> 
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Egreso N.-" maxlength="10" placeholder="<?php echo ($resultcomp[0]); ?>" name="egreso_n" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Egreso N.-</label>

                            </div> 

                            <div class="group-material">
                                <?php 
                                $sqlconsuls=$conexion->query("select max(cheque) as comp from tb_egreso_escuela "); 
                                $resultcomps=mysqli_fetch_array($sqlconsuls);?> 
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Cheque N.-" maxlength="10" name="cheque" placeholder="<?php echo ($resultcomps[0]); ?>" required value="" >
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

      $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
                });

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