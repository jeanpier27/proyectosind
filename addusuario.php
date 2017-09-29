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
            $('#contconfig').attr("style","display:block;");
            $('#usuarios').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Usuarios</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
        	 <div class="container-fluid">
            
            
            <form autocomplete="" action="" method="post">
                            
                 
                <div class="container-flat-form">
 



                    <div class="title-flat-form title-flat-blue">Nuevo Usuario</div> 
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2"> 
                       <?php   

    if(isset($_POST['registra'])){
                    $id_pers= $_POST['nombres'];                  
                    $contraseña=$_POST['contraseña'];
                    $tipo_usuario= $_POST['tipo_usuario'];
                    $acceso= $_POST['acceso'];
                                
                        $query ="INSERT INTO tb_usuarios(id_persona,contraseña,id_tipo_usuario,estado,acceso) VALUES ('".$id_pers."','".$contraseña."','".$tipo_usuario."','ACTIVO','".$acceso."')";

                        $resultado = $conexion->query($query); 
                        if($resultado){

                               echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="addusuario.php";});});</script>';

                      }else{
                         echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>';
                      }
             
                   }
                  ?>       

                      <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            // $sql2=$conexion->query("SELECT * FROM tb_pagos_socio Group by descripcion");

                            $sqlsocio=$conexion->query("SELECT * from  `tb_personas` order by apellido");   
                         ?>
                 

                 <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">  
                            <div class="group-material">
                                <span>Seleccione al nuevo Usuario </span> 
                               
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
                                <input type="password" class="tooltips-general material-control" required="" maxlength="15"  data-toggle="tooltip" data-placement="top"  placeholder="Escribe la contraseña" title="Contraseña" name="contraseña">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contraseña </label>
                            </div> 
                              <?php 
                                $sqltipo=$conexion->query("select * from tb_tipo_usuario ");
                               ?>
                            <div class="group-material"> 
                             <span>Seleccione Cargo </span> 
                                 <select style="color:red;" name="tipo_usuario" class="tooltips-general material-control " data-toggle="tooltip" data-placement="top" >
                                 <?php 
                                   while($row=$sqltipo->fetch_array()){ ?>
                                  <option value="<?php echo $row['id_tipo_usuario']; ?>"><?php echo ($row['tipo_usuario']); ?></option>
                                   <?php } ?>
                                   
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div>

                             <div class="group-material"> 
                             <span>Seleccione Nivel de Acceso </span> 
                                 <select style="color:red;" name="acceso" class="tooltips-general material-control " data-toggle="tooltip" data-placement="top" >
                                 
                                  <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                   <option value="ADMINISTRATTIVO">ADMINISTRATTIVO</option>
                                    <option value="EDUCATIVO">EDUCATIVO</option>
                                  
                                   
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div>
                         
                              
                            <p class="text-center">
                               <!--  <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;  
                            </p>
                       </div>

                   </div>
                </div>
            </form>  
        </div> 
        	

        </section>
        </div>
   
      
        
 </body>
<script type="text/javascript">
$(document).ready(function(){
   

 $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
                });

// $('#registra').click(function(e){
//     e.preventDefault();
//     alert('h');
// });

});
</script>
 </html>