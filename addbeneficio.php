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
            $('#contsocio').attr("style","display:block;");
            $('#alquiler').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Beneficios</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
        	 <div class="container-fluid">
            
            
            <form autocomplete="" action="" method="post">
                            
                 
                <div class="container-flat-form">
 



                    <div class="title-flat-form title-flat-blue">Nuevo Beneficio</div> 
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2"> 
                       <?php   

    if(isset($_POST['registra'])){
                    $beneficio= $_POST['beneficio'];                  
                    $tiempo=$_POST['tiempo'];
                    $Valor= $_POST['valor'];
                   
                                
                        $query ="INSERT INTO tb_beneficios(beneficio,estado,valor) VALUES ('".$beneficio."','".$tiempo."','".$Valor."')";

                        $resultado = $conexion->query($query); 
                        if($resultado){

                               echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="addbeneficio.php";});});</script>';

                      }else{
                         echo '<script type="text/javascript">swal("Error!", "No se pudo guardar el socio!", "error")</script>';
                      }
             
                   }
                  ?>       


                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" required="" maxlength="20" onkeyup="javascript:this.value=this.value.toUpperCase();" data-toggle="tooltip" data-placement="top"  placeholder="Escribe el beneficio" title="Beneficio" name="beneficio">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Beneficio </label>
                            </div> 

                            <div class="group-material"> 
                             <span>Seleccione Tiempo </span> 
                                 <select style="color:red;" name="tiempo" class="tooltips-general material-control " data-toggle="tooltip" data-placement="top" >
                                   <option value="DIA" selected="">DIA</option>
                                   <option value="HORAS">HORAS</option>
                                   
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div>
                 

                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" required="" maxlength="20" data-toggle="tooltip" data-placement="top"  placeholder="Escribe el valor" title="Describa el Valor" name="valor">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor</label>
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