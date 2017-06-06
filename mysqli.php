<?php

echo 'hollymolly';
$con = new mysqli('localhost','root','root','hah');

	
$sql='select * from movie';
$record =mysqli_query($con,$sql);
var_dump($record);
foreach($record as $rec){
	
echo $rec['name'].'<br>';
echo $rec['type'].'<br>';
}