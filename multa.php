<!DOCTYPE html>
<html>
<head>
    <title>SOCIOS</title>
    <?php 
    session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
        require_once('meta.php');
        require_once('login/conexion.php');
        error_reporting(0);
     ?>
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> -Asistencia de Asamblea</small></h1>
            </div>
        </div>
         <section>
          <form autocomplete="" action="" method="post" id="formreg" name="formreg"> 
                
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Asistencia de Asamblea</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend><br> 

                              <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                              $sqlreunion=$conexion->query("SELECT * FROM `tb_reunion` WHERE verificado='0'"); 
                           
                         
                        
                            $sqlsocio=$conexion->query("SELECT tb_socio.id_socio,tb_socio.id_persona, tb_personas.nombre, tb_personas.apellido FROM `tb_socio` inner join tb_personas on tb_socio.id_persona=tb_personas.id_persona WHERE tb_socio.estado='ACTIVO' order by tb_personas.apellido");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                       <!-- <div class="col-xs-12 col-sm-8 col-sm-offset-2">   -->
                       <form method="post">
                       <center>
                       <div class="group-material">
                          <span>Seleccione la fecha de la Asamblea </span> 
                          <br>
                           <select class="selectpicker" name="id_re" class="material-control" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>

                                <?php  

                             while($rows=$sqlreunion->fetch_array()){ ?>

                              <option value="<?php echo $rows['id_reunion']; ?>"><?php echo ($rows['fecha']); ?></option>
                               <?php  
                            }

                            ?>
                          </select>
                            </div> 
                            </center>
                             <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="buscar" id="buscar" type="submit" class="btn btn-success"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GENERAR</button> &nbsp;&nbsp;
                            </p>
                        </form>

<?php 
if(isset($_POST['buscar']) and $_POST['id_re']!=''){
$id_re=$_POST['id_re'];
 ?>
                            <form action="" method="post">
                               <table class="table table-hover table-striped table-border display nowrap" id="tablaempleado">
                                <thead>
                                    <tr  class="info">
                                      <th width="10">Id</th>
                                      <th>Socio</th>
                                      <th>Asistió</th>
                                      <th>Faltó</th>
                                      <th>Justificó</th>
                                      
                                  </tr>
                              </thead>

                              <tbody>
                             <div class="group-material">
                                <!-- <span>Seleccione al Socio </span>  -->
                               
                          
                           <?php  
                              $i=1;
                             while($row=$sqlsocio->fetch_array()){ ?>
                                <tr>
                                 <td><?php echo ($i++); ?></td>
                                 <input type="hidden" name="id[<?php echo ($row['id_persona']); ?>]" value="<?php echo ($row['id_persona']); ?>" readonly>
                                <td><?php echo ($row['apellido'].' '.$row['nombre']); ?></td>
                                <?php 
                                 $queryju=mysqli_query($conexion,"select * from tb_justificacion where id_persona='".$row['id_persona']."' and id_reunion='".$id_re."'");
                                 // echo $id_re;
                                 // $resultcons = mysqli_query($conexion, $queryju);
                                 $rowcount=mysqli_num_rows($queryju);
                                 if($rowcount==1){ 
                                ?>
                                <td><input type="radio" name="multa[<?php echo ($row['id_persona']);?>]" value="1" disabled ></td>

                                <td><input type="radio" name="multa[<?php echo ($row['id_persona']);?>]" value="0" disabled></td>

                                <td><input type="radio" name="multa[<?php echo ($row['id_persona']);?>]" value="j" checked="checked"  ></td>
                                <?php 
                                    }else{ 

                                 ?>
                                  <td><input type="radio" name="multa[<?php echo ($row['id_persona']);?>]" value="1" checked="checked"></td>

                                <td><input type="radio" name="multa[<?php echo ($row['id_persona']);?>]" value="0"></td>

                                <td><input type="radio" name="multa[<?php echo ($row['id_persona']);?>]" value="j" disabled></td>
                                <?php 
                                } ?>
                            <?php      
                            }
                            ?>
                            </tr>
                     
                            </div>

</tbody>

  </table>

                            <input type="hidden" name="fecha_r" value="<?php echo($id_re); ?>">
                           
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                            </p>
                       </div>
                   </div>
                
            </form> 
            <?php 
}
             ?>
        </section>

