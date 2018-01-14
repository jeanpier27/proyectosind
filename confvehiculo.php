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
            $('#contconfig').attr("style","display:block;");
            $('#confvehiculo').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Varios</small></h1>
            </div>
        </div>
        <!-- <section class="full-reset text-center" style="padding: 10px 40PX;" id="contenedor"> -->
        	<div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Vehículo </div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                      
    <!-- <div style="display: flex; justify-content: space-between;"> -->
    <center>
    <div class="group-material">
    
      <div>
      <h1>MARCA</h1>
      <form autocomplete="off" method="post">
        <select name="marca">
        <?php $consulmarca=$conexion->query("select * from tb_marca"); 
        while($row=mysqli_fetch_array($consulmarca)){?>
          <option value="<?php echo($row['id_marca']); ?>"><?php echo($row['descripcion']); ?></option>
        <?php } ?>
        </select>
        <input type="text" name="addmarca">
          <input type="submit" name="agregarmarca" class="btn btn-info" value="Agregar Marca">
        <h1>MODELO</h1>
        <select name="modelo"></select>
        <input type="text" name="addmodelo">
        <input type="submit" name="agregarmodelo" class="btn btn-info" value="Agregar Modelo">
        </form>
      </div>
    </div>
    </center>
                   
<?php 

  if(isset($_POST['agregarmodelo'])){
    $id_marca=$_POST['marca'];
    $modelo=$_POST['addmodelo'];
    $repetido=$conexion->query("select 1 from tb_modelo where descripcion='".$marca."' and id_marca='".$id_marca."'");
    $consult=mysqli_fetch_array($repetido);
    if($consult[0]!=1){
      $insertm=$conexion->query("insert into tb_modelo (id_marca,descripcion)values('".$id_marca."','".$modelo."')");
      if($insertm){
        echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';

      }else{
        echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
      }

    }else{
      echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Ya se encuentra registrada el modelo",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
    }

  }



  if(isset($_POST['agregarmarca'])){
    $marca=$_POST['addmarca'];
    $repetido=$conexion->query("select 1 from tb_marca where descripcion='".$marca."'");
    $result=mysqli_fetch_array($repetido);
    if($result[0]!=1){
    $sqlinsert=$conexion->query("insert into tb_marca (descripcion)values('".$marca."')");
    if($sqlinsert){
      echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';

    }else{
      echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
    }
    }else{
       echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Ya se encuentra registrada la marca",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
    }

  }
 ?>
                       </div>
                       </div>
        	

        <!-- </section> -->
        </div>

        <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Cantidad de Alumnos por Curso </div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <div  class="group-material">
                       <center>
                       <h1>Cantidad de alumno por curso</h1>
                       <?php 
                       $consulcant=$conexion->query("select cantidad from tb_cantidad_curso where descripcion='alumnosxcurso'");
                       $respu=mysqli_fetch_array($consulcant);
                        ?>
                        <form autocomplete="off" method="post">
                        <!-- <label>Cantidad por Curso</label> -->
                        <input type="text" class="numero" name="cantidad" value="<?php echo($respu[0]); ?>">
                        <input type="submit" name="guardarcantidad" value="Guardar" class="btn btn-info" >
                        </form>
                       </div>
                       <?php 
                        if(isset($_POST['guardarcantidad'])){
                          $cantidad=$_POST['cantidad'];
                          // echo ("<script type='text/javascript'>alert('".$cantidad."');</script>");
                          $insert=$conexion->query("update tb_cantidad_curso set cantidad='".$cantidad."' where id_cantidad_curso=1");
                          if($insert){
                            echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';

                          }else{
                            echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                          }

                        }
                        ?>

                       </center>
                       </div>
                       </div>
          
        </div>


        <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Valor de Garantía</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <div  class="group-material">
                       <center>
                       <h1>Valor de Garantía Salon de eventos</h1>
                       <?php 
                       $consulcant=$conexion->query("select cantidad from tb_cantidad_curso where descripcion='garantia'");
                       $respu=mysqli_fetch_array($consulcant);
                        ?>
                        <form autocomplete="off" method="post">
                        <!-- <label>Cantidad por Curso</label> -->
                        <input type="text" class="numero" name="garantia" value="<?php echo($respu[0]); ?>">
                        <input type="submit" name="guardargarantia" value="Guardar" class="btn btn-info" >
                        </form>
                       </div>
                       <?php 
                        if(isset($_POST['guardargarantia'])){
                          $cantidad=$_POST['garantia'];
                          // echo ("<script type='text/javascript'>alert('".$cantidad."');</script>");
                          $insert=$conexion->query("update tb_cantidad_curso set cantidad='".$cantidad."' where id_cantidad_curso=2");
                          if($insert){
                            echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';

                          }else{
                            echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                          }

                        }
                        ?>

                       </center>
                       </div>
                       </div>
          
        </div>

        <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Actividad Comercial</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <div  class="group-material">
                       <center>
                       <h1>Actividad Comercial</h1>
                       
                        <form autocomplete="off" method="post">
                          <select name="marca">
                            <?php $consulmarca=$conexion->query("select descripcion from tb_actividad_comercial"); 
                            while($row=mysqli_fetch_array($consulmarca)){?>
                            <option value="<?php echo($row['id_marca']); ?>"><?php echo($row['descripcion']); ?></option>
                            <?php } ?>
                          </select>
                          <input type="text" name="actividad">
                          <input type="submit" name="agregaractividad" class="btn btn-info" value="Agregar Actividad Comercial">
                          
                        </form>
                       </div>
                       <?php 
                        if(isset($_POST['agregaractividad'])){
                          $cantidad=$_POST['actividad'];
                          // echo ("<script type='text/javascript'>alert('".$cantidad."');</script>");
                          $repetido=$conexion->query("select 1 from tb_actividad_comercial where descripcion='".$cantidad."'");
                          $result=mysqli_fetch_array($repetido);
                          if($result!=1){
                          $insert=$conexion->query("insert into tb_actividad_comercial (descripcion) values('".$cantidad."') ");
                          if($insert){
                            echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';

                          }else{
                            echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                          }
                        }else{
                           echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Ya se encuentra repetida la actividad comercial",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                        }

                        }
                        ?>



                       </center>
                       </div>
                       </div>
          
        </div>

      
                        <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Valor de Supletorios</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <div  class="group-material">
                       <center>
                       <h1>Valor de Supletorios</h1>
                       
                        <form autocomplete="off" method="post">
                         
                            <?php $consulmarca=$conexion->query("select cantidad from tb_agregar_saldo_estudiante where id_agregar_saldo_estudiante=1"); 
                            while($row=mysqli_fetch_array($consulmarca)){?>
                             <input type="text" name="actividad" value="<?php echo($row['cantidad']); ?>">
                            <?php } ?>
                                                   
                          <input type="submit" name="agregarvalorsuple" class="btn btn-info" value="Agregar Valor Supletorio">
                          
                        </form>
                       </div>
                         <?php 
                        if(isset($_POST['agregarvalorsuple'])){
                          $cantidad=$_POST['actividad'];
                          // echo ("<script type='text/javascript'>alert('".$cantidad."');</script>");
                          // $repetido=$conexion->query("select 1 from tb_actividad_comercial where descripcion='".$cantidad."'");
                          // $result=mysqli_fetch_array($repetido);
                          // if($result!=1){
                          $insert=$conexion->query("update tb_agregar_saldo_estudiante set cantidad='".$cantidad."' where id_agregar_saldo_estudiante=1 ");
                          if($insert){
                            echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';

                          }else{
                            echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                          }
                        // }else{
                        //    echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Ya se encuentra repetida la actividad comercial",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                        // }

                        }
                        ?>



                       </center>
                       </div>
                       </div>
          
        </div>

          <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">RECUPERACIÓN PEDAGOGICA</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <div  class="group-material">
                       <center>
                       <h1>RECUPERACIÓN PEDAGOGICA</h1>
                       
                        <form autocomplete="off" method="post">
                          
                          <select class="" name="promo" id="promo" data-live-search="true" required="">
                          <option value="0">Seleccione la promocion</option>

                        <?php 
                         // $Id_est = isset($_REQUEST["ides"]) ? $_REQUEST["ides"]: 0;
                         //   $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                            $sqlpromo=$conexion->query("SELECT * FROM `tb_promocion` "); 
                            // $desc=$conexion->query("select descripcion from tb_promocion where id_promocion='".$Promo."'");
                            // $resdesc=mysqli_fetch_array($desc);
                             while($sqlpromo=mysqli_fetch_array($sqlpromo)){
                         ?>
                                 
                            <option value="<?php echo $sqlpromo['id_promocion']; ?>" <?php if($Promo==$sqlpromo['id_promocion']){ echo 'selected';} ?> ><?php echo ($sqlpromo['descripcion'].' '.$sqlpromo['fecha_inicio'].' / '.$sqlpromo['fecha_fin']); ?></option>
                                                       

                           <?php }  ?>
                           </select>
                              <br><br>
                              Estudiante
                           <select name="id_estudiante" id="">
                           </select>
                         <br><br>
                          Descripción
                             <input type="text" name="descripcion" required="">
                             <br><br>
                          Cantidad
                             <input class="numero" type="text" name="actividad" required="">
                           
                                                   <br><br>
                           
                                                   <br><br>
                          <input type="submit" name="agregarvalorestudiante" class="btn btn-info" value="Agregar Recuperación Pedagogica ">
                          
                        </form>

                       </div>
                         <?php 
                        if(isset($_POST['agregarvalorestudiante'])){
                          $promo=$_POST['promo'];
                          $id_estudiante=$_POST['id_estudiante'];
                          $descripción=$_POST['descripcion'];
                          $cantidad=$_POST['actividad'];
                          // echo ("<script type='text/javascript'>alert('".$cantidad."');</script>");
                          // $repetido=$conexion->query("select 1 from tb_actividad_comercial where descripcion='".$cantidad."'");
                          // $result=mysqli_fetch_array($repetido);
                          // echo '<script type="text/javascript">alert("'.$promo.$id_estudiante.$descripción.$cantidad.'");</script>';
                          // exit;
                          if($promo!=0 and $id_estudiante!=0){

                          $sqlestudiante=$conexion->query("SELECT tb_estudiantes.id_estudiante,tb_personas.nombre, tb_personas.apellido FROM `tb_estudiantes` inner join tb_personas on tb_estudiantes.id_persona=tb_personas.id_persona where tb_estudiantes.estado='ACTIVO' and tb_estudiantes.id_estudiante=".$id_estudiante." "); 
                          $respnombres=mysqli_fetch_array($sqlestudiante);
                          $nombres= $respnombres[2].' '.$respnombres[1];

                          $sqlpromo=$conexion->query("select descripcion from tb_promocion where id_promocion='".$promo."'");
                          $respromo=mysqli_fetch_array($sqlpromo);

                          $insert=$conexion->query("insert into tb_agregar_saldo_estudiante (descripcion,cantidad) values ('".$respromo[0].' '.$nombres.' '.$descripción."','".$cantidad."') ");
                          if($insert){
                            $updatesaldo=$conexion->query("update tb_estudiantes set valor=valor+".$cantidad." where id_estudiante='".$id_estudiante."' ");
                            if($updatesaldo){
                                 echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                            }else{
                               echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                            }
                           

                          }else{
                            echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                          }
                        }else{
                           echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Debe seleccionar todos los campos",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                        }

                        }
                        ?>



                       </center>
                       </div>
                       </div>
          
        </div>

        <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">CUENTAS CONTABLES</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <div  class="group-material">
                       <center>
                       <h1>CUENTAS CONTABLE</h1>
                       
                        <form autocomplete="off" method="post">
                          
                          
                              <br><br>
                          
                          Codigo cuenta contable
                             <input type="text" name="codigocuentap" required="">
                             <br><br>
                          Nueva cuenta contable
                             <input class="numero" type="text" name="cuentap" required="">
                           
                                                   <br><br>
                           
                                                   <br><br>
                          <input type="submit" name="agregarcuentaprincipal" class="btn btn-info" value="Agregar cuenta contable principal ">
                          
                        </form>

                       </div>
                         <?php 
                        if(isset($_POST['agregarcuentaprincipal'])){
                          // $promo=$_POST['promo'];
                          $codigo=$_POST['codigocuentap'];
                          $cuenta=$_POST['cuentap'];
                          // $cantidad=$_POST['actividad'];
                          // echo ("<script type='text/javascript'>alert('".$cantidad."');</script>");
                          // $repetido=$conexion->query("select 1 from tb_actividad_comercial where descripcion='".$cantidad."'");
                          // $result=mysqli_fetch_array($repetido);
                          // echo '<script type="text/javascript">alert("'.$promo.$id_estudiante.$descripción.$cantidad.'");</script>';
                          // exit;
                          if($codigo!="" and $cuenta!=""){

                         
                          $insert=$conexion->query("insert into tb_plan_cuenta (id_plan_cuenta,descripcion) values ('".$codigo.', '.$cuenta."') ");
                          if(!$insert){
                            
                                 echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                           

                          }else{
                            echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                          }
                        }else{
                           echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Debe seleccionar todos los campos",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                        }

                        }
                        ?>



                       </center>
                       </div>
                       </div>
          
        </div>

        <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">SUBCUENTAS CONTABLES</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-11 col-sm-offset-1">
                       <div  class="group-material">
                       <center>
                       <h1>SUBCUENTAS CONTABLE</h1>
                       
                        <form autocomplete="off" method="post">
                          
                          <select class="" name="plan_cuenta" id="plan_cuenta" data-live-search="true" required="">
                          <option value="0">Seleccione</option>

                        <?php 
                         // $Id_est = isset($_REQUEST["ides"]) ? $_REQUEST["ides"]: 0;
                         //   $Promo = isset($_REQUEST["promo"]) ? $_REQUEST["promo"]: 0;
                            $cuenta=$conexion->query("SELECT * FROM `tb_plan_cuenta`"); 
                            // $desc=$conexion->query("select descripcion from tb_promocion where id_promocion='".$Promo."'");
                            // $resdesc=mysqli_fetch_array($desc);
                             while($respcuenta=mysqli_fetch_array($cuenta)){
                         ?>
                                 
                            <option value="<?php echo $respcuenta['id_plan_cuenta']; ?>" > <?php echo $respcuenta['descripcion']; ?> </option>
                                                       

                           <?php 
                             }  
                         ?>
                           </select>
                              <br><br>
                          
                          Codigo cuenta contable
                             <input type="text" name="codigocuentasp" required="">
                             <br><br>
                          Nueva cuenta contable
                             <input class="numero" type="text" name="cuentasp" required="">
                           
                                                   <br><br>
                           
                                                   <br><br>
                          <input type="submit" name="agregarcuentasubcuenta" class="btn btn-info" value="Agregar subcuenta contable">
                          
                        </form>

                       </div>
                         <?php 
                        if(isset($_POST['agregarcuentasubcuenta'])){
                          $id=$_POST['plan_cuenta'];
                          $codigo=$_POST['codigocuentap'];
                          $cuenta=$_POST['cuentap'];
                          // $cantidad=$_POST['actividad'];
                          // echo ("<script type='text/javascript'>alert('".$cantidad."');</script>");
                          // $repetido=$conexion->query("select 1 from tb_actividad_comercial where descripcion='".$cantidad."'");
                          // $result=mysqli_fetch_array($repetido);
                          // echo '<script type="text/javascript">alert("'.$promo.$id_estudiante.$descripción.$cantidad.'");</script>';
                          // exit;
                          if($codigo!="" and $cuenta!=""){

                         
                          $insert=$conexion->query("insert into tb_plan_subcuentas (id_plan_subcuentas,id_plan_cuenta,descripcion) values ('".$id."','".$codigo.', '.$cuenta."') ");
                          if(!$insert){
                            
                                 echo '<script>jQuery(function(){swal({title:"OK..!!",text:"Registro guardado con exito",type:"success",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                           

                          }else{
                            echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Error al guardar",type:"error",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                          }
                        }else{
                           echo '<script>jQuery(function(){swal({title:"ERROR..!!",text:"Debe seleccionar todos los campos",type:"warning",confirmButtonText:"Aceptar"},function(){location.href="confvehiculo.php";});});</script>';
                        }

                        }
                        ?>



                       </center>
                       </div>
                       </div>
          
        </div>
        
 </body>
 <script type="text/javascript">

 $(".numero").keypress(function(e){
                    var key = window.Event ? e.which : e.keyCode 
                    return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
                });
 	$(document).ready(function(){

    
    $('select[name=promo]').change(function(){
      var id_promo=$('select[name=promo]').val();
       $.post("controler/consulta_estudiante.php",{promo:id_promo},function(data,status){
                                 // console.log(id_promo);
                                 //    console.log(data);
                                 //    console.log(status);
                                  $('select[name=id_estudiante]').html(data);
                                                               
                               
                            });
    });
    

   var id_persona=$('select[name=marca]').val();
                        
                            $.post("controler/consulta_modelo.php",{cedula:id_persona},function(data,status){
                                
                                    console.log(data);
                                    console.log(status);
                                    $('select[name=modelo]').html(data);
                                                               
                               
                            });

     $('select[name=marca]').change(function(){
                        // alert($('select[name=nombres]').val());s
                        var id_persona=$('select[name=marca]').val();
                        console.log(id_persona);
                        
                            $.post("controler/consulta_modelo.php",{cedula:id_persona},function(data,status){
                                
                                    console.log(data);
                                    console.log(status);
                                    $('select[name=modelo]').html(data);
                               
                                  //   swal({
                                  //       title: "Advertencia?",
                                  //     text: "Ya se encuentra registrado!",
                                  //     type: "warning",
                                  //     confirmButtonColor: "#DD6B55",
                                  //     confirmButtonText: "Aceptar!"
                                  // },
                                  // function(){
                                  //       location.href="addsocio.php";
                                      
                                  // });
                                
                               
                            });
                       
                    
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
},

        dom: 'Bfrtip',
       buttons: [
            {
                extend: 'print', text:'Imprimir',
                 message: 'Datos de Socios',
                exportOptions: {
                    columns: ':visible',
                    
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' )
                        .prepend(
                            '<img src="http://www.ferreteriaquintana.com/sindicato/assets/fotos/thumbnail_escudo%20-%20copia.jpg" style="opacity: 0.2; position:absolute;" />'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                    }
            },
            {
              extend:   'colvis',
              text:'Seleccione las Columnas a imprimir'
            },
            {
              extend:   'excel',
              text:'Exportar a Excel',
              exportOptions: {
                    columns: ':visible',
                    
                },
              
            },
            {
              extend:   'pdfHtml5',
              text:'Exportar a PDF',
              orientation: 'landscape',
                pageSize: 'A4',
              exportOptions: {
                    columns: ':visible',
                    
                },
                
              
            },
            

        ],
        columnDefs: [ {

            
            targets: 0,
            visible: false
        },

         ]
    } );
} );



 </script>
 </html>