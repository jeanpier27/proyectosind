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
            $('#ingresos').attr("style","background-color:#E75A5A;");
               
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - PAGOS Estudiantes</small></h1>
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
                            $desc=$conexion->query("select descripcion from tb_promocion where id_promocion='".$Promo."'");
                            $resdesc=mysqli_fetch_array($desc);
                             while($sqlpromo=mysqli_fetch_array($sqlpromo)){
                         ?>
                                 
                            <option value="<?php echo $sqlpromo['id_promocion']; ?>" <?php if($Promo==$sqlpromo['id_promocion']){ echo 'selected';} ?> ><?php echo ($sqlpromo['descripcion'].' '.$sqlpromo['fecha_inicio'].' / '.$sqlpromo['fecha_fin']); ?></option>
                                                       

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
                            $sqlestudiante=$conexion->query("SELECT tb_estudiantes.*,tb_personas.nombre, tb_personas.apellido FROM `tb_estudiantes` inner join tb_personas on tb_estudiantes.id_persona=tb_personas.id_persona where tb_estudiantes.estado='ACTIVO' and tb_estudiantes.id_promocion=".$_GET['promo']." order by tb_personas.apellido"); 
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
                             <div class="table-responsive">   
                            <table class="table table-hover table-bordered table-responsive order-table" aling="center" id="tabladatos">
                                <thead>
                                    <tr  class="info">
                                      <th>Id</th>
                                      <th>Fecha</th>
                                      <th>Descripcion</th>
                                      <th>Comprobante N.-</th>
                                      <th>Deposito N.-</th>
                                      <th>Valor</th>


                                      
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr  class="info">
                                      <th>Id</th>
                                      <th>Fecha</th>
                                      <th>Descripcion</th>
                                      <th>Comprobante N.-</th>
                                      <th>Deposito N.-</th>
                                      <th>Valor</th>
                                      
                                      <!-- <th>Observacion</th> -->


                                      
                                  </tr>
                              </tfoot>

                              <tbody>
                              <?php 
                              $sqlcuotas=$conexion->query('select tb_detalle_estudiante_pago.*,tb_ingreso_escuela.comprabante_n,tb_ingreso_escuela.comprabante_banco,tb_ingreso_escuela.fecha as fechas, tb_ingreso_escuela.saldo FROM `tb_detalle_estudiante_pago` inner join tb_ingreso_escuela on tb_detalle_estudiante_pago.id_ingreso_escuela=tb_ingreso_escuela.id_ingreso_escuela where tb_detalle_estudiante_pago.id_estudiante='.$Id_est);
                                while($consultasocio=mysqli_fetch_array($sqlcuotas)){
                               ?>
                               <?php if($consultasocio['descripcion']=='PSICONSENSOMETRICO'){ $psi=1;} 
                                     if($consultasocio['descripcion']=='MATRICULA'){ $mat=1;}
                                     $total=$total+$consultasocio['saldo'];

                               ?>
                                <tr>
                                <td><?php echo($consultasocio['id_detalle_estudiante_pago']); ?></td>
                                <td><?php echo($consultasocio['fechas']); ?></td>
                                <td><?php echo($consultasocio['descripcion']); ?></td>
                                <td><?php echo($consultasocio['comprabante_n']); ?></td>
                                 <td><?php echo($consultasocio['comprabante_banco']); ?></td>
                                 <td><?php echo($consultasocio['saldo']); ?></td>
                                

                               <?php } ?>
                               </tr>
                              </tbody>

                              </table>
                              </div>
                              <div class="group-material">
                                <h2>Total abonado $<?php if($total==''){echo '0';}else{ echo $total; }  ?></h2>
                              </div>
                            <div class="group-material">
                            <?php 
                            $sqlvalorde=$conexion->query('select valor,abono,id_persona from tb_estudiantes where id_estudiante='.$Id_est);
                            while($consulta=mysqli_fetch_array($sqlvalorde)){ ?>  
                                <input type="hidden" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Valor Inscripcion" name="" required value="$ <?php echo $consulta['valor']-$consulta['abono']; ?>" readonly="">
                                <h2>Valor de la Deuda $ <?php echo $consulta['valor']-$consulta['abono']; ?></h2>
                                <!-- <span class="highlight"></span>
                                <span class="bar"></span> -->
                                <input type="hidden" name="id_persona" value="<?php echo $consulta['id_persona']; ?>">
                                
                            </div> 
                            
                            <?php }

                              $sqlsupletorio=$conexion->query("SELECT `tb_asignatura_docente`.`id_asignatura_docente`, `tb_asignaturas`.`id_asignatura`, `tb_notas`.`id_notas`, `tb_asignaturas`.`asignatura`,tb_asignatura_docente.id_docente FROM `tb_asignaturas` inner JOIN `tb_asignatura_docente` ON `tb_asignatura_docente`.`id_asignatura` = `tb_asignaturas`.`id_asignatura` inner JOIN `tb_notas` ON `tb_notas`.`id_asignatura_docente` = `tb_asignatura_docente`.`id_asignatura_docente` where tb_notas.id_estudiante=".$Id_est." and tb_notas.estado='REPROBADO' and tb_notas.verifica_pago=0");
                              $resp=mysqli_num_rows($sqlsupletorio);
                              if($resp>0){


                              ?>

                              <div class="group-material">
                               <h2> Supletorios</h2>
                               <?php $consulmarca=$conexion->query("select cantidad from tb_agregar_saldo_estudiante where id_agregar_saldo_estudiante=1"); 
                            $respu=mysqli_fetch_array($consulmarca);?>
                                    <?php 

                                    while($rows=mysqli_fetch_array($sqlsupletorio)){ ?> 
                                      <input type="checkbox" name="supletorio[<?php echo $rows['id_notas'] ?>]" value="<?php echo $rows['id_notas'] ?>"> <?php echo $rows['asignatura'].' $'.$respu[0]; ?><br>
                                      <?php } ?>
                            
                               

                            </div> 
                            <?php 
                            }?>

                            <div class="group-material">
                                <?php if($_GET['tipo_ingreso']=='PSICONSENSOMETRICO'){echo 'selected';} ?>
                               <h4> Tipo de Ingreso</h4>
                                <select name="tipo_ingreso" id="tipo_ingreso" onchange="carga_bienes(this.value);" class="tooltips-general material-control">
                                <option value="0" >Seleccione</option>
                                    <?php if($psi!=1){  ?>
                                    <option value="PSICONSENSOMETRICO" <?php if($_GET['tipo_ingre']=='PSICONSENSOMETRICO'){echo 'selected';} ?> >PSICOSENSOMETRICO</option>
                                    <?php } 
                                        if($mat!=1){
                                    ?>
                                    <option value="MATRICULA" <?php if($_GET['tipo_ingre']=='MATRICULA'){echo 'selected';} ?> >MATRICULA</option>
                                    <?php } ?>
                                    <option value="ABONOS" <?php if($_GET['tipo_ingre']=='ABONOS'){echo 'selected';} ?> >ABONOS</option>
                                    <option value="SUPLETORIO" <?php if($_GET['tipo_ingre']=='SUPLETORIO'){echo 'selected';} ?> >SUPLETORIO</option>
 

                                </select>
                               

                            </div> 

                            <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Valor Abonar" name="abono" required value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Abonar</label>

                            </div> 

                             <div class="group-material">
                               <h4> Fecha Registro</h4>
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_ingreso" required value="<?php echo date('Y-m-d'); ?>" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                            <div class="group-material">
                                
                                <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" required value="<?php if($_GET['tipo_ingre']=='PSICONSENSOMETRICO'){echo 'PAGO DE EXAMEN PSICONSEMETRICO, MEDICOS Y PSICOLOGICOS DEL CURSO DE CAPACITACION PARA CONDUCTOR PROFESIONAL '.$resdesc[0];} if($_GET['tipo_ingre']=='MATRICULA'){echo 'MATRICULA DEL CURSO DE CAPACITACION PARA CONDUCTOR PROFESIONAL '.$resdesc[0];} if($_GET['tipo_ingre']=='ABONOS'){echo 'ABONO CURSO DE CAPACITACION PARA CONDUCTOR PROFESIONAL '.$resdesc[0];} if($_GET['tipo_ingre']=='SUPLETORIO'){echo 'PAGO DE SUPLETORIO CURSO DE CAPACITACION PARA CONDUCTOR PROFESIONAL '.$resdesc[0].' EN LA MATERIA DE';} ?>" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div> 

                            <div class="group-material">
                                 <?php 
                            $conuslt=$conexion->query("select max(comprabante_n)as comp from tb_ingreso_escuela"); 
                            $res=mysqli_fetch_array($conuslt);?>
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Ingreso N.-" maxlength="10" name="ingreso_n" required placeholder="<?php echo($res[0]); ?>" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Ingreso N.-</label>

                            </div> 

                             <div class="group-material">
                                
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Comprobante de Banco N.-" maxlength="30" name="comproante_bco" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Deposito de Banco N.-</label>

                            </div> 

                              <?php 

                            $sql5=mysqli_query($conexion,"SELECT * FROM `tb_plan_subcuentas`");
                        
                            ?>

                           <div class="group-material">
                                <span>Seleccione cuenta contable </span> 
                               
                          <select class="selectpicker" name="c_contable" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php  

                             while($row=$sql5->fetch_array()){ ?>

                              <option value="<?php echo $row['id_plan_subcuentas']; ?>"><?php echo ($row['descripcion']); ?></option>
                               <?php  
                            }
                            ?>
                          </select>

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
                            <?php } 
                                              ?>
                 
                    <p class="text-center">
                        <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
                        <button name="facturar" type="submit" class="btn btn-primary" style="margin-right: 20px;"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR Y FACTURAR</button>

                    </p>
                    </form>
                       </div>
                         
