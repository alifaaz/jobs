<?php include 'adminr/database/config.php'; 
$from = $_POST['from']; $to = $_POST['to']; 
$id = $_POST['id']; 
global $con; 
$stmt = $con->prepare("SELECT * FROM `bill` WHERE  p_id=? And b_date BETWEEN '$from' and '$to'"); 
$stmt->execute(array($id));
 $found = $stmt->rowcount();
  $bills = $stmt->FetchAll(); 
  $data =""; 
  $counter=0;
  if($found > 0){ 
  	foreach($bills as $bill){
  	 
                            
                          switch($bill['b_status']){
                              case 0 :$state ='pending..';break;
                              case 1 :$state ='finished';break;
                              case 2 :$state ='deleverd';break;
                              default:$state= 'pending';}
                            ++$counter;
  	 $data .= "<tr><td>".$counter."</td>
  	             <td> 
  	              <a  href='bill.php?p_id= ".$id." &b_id=".$bill['b_id']." ' >
  	              ".$bill['b_date']."</a></td>
  	             <td>".$bill['b_number']."</td>
  	             <td> 
  	              <a  href='bill.php?p_id=".$id." &b_id=".$bill['b_id']." ' >
  	              $state</a>
  	              </td></tr>";
  	          }
                           
  		
  		}else{ $data .=  "<tr'> <td rowspan=4>no bill in such date </td></tr> "; } 



  		echo $data; ?>
