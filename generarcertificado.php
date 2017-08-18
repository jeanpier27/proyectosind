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
            $('#contreporte').attr("style","display:block;");
            $('#reportecertificado').attr("style","background-color:#E75A5A;");
               
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Ingresos Estudiantes</small></h1>
            </div>
        </div>
        <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor">
           <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Registro</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <form method="post">

                         <div class="group-material">
                         Seleccione promocion <br>
                         <select class="selectpicker" name="promo" id="promo" onchange="carga_bienes(this.value);"  data-live-search="true" required="">
                          <option value="0">Seleccione la promocion</option>

                        <?php 
                         $Id_est = isset($_REQUEST["ides"]) ? $_REQUEST["ides"]: 0;
                           $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                            $sqlpromo=$conexion->query("SELECT * FROM `tb_promocion` "); 
                             while($sqlpromo=mysqli_fetch_array($sqlpromo)){
                         ?>
                                 
                            <option value="<?php echo $sqlpromo['id_promocion']; ?>" <?php if($Promo==$sqlpromo['id_promocion']){ echo 'selected';} ?> ><?php echo ($sqlpromo['fecha_inicio'].' - '.$sqlpromo['fecha_fin']); ?></option>
                                                       

                           <?php }  ?>
                           </select>
                        </div> 

                        <?php 
                        // if(isset($_GET['promo'])){  
                            ?>
                        <div class="group-material">
                        Seleccione Estudiante <br>
                         <select class="selectpicker" name="idestudiante" id="persona_dato" onchange="carga_bienes(this.value);"  data-live-search="true" required="">
                          <option value="0" >Seleccione al estudiante</option>

                        <?php 
                            $sqlestudiante=$conexion->query("SELECT tb_estudiantes.*,tb_personas.nombre, tb_personas.apellido FROM `tb_estudiantes` inner join tb_personas on tb_estudiantes.id_persona=tb_personas.id_persona where tb_estudiantes.estado='ACTIVO' and tb_estudiantes.id_promocion=".$_GET['promo']); 
                             while($consultaestudiante=mysqli_fetch_array($sqlestudiante)){
                         ?>
                                 
                            <option value="<?php echo $consultaestudiante['id_estudiante']; ?>"  <?php if($Id_est==$consultaestudiante['id_estudiante']){ echo 'selected';} ?> ><?php echo ($consultaestudiante['apellido'].' '.$consultaestudiante['nombre']); ?></option>
                                                       

                           <?php }  ?>
                           </select>
                        </div> 
                        <?php 
                    // } 
                            // if(isset($_GET['ides'])){
                             ?>
                           
                 
                    <p class="text-center">
                        <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                        <button  name="registra" id="registra" type="submit"  class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Generar Certificado</button> &nbsp;&nbsp;
                    </p>
                    </form>
                       </div>
                         
<?php 
if(isset($_POST['registra'])){
     echo '<script type="text/javascript">swal("Advertencia!", "No se encontraros datos de notas para generar el certificado!", "warning")</script>';  

}

 ?>




                    </div>
            </div>
        	

        </section>
        </div>

   <?php require_once('login/cerrar_conexion.php'); ?>   
        
 </body>
 <script type="text/javascript">
    var comprob = '<?php echo $Comprob = isset($_REQUEST["ingreso"]) ? $_REQUEST["ingreso"]: "nada"; ?>';
        if (comprob != "nada") {
            VentanaCentrada('comprobante_ingreso_escuela.php?id='+comprob,'Recaudaciones','','1000','500','true');
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

        $('input[name=fecha_ingreso]').daterangepicker({
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
 <script>
                                function carga_bienes() {
                                    var x = document.getElementById("promo").value;
                                    var a = document.getElementById("persona_dato").value;
                                    location.href="generarcertificado.php?promo="+x+"&ides="+a;
                                    //location.href="updatestudiante.php?est="+a;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script> 
 </html>