<?php 
if(isset($_POST['registra'])){
    $id_persona=$_POST['id_persona'];
    $id_est=$_POST['idestudiante'];
    $promo=$_POST['promo'];
    $abono=$_POST['abono'];
    $tipo_ingreso=$_POST['tipo_ingreso'];
    $fecha_ingreso=$_POST['fecha_ingreso'];
    $descripcion=$_POST['descripcion'];
    $ingreso_n=$_POST['ingreso_n'];
    $deposito=$_POST['comproante_bco'];
    $id_banco=$_POST['id_banco'];
    $id_plan_c=$_POST['c_contable'];
    $fecha=date('Y-m-d H:i:s');
    $observaciontotal='('.$fecha.' usuario: '.$_SESSION['nombres'].'.- Ingreso)';
    $sqlcompro=$conexion->query("select 1 from tb_ingreso_escuela where comprabante_n=".$ingreso_n);
                $respcom=mysqli_fetch_array($sqlcompro);
                if($respcom[0]!=1){

  // $squery=$conexion->query("select descripcion from tb_promocion where id_promocion=".$promo);
  //   $resul=mysqli_fetch_array($squery);


  //   if(stristr($resul[0],'TIPO C')!=FALSE){
  //      $id_plan_c=141;
  //   }

  //   if(stristr($resul[0],'TIPO D')!=FALSE){
  //     $id_plan_c=142;
  //   }

  //   if(stristr($resul[0],'TIPO E')!=FALSE){
  //     $id_plan_c=143;
  //   }
     if (is_array($_POST['supletorio'])){ 
          while (list($key,$valor) = each($_POST['supletorio'])) {      
                                                                                                   
              $consultanot = "update tb_notas set verifica_pago=1 where id_notas = ".$valor;    
              $rescon = mysqli_query($conexion,$consultanot);
              
          }
    
      }     

     $query="call insertar_pagos_estu('$id_persona','$id_est','$promo','$abono','$tipo_ingreso','$fecha_ingreso','$descripcion','$ingreso_n','$deposito','$id_banco','$id_plan_c','$observaciontotal')";
        $a=$conexion->query($query);     
        if($a){
        echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="addpagosestudiantes.php?ingreso='.$ingreso_n.'";});</script>';    
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar!", "error")</script>';    
    }
    }  else{
                echo '<script type="text/javascript">swal("Error!", "Ya se encuentra registrado ese comprobante!", "error")</script>'; 
            }
}

