
	<!-- <div class="container contenedor-principal-empleado"> -->
  <div class="modal-header">
        
        <h4 class="modal-title">INGRESO NUEVA ASAMBLEA</h4>
  </div>
  <!-- <h2>INGRESO EMPLEADO</h2> -->
 
  <form method="post" id="form">
    <div class="form-group ">
     
    <!-- </div> -->
        <!-- <div class="form-group"> -->
         <label for="nombres">Fecha:</label>
      <input type="text" class="form-control" id="fecha" name="fecha" ><span  class="error" disabled></span>


      <label for="nombres">Descripcion:</label>
      <textarea name="descripcion" id="descripcion" class="form-control" required=""></textarea>
      <!-- <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Escriba los nombres" required=""><span  class="error"></span> -->
    <!-- </div> -->
  
    <br><br>
     <p class="text-center">
                                
     <button  name="registra" id="registra" type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;
    </p>
    </div>
  

</form>
<?php 
// include('bd/conexion.php');
$hoy=date('Y/m/d');

// mysql_close($conexion);
 ?>


<script type="text/javascript">
  $(document).ready(function(){
     var hoys=' <?php echo($hoy); ?>';
      // $('#guardar').click(function(e){
      //   e.preventDefault();
      //     var nombres=$('#nombres').val();
         
        
     $('#registra').click(function(e){
            e.preventDefault();
            var fecha=$('#fecha').val();
            var descripcion =$('#descripcion').val();
            $.post('controler/inserta_reunion.php',{fecha:fecha,descripcion:descripcion},function(data,status){
                // $('#nueva_asamblea').html(data);
                if(data=='ok'){
                  swal({title: "ok", text: "Registrado con exito...!", type: "success",  confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  location.href="reuniones.php";});
                }else if(data=='registrado'){
                    swal({title: "Advertencia", text: "Ya se encuentra registrada la fecha de esta asamblea..!", type: "warning",   confirmButtonText: "Aceptar!",  closeOnConfirm: true},function(){  
                        
                    });
                }else{
                  swal({title: "Error", text: "Ah ocurrido un error al momento de guardar..!", type: "error",   confirmButtonText: "Aceptar!",  closeOnConfirm: false},function(){  
                        $('#fecha').val("");
                    });
                }
                // console.log(data);
                // console.log(status);

            });
        });

       $('input[name=fecha]').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                         autoUpdateInput: false,
                        minDate: hoys,
                        timePicker: true,
                        timePicker24Hour: true,
                        timePickerIncrement: 30,
                        locale: {
                          cancelLabel: 'Clear',
                          format: 'YYYY-MM-DD H:mm:00',
                          "separator": " - ",
                          "applyLabel": "Aceptar",
                          "cancelLabel": "Cancelar",
                          "daysOfWeek": ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
                           "monthNames": ["Enero","Febrero","Marzo","Abril","Mayo",
                          "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre",
                          "Diciembre"]
                      }
                  });
       $('input[name="fecha"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD H:mm:00'));
      });

       $('input[name="fecha"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

  })

</script>


     