<?php

include 'adminr/database/config.php';

$display ='';

$date =$_POST['date'];
$id=$_POST['id'];
$rate=$_POST['rate'];
global $con;

$stmt1 = $con->prepare("SELECT count(p_name) as con FROM `patient` 
	WHERE d_id = ?
	 AND  MONTH(p_date) = MONTH(?) ");
$stmt1->execute(array($id,$date));
$record = $stmt1->fetchAll();

foreach($record as $rec){

		if($rec['con']== 0){$padoc='no record';
							$amount='no record';
				}else{$padoc=$rec['con'];
					$amount = $rec['con'] * $rate;
						}
	$display .= '
	<div class="heding"> 
	<i style="color:#fff" class="fa fa-calendar" aria-hidden="true">
	</i> '.$date .'
	</div>
	 <div class="col-md-12">
	</div>
	<div class="col-md-4">
	<div class="static">
	<h1 class="stahead"><i class="fa fa-users"></i> patients</h1><span > '.$padoc.' <p> </p> </span></div></div>

	<div class="col-md-4">
	<div class="static">
		<h1 class="stahead"><i class="fa fa-money"></i> money</h1>
		<span>
		'.$amount.'$
		</span>
	</div>
</div>';

}

echo $display;