if(isset($_POST['facturar'])){
    $id_persona=$_POST['id_persona'];
    $id_est=$_POST['idestudiante'];
    $promo=$_POST['promo'];
    $abono=$_POST['abono'];
    $tipo_ingreso=$_POST['tipo_ingreso'];
    $fecha_ingreso=$_POST['fecha_ingreso'];
    $descripcion=$_POST['descripcion'];
    $ingreso_n=$_POST['ingreso_n'];
    $deposito=$_POST['comproante_bco'];
    $id_banco=$_POST['id_banco'];
    $id_plan_c=$_POST['c_contable'];
    $fecha=date('Y-m-d H:i:s');
    $observaciontotal='('.$fecha.' usuario: '.$_SESSION['nombres'].'.- Ingreso)';
    $sqlcompro=$conexion->query("select 1 from tb_ingreso_escuela where comprabante_n=".$ingreso_n);
                $respcom=mysqli_fetch_array($sqlcompro);
                if($respcom[0]!=1){
    // $squery=$conexion->query("select descripcion from tb_promocion where id_promocion=".$promo);
    // $resul=mysqli_fetch_array($squery);


    // if(stristr($resul[0],'TIPO C')!=FALSE){
    //    $id_plan_c=141;
    // }

    // if(stristr($resul[0],'TIPO D')!=FALSE){
    //   $id_plan_c=142;
    // }

    // if(stristr($resul[0],'TIPO E')!=FALSE){
    //   $id_plan_c=143;
    // }
     if (is_array($_POST['supletorio'])){ 
          while (list($key,$valor) = each($_POST['supletorio'])) {      
                                                                                                   
              $consultanot = "update tb_notas set verifica_pago=1 where id_notas = ".$valor;    
              $rescon = mysqli_query($conexion,$consultanot);
              
          }
    
      }  

     $query="call insertar_pagos_estu('$id_persona','$id_est','$promo','$abono','$tipo_ingreso','$fecha_ingreso','$descripcion','$ingreso_n','$deposito','$id_banco','$id_plan_c','$observaciontotal')";
        $a=$conexion->query($query);     
        if($a){
        echo '<script type="text/javascript">swal({title: "ok", text: "Registrado con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="facturas.php?ingreso='.$ingreso_n.'&descripcion='.$descripcion.'&persona='.$id_persona.'&subtcero='.$abono.'";});</script>';    
    }else{
        echo '<script type="text/javascript">swal("Error!", "No se pudo guardar!", "error")</script>';    
    }
    }  else{
                echo '<script type="text/javascript">swal("Error!", "Ya se encuentra registrado ese comprobante!", "error")</script>'; 
            }
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
                                    var c = document.getElementById("tipo_ingreso").value;
                                    location.href="addpagosestudiantes.php?promo="+x+"&ides="+a+"&tipo_ingre="+c;
                                    //location.href="updatestudiante.php?est="+a;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script> 
 </html>