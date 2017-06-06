<?php
include "adminr/database/config.php";
include "include/function/model.php";
  $date = $_POST['date'];
  $show=  '';
   $tests  = testAll();
global $con;
$stmtmonth =  $con->prepare("SELECT sum(b_paid_amount) as sum , MONTHNAME(?) as month FROM `bill` WHERE  MONTH(b_date) = MONTH(?) ");
$stmtmonth->execute(array($date,$date));
$month  = $stmtmonth->fetchAll();
$stmtweek = $con->prepare("SELECT sum(b_paid_amount) as sum , WEEKOFYEAR(?) as week FROM `bill` WHERE  WEEKOFYEAR(b_date) =  WEEKOFYEAR(?) ");
$stmtweek->execute(array($date,$date));
$week =	$stmtweek->fetchAll();
$stmtday =  $con->prepare("SELECT sum(b_paid_amount)  as sum , DAY(?) as day FROM `bill` WHERE   DAY(b_date) = DAY(?) ");
$stmtday->execute(array($date,$date));
$day  = $stmtday->fetchAll();
$stmttest = $con->prepare("select t_id , t_acrynom from tests ");
$stmttest->execute();
$tests  =  $stmttest->fetchAll();




$show .="<div class='row'>";
  if($stmtmonth->rowcount() > 0){
    foreach($day as $money){
        $out = $money['sum'] ?? "noRecord";
        $show .="  <div class=' col-md-4'>
            <div class='static'>
              <h1 class='stahead'>day # ".$money['day']."</h1>  <span >".$out." <p>$  </p></span>  </div>  </div>";  }
  foreach($week as $money){
    $out = $money['sum'] ?? "noRecord";
    $show .="

        <div class=' col-md-4'>
          <div class='static'>
          <h1 class='stahead'>week#".$money['week']."<?php?></h1>
          <span >

                ".$out ."

             <p>
$
            </p> </span>
        </div>
        </div>";

      }
      foreach($month as $money){
        $out = $money['sum'] ?? "noRecord";
        $show .="  <div class=' col-md-4'>
            <div class='static'>
              <h1 class='stahead'>month# ".$money['month']."</h1>  <span >".$out." <p>$  </p></span>  </div>  </div>";  }
      
        $show .= "</div>";
        $show .=  '<h3 style="color:grey">Tests Statistics for month</h3>';

  $show .= ' <div class="test-statistic">';
   foreach($tests  as $test){
          
              foreach(testStat($test['t_id'] , $date) as $te){
                  if($te['cons'] != 0) {
      
            $show .= '
           
            <div class="col-sm-3">
                      <div class="static">
                      <h2 class="stahead"> '.$test['t_acrynom'].'</h2>
                        <span>
                          '.$te['cons'].'
                      </span>
                      </div>
                  </div>';
   
  }}}



$show .='</div>';



}else{ $show .= "no info here ";}
$show .="</div></div>";
    echo $show;
 ?>




