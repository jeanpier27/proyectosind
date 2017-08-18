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
     ?>
</head>
<body>
 <script type="text/javascript">
    $(document).ready(function(){
            $('#contcontable').attr("style","display:block;");
            $('#graficos').attr("style","background-color:#E75A5A;");
              
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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - Graficos</small></h1>
            </div>
            <section class="full-reset text-center" style="padding: 40px 0;">

             <div class="container-fluid">   
                
            
                    <form action="" method="get" role="form">
                                
                         
                        <div class="container-flat-form">
                            <div class="title-flat-form title-flat-blue">GRAFICO DE INGRESOS E EGRESOS</div>
                            <div class="row">
                               <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                     
        
                                  <div class="form-group">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">                                        
                                          <select id="anio" name="anio" tabindex="" onchange='submit();' class="form-control">
                                            <option value="">Seleccione Año</option>                                            
                                            <?php 
                                            
                                            $consulta = ("SELECT max(YEAR(fecha)) as year FROM `tb_ingreso_sindicato`");
                                            $res = mysqli_query($conexion, $consulta);
                                            while($anio = mysqli_fetch_array($res)){
                                              $ani=$anio['year'];
                                              $Anio2 = $_REQUEST["anio"];              
                                              ?> 
                                              <option value="<?php echo $ani; ?>" <?php if ($ani==$Anio2) {echo "selected";} ?>><?php echo $ani;?></option>            
                                              <?php } ?>
                                            </select>
                                            </div>
                                            <div class="col-md-4"></div>                                                                                  
                                          </div>  


<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

            <script type="text/javascript">

// Create the chart
<?php 
if(isset($_GET['anio'])){
    $anio=$_GET['anio'];
}    else{
     $anio=date('Y');
   } 
 ?>


Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ingresos y Egresos Sindicato año <?php echo $anio; ?>'
    },
    subtitle: {
        text: 'Click en la columna para ver detalle'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Dolares'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}$'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}$</b><br/>'
    },

    series: [{
        name: 'Sindicato',
        colorByPoint: true,
        data: [{
            <?php 
                $sqlingre=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO'");
                $ingre=mysqli_fetch_array($sqlingre);
             ?>
            name: 'Ingresos',
            y: <?php echo $ingre[0]; ?>,
            drilldown: 'Ingresos'
        }, {
            name: 'Egresos',
             <?php 
                $sqlegre=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO'");
                $egre=mysqli_fetch_array($sqlegre);
             ?>
            y: <?php echo $egre[0]; ?>,
            drilldown: 'Egresos'
        }]
    }],
    drilldown: {
        series: [{
            name: 'Ingresos',
            id: 'Ingresos',
            data: [
                [
                <?php 
                     $sqlingren=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='1'");
                $enein=mysqli_fetch_array($sqlingren);
                 ?>
                    'enero',
                    <?php echo $enein[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrfe=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='2'");
                $fein=mysqli_fetch_array($sqlingrfe); 
                 ?>
                    'febrero',
                     <?php echo $fein[0];  ?>
                ],
                [
                <?php 
                     $sqlingrma=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='3'");
                $main=mysqli_fetch_array($sqlingrma);
                 ?>
                    'marzo',
                    <?php  echo $main[0]; ?>
                ],
                [
                <?php 
                     $sqlingrab=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='4'");
                $abin=mysqli_fetch_array($sqlingrab); 
                 ?>
                    'abril',
                    <?php echo $abin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrma=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='5'");
                $main=mysqli_fetch_array($sqlingrma); 
                 ?>
                    'mayo',
                     <?php echo $main[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrju=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='6'");
                $juin=mysqli_fetch_array($sqlingrju); 
                 ?>
                    'junio',
                    <?php echo $juin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='7'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'julio',
                   <?php echo $julin[0]; ?>
                ],
                [
                <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='8'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'agosto',
                     <?php echo $julin[0]; ?>
                ],
                [
                <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='9'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'septiembre',
                    <?php echo $julin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='10'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'octubre',
                   <?php echo $julin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='11'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'noviembre',
                     <?php echo $julin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_ingreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='12'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'diciembre',
                    <?php echo $julin[0]; ?>
                ]

            ]
        }, {
            name: 'Egresos',
            id: 'Egresos',
            data: [
                [
                <?php 
                     $sqlingren=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='1'");
                $enein=mysqli_fetch_array($sqlingren);
                 ?>
                    'enero',
                    <?php echo $enein[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrfe=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='2'");
                $fein=mysqli_fetch_array($sqlingrfe); 
                 ?>
                    'febrero',
                     <?php echo $fein[0];  ?>
                ],
                [
                <?php 
                     $sqlingrma=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='3'");
                $main=mysqli_fetch_array($sqlingrma);
                 ?>
                    'marzo',
                    <?php  echo $main[0]; ?>
                ],
                [
                <?php 
                     $sqlingrab=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='4'");
                $abin=mysqli_fetch_array($sqlingrab); 
                 ?>
                    'abril',
                    <?php echo $abin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrma=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='5'");
                $main=mysqli_fetch_array($sqlingrma); 
                 ?>
                    'mayo',
                     <?php echo $main[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrju=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='6'");
                $juin=mysqli_fetch_array($sqlingrju); 
                 ?>
                    'junio',
                    <?php echo $juin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='7'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'julio',
                   <?php echo $julin[0]; ?>
                ],
                [
                <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='8'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'agosto',
                     <?php echo $julin[0]; ?>
                ],
                [
                <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='9'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'septiembre',
                    <?php echo $julin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='10'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'octubre',
                   <?php echo $julin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='11'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'noviembre',
                     <?php echo $julin[0]; ?>
                ],
                [
                 <?php 
                     $sqlingrjul=$conexion->query("SELECT IFNULL(sum(saldo),0)as cantidad FROM `tb_egreso_sindicato` WHERE Year(fecha)='".$anio."' and estado='ACTIVO' and month(fecha)='12'");
                $julin=mysqli_fetch_array($sqlingrjul); 
                 ?>
                    'diciembre',
                    <?php echo $julin[0]; ?>
                ]
            ]
        }]
    }
});
        </script>
                
                                                                           
                                    
                                   
                               </div>




                           </div>
                        </div>
                    </form>  





        </div>  
    </div> 
           




        </section>
        </div>

</body>
</html>

<script type="text/javascript">
    // $('#addsocio').click(function(){
    //      // alert('hola');
    //      $('#contenedor').load('vistas/addsocio.php');
    //     });
    // $('#addrecaudacion').click(function(){
    //      // alert('hola');
    //      $('#contenedor').load('vistas/recaudaciones.php');
    //     });
</script>