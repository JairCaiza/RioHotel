<?php
require_once("frmConfig.php");
$ruta = new classConfig();
$dirInsert = $ruta->rutaInsert();

if(!empty($_POST['insDataHotel'])){
	$vect = json_decode($_POST['insDataHotel']);
	$time = time();
	$data = array('dato0'=>$vect[0], 'dato1'=>$vect[1], 'dato2'=>$vect[2], 'dato3'=>$vect[3], 'dato4'=>$vect[4], 'dato5'=>$vect[5], 'dato6'=>$vect[6],
	'dato7'=>$vect[7], 'dato8'=>$vect[8], 'dato9'=>$vect[9], 'dato10'=>$vect[10], 'dato11'=>$vect[11], 'dato12'=>$vect[12], 'dato13'=>$vect[13],
	'dato14'=>$vect[14], 'dato15'=>$vect[15], 'dato16'=>$vect[16], 'dato17'=>$vect[17], 'dato18'=>$vect[18], 'dato19'=>$vect[19], 'dato20'=>$vect[20]);
	
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($dirInsert.'opc=insHotel', false, $context);
	echo $result;
}

?>