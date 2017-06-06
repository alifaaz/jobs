<?php


include "adminr/database/config.php";
include "include/function/model.php";

$group = $_POST['group'];

$tests	=	test($group);

$show ='';

foreach ($tests as $value) {
			
			$show .='<tr>
							<td> '.$value['t_name'].'</td>
							<td>'.$value['t_acrynom'].'</td>
							<td>'.$value['t_normalvalue'].'</td>
							<td>'.$value['t_price'].'</td>
							<td>
				<a href="test.php?tst=edit&id='.$value['t_id'].'" class="btn btn-info" data-toggle="modal" data-target=".bd4" >edit</td>
							<td>
				<a href="test.php?tst=delete&id='.$value['t_id'].'" class="btn btn-danger sure">delete</a></td>
						</tr>';
		
				}

if(empty($tests)){echo "no record";}else{
	echo $show;	 
			}
