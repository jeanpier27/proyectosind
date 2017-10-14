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
            $('#contsocio').attr("style","display:block;");
            $('#socio').attr("style","background-color:#E75A5A;");
              
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
            selectable: true,  //Deshabilita la seleccion en los dias
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
                // alert("inicio: "+ new Date(start)+"/ fin: "+end );
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
                $consulta_alquiler = $conexion->query("SELECT `tb_alquiler`.`id_alquiler`, `tb_personas`.`nombre`,`tb_personas`.`apellido`, `tb_beneficios`.`beneficio`, `tb_alquiler`.`fecha_desde`, `tb_alquiler`.`fecha_hasta`, `tb_alquiler`.`estado`, `tb_beneficios`.`estado` as benefito,`tb_alquiler`.`valor`,`tb_alquiler`.`abonos`,`tb_alquiler`.`estadogarantia` FROM `tb_personas`
                    INNER JOIN `tb_alquiler` ON `tb_alquiler`.`id_persona` = `tb_personas`.`id_persona`
                    INNER JOIN `tb_beneficios` ON `tb_alquiler`.`id_beneficio` = `tb_beneficios`.`id_beneficio` where (`tb_alquiler`.`estado` = 'ACTIVO' OR `tb_alquiler`.`estado` = 'PAGADO') AND `tb_alquiler`.`id_beneficio` = ".$Id_bien);
                                while ($alquiler=$consulta_alquiler->fetch_array()){ 
                                  $personita=$alquiler['nombre'].' '.$alquiler['apellido'];
                                  $benefic=$alquiler['beneficio'];
                                  $inicio=$alquiler['fecha_desde'];
                                  $fincito=$alquiler['fecha_hasta'];
                                  $cod_alqui=$alquiler['id_alquiler'];
                                  $dia_hora=$alquiler['benefito'];
                                  $valor=$alquiler['valor'];
                                  $abono=$alquiler['abonos'];
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
                                    url: '<?php echo $cod_alqui; ?>',
                                    className: 'success',
                                    <?php 
                                    if($Id_bien==1 and $estadogarantia=='DEVUELTO'){?>
                                        color:'#e74c3c',
                                     <?php 
                                   }else{

                                    if($estado=='PAGADO'){ ?>
                                         color:'#2ecc71'
                                      <?php }elseif($abono<$valor and $abono>0){  ?>
                                        color:'#f1c40f'
                                        <?php }elseif($estado=='ACTIVO'){  ?>
                                        color:'#2980b9'
                                        <?php }} ?>
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

            eventRender: function (event, element) {
        element.attr('href', 'javascript:void(0);');
        element.click(function() {
            // alert("hola "+event.url);
            // $("#startTime").html(moment(event.start).format('MMM Do h:mm A'));
            // $("#endTime").html(moment(event.end).format('MMM Do h:mm A'));
            // $("#eventInfo").html(event.description);
            // $("#eventLink").attr('href', event.url);
            // $("#eventContent").dialog({ modal: true, title: event.title, width:350});



            swal({
                title: "Esta seguro que desea anular este alquiler?",
              text: "Una vez realizada la accion no se podra deshacer!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Si, Deseo anular el alquiler!",
              cancelButtonText: "Cancelar",
              showLoaderOnConfirm: true,
              closeOnConfirm: false,
              allowOutsideClick: false,
              allowEscapeKey: false
          },
          function(){
               // swal("Eliminado Id: "+event.url, "El alquiler ha sido anulado.", "success");




               $.post("controler/anular_alquiler.php",{id_alquiler:event.url},function(data,status){
                var beneficio_tenido = '<?php echo $Id_bien = isset($_REQUEST["bien"]) ? $_REQUEST["bien"]: 0; ?>';
                                if(data=='ok'){
                                    // console.log(data);
                                    // console.log(status);

                                    swal({
                                        title: "OK",
                                      text: "Alquiler anulado con exito",
                                      type: "success",
                                      // confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                        location.href="addalquiler.php";
                                      
                                  });


                                }else if (data=='pagado'){
                                    swal({
                                        title: "Advertencia",
                                      text: "No se puede anular un alquiler ya realizado",
                                      type: "warning",
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                        location.href="addalquiler.php?bien="+beneficio_tenido;
                                      
                                  });
                                    
                                }else if (data=='error'){
                                    swal({
                                        title: "eroor",
                                      text: "Nose ha podido anular el alquiler, intentelo nuevamente",
                                      type: "error",
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "Aceptar!"
                                  },
                                  function(){
                                        location.href="addalquiler.php";
                                      
                                  });
                                    
                                }
                               
                            });
          });

        });
    }







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
        /* try to mimick the look of a real event */
    .external-event { 
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
                            $sql=$conexion->query("SELECT * FROM `tb_personas` ORDER BY apellido");  
                            $sqlb=$conexion->query("SELECT * FROM tb_beneficios order by beneficio");  
                         ?> 
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Alquiler </div>



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
                                <select class="tooltips-general material-control" data-toggle="tooltip" id="carga_bienes_encontrados" onchange="carga_bienes()" data-placement="top" title="Elige el bien que alquilará el socio antes seleccionado"  required name="id_beneficio">
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
                                    location.href="addalquiler.php?bien="+x;
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
                            <legend><strong>Información básica</strong></legend> <br>
                            <div class="group-material">
                                <span>Seleccione la Persona </span> <br>
                                <select class="selectpicker" data-live-search="true"  required name="id_socio">
                                    <option value="" disabled="" selected="">Selecciona</option>
                                        <?php
                                          while($f = $sql->fetch_array()){ 
                                            echo '<option value="'.$f['id_persona'].'">'.$f['apellido'].' '.$f['nombre'].' </option>';
                                            } 
                                        ?> 
                                </select>
                            </div>         

                            <div class="gruop-material" id="msj"></div>                   
                              
                            <div class="group-material">
                                <label>Fecha y Hora que comenzar&aacute; a utilizar</label><br>
                                <input type="text" class="tooltips-general material-control" id="iniciando" readonly="true" required title="Seleccione la fecha que se alquilará" name="fecha_desde">
                                <span class="highlight"></span>
                                <span class="bar"></span> 
                            
                                <!-- <input type="time" class="tooltips-general material-control"  required=""  data-toggle="tooltip" data-placement="top" title="Seleccione la fecha que se alquilará" name="hora_desde" >
                                <span class="highlight"></span>
                                <span class="bar"></span> -->
                                <!-- <label>Fecha y Hora que comenzar&aacute; a utilizar</label> -->
                            </div>
                               
                            <div class="group-material">
                            <label>Fecha y hora que dejar&aacute; disponible el bien</label><br>
                                <input type="text" class="tooltips-general material-control" id="terminando" readonly="" required title="Seleccione la fecha que se alquilará" name="fecha_hasta">
                                <span class="highlight"></span>
                                <span class="bar"></span> 
                                
                                <!-- <input type="time" class="tooltips-general material-control"  required=""  data-toggle="tooltip" data-placement="top" title="Seleccione la fecha que se alquilará" name="hora_hasta">
                                <span class="highlight"></span>
                                <span class="bar"></span> -->
                                <!-- <label>Fecha y hora que dejar&aacute; disponible el bien</label> -->
                            </div> 
                           
                            <div class="group-material">
                            <label>Valor a Pagar</label><br>
                            <?php 
                              $bien=$_GET['bien']; 
                              $consul=$conexion->query("select valor from tb_beneficios where id_beneficio=".$bien);
                              $resp=mysqli_fetch_array($consul);
                            ?> 
                                <input type="text" class="tooltips-general material-control numero" required="" id="valor_pagar"  required title="Valor a pagar" name="valor_pagar" value="<?php echo $resp[0]; ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span> 
                                
                                <!-- <input type="time" class="tooltips-general material-control"  required=""  data-toggle="tooltip" data-placement="top" title="Seleccione la fecha que se alquilará" name="hora_hasta">
                                <span class="highlight"></span>
                                <span class="bar"></span> -->
                                <!-- <label>Fecha y hora que dejar&aacute; disponible el bien</label> -->
                            </div>
                            <br><br>
                            
                            <p class="text-center">
                                <!-- <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; LIMPIAR</button> -->
                                <button  name="registro" id="registro" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;  
                            </p>
                       </div>
                   </div>
                </div>



                <?php

                 if (isset($_POST['registro'])){
                  $Id_per=$_POST['id_socio']; 
                  $Id_beneficio=$_POST['id_beneficio'];
                  $Fecha_desde=$_POST['fecha_desde'];                 
                  $Fecha_hasta=$_POST['fecha_hasta'];
                  $valor_pagar=$_POST['valor_pagar'];
                  $Estado="ACTIVO"; 


                  if(($Fecha_desde == "") || ($Fecha_hasta == "")){
                    header('location: addalquiler.php?msg=sf&bien='.$Id_beneficio);
                    exit;
                  }


                                $consulta_alquiler = $conexion->query("SELECT fecha_desde, fecha_hasta FROM tb_alquiler where estado = 'ACTIVO' AND id_beneficio = ".$Id_beneficio);
                                while ($alquiler=$consulta_alquiler->fetch_array()){                                  
                                  $iniciooo=$alquiler['fecha_desde'];
                                  $fincitooo=$alquiler['fecha_hasta'];
                                  //echo $iniciooo."  ........  ".$fincitooo."<br>";


                                    $start_ts = strtotime($iniciooo);
                                    $end_ts = strtotime($fincitooo);
                                    $user_fi = strtotime($Fecha_desde);
                                    $user_ff = strtotime($Fecha_hasta);

                                    echo $start_ts."  ........  ".$end_ts."................".$user_fi." <br>";

                                    if(($user_fi >= $start_ts) && ($user_fi <= $end_ts)){
                                       // echo "Dentro de rango inicio <br>";
                                      header('location: addalquiler.php?msg=ff&bien='.$Id_beneficio);
                                      exit;
                                    }

                                    if(($user_ff >= $start_ts) && ($user_ff <= $end_ts)){
                                       //echo "Dentro de rango fin <br>";
                                      header('location: addalquiler.php?msg=ff&bien='.$Id_beneficio);
                                      exit;
                                    }

                                  
                              } 

                  // $valorbien=$conexion->query("select valor from tb_beneficios where id_beneficio=".$Id_beneficio);
                  //  while($row=$valorbien->fetch_array()){ 
                  //     $valors=$row['valor'];
                  //  }

                  //  $beneficiosocio=$conexion->query("select 1 from tb_socio where id_persona=".$Id_per." and estado='ACTIVO'");
                  //  $consultben=mysqli_fetch_array($beneficiosocio);

                  //  if($consultben[0]==1){
                  //     $valors=$valors/2;
                  //  }

                  $consulta = "insert into tb_alquiler (id_persona, id_beneficio, fecha_desde, fecha_hasta, estado,valor,abonos) values (".$Id_per.", ".$Id_beneficio.", '".$Fecha_desde."', '".$Fecha_hasta."', '".$Estado."','".$valor_pagar."',0)";    
                  $ingreso = mysqli_query($conexion,$consulta);                       
                  

                 if ($ingreso) {                    
                    header('location: addalquiler.php?msg=yes&bien='.$Id_beneficio); 
                 } else {
                    header('location: addalquiler.php?msg=no&bien='.$Id_beneficio);   
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
      $('select[name=id_socio]').change(function(){
          var id_persona=$('select[name=id_socio]').val();
                        
                            $.post("controler/consulta_socio.php",{socio:id_persona},function(data,status){
                                if(data=='ok'){
                                    // console.log(data);
                                    // console.log(status);
                                    $('#msj').html('<div class="alert alert-warning" role="alert"><h3><strong>Aviso!..</strong> Es socio activo del sindicato</h3></div>');
                                    // $('input[name=fecha_nacimiento]').val(data);
                                }else{
                                  $('#msj').empty();
                                }
                            });

      });
      $('input[name=fecha_desde]').daterangepicker({
                        singleDatePicker: true,
                        timePicker: true,
                        showDropdowns: true,
                        autoUpdateInput: false,
                        timePicker24Hour: true,
                        locale: {
                          cancelLabel: 'Clear',
                          // format: 'YYYY-MM-DD',
                          "separator": " - ",
                          "applyLabel": "Aceptar",
                          "cancelLabel": "Cancelar",
                          "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                          "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo",
                          "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre",
                          "Diciembre"]
                      }
                  });
      $('input[name="fecha_desde"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD H:mm:00'));
      });

      $('input[name="fecha_desde"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });

      $('input[name=fecha_hasta]').daterangepicker({
                        singleDatePicker: true,
                        timePicker: true,
                        showDropdowns: true,
                        autoUpdateInput: false,
                        timePicker24Hour: true,
                        locale: {
                          cancelLabel: 'Clear',
                          // format: 'YYYY-MM-DD',
                          "separator": " - ",
                          "applyLabel": "Aceptar",
                          "cancelLabel": "Cancelar",
                          "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                          "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo",
                          "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre",
                          "Diciembre"]
                      }
                  });
      $('input[name="fecha_hasta"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD H:mm:00'));
      });

      $('input[name="fecha_hasta"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });

      $(".numero").keypress(function(e){
          var key = window.Event ? e.which : e.keyCode 
          return ((key >= 48 && key <= 57) || (key==8) || (key==46)) 
      });
</script>
</body>
</html>
<?php

$MSG = isset($_REQUEST["msg"]) ? $_REQUEST["msg"]: 'nada';

if ($MSG=='yes') {
    
    echo '<script type="text/javascript">swal("OK", "Alquiler registrado con exito", "success")</script>';

} elseif ($MSG=='no') {
    
    echo '<script type="text/javascript">swal("Error!", "No se pudo registrar este alquiler", "error")</script>';

} elseif ($MSG=='nada') {

}elseif ($MSG=='ff') {
    
    echo '<script type="text/javascript">swal("Error!", "La fecha seleccionada no se encuentra disponible", "error")</script>';

}elseif ($MSG=='sf') {
    
    echo '<script type="text/javascript">swal("Error!", "Seleccione una fecha por favor", "error")</script>';

}

ob_end_flush();
?>












