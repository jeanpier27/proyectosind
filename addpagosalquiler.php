<?php 
ob_start();
session_start();
if(!isset($_SESSION['usuario'])){
require_once('login/cerrar_sesion.php'); 
}
 ?>
 
 <!DOCTYPE html>
<html lang="es">
<head>
    <title>Sindicato</title>
    
    <?php 
    require_once('meta.php');
    require_once('login/conexion.php')
     ?>
</head>
     <script type="text/javascript">
    $(document).ready(function(){
            $('#contcontable').attr("style","display:block;");
            $('#ingresos').attr("style","background-color:#E75A5A;");
              
            });
</script>

<script>
    function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = ".0123456789";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>

<script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
</script>
<body>



<script>

    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear(); 
        
        /*  className colors
        
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
        
        */      
        
          
        /* initialize the external events
        -----------------------------------------------------------------*/
    
        $('#external-events div.external-event').each(function() {
        
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
            
        });
    
    
        /* initialize the calendar
        -----------------------------------------------------------------*/
        
        var calendar =  $('#calendar').fullCalendar({
            
            header: {
                left: 'title',
                //center: 'agendaDay,agendaWeek,month',
                // center: 'month',
                right: 'prev,next today'
            },
            
           //  eventRender: function(event, element, view) {
           //      if (event.allDay === 'true') {
           //         event.allDay = true;
           //     } else {
           //         event.allDay = false;
           //     }
           // },

           
            editable: true,      //Deshabilita que se modifique el evento
            firstDay: 1,        //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: false,  //Deshabilita la seleccion en los dias
            // defaultDate: '2014-11-10',
            //defaultView: 'month',
            // defaultView: 'agendaWeek',




            <?php                
                $Id_bien = isset($_REQUEST["bien"]) ? $_REQUEST["bien"]: 0; 
                $consulta_tipo_alquiler = $conexion->query("SELECT estado FROM tb_beneficios where id_beneficio = ".$Id_bien);
                                while ($dato_alquiler=$consulta_tipo_alquiler->fetch_array()){ 
                                  $estado_alquiler=$dato_alquiler['estado'];                               
                                  } 

                                  if ($estado_alquiler=='DIA') { ?>
                                  defaultView: 'month',
                                 <?php } elseif ($estado_alquiler=='HORAS') { ?>
                                    defaultView: 'agendaWeek',
                                 <?php } elseif ($Id_bien==0) {  ?>
                                  defaultView: 'month',
                                 <?php } ?> 







            columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },


            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'  // Tuesday, Sep 8, 2009
            },


            allDaySlot: false,
            selectHelper: true,
            slotEventOverlap: false,



            select: function(start, end, allDay) {
                // var title = prompt('Ingresar Titulo:');
                var title ='';
                if (title) {
                      
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"

                    );
                }

            if (start < date && start.getDate() != date.getDate() ) {
            sweetAlert("Error...", "No se puede seleecionar fechas pasadas", "error");
            $("#iniciando").val("");
            $("#terminando").val("");
            return;
            }          

                calendar.fullCalendar('unselect');
                $("#iniciando").val("" + moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $("#terminando").val("" + moment(end).format('YYYY-MM-DD HH:mm:ss'));                 

            },







            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
            
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
                
            },
            
            events: [
                <?php                
                $Id_bien = isset($_REQUEST["bien"]) ? $_REQUEST["bien"]: 0; 
                $consulta_alquiler = $conexion->query("SELECT `tb_alquiler`.`id_alquiler`,`tb_alquiler`.`id_beneficio`, `tb_personas`.`nombre`,`tb_personas`.`apellido`, `tb_beneficios`.`beneficio`, `tb_alquiler`.`fecha_desde`, `tb_alquiler`.`fecha_hasta`, `tb_alquiler`.`estado`, `tb_beneficios`.`estado` as benefito,`tb_alquiler`.`valor`,`tb_alquiler`.`abonos`,`tb_alquiler`.`estadogarantia` FROM `tb_personas`
                    INNER JOIN `tb_alquiler` ON `tb_alquiler`.`id_persona` = `tb_personas`.`id_persona`
                    INNER JOIN `tb_beneficios` ON `tb_alquiler`.`id_beneficio` = `tb_beneficios`.`id_beneficio` where (`tb_alquiler`.`estado` = 'ACTIVO' or tb_alquiler.estadogarantia='DEVUELTO') AND `tb_alquiler`.`id_beneficio` = ".$Id_bien);
                                while ($alquiler=$consulta_alquiler->fetch_array()){ 
                                  $personita=$alquiler['nombre'].' '.$alquiler['apellido'];;
                                  $benefic=$alquiler['beneficio'];
                                  $inicio=$alquiler['fecha_desde'];
                                  $fincito=$alquiler['fecha_hasta'];
                                  $cod_alqui=$alquiler['id_alquiler'];
                                  $dia_hora=$alquiler['benefito'];
                                  $valor=$alquiler['valor'];
                                  $abono=$alquiler['abonos'];
                                  $id_bene=$alquiler['id_beneficio'];
                                  $estado=$alquiler['estado'];
                                  $estadogarantia=$alquiler['estadogarantia'];

                                  date_default_timezone_set('America/Bogota');
                                  $fecha_nueva_inicio = date("Y-n-d h:i:s A",strtotime($inicio));
                                  $fecha_nueva_fin = date("Y-n-d h:i:s A",strtotime($fincito));                                
                                 ?>

                                  {
                                    title: '<?php echo "Costo: $".$valor." Abonado: $".$abono.' /'.$personita; ?>',
                                    start: new Date("<?php echo $fecha_nueva_inicio; ?>"),
                                    end: new Date("<?php echo $fecha_nueva_fin; ?>"),
                                    <?php if ($dia_hora == 'DIA') {  ?>
                                        allDay: true,
                                    <?php } else { ?>
                                        allDay: false,
                                    <?php } ?>
                                    url: '<?php echo "addpagosalquiler.php?bien=".$id_bene."&idal=".$cod_alqui; ?>',
                                    <?php 
                                     if($Id_bien==1 and $estadogarantia=='DEVUELTO'){?>
                                        color:'#e74c3c',
                                     <?php }else{
                                    if($abono<$valor and $abono>0){  ?>
                                        color:'#f1c40f',
                                        <?php }elseif($estado=='ACTIVO'){  ?>
                                        color:'#2980b9',
                                        <?php }}
                                       ?>

                                },


                               <?php  } ?>             






                // {
                //     title: 'All Day Event',
                //     start: new Date(y, m, 1)
                //  },
                // {
                //     id: 999,
                //     title: 'Repeating Event',
                //     start: new Date(y, m, d-3, 16, 0),
                //     allDay: false,
                //     className: 'info'
                // },
                // {
                //     id: 999,
                //     title: 'Repeating Event',
                //     start: new Date(y, m, d+4, 16, 0),
                //     allDay: false,
                //     className: 'info'
                // },
                // {
                //     title: 'Meeting',
                //     start: new Date(y, m, d, 10, 30),
                //     allDay: false,
                //     className: 'important'
                // },
                // {
                //     title: 'Lunch',
                //     start: new Date(y, m, d, 12, 0),
                //     end: new Date(y, m, d, 14, 0),
                //     allDay: false,
                //     className: 'important'
                // },
                // {
                //     title: 'Birthday Party',
                //     start: new Date(y, m, d+1, 19, 0),
                //     end: new Date(y, m, d+1, 22, 30),
                //     allDay: false,
                // },
                // {
                //     title: 'Click for Google',
                //     start: new Date(y, m, 28),
                //     // end: new Date(y, m, 29),
                //     url: 'http://google.com/',
                //     className: 'success'
                // },
                // {
                //     title: 'luis 1',
                //     start: new Date(y, m, 20),
                //     end: new Date(y, m, 27),
                //     url: 'http://www.facebook.com',
                //     className: 'success'
                //},
                // {
                //     title: 'luis 2',
                //     start: new Date("2017-7-25 12:00:00"),
                //     end: new Date("2017-7-25 18:00:00"),
                //     allDay: false                  
                // }
            ],

    //         eventRender: function (event, element) {
    //     element.attr('href', 'javascript:void(0);');
    //     element.click(function(e) {
    //        var beneficio_tenido = '<?php echo $Id_bien = isset($_REQUEST["bien"]) ? $_REQUEST["bien"]: 0; ?>';
    //        console.log(e);




    //     });
    // }







        });
        
        
    });

