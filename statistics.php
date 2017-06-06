<?php
session_start();
if(isset($_SESSION['lab'])){
    $title="statistcs";
  include "init.php";
  $weekNumber = date("W");
  $tests  = testAll();
// echo $weekNumber;
// echo date('H-i-s');
// if(date('H-i') == '23-08'){
//   $date =1;
// }
// if(date('H-i') == '23-09'){
//   $date = 5;
// }
// if(isset($date)){echo $date;}
      ?>

<div class='container' >
<div class="breadcrumbss">
      <div class="breadcrumbs_inner">
        <ul>
          <li><a href="index.php">Home</a><span>«</span></li>
          <li>Statistics</li>
          
        </ul>
      </div>
    </div>
<div class="statis"></div>
<div class="intro"> <h1 > <i class='fa fa-line-chart'></i>statistics</h1>
   <span class="lead"> Here you can check weekly and monthly statistc</span></div>
 <!--  <div class="static">

 
  </div> -->
  <div class='filter'>
  <input   type='text' name='date' id="datepicker" />
  <input type='button' id='filter2' class='btn btn-info'  value='filter'/>  </div>
  <div id="static-ajax">


    <div class='row'>
      <div class=' col-lg-4'>
        <div class="static">
        <h1 class="stahead">today #<?php echo date('d'); ?></h1>
        <span > <?php
              foreach(getPaidDay() as $money){
                echo $money['sum'];
              }
          ?> <p>
            $
          </p> </span>
      </div>
      </div>
      <div class=' col-lg-4'>
        <div class="static">
        <h1 class="stahead">week #<?php echo $weekNumber ;?></h1>
      <span >  <?php
            foreach(getPaidWeek() as $mone){
              echo $mone['sum'];
            }
        ?> <p>
$
        </p> </span>
      </div>
      </div>
      <div class=' col-lg-4'>
        <div class="static">
        <h1 class="stahead">month #<?php echo date('M'); ?></h1>
      <span >  <?php
            foreach(getPaidMonth() as $money){
              echo $money['sum'];
            }
        ?> <p>
$
        </p></span>
      </div>

      </div>

    </div>
    <div class="row">
        <div class="col-lg-4">
          <div class='static'>
          <h2 class='stahead'><i class='fa fa-users'></i> Today</h2>
            <span><?php
              foreach(getPatientDay() as $pai){
                echo $pai['num'];
              }
            ?></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class='static'>
        <h2 class='stahead'><i class='fa fa-users'></i> Week</h2>
        <span><?php
          foreach(getPatientWeek() as $pai){
            echo $pai['num'];
          }
        ?></span>
          </div>
        </div>
        <div class="col-lg-4">
          <div class='static'>
          <h2 class="stahead"> <i class='fa fa-users'></i> Month</h2>
          <span><?php
            foreach(getPatientMonth() as $pai){
              echo $pai['num'];
            }
          ?></span>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="test-statistic">

        <h3 style="color:grey">How many test for this month<?php echo date('M'); ?></h3>
    <?php
        foreach($tests  as $test){
        
            foreach(testStat($test['t_id'] , date('d-m-y')) as $te){
                if($te['cons'] != 0) {
    ?>
        <div class='col-md-3 '>
          <div class='static'>
          <h2 class="stahead">  <?php echo $test['t_acrynom']; ?></h2>
            <span>
                <?php

                  echo $te['cons'];

                ?>
          </span>
          </div>
        </div>
    <?php
  }}}
    ?>
  </div>
</div>
</div>
</div>
</div>


<?php
include $temple."footer.php";
}else{header("location:signin.php"); exit();}
 ?>
