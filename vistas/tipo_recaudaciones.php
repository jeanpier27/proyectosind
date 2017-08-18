<?php 
$id_socio=$_POST['nombres'];
$id_recaudacion=$_POST['recaudacion'];
if($id_recaudacion==1){
	echo ("<form  action='' method='post'><div class='group-material'>
                                <input  placeholder='Escribe el valor a cancelar'  title='Solamente números y punto' name='valor' type='text' class='material-control tooltips-general check-representative' pattern='[0-9.]{1,10}'' required='' maxlength='10' data-toggle='tooltip' data-placement='top' >
                                <span class='highlight'></span>
                                <span class='bar'></span>
                                <label>Valor a cancelar</label>
                            </div> <p class='text-center'>
                                <button type='reset' class='btn btn-info' style='margin-right: 20px;''><i class='zmdi zmdi-roller'></i> &nbsp;&nbsp; LIMPIAR</button>
                                <button  name='registra' id='prueba' type='submit' class='btn btn-primary'><i class='zmdi zmdi-floppy'></i> &nbsp;&nbsp; GUARDAR</button> &nbsp;&nbsp;  
                            </p></form> <script type='text/javascript'>
	$('#prueba').click(function(){
		$('#contenedor').load('vistas/recaudaciones.php');
	})
</script>");
}

 ?>
