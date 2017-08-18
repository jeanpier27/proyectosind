 
<!DOCTYPE html>
<html lang="es">
<head>
    <title>BIENVENIDO</title>
    <?php 
      require_once('meta.php');
     ?>
    
</head>
<body class="full-cover-background" >
  
  
   <div class="form-container"  style="margin-left:-30%; margin-top:-6%; background:white;"> 
           <img src="assets/img/anigif.gif" >
   </div> 
   
<!--    style="background-image:url(assets/img/fondo.jpg);"-->
   
    <div class="form-container" style="margin-left:30%;margin-top:-6%;">
            <center><img src="assets/img/logo.png" width="35%"></center>
            <!--
        <p class="text-center" style="margin-top: 17px;">
           <i class="zmdi zmdi-account-circle zmdi-hc-5x"></i>
       </p>
    -->
           <h4 class="text-center all-tittles" style="margin-bottom: 30px;">Inicie sesión con su cuenta</h4>
           <form action=""  method="post">
                <div class="group-material-login">
                  <input type="text" name="usuario" class="material-login-control" required="" maxlength="10" value="0928440304">
                  <span class="highlight-login"></span>
                  <span class="bar-login"></span>
                  <label><i class="zmdi zmdi-account"></i> &nbsp; Usuario</label>
                </div><br>
                <div class="group-material-login">
                  <input type="password" name="password" class="material-login-control" required="" maxlength="70">
                  <span class="highlight-login"></span>
                  <span class="bar-login"></span>
                  <label><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</label><br>
                </div>
            <!--
                <div class="group-material">
                    <select class="material-control-login" name="tipo">
                        <option value="" disabled="" selected="">Tipo de usuario</option>
                        <option value="socio">SOCIO</option>
                        <option value="administrador">PRESIDENTE</option>
                        <option value="administrativo">PERSONAL ADMNISTRATIVO</option>

                    </select>
                </div>
 -->
               <button class="btn-login" type="submit" id="enviar">
                  <b style="color:orange">Ingresar al sistema</b> &nbsp; <i class="zmdi zmdi-arrow-right"></i>
                </button> 
                <!-- <a class="btn-login" href="home-a.php"><b>Ingresar al sistema</b> &nbsp; <i class="zmdi zmdi-arrow-right"></i></a>-->
            </form>
   <!--  </div>  <br><br><br><br>  <br><br><br><br>  <br><br><br><br>  <br><br><br><br>  <br><br><br><br>  
    <div class=" full-reset custom-scroll-containers">
      <footer class="footer full-reset"> 
                <div class="row">
                   <center>
                    <div class="col-xs-12 col-sm-12">
                        <h1 style="color:orange;">SISTEMA DEL SINDICATO DE CHOFERES DE NARANJAL</h1>
                    </div> </center> 
                </div>
            
            <div class="footer-copyright full-reset all-tittles">© Ecuador 2017</div>
        </footer>
        
    </div> -->
    
</body>
 <script type="text/javascript">
 $(document).ready(function(){
   $('#enviar').click(function(e){
      e.preventDefault();
      var us=$('input[name=usuario]').val();
      var pas=$('input[name=password]').val();
     
      $.post("login/ingresar.php",{usuario:us,password:pas},function(data,status){
          
          if(data=='error'){
            sweetAlert("Error...", "Usuario o contraseña incorrecta!", "error");
          } else{
            location.href='sindnaranjal.php';
          }
        });
   });
 });
 </script>
</html>