</script>
<style>

    /*body {
        margin-bottom: 40px;
        margin-top: 40px;
        text-align: center;
        font-size: 14px;
        font-family: 'Roboto', sans-serif;
        background:url(http://www.digiphotohub.com/wp-content/uploads/2015/09/bigstock-Abstract-Blurred-Background-Of-92820527.jpg);
        }
        
    #wrap {
        width: 1100px;
        margin: 0 auto;
        }
        
    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
        }
        
    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
        }*/
        
    .external-event { /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
        }
        
    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
        }
        
    #external-events p input {
        margin: 0;
        vertical-align: middle;
        }

    #calendar {
/*      float: right; */
        margin: 0 auto;
        width: 900px;
        background-color: #FFFFFF;
          border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
        -webkit-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
-moz-box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
box-shadow: 0px 0px 21px 2px rgba(0,0,0,0.18);
        }

</style>
























    


<?php  ?>

      
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
            <form autocomplete="" action="" method="post">
                        <?php //////////CONSULTA A LA BASE DE DATOS////////    
                            $sql=$conexion->query("SELECT `tb_personas`.*, `tb_socio`.* FROM `tb_personas`
         INNER JOIN `tb_socio` ON `tb_socio`.`id_persona` = `tb_personas`.`id_persona` order by `tb_personas`.`apellido`");  
                            $sqlb=$conexion->query("SELECT * FROM tb_beneficios order by beneficio");  
                         ?> 
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Cobro de Alquileres </div>



                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                       <div >
                       <h1>Información de colores para los bienes alquilados</h1>
                       <div width="50px" height="50px" style="background: #2980b9; width=50px; height=50px"><h1>Alquiler Reservado</h1></div>
                       <div width="50px" height="50px" style="background: #f1c40f;"><h1>Alquiler Abonado</h1></div>
                       <div width="50px" heigth="50px" style="background: #2ecc71;"><h1>Alquiler Pagado</h1></div>
                       <?php if($_REQUEST["bien"]==1){  ?>
                       <div width="50px" heigth="50px" style="background: #e74c3c;"><h1>Devolver Garantía</h1></div>
                         <?php } ?>
                       </div>
                       <div class="group-material">
                                <span>Seleccione el bien</span> 
                                <select class="tooltips-general material-control" data-toggle="tooltip" id="carga_bienes_encontrados" onchange="carga_bienes()" data-placement="top" title="Elige el bien"  required name="id_beneficio">
                                    <option value="" disabled="" selected="">Selecciona</option>
                                        <?php
                                         $Id_bien = $_REQUEST["bien"];
                                          while($f = $sqlb->fetch_array()){ 
                                          ?>  
                                            <!-- echo '<option value="'.$f['id_beneficio'].'">'.$f['beneficio'].' </option>'; -->
                                            <option value="<?php echo $f['id_beneficio'];?>"    <?php if($f['id_beneficio']==$Id_bien){echo "selected='selected'";}?>    >  <?php echo $f['beneficio']; ?></option>
                                          <?php  
                                            } 
                                        ?> 
                                </select>
                            </div> 

                            <script>
                                function carga_bienes() {
                                    var x = document.getElementById("carga_bienes_encontrados").value;
                                    location.href="addpagosalquiler.php?bien="+x;
                                    // document.getElementById("demo").innerHTML = "You selected: " + x;
                                }
                            </script> 

                  </div>
                       </div>




                    <div class="container-fluid">
                        <div class="table-responsive">
                    <!-- <legend><strong>CALENDARIO</strong></legend> --> <br>
                               <div id="wrap">
                                     <div id="calendar" class="fc fc-ltr">
                                     </div><br><br>
                                   <div style="clear:both"></div>
                              </div>   
                        </div>                           
                    </div>







                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong></strong></legend> <br>
                            <?php 
                            if(isset($_GET['idal'])){
                            $id_alq=$_GET['idal'];
                              $sql4=$conexion->query("SELECT tb_alquiler.*,tb_personas.nombre,tb_personas.apellido FROM `tb_alquiler` inner join tb_personas on tb_alquiler.id_persona=tb_personas.id_persona WHERE tb_alquiler.id_alquiler=".$id_alq);  
                             ?>
                            <div class="group-material" >
                                <label>Nombres</label><br>
                                <?php
                                          while($fe = $sql4->fetch_array()){ 
                                          $deuda=$fe['valor']-$fe['abonos']; 
                                          $id_personas=$fe['id_persona'];?>

                                <input type="text" class="tooltips-general material-control" id="nombres" readonly="true" required title="Nombres" name="" value="<?php echo $fe['nombre'].' '.$fe['apellido']; ?>">
                                <input type="hidden" class="tooltips-general material-control" id="id_per" readonly="true" required title="Nombres" name="id_per" value="<?php echo $fe['id_persona']; ?>"> 
                                <input type="hidden" name="id_alqui" value="<?php echo $id_alq; ?>">
                                <input type="hidden" name="bien" value="<?php echo $_GET['bien']; ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span> 
                            <?php } ?>
                                <!-- <input type="time" class="tooltips-general material-control"  required=""  data-toggle="tooltip" data-placement="top" title="Seleccione la fecha que se alquilará" name="hora_desde" >
                                <span class="highlight"></span>
                                <span class="bar"></span> -->
                                <!-- <label>Fecha y Hora que comenzar&aacute; a utilizar</label> -->
                            </div>


                               
                           <div class="group-material">
                                Fecha Registro
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Fecha registro" name="fecha_registro" required value="<?php echo date('Y-m-d'); ?>" readonly>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <?php 
                            $consulestadogarantia=$conexion->query("select estadogarantia from tb_alquiler where id_alquiler=".$id_alq);
                            $respestgaran=mysqli_fetch_array($consulestadogarantia);

                            $sqlvalorgarantia=$conexion->query("select cantidad from tb_cantidad_curso where descripcion='garantia'");
                            $resvalorgara=mysqli_fetch_array($sqlvalorgarantia);


                            $consulgarantia=$conexion->query("select 1 from tb_alquiler where garantia=0 and id_alquiler=".$id_alq);
                            $resgarantia=mysqli_fetch_array($consulgarantia);

                            if($_GET['bien']==1){
                            if($resgarantia[0]==1){   ?> 
                            <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?>>
                                Garantia
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="garantia" readonly="" value="<?php echo($resvalorgara[0]); ?>" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div> 
                            <?php } }?>

                          
                                
                            <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> >
                                
                                <input type="text"  onkeyup="javascript:this.value=this.value.toUpperCase();" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="descripcion" <?php if($respestgaran[0]!='DEVUELTO'){echo('required');} ?>  value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripcion</label>

                            </div> 
                            
                            <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> >
                                Valor de la Deuda
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Descripcion" name="deuda" readonly  required value="<?php echo $deuda; ?>" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 

                            <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> >
                                
                                <input type="number" class="tooltips-general material-control numero " step="0.01" max="<?php echo $deuda; ?>" data-toggle="tooltip" data-placement="top" title="Valor Abonar" id="valor_abonar" name="abono" <?php if($respestgaran[0]!='DEVUELTO'){echo('required');} ?>  value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Abonar</label>

                            </div>
                               <!--  <?php 
                                $sqlsocio=$conexion->query("select * from tb_socio where id_persona=".$id_personas);
                                if($sqlsocio){
                             ?>
                            <div class="group-material">

                                
                              <div class="alert alert-info" role="alert"> Tiene el <strong>50%</strong> de descuento por ser socio</div>

                            </div>
                            <?php } ?> -->
                            <script type="text/javascript">
                                $('input[name=abono]').focusout(function(){
                                    var abonos=$('input[name=abono]').val();
                                    var deuda=$('input[name=deuda]').val();
                                    var maximo=deuda-abonos;
                                    if(maximo==0){
                                        $('input[name=descuento]').val("");
                                        $('input[name=descuento]').attr("readonly",true);
                                        $('input[name=descuento]').attr("placeholder","no tiene descuento");
                                        $('#nodescuento').css("display","block");
                                        $('#sidescuento').css("display","none");
                                    }else{
                                        $('input[name=descuento]').val("");
                                        $('input[name=descuento]').removeAttr("readonly");
                                        $('input[name=descuento]').removeAttr("placeholder");
                                        $('#nodescuento').css("display","none");
                                        $('#sidescuento').css("display","block");
                                    $('input[name=descuento]').attr("max",""+maximo+"");
                                    }
                                    // console.log(maximo);
                                })
                            </script>

                            <?php $consuldescuento=$conexion->query("select 1 from tb_alquiler where descuento=0 and id_alquiler=".$id_alq);
                            $resdescuento=mysqli_fetch_array($consuldescuento);
                            if($resdescuento[0]==1){  ?>

                            <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> >
                                <span id="nodescuento" style="display:none;">Descuento</span>
                                <input type="number" class="tooltips-general material-control numero " step="0.01" max="" data-toggle="tooltip" data-placement="top" title="Descuento" id="descuento" name="descuento" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label id="sidescuento"> Descuento</label>           

                            </div>
                            <?php } ?>

                             <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> >
                                <?php 
                            $conuslt=$conexion->query("select max(comprabante_n)as comp from tb_ingreso_sindicato"); 
                            $res=mysqli_fetch_array($conuslt);?>
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Ingreso N.-" name="ingreso_n" <?php if($respestgaran[0]!='DEVUELTO'){echo('required');} ?>  placeholder="<?php echo($res[0]); ?>" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Comprobante de Ingreso N.-</label>

                            </div> 

                            <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> >
                                
                                <input type="text" class="tooltips-general material-control numero"  data-toggle="tooltip" data-placement="top" title="Comprobante de Banco N.-" name="comproante_bco" value="" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Deposito de Banco N.-</label>

                            </div> 
                             <!--  <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> > 
                             <span>Seleccione ESTADO </span> 
                                 <select style="color:red;" name="estado" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" >
                                   <option value="ACTIVO" selected="">ACTIVO</option>
                                   <option value="PAGADO">PAGADO</option>
                               </select> 
                                <span class="highlight"></span>
                                <span class="bar"></span>

                            </div> -->

                             <div class="group-material" <?php if($respestgaran[0]=='DEVUELTO'){echo('style="display:none;"');} ?> >
                             BANCO A ACREDITARSE
                            <?php
                              $sql2=mysqli_query($conexion,"SELECT * FROM `tb_bancos` WHERE descripcion='CUENTA ADMINISTRATIVA'"); 
                             while($consult=mysqli_fetch_array($sql2)){ ?>  
                                <input type="text" class="tooltips-general material-control"  data-toggle="tooltip" data-placement="top" title="Cuenta Bancaria" name="" required value="<?php echo $consult['descripcion'].' N.-'.$consult['n_cuenta']; ?>" readonly="">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                
                            </div> 
                            <input type="hidden" name="id_banco" value="<?php echo $consult['id_banco']; ?>">
                            <?php } 
                                              ?>

                             <?php 
                              // if(){
                            
                            if ($respestgaran[0]!="DEVUELTO"){  ?>
                                                                         
                              
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registro" id="registro" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;  
                            </p>

                            <?php }else{ 

                                $id_alq=$_GET['idal'];
                                ?>
                            <input type="hidden" name="id_alqui" value="<?php echo $id_alq; ?>">
                            <p class="text-center">
                                <button  name="guardargarantia" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Devolver Garantía</button> &nbsp;&nbsp;  
                            </p>
                            <?php } ?>



                            <?php } ?>
                       </div>
                   </div>
                </div>



                <?php

                if(isset($_POST['guardargarantia'])){                  
                  $idalq=$_POST['id_alqui'];
                  $insert=$conexion->query("update tb_alquiler set estadogarantia='ok' where id_alquiler=".$idalq);
                  if($insert){
                        echo '<script type="text/javascript">swal({title: "ok", text: "Garantía devuelto con exito...!", type: "success",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="addpagosalquiler.php";});</script>'; 
                  }
                }

                 if (isset($_POST['registro'])){
                    $bienes=$_GET['bien'];
                  $id_per=$_POST['id_per'];
                  $comprobante_ingreso=$_POST['ingreso_n'];
                  $Id_banco=$_POST['id_banco'];                 
                  $Fecha=$_POST['fecha_registro'];
                  $Descripcion=$_POST['descripcion'];
                  $Comprobante_banco=$_POST['comproante_bco'];
                  $Saldo=$_POST['abono'];                  
                  $idalq=$_POST['id_alqui'];
                  $bien=$_POST['bien'];
                  $descuento=$_POST['descuento'];
                  $valdescuento=$_POST['descuento'];
                  $estado=$_POST['estado'];
                  $garantia=$_POST['garantia'];
                  if($garantia>0){
                    $garantia=1;
                  }else{
                    $garantia=0;
                  }
                  if($descuento>0){
                    $descuento=1;
                  }else{
                    $descuento=0;
                  }
                  if($bien==1){
                    $id_plan_cu=61;
                  }
                  if($bien==2){
                    $id_plan_cu=69;
                  }
                  if($bien==3){
                    $id_plan_cu=66;
                  }
                  if($bien==4){
                    $id_plan_cu=64;
                  }
                    $sqlcompro=$conexion->query("select 1 from tb_ingreso_sindicato where comprabante_n=".$ingreso_n);
                $respcom=mysqli_fetch_array($sqlcompro);
                if($respcom[0]!=1){
                  // echo ("<script type='text/javascript'>alert('".$id_per.' '.$comprobante_ingreso.' '.$Id_banco.' '.$Fecha.' '.$Descripcion.' '.$Comprobante_banco.' '.$Saldo.' '.$idalq."');</script>");
                  $consuldescuento=$conexion->query("select 1 from tb_alquiler where descuento=0 and id_alquiler=".$idalq);
                            $resdescuento=mysqli_fetch_array($consuldescuento);
                            if($resdescuento[0]==1){
                  $insert=$conexion->query("update tb_alquiler set descuento='".$descuento."', valor=valor-'".$valdescuento."',estadogarantia='ok' where id_alquiler=".$idalq);
                  
                    }
                  if($bienes==1){
                    $consuldescuentos=$conexion->query("select 1 from tb_alquiler where garantia=0 and estadogarantia='ok' and id_alquiler=".$idalq);
                            $resdescuentos=mysqli_fetch_array($consuldescuentos);
                            if($resdescuentos[0]==1){
                    $insert2=$conexion->query("update tb_alquiler set garantia='".$garantia."', estadogarantia='PROCESO' where id_alquiler=".$idalq);
                        }
                  }
            
                  $consulta2 = "call insertar_pagos_alquiler(".$id_per.",'".$comprobante_ingreso."', ".$Id_banco.", '".$Fecha."', '".$Descripcion."','".$Comprobante_banco."',   ".$Saldo.", '".$idalq."','".$id_plan_cu."','".$bienes."')";    
                  $ingreso2 = mysqli_query($conexion,$consulta2);
                  if($ingreso2){
                     header('location: addpagosalquiler.php?msg=yes&ingreso='.$comprobante_ingreso);

                  }else{
                     echo '<script type="text/javascript">swal("Error!", "No se pudo registrar pago de alquiler", "error")</script>';
                  }


                  }  else{
                echo '<script type="text/javascript">swal("Error!", "Ya se encuentra registrado ese comprobante socio!", "error")</script>'; 
            }

               
              }

                ?>

<?php  ?>



            </form>  
        </div> 
            </section>
          </div>
<script type="text/javascript" src="js/agenda.js"></script>

<script type="text/javascript">
  $('input[name=fecha_registro]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        drops:"up",
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

   var comprob = '<?php echo $Comprob = isset($_REQUEST["ingreso"]) ? $_REQUEST["ingreso"]: "nada"; ?>';
        if (comprob != "nada") {
            VentanaCentrada('comprobante_ingreso_sind.php?id='+comprob,'Recaudaciones','','1000','500','true');
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

</script>
             
</body>
</html>
<?php

// $MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

// if ($MSG=='yes') {
    
//     echo '<script type="text/javascript">swal("OK", "Alquiler registrado con exito", "success")</script>';

// } elseif ($MSG=='no') {
    
//     echo '<script type="text/javascript">swal("Error!", "No se pudo registrar este alquiler", "error")</script>';

// } elseif ($MSG=='nada') {

// }elseif ($MSG=='ff') {
    
//     echo '<script type="text/javascript">swal("Error!", "La fecha seleccionada no se encuentra disponible", "error")</script>';

// }elseif ($MSG=='sf') {
    
//     echo '<script type="text/javascript">swal("Error!", "Seleccione una fecha por favor", "error")</script>';

// }

ob_end_flush();
?>

