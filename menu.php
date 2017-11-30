    <div class="full-reset nav-lateral-list-menu">
        <ul class="list-unstyled">
        <?php if($_SESSION['acceso']=='ADMINISTRADOR'){  ?>
          <li><a href="sindnaranjal.php" id="inicio"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
          <?php } ?>
           <?php if($_SESSION['acceso']=='ADMINISTRADOR' or $_SESSION['acceso']=='ADMINISTRATIVO'){  ?>
             <li>
                <div class="dropdown-menu-button" id="contadministrativo"><i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp; ADMINISTRATIVO <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                 <ul class="list-unstyled selectable" id="contsocio">
                <li><a href="socios.php" id="socio"><i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp; Socios</a></li>
                <li><a href="vehiculos.php" id="vehiculo"><i class="zmdi zmdi-truck zmdi-hc-fw"></i>&nbsp;&nbsp; Vehículos</a></li> 
                <!-- <li><a href="beneficio.php" id="alquiler"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>&nbsp;&nbsp;  Beneficios</a></li> -->
               
         <li><a href="recursoshumanos.php" id="rh"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>&nbsp;&nbsp; Recursos humanos</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($_SESSION['acceso']=='ADMINISTRADOR' or $_SESSION['acceso']=='EDUCATIVO'){  ?>
        
            <li>
                <div class="dropdown-menu-button"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; EDUCATIVO <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                <ul class="list-unstyled" id="conteducativo">
               <?php
                // if($_SESSION['tipo_usuario']=='SECRETARIO_GENERAL' or $_SESSION['tipo_usuario']=='SECRETARIO_FINANCIERO' or $_SESSION['tipo_usuario']=='INSPECTOR' or $_SESSION['tipo_usuario']=='PEDAGOGO'){  
                ?>
                    <li><a href="docentes.php" id="docentes"><i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Docentes</a></li>
                    <li><a href="estudiantes.php" id="estudiantes"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Estudiantes</a></li>
                    <li><a href="asignaturas.php" id="asignaturas"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp; Asignaturas</a></li>
                    <li><a href="calificaciones.php" id="calificaciones"><i class="zmdi zmdi-book"></i>&nbsp;&nbsp; Calificaciones</a></li> 
                   <?php 
               // } 
               ?>
                   <?php if($_SESSION['tipo_usuario']=='DOCENTE'){  ?>
                    <li><a href="asistencia.php" id="asistencia_estudiantes"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Asistencia</a></li>
                    <li><a href="calificaciones_docentes.php" id="calificaciones_docentes"><i class="zmdi zmdi-book"></i>&nbsp;&nbsp; Calificaciones</a></li>
                    <?php } ?>

                </ul>
            </li>
            <?php } ?>
            <?php if($_SESSION['acceso']=='ADMINISTRADOR' or $_SESSION['acceso']=='ADMINISTRATIVO'){  ?>
            <li>
                <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; CONTABLE <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
                <ul class="list-unstyled" id="contcontable">
                    <li><a href="inventario.php" id="inventario"><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp; Inventario</a></li>
                    <li><a href="ingresos.php" id="ingresos"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Ingresos</a></li>
                    <li><a href="egreso.php" id="egreso"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Egresos</a></li>
                    <li><a href="graficos.php" id="graficos"><i class="zmdi zmdi-chart zmdi-hc-fw"></i>&nbsp;&nbsp; Graficos</a></li>
                    <li><a href="comprobantes.php" id="comprobantes"><i class="zmdi zmdi-trending-up"></i>&nbsp;&nbsp; Contable</a></li>
                </ul>
            </li>
             <?php } ?>

             <?php if($_SESSION['acceso']=='ADMINISTRADOR' or $_SESSION['acceso']=='ADMINISTRATIVO' or $_SESSION['acceso']=='EDUCATIVO'){  ?>
        <li>
          <div class="dropdown-menu-button"><i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; REPORTES <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
            <ul class="list-unstyled" id="contreporte">
             <?php if($_SESSION['acceso']=='ADMINISTRADOR' or $_SESSION['acceso']=='ADMINISTRATIVO'){  ?>
                <li><a href="reporteinventario.php" id="reporteinventario"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Inventario</a></li>
                <?php } ?>
                <?php if($_SESSION['acceso']=='ADMINISTRADOR' or $_SESSION['acceso']=='ADMINISTRATIVO' or $_SESSION['acceso']=='EDUCATIVO'){  ?>
                <li> <a href="reportedocente.php" id="reportedocente"><i class="zmdi zmdi-time-restore zmdi-hc-fw"></i>&nbsp;&nbsp; Docentes </a> </li>

                <li> <a href="reportealumnos.php" id="reportealumnos"><i class="zmdi zmdi-time-restore zmdi-hc-fw"></i>&nbsp;&nbsp; Alumnos </a> </li>
                <li>  <a href="reportenotas.php" id="reportenotas"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Notas </a> </li> 
                <?php } ?>
                <!-- <li><a href="reportecertificado.php" id="reportecertificado"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Certificados </a></li> -->
                <?php if($_SESSION['acceso']=='ADMINISTRADOR' or $_SESSION['acceso']=='ADMINISTRATIVO'){  ?>
                <li><a href="reportecontable.php" id="reportecontable"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Contable </a></li>
                <?php } ?>
                
            </ul>
        </li>
        <?php } ?>
        <?php if($_SESSION['acceso']=='ADMINISTRADOR'){  ?>
        <li>
        <div class="dropdown-menu-button"  ><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Configuracion <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i></div>
        <ul class="list-unstyled" id="contconfig">
             <li><a href="usuario.php" id="usuarios"><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Usuarios</a></li>
                <li><a href="confsocio.php" id="confsocio"><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Socio</a></li>
                <li>  <a href="confcuotassocio.php" id="confcuotassocio"><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Socio Cuotas </a> </li> 
                <li> <a href="confcontable.php" id="confcontable"><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Contable </a> </li>
                 <li> <a href="confbancos.php" id="confbancos"><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Bancos </a> </li>
                <li> <a href="confpromo.php" id="confpromo"><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Promocion </a> </li>           
                <li> <a href="confvehiculo.php" id="confvehiculo"><i class="zmdi zmdi-wrench"></i>&nbsp;&nbsp; Varios </a> </li>
                
            </ul>
        </li>
        <?php } ?>
                   
            </ul>
        </div>

        <!-- <script type="text/javascript">
            $(document).ready(function(){
                $('#contconfig').click(function(){
                    $('#config').slideToggle(400);
                    
                });
            });
        </script> -->