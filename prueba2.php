

<?php 

function conversion($numer){ 
$numero=$numer;
$rango=strlen($numero);
if($rango>=4){
$millares=miles($numero);
return $millares;
}
if($rango==3){
$centenas=centena($numero);
return $centenas;
}
if($rango<=2){
$decenas=decenas($numero);

return $decenas;
}
}
// if($rango==1){
// $unidades=unidades($numero);
// echo $unidades;
// }

function miles($num){
	if($num>=1000 and $num<=1999){
		if($num==1000){
			return 'MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'MIL '.$mils;
		}
	}
	// $nume=($num/1000);
	
	// $nummil=centena($nume);
	// $mil=(int)substr($num, 1);
	// $mils=centena($mil);
			

	// return $nummil.'MIL';

	if($num>=2000 and $num<=2999){
		if($num==2000){
			return 'DOS MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'DOS MIL '.$mils;
		}
	}

	if($num>=3000 and $num<=3999){
		if($num==3000){
			return 'TRES MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'TRES MIL '.$mils;
		}
	}

	if($num>=4000 and $num<=4999){
		if($num==4000){
			return 'CUATRO MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'CUATRO MIL '.$mils;
		}
	}

	if($num>=5000 and $num<=5999){
		if($num==5000){
			return 'CINCO MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'CINCO MIL '.$mils;
		}
	}

	if($num>=6000 and $num<=6999){
		if($num==6000){
			return 'SEIS MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'SEIS MIL '.$mils;
		}
	}

	if($num>=7000 and $num<=7999){
		if($num==7000){
			return 'SIETE MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'SIETE MIL '.$mils;
		}
	}

	if($num>=8000 and $num<=8999){
		if($num==8000){
			return 'OCHO MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'OCHO MIL '.$mils;
		}
	}

	if($num>=9000 and $num<=9999){
		if($num==9000){
			return 'NUEVE MIL';
		}else{
			$mil=(int)substr($num, 1);
			$mils=centena($mil);
			return 'NUEVE MIL '.$mils;
		}
	}

	if($num>=10000){
		$prueba=$num/1000;
		if ($prueba<100){
			$enteros= explode('.',$prueba);
			$a=decenas($enteros[0]);
			$b=conversion($enteros[1]);
			return $a.' MIL '.$b;
		}else{
			$enteros= explode('.',$prueba);
			$a=centena($enteros[0]);
			$b=conversion($enteros[1]);
			return $a.' MIL '.$b;
		}


	}

}

function centena($num){
	if($num>=100 and $num<=119){
		if($num==100){
			return 'CIEN';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'CIENTO '.$ciento;
			// }
		}

	}else if($num<100){
		return decenas($num);
	}
	if($num>=120 and $num<=199){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'CIENTO '.$ciento;

	}

	if($num>=200 and $num<=219){
		if($num==200){
			return 'DOSCIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'DOSCIENTOS '.$ciento;
			// }
		}

	}

	if($num>=220 and $num<=299){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'DOSCIENTOS '.$ciento;

	}

	if($num>=300 and $num<=319){
		if($num==300){
			return 'TRESCIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'TRESCIENTOS '.$ciento;
			// }
		}

	}

	if($num>=320 and $num<=399){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'TRESCIENTOS '.$ciento;

	}

	if($num>=400 and $num<=419){
		if($num==400){
			return 'CUATROCIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'CUATROCIENTOS '.$ciento;
			// }
		}

	}

	if($num>=420 and $num<=499){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'CUATROCIENTOS '.$ciento;

	}

	if($num>=500 and $num<=519){
		if($num==500){
			return 'QUINIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'QUINIENTOS '.$ciento;
			// }
		}

	}

	if($num>=520 and $num<=599){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'QUINIENTOS '.$ciento;

	}

	if($num>=600 and $num<=619){
		if($num==600){
			return 'SEISCIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'SEISCIENTOS '.$ciento;
			// }
		}

	}

	if($num>=620 and $num<=699){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'SEISCIENTOS '.$ciento;

	}

	if($num>=700 and $num<=719){
		if($num==700){
			return 'SETECIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'SETECIENTOS '.$ciento;
			// }
		}

	}

	if($num>=720 and $num<=799){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'SETECIENTOS '.$ciento;

	}

	if($num>=800 and $num<=819){
		if($num==800){
			return 'OCHOCIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'OCHOCIENTOS '.$ciento;
			// }
		}

	}

	if($num>=820 and $num<=899){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'OCHOCIENTOS '.$ciento;

	}

	if($num>=900 and $num<=919){
		if($num==900){
			return 'NOVECIENTOS';
		}else{
			// if($num>=110){
			$cien=substr($num, 1);
			$ciento=decenas($cien);
			return 'NOVECIENTOS '.$ciento;
			// }
		}

	}

	if($num>=920 and $num<=999){
		$cien=substr($num, 1);
		$ciento=decenas($cien);
		return 'NOVECIENTOS '.$ciento;

	}

	

}

function decenas($num){
	if($num>=10 and $num<=19){
		switch ($num) {
			case 10:
			return 'DIEZ';
			break;
			case 11:
			return 'ONCE';
			break;
			case 12:
			return 'DOCE';
			break;
			case 13:
			return 'TRECE';
			break;
			case 14:
			return 'CATORCE';
			break;
			case 15:
			return 'QUINCE';
			break;
			case 16:
			return 'DIECISEIS';
			break;
			case 17:
			return 'DIECISIETE';
			break;
			case 18:
			return 'DIECIOCHO';
			break;
			case 19:
			return 'DIECINUEVE';
			break;
		}
	}
	if($num<10){
		return unidades($num);
	}
	if($num>=20 and $num<=29){
		if($num==20){
			return 'VEINTE';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('VEINTI '.$v);
		}

	}

	if($num>=30 and $num<=39){
		if($num==30){
			return 'TREINTA';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('TREINTA Y '.$v);
		}

	}

	if($num>=40 and $num<=49){
		if($num==40){
			return 'CUARENTA';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('CUARENTA Y '.$v);
		}

	}

	if($num>=50 and $num<=59){
		if($num==50){
			return 'CINCUENTA';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('CINCUENTA Y '.$v);
		}

	}

	if($num>=60 and $num<=69){
		if($num==60){
			return 'SESENTA';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('SESENTA Y '.$v);
		}

	}

	if($num>=70 and $num<=79){
		if($num==70){
			return 'SETENTA';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('SETENTA Y '.$v);
		}

	}

	if($num>=80 and $num<=89){
		if($num==80){
			return 'OCHENTA';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('OCHENTA Y '.$v);
		}

	}

	if($num>=90 and $num<=99){
		if($num==90){
			return 'NOVENTA';
		}else{
			$va=substr($num, 1);
			$v=unidades($va);
			return ('NOVENTA Y '.$v);
		}

	}

}

function unidades($num){
	switch($num){
		case 1:
		return 'UNO';
		break;
		case 2:
		return 'DOS';
		break;
		case 3:
		return 'TRES';
		break;
		case 4:
		return 'CUATRO';
		break;
		case 5:
		return 'CINCO';
		break;
		case 6:
		return 'SEIS';
		break;
		case 7:
		return 'SIETE';
		break;
		case 8:
		return 'OCHO';
		break;
		case 9:
		return 'NUEVE';

	}

}
// echo ($millares.' '.$centenas.' '.$decenas.' '.$unidades);

 ?>
