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
    // require_once('asamblea.php'); 
    if(isset($_GET['success'])){
 	 ?>
     <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Ok!</strong> Registro Grabado.
</div>
    <?php  }else{?>
 <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Ok!</strong> Registro Grabado.
</div>

    <?php } ?>

   
 </head>
 <body>
 <script type="text/javascript">
    $(document).ready(function(){
            $('#contsocio').attr("style","display:block;");
            $('#socio').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Reuniones</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">

        <div class="form-inline">
        <button type='button' class="btn btn-success pull-right" data-toggle="modal" data-target="#asambleas" id="n_asamblea"><span class="glyphicon glyphicon-list-alt" ></span> Nueva Asamblea</button>
        </div>
        <br><br><br><br>
              
        <?php 
        if(isset($_GET['id'])){
            $ids=$_GET['id'];
            $hoy=date('Y/m/d');
            $act=$conexion->query("SELECT *  FROM  tb_reunion where id_reunion='".$ids."' ");
            while($rows=$act->fetch_array()){
                ?>
<div class="table-responsive col-md-10 col-md-offset-1">  
              <h1 class="all-tittles">Actualización de datos<small> </h1>
                <form method="post">
                    <div class="form-group ">
                    <input type="hidden" name="id_re" value="<?php echo($rows['id_reunion']); ?>">
                        <label for="nombres">Fecha:</label>
                        <input type="text" class="form-control" id="fecha" name="fecha"  value="<?php echo($rows['fecha']); ?>" readonly ><span ></span>
                    </div> 
                    
                    <div class="form-group ">
                        <label for="nombres">Descripcion:</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required="" ><?php echo($rows['descripcion']); ?></textarea>
                    </div>

                    <div class="form-group ">
                       <select name="estado"  class="form-control">
                           <option value="ACTIVO" <?php if($rows['estado']=='ACTIVO'){echo ('selected');}?> >ACTIVO</option>
                           <option value="INACTIVO" <?php if($rows['estado']=='INACTIVO'){echo ('selected');}?> >INACTIVO</option>
                       </select>
                    </div>

                    <div class="form-group ">
                        <label for="nombres">Observacion:</label>
                        <input type="text" class="form-control" id="observacion" name="observacion" value="<?php echo($rows['observacion']); ?>" required>
                    </div> 

                    <br><br>
                    <p class="text-center">
                    <a href="reuniones.php"  class="btn btn-danger"> CANCELAR</a>
                       <button  name="actuali" id="actuali" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                   </p>
<br><br>
                </form>
</div> 

                <?php 
            }  
        }

        if(isset($_POST['actuali'])){
            $fecha=$_POST['fecha'];
            $descripcion=$_POST['descripcion'];
            $estado=$_POST['estado'];
            $observa=$_POST['observacion'];
            $id_re=$_POST['id_re'];
            
            $queryUpdate="update tb_reunion set fecha='".$fecha."', descripcion='".$descripcion."',estado='". $estado."',observacion='".$observa."' where id_reunion='".$id_re."'";
             $resultUpdate = mysqli_query($conexion, $queryUpdate); 

                                 if($resultUpdate)
                                 {
                                       echo '<script>jQuery(function(){swal({title:"Ok",text:"Acualización exitosa",type:"success",confirmButtonText:"Aceptar"},function(){location.href="reuniones.php";});});</script>';
                                   } else 
                                        {
                                       echo '<script>jQuery(function(){sweetAlert("Error...", "No se pudo actualizar los registros!", "error");});</script>'; 
                                            }  
        }
        ?>  


        <div id=nueva_asamblea>
            

        </div>
        <?php 
         $reunion=$conexion->query("SELECT *  FROM  tb_reunion order by fecha,estado"); 

         ?>
        <div class="table-responsive col-md-10 col-md-offset-1">
  
  <table class="table table-hover table-striped table-border display nowrap" id="tablaempleado">
    <thead>
        <tr  class="info">
          <th>Codigo</th>
          <th>Fecha</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>Observacion</th>
          <th class='text-right'>Editar</th>
         
        </tr>
        </thead>

        <tbody>
 
                <?php  

                while($row=$reunion->fetch_array()){ 
                    $id=$row['id_reunion'];

                                ?>
          <tr>
          <!-- dia -->
            <td>
            <?php
             echo($id);
              ?>
                
            </td>
            <!-- fecha -->
            <td>
            <?php 
            echo $row['fecha']; 
            ?>
                
            </td>
            <td>
            <?php 
            echo $row['descripcion']; 
            ?>
            </td>
             <td>
            <?php 
            echo $row['estado']; 
            ?>
            </td>
            <td>
            <?php 
            echo $row['observacion']; 
            ?>
            </td>
            <td>
              <span class="pull-right">

      <a href="reuniones.php?id=<?php echo $id; ?>"  data-toggle="modal"  class="btn btn-info" ><i class="glyphicon glyphicon-pencil"></i></a>
       <?php 
        // include('editar_empleado.php');
        ?>

     </span>
     </td>
 

          
           
<?php  
}
   
 ?>

 </tr>
        </tbody>

  </table>


</div>
       	

        </section>
       
        </div>

    
        
 </body>
 <script type="text/javascript">
 	$(document).ready(function(){
var hoys=' <?php echo($hoy); ?>';
 		$('#inicio').click(function(){
 			$('#contenedor').load('vistas/inicio.php');
 		});


        $('#tablaempleado').DataTable( {
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
        },
    } );
        

        $('#n_asamblea').click(function(){
            $.post('asamblea.php',{id:'hola'},function(data,status){
                $('#nueva_asamblea').html(data);
                // console.log(data);
                // console.log(status);

            });
        });

         $('input[name=fecha]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                         autoUpdateInput: false,
                         drops:"up",
                        minDate: hoys,
                       
                        locale: {
                          cancelLabel: 'Clear',
                          format: 'YYYY-MM-DD H:mm:00',
                          "separator": " - ",
                          "applyLabel": "Aceptar",
                          "cancelLabel": "Cancelar",
                          "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                           "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo",
                          "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre",
                          "Diciembre"]
                      }
                  });
       $('input[name="fecha"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD H:mm:00'));
      });

       $('input[name="fecha"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

 		
 	});

 </script>
 </html>