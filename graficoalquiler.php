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
              <h1 class="all-tittles">SINDICATO DE CHOFERES  DE NARANJAL<small> - GRAFICO</small></h1>
            </div>
            <section class="full-reset text-center" style="padding: 40px 0;">

             <div class="container-fluid">   
                
            
                    <form action="" method="get" role="form">
                                
                         
                        <div class="container-flat-form">
                            <div class="title-flat-form title-flat-blue">Grafico de Alquileres</div>
                            <div class="row">
                               <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                                     
        
                                  <div class="form-group">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">                                        
                                          <select id="anio" name="anio" tabindex="" onchange='submit();' class="form-control">
                                            <option value="">Seleccione Año</option>                                            
                                            <?php 
                                            
                                            $consulta = ("SELECT max(YEAR(fecha_desde)) as year FROM `tb_alquiler`");
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
<?php 
if(isset($_GET['anio'])){
    $anio=$_GET['anio'];
}    else{
     $anio=date('Y');
   } 
 ?> 


<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

          <script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ingresos mensuales de los diferentes tipos de alquileres'
    },
    subtitle: {
        text: 'Alquileres año <?php echo $anio; ?>'
    },
    xAxis: {
        categories: [
            'enero',
            'febrero',
            'marzo',
            'abril',
            'mayo',
            'junio',
            'julio',
            'agosto',
            'septiembre',
            'octubre',
            'noviembre',
            'diciembre'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Dolares ($)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} $</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        <?php $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='1'");
            $saene=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='2'");
            $safe=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='3'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='4'");
            $sabr=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='5'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='6'");
            $sajun=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='7'");
            $sajul=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='8'");
            $saago=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='9'");
            $sasep=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='10'");
            $saoct=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='11'");
            $sanov=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=1 and month(fecha_desde)='12'");
            $sadic=mysqli_fetch_array($sal);

         ?>

        name: 'Salon de Evento',
        data: [<?php echo $saene[0]; ?>, <?php echo $safe[0]; ?>,<?php echo $sama[0]; ?>, <?php echo $sabr[0]; ?>, <?php echo $sama[0]; ?>, <?php echo $sajun[0]; ?>, <?php echo $sajul[0]; ?>, <?php echo $saago[0]; ?>, <?php echo $sasep[0]; ?>, <?php echo $saoct[0]; ?>, <?php echo $sanov[0]; ?>, <?php echo $sadic[0]; ?>]

    }, {
        <?php $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='1'");
            $saene=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='2'");
            $safe=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='3'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='4'");
            $sabr=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='5'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='6'");
            $sajun=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='7'");
            $sajul=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='8'");
            $saago=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='9'");
            $sasep=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='10'");
            $saoct=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='11'");
            $sanov=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=2 and month(fecha_desde)='12'");
            $sadic=mysqli_fetch_array($sal);

         ?>
        name: 'Bus',
          data: [<?php echo $saene[0]; ?>, <?php echo $safe[0]; ?>,<?php echo $sama[0]; ?>, <?php echo $sabr[0]; ?>, <?php echo $sama[0]; ?>, <?php echo $sajun[0]; ?>, <?php echo $sajul[0]; ?>, <?php echo $saago[0]; ?>, <?php echo $sasep[0]; ?>, <?php echo $saoct[0]; ?>, <?php echo $sanov[0]; ?>, <?php echo $sadic[0]; ?>]

    }, {
         <?php $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='1'");
            $saene=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='2'");
            $safe=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='3'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='4'");
            $sabr=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='5'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='6'");
            $sajun=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='7'");
            $sajul=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='8'");
            $saago=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='9'");
            $sasep=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='10'");
            $saoct=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='11'");
            $sanov=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=3 and month(fecha_desde)='12'");
            $sadic=mysqli_fetch_array($sal);

         ?>
        name: 'Mesa billar',
       data: [<?php echo $saene[0]; ?>, <?php echo $safe[0]; ?>,<?php echo $sama[0]; ?>, <?php echo $sabr[0]; ?>, <?php echo $sama[0]; ?>, <?php echo $sajun[0]; ?>, <?php echo $sajul[0]; ?>, <?php echo $saago[0]; ?>, <?php echo $sasep[0]; ?>, <?php echo $saoct[0]; ?>, <?php echo $sanov[0]; ?>, <?php echo $sadic[0]; ?>]

    }, {
        <?php $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='1'");
            $saene=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='2'");
            $safe=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='3'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='4'");
            $sabr=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='5'");
            $sama=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='6'");
            $sajun=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='7'");
            $sajul=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='8'");
            $saago=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='9'");
            $sasep=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='10'");
            $saoct=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='11'");
            $sanov=mysqli_fetch_array($sal);
            $sal=$conexion->query("SELECT ifnull(sum(abonos),0)as valors FROM `tb_alquiler` where id_beneficio=4 and month(fecha_desde)='12'");
            $sadic=mysqli_fetch_array($sal);

         ?>
        name: 'Cancha Sintetica',
        data: [<?php echo $saene[0]; ?>, <?php echo $safe[0]; ?>,<?php echo $sama[0]; ?>, <?php echo $sabr[0]; ?>, <?php echo $sama[0]; ?>, <?php echo $sajun[0]; ?>, <?php echo $sajul[0]; ?>, <?php echo $saago[0]; ?>, <?php echo $sasep[0]; ?>, <?php echo $saoct[0]; ?>, <?php echo $sanov[0]; ?>, <?php echo $sadic[0]; ?>]

    }]
});
        </script>
    </body>
</html>

                
                                                                           
                                    
                                   
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