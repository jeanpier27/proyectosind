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
                      <li class="active">Nuevos Cofres</li>
                      <li><a href="addsalidaproducto.php">Salida de Cofres</a></li>
                    </ol>
                </div>
            </div>
  </div> 
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
           <div class="container-flat-form">
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <form method="post" autocomplete="off">
                         <div class="title-flat-form title-flat-blue">Nuevos Cofres</div> 

                        <br><br>
                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlproveedor=$conexion->query("SELECT *  FROM  tb_proveedores where estado='ACTIVO' ");   
                         ?>
                         <div class="group-material">
                                <span>Seleccione al Proveedor </span> 
                               
                          <select class="selectpicker" name="proveedor" data-live-search="true" required="">
                          <option selected="" disabled>Seleccione </option>
                           <?php  

                             while($row=$sqlproveedor->fetch_array()){ ?>

                              <option value="<?php echo $row['id_proveedores']; ?>"><?php echo ($row['nombres']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

                            </div>


                           <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="N.- de Factura" title="Describa la factura" name="n_factura">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>N.- Factura</label>
                            </div> 

                            <div class="group-material">
                                Fecha de Factura
                                <input type="text" class="tooltips-general material-control" name="fecha_factura" required="" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                

                            </div> 

                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="50" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="Descripcion" title="Descripcion" name="descripcion" value="COMPRA DE COFRES">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>
                            </div> 

                            <?php 
                            $sqlproducto=$conexion->query("SELECT *  FROM  tb_producto ");   
                            ?>
                            

                            <div class="group-material">
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                      <th>Id</th>
                                      <th>Cofre</th>
                                      <th>Cantidad</th>
                                    <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </thead>
                               <tbody>
                                                                                         
                                  <?php  

                                  while($row=$sqlproducto->fetch_array()){ ?>
                                  <tr>  
                                  <input type="hidden" name="id[<?php echo $row['id_producto']; ?>]" value ="<?php echo $row['id_producto']; ?>">
                                  <td><?php echo $row['id_producto']; ?></td> 
                                  <td><?php echo $row['descripcion']; ?></td>  
                                  <td><input type="text" maxlength="4" style="width:40px;padding:0.2em;border: solid 1px #ffffff;-moz-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background-color: #fff;" class="numero" placeholder="cantidad" name="cantidad[<?php echo $row['id_producto']; ?>]"></td>
                                  <?php  
                              }
                              ?>
                         
                                </tr>
                              </table>
                      </div>


                    <p class="text-center">
                        <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                        <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                    </p>
                    </form>
                       </div>
                         
<?php 
if(isset($_POST['registra'])){
   $n_factura=$_POST['n_factura'];
   $fecha_factura=$_POST['fecha_factura'];
   $descripcion=$_POST['descripcion'];
   $proveedor=$_POST['proveedor'];

   foreach ($_POST['id'] as $value) {
    $id=$_POST['id'][$value];
    if($_POST['cantidad'][$value]!=''){
        $cantidad=$_POST['cantidad'][$value];

    $query="call ingreso_inventario('$id','$cantidad','$proveedor')";
        $a=$conexion->query($query);     
        if($a){
          echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="facturas_x_cobrar.php?n_factura='.$n_factura.'&fecha_fact='.$fecha_factura.'&descripcion='.$descripcion.'&proveedor='.$proveedor.'";});});</script>';  
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar!", "error")</script>';    
    }


    }

    
}

}

 ?>


<!-- <label></label><input type="" name=""> -->

                    </div>
            </div>
          

        </section>
        </div>

      
        
 </body>
 <script type="text/javascript">
  $(document).ready(function(){
        // $("#agregar").click(function(e){
        //     e.preventDefault();
        //     $("#nuevoscofres").append("Appended item");
        // });


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