</body>
<?php 
if(isset($_POST['registra'])){
    $fecha_r=$_POST['fecha_r'];

    $consulfecha=$conexion->query("SELECT fecha FROM `tb_reunion` WHERE id_reunion='".$fecha_r."'");
    while($consultaf=mysqli_fetch_array($consulfecha)){
                $fecha_reunion=$consultaf['fecha'];
                
            }

    $descripcion=$_POST['descripcion'];


$multa=$conexion->query("SELECT * FROM `tb_pagos_socio` WHERE descripcion='MULTAS' and fecha=(SELECT MAX(fecha) FROM tb_pagos_socio)"); 

 while($consultamulta=mysqli_fetch_array($multa)){
                $mult=$consultamulta['id_pagos_socio'];
                $valormulta=$consultamulta['valor'];
            }


foreach ($_POST['id'] as $value) {
    $id=$_POST['id'][$value];
    if($_POST['multa'][$value]=='0'){
    
     $insertar_cuenta=$conexion->query("call insertar_multa('".$id."','".$valormulta."','".$fecha_reunion."','3')");



    }
    // echo "<script type='text/javascript'>alert('".$id."');</script>";
 $insertar_asis=$conexion->query("insert into tb_asistencia (id_persona,id_reunion,asistencia,id_usuarios)values('".$id."','".$fecha_r."','".$_POST['multa'][$value]."','".$_SESSION['id_usuario']."')");

}

  if($insertar_cuenta and $insertar_asis){
$insertar_asis=$conexion->query("update tb_reunion set verificado='1' where id_reunion='".$fecha_r."'");

        echo '<script type="text/javascript">swal({
  title: "ok",
  text: "Registrado con exito...!",
  type: "success",
  showCancelButton: true,
  confirmButtonText: "Aceptar!",
  closeOnConfirm: false
},
function(){
  location.href="multa.php";
});</script>';    
  }else{
    echo '<script type="text/javascript">swal({
  title: "ok",
  text: "A ocurrido un error durante el proceso...!",
  type: "error",
  confirmButtonText: "Aceptar!",
  closeOnConfirm: false
},
function(){
  location.href="multa.php";
});</script>';    
  }

}

 ?>

<script type="text/javascript">
     $(document).ready(function(){
                   
                    $('input[name=fecha_reunion]').daterangepicker({
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

                    $('input[name=fecha_reunion]').focusout(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('input[name=fecha_reunion]').val();
                        
                            $.post("controler/verificar_multa.php",{fecha:id_persona},function(data,status){
                                if(data=='ok'){
                                    console.log(data);
                                    console.log(status);
                                }else{
                                    console.log(data);
                                    console.log(status);
                                    swal({
                                        title: "Advertencia?",
                                      text: "Ya se encuentra registrada la fecha de esa Asamblea!",
                                      type: "warning",
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                        location.href="multa.php";
                                      
                                  });
                                }
                               
                            });
                       
                    
                });
            //     $('#registra').click(function(e){
            //         e.preventDefault();

            //         var id_persona=$('input[name=fecha_reunion]').val();
            //         var descrip=$('#descripcion').val();
            //         // alert(descrip);
            //         if(descrip!=""){
            //                      $.post("controler/verificar_multa.php",{fecha:id_persona},function(data,status){
            //                     if(data=='ok'){
            //                         console.log(data);
            //                         console.log(status);
            //                         // $('form').submit(function(){
            //                         //     window.location.href = "multa.php?registra=registra";
            //                         // });
            //                     }else{
            //                         console.log(data);
            //                         console.log(status);
            //                         swal({
            //                             title: "Advertencia?",
            //                           text: "Ya se encuentra registrada la fecha de esa Asamblea! Elija otra Fecha!",
            //                           type: "warning",
            //                           confirmButtonColor: "#DD6B55",
            //                           confirmButtonText: "Aceptar!"
            //                       },
            //                       function(){

            //                             location.href="multa.php";
                                      
            //                       });
            //                     }

            //                     });
            //         }else{
            //             swal({
            //                             title: "Advertencia?",
            //                           text: "Debe rellenar el campo descripcion!",
            //                           type: "warning",
            //                           confirmButtonColor: "#DD6B55",
            //                           confirmButtonText: "Aceptar!"
            //                       },
            //                       function(){

            //                             // location.href="multa.php";
                                      
            //                       });
            //         }
                   
            // });
    });

</script>
</html>