<?php

include 'adminr/database/config.php';

$date = $_POST['date'];
global $con;
$stmt=$con->prepare("SELECT * FROM material WHERE MONTH(m_date) = MONTH(?) ORDER BY m_id DESC");
$stmt->execute(array($date));
$record	=$stmt->fetchAll();
$sum=0;

if(empty($record)){$display='<div class="alert alert-danger">no record this month</div>';}else{
$display = '<div class="" >
             <h4 style="background-color:#f3faff; padding:10px;">purchases for</h4> <h3 class="altermonth">'.$date .'</h3></h4>
              <table class="" id="table">
                
              
              
                 <thead>
                   <tr>
                     <th> item</th><th> num</th><th> unit</th><th> price</th><th> date</th>
                   </tr>
                 </thead><tbody>';

               foreach($record as $mat) {

               	$display .='
                   <tr> 
                   <td>'.$mat['m_name'].' </td>
                    <td> '.$mat['m_num'].'</td> 
                    <td>' .$mat['m_unit'].'  </td> 
                    <td> '.$mat['price'] .'</td> 
                    <td>'.$mat['m_date'].' </td></tr>';
             
                        $sum=$sum+$mat['price'];

               }


            

     $display .= '</tbody></table>
               </div>
               <div class="matprice">Total Amount : '.$sum.'</div>';}

          echo $display;
