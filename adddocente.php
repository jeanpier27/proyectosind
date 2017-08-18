<?php 
date_default_timezone_set('America/Bogota'); 
ob_start();
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>DOCENTES</title>
   <?php 
        require_once('meta.php');
        require_once('login/conexion.php');
     ?>    
</head>
    
<body>
    <script type="text/javascript">
    $(document).ready(function(){
            $('#conteducativo').attr("style","display:block;");
            $('#docentes').attr("style","background-color:#E75A5A;");
              
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




            
        
          <div  class="content-page-container full-reset custom-scroll-containers">  
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



         <section class="full-reset text-center" style="padding: 40px 0;">
               <div class="container-fluid">
                      
            
            <form autocomplete="" action="" method="post" id="formreg" name="formreg">
                            <?php //////////CONSULTA A LA BASE DE DATOS//////// 
                                $sql=$conexion->query("SELECT * FROM tb_tipo_usuario WHERE tipo_usuario = 'DOCENTE' order by id_tipo_usuario ");
                                $sqlsocio2=$conexion->query("SELECT `tb_personas`.`id_persona`, `tb_personas`.`nombre`, `tb_personas`.`apellido`, `tb_usuarios`.`id_persona` as cod FROM `tb_personas` LEFT JOIN `tb_usuarios` ON `tb_usuarios`.`id_persona` = `tb_personas`.`id_persona` where `tb_usuarios`.`id_persona` is null order by `tb_personas`.`apellido`"); 
                             ?>
                
                
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Nuevo Docente</div>
                    <div class="row">  
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            
                           	                            
                            <div class="group-material">
                                <span>Seleccione al nuevo Docente </span> 
                               
                          <select class="selectpicker" name="nombres" data-live-search="true" required="">
                          <option selected="" disabled="">Seleccione </option>
                           <?php
                              while($row=$sqlsocio2->fetch_array()){ ?>
                              <option value="<?php echo $row['id_persona']; ?>"><?php echo ($row['apellido'].' '.$row['nombre']); ?></option>
                               <?php  }  ?>
                          </select>
                            </div>

                            <!-- <div class="group-material" > -->
                                <!-- <span>Tipo de Usuario</span> --> 
                              <!--   <select class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Elige el tipo del usuario correspondiente" name="id_tipo_usuario" required>
                                    <option value="" disabled="">Selecciona el Tipo de Usuario</option> -->
                                                <?php
			                                      while($f = $sql->fetch_array()){ 
			                                        // echo '<option selected="" value="'.$f['id_tipo_usuario'].'">'.$f['tipo_usuario'].'</option>';

			                                       
			                                    ?> 
                                            <input type="hidden" name="id_tipo_usuario" value="<?php echo ($f['id_tipo_usuario']); ?>">
                                          <?php 
                                            }

                                           ?>
                                <!-- </select> -->
                            <!-- </div>                      -->
                      
                          								

                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control numero" placeholder="Escribe aquí el sueldo a recibir del docente"  required="" pattern="[0-9.]{1,20}"  maxlength="8" data-toggle="tooltip" data-placement="top" title="Escriba el sueldo del docente" name="sueldo">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Salario</label>
                            </div>


                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe la contraseña del nuevo docente" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Contraseña" name="password">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contrase&ntilde;a</label>
                            </div> 

                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="fecha_ingreso" name="fecha_ingreso">
                                <span class="highlight"></span>
                                <span class="bar"></span><label>Fecha de Ingreso</label>
                            </div> 
           <?php  
                // $fecha = date('Y-m-d');
                // $nuevafecha = strtotime ( '+4 year' , strtotime ( $fecha ));
                // $nuevafecha1 = date ( 'Y-m' , $nuevafecha); 
                // echo $nuevafecha1; 
              ?>                             
                              
                           <!--      <div class="group-material">
                                        <input type="date" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="fecha_salida" name="fecha_salida">
                                        <span class="highlight"></span>
                                        <span class="bar"></span><label>Fecha de Salida</label>
                            </div> 
                            -->
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;  
                            </p>
                       </div>
                   </div>
                </div>


                <?php 
                    if (isset($_POST['registra'])){
                                           
                   $Id_per = $_POST['nombres'];                   
                   $id_tipo_usuario = $_POST['id_tipo_usuario'];
                   $sueldo = $_POST['sueldo'];  
                   $password = $_POST['password'];
                   $fecha=$_POST['fecha_ingreso'];
                   $fecha_ingreso=substr($fecha, 0, -13);
                   $fecha_salida=substr($fecha, 13);
                   $Estado = 'ACTIVO';

                   $add_table_usu = "insert into tb_usuarios (id_persona, contraseña, id_tipo_usuario, estado) values (".$Id_per.", '".$password."', ".$id_tipo_usuario.", '".$Estado."')";    
                   $ingreso_table_usu = mysqli_query($conexion,$add_table_usu);


                   if (!$ingreso_table_usu) {                     
                     header('location: docentes.php?msg=tuerror'); 
                   } else {
                     // *************************************
                    $busca_id_usuarios =mysqli_query($conexion,"select * FROM tb_usuarios where id_persona =".$Id_per);
                    $despejar_id_usuarios=mysqli_fetch_array($busca_id_usuarios);
                    $Id_usuario = $despejar_id_usuarios['id_usuarios'];

                    $add_table_docente = "insert into tb_docente (id_usuarios, sueldo, fecha_ingreso, fecha_salida, estado) values (".$Id_usuario.",'".$sueldo."','".$fecha_ingreso."','".$fecha_salida."','".$Estado."')";    
                    $ingreso_table_docente = mysqli_query($conexion,$add_table_docente);

                    if ($ingreso_table_docente) {
                      header('location: docentes.php?msg=ss');
                    } else {
                      header('location: docentes.php?msg=tderror');
                    }

                     // *************************************
                   }


                 }  
                   
                  ?>




            </form> 
        </div>   
</section>
          </div>  



<script>
   $('input[name=fecha_ingreso]').daterangepicker({
                        drops:"up",
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

	function solonumero(e)
	{
		var numero=window.event ? window.event.keycode : e.which;
		if((numero==8)|| (numero==46))
			return true;
			return /\d/.test(String.fromCharCode(numero));
	}
	 
	 
	function validacion()
	{
		var digito3;
		var i;
		var ruc;
		var cadenar;
		var digito;
		var suma=0;
		var d;
		var c;
		var ver;
		
		ruc=document.getElementById("ced").value;
			digito3=ruc.substring(2,3);
			if(digito3<6){
				for (i=1;i<10;i++){
					if(i%2==0){
						cadenar=ruc.substring(i-1,i);
						suma+=parseInt(cadenar);
					}else{
						cadenar=ruc.substring(i-1,i);
						cadenar=parseInt(cadenar)*2;
						if(cadenar>9){
							cadenar-=9;
							suma+=parseInt(cadenar);
						}else{
							suma+=parseInt(cadenar);
						}
					}
				}
				c=suma.toString();
				d=c.substring(0,1);
				d=d+0;
				c=parseInt(d);
				d=c+10;
				digito=d-parseInt(suma);
				ver=ruc.substring(9,10);
					if(digito!=ver){
						function mostrar() {
                                        div = document.getElementById('flotante');
                                        div.style.display = '';
                                    }
                        mostrar();
                        setTimeout("location.reload()", 1000);
						
					}else{
						function mostrar2() {
                                        div = document.getElementById('flotante2');
                                        div.style.display = '';
                                    }
                        mostrar2();
                        document.getElementById('ced').readOnly = true;
                        
					}
			}else{
				if(digito3==6){
					var psuma=0;
					var pcadena=0;
					var p;
					var presiduo;
					var pveri;
					for (p=1;p<9;p++){
						if(p==1){
							pcadena=ruc.substring(p-1,p);
							pcadena=parseInt(pcadena)*3;
							psuma+=parseInt(pcadena);
						}else{
							if(p==2){
								pcadena=ruc.substring(p-1,p);
								pcadena=parseInt(pcadena)*2;
								psuma+=parseInt(pcadena);
							}else{
								if(p==3){
									pcadena=ruc.substring(p-1,p);
									pcadena=parseInt(pcadena)*7;
									psuma+=parseInt(pcadena);
								}else{
									if(p==4){
										pcadena=ruc.substring(p-1,p);
										pcadena=parseInt(pcadena)*6;
										psuma+=parseInt(pcadena);
									}else{
										if(p==5){
											pcadena=ruc.substring(p-1,p);
											pcadena=parseInt(pcadena)*5;
											psuma+=parseInt(pcadena);
										}else{
											if(p==6){
												pcadena=ruc.substring(p-1,p);
												pcadena=parseInt(pcadena)*4;
												psuma+=parseInt(pcadena);
											}else{
												if(p==7){
													pcadena=ruc.substring(p-1,p);
													pcadena=parseInt(pcadena)*3;
													psuma+=parseInt(pcadena);
												}else{
													if(p==8){
														pcadena=ruc.substring(p-1,p);
														pcadena=parseInt(pcadena)*2;
														psuma+=parseInt(pcadena);
													}
												}
											}
										}
									}
								}
							}
						}
					}
					presiduo=(psuma%11);
					presiduo=11-presiduo;
					pveri=ruc.substring(8,9);
					if(presiduo!=pveri){
						function mostrar() {
                                        div = document.getElementById('flotante');
                                        div.style.display = '';
                                    }
                        mostrar();
                        setTimeout("location.reload()", 1000); 
						
					}else{
                        function mostrar3() {
                                        div = document.getElementById('flotante3');
                                        div.style.display = '';
                                    }
                        mostrar3();
                        setTimeout("location.reload()", 1000);
					}
				}else{
					if(digito3==9){
						var jsuma=0;
						var jcadena=0;
						var j;
						var jresiduo;
						var jveri;
						for (j=1;j<10;j++){
							if(p==1){
								jcadena=ruc.substring(j-1,j);
								jcadena=parseInt(jcadena)*4;
								jsuma+=parseInt(jcadena);
							}else{
								if(j==2){
									jcadena=ruc.substring(j-1,j);
									jcadena=parseInt(jcadena)*3;
									jsuma+=parseInt(jcadena);
								}else{
									if(j==3){
										jcadena=ruc.substring(j-1,j);
										jcadena=parseInt(jcadena)*2;
										jsuma+=parseInt(jcadena);
									}else{
										if(j==4){
											jcadena=ruc.substring(j-1,j);
											jcadena=parseInt(jcadena)*7;
											jsuma+=parseInt(jcadena);
										}else{
											if(j==5){
												jcadena=ruc.substring(j-1,j);
												jcadena=parseInt(jcadena)*6;
												jsuma+=parseInt(jcadena);
											}else{
												if(j==6){
													jcadena=ruc.substring(j-1,j);
													jcadena=parseInt(jcadena)*5;
													jsuma+=parseInt(jcadena);
												}else{
													if(j==7){
														jcadena=ruc.substring(j-1,j);
														jcadena=parseInt(jcadena)*4;
														jsuma+=parseInt(jcadena);
													}else{
														if(j==8){
															jcadena=ruc.substring(j-1,j);
															jcadena=parseInt(jcadena)*3;
															jsuma+=parseInt(jcadena);
														}else{
															if(j==9){
																jcadena=ruc.substring(j-1,j);
																jcadena=parseInt(jcadena)*2;
																jsuma+=parseInt(jcadena);
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
						jresiduo=(jsuma%11);
						jresiduo=11-jresiduo;
						jveri=ruc.substring(9,10);
						if(jresiduo!=jveri){
							 function mostrar() {
                                        div = document.getElementById('flotante');
                                        div.style.display = '';
                                    }
                        mostrar();
                        setTimeout("location.reload()", 1000); 
							
						}else{
                            function mostrar3() {
                                        div = document.getElementById('flotante3');
                                        div.style.display = '';
                                    }
                        mostrar3();
                        setTimeout("location.reload()", 1000);
						}
					}
				}
			}
	}

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

	
</script>



            
</body>
</html>
<?php
ob_end_flush();
?>
