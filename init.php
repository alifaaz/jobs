<?php
ob_start();
date_default_timezone_set("Asia/Baghdad");
$temple='include/template/'; 
$css='face/css/'; 
$js='face/js/';
$img='face/img/';
$funcion='include/function/';
$model='adminr/database/';
$dayReset ="Monday";

include $model."config.php";
include $funcion.'model.php';
include $temple.'header.php';

if (date("l") == $dayReset & date("h:i:sa") == "08:35:00pm"){ $Bill = 0;
	emptyBill();
	}
	else{

	foreach (biilnumb() as $key) {
     	$Bill=$key['b_number'];
   }

			}	
		?>
		