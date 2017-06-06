<?php
session_start();
if(isset($_SESSION['lab'])){
    $left='';
    $title='print and send';
include "init.php";

if(!isset($_GET['p_id']) || !isset($_GET['b_id']) || !isset($_GET['price'])){header("location:404.php"); exit();}else{
    $p_id=isset($_GET['p_id']) & is_numeric($_GET['p_id']) ? intval($_GET['p_id']) : 0 ;//VALIDATE itema AND SECURE IT FROM SMARTASS
    $b_id=isset($_GET['b_id']) & is_numeric($_GET['b_id']) ? intval($_GET['b_id']) : 0 ; }
$price =$_GET['price'];
   $print =printInfo($b_id);
 $patient =getpatient($p_id);
 $record =	getRecord($b_id);
 $bill =billl($b_id) ;
 foreach ($bill  as $bil) {
  if($price == $bil['b_paid_amount']){$mony ="paid";}else{$mony='not paid';}
  if($bil['b_status'] == 2 ){
  $active = 'destroy hahah';
}
 $tst = $_GET['tst'] ?? 'manage';
  if($tst == 'manage'){

    ?>

<div class="content-print container">

    <div class="head-print intro">
   <?php

       echo "<h3 style='text-align:center;margin:10px;'>Life Labrotary for clinical test</h3>"  ;
foreach($patient as $te){
         ?>


     <ul class="p-info">
     <li><span >Name :</span> <?php echo $te['p_name'] ;?></li>
     <li><span >Age :</span> <?php echo  (date('20y')-$te['p_age']);?></li>
    <?php
        if($te['p_gender'] == 1){$gender ="male";}else{$gender="female";}
    ?>
    <li><span>Gender : </span><?php echo $gender ;?></li>
    <li><span> Date :</span><?php echo date('d-m-y');?></li>
    <li><span class="moneyy">price#</span><span style="color:green; font-size:20px;"><?php
          echo $price."</span> (".'<span style="color:gray; font-size:14px;">'.$mony."</span>)";
    ?></li>
    </ul>
    <?php
        }
    ?>

    </div>

    <div class="table-print" style="overflow:hidden">

        <table class="table">
        <tr>
            <th>test</th>
            <th>result</th>
            <th>Ref.Interval</th>
            <th>Units</th>
        </tr>
            <tr>
                <td>=======</td>
                <td>=======</td>
                <td>=======</td>
                <td>=======</td>
            </tr>
        <tr>
            <?php

         foreach($print as $tes){
            foreach(getTest($tes['t_id']) as $te){
     echo '<tr>';
            echo '<td>'.$te['t_name'].'</td>';
            echo '<td>'.$tes['result'].'</td>';
            echo '<td>'.$te['t_normalvalue'].'</td>';
            echo '<td>'.$te['units'].'</td>';
     echo '</tr>';
    }}
    ?>
            </table>

    </div>
        <?php
              foreach($record as $rec){
?>
                      <div class='container'>
                        <h2>Notes :</h2>
                        <p>
                                <?php echo $rec['b_record'];?>
                              </p>
                      </div>
  <?php

              }
        ?>
    <?php 
      if(isset($active)){
    ?>
    <button onclick="window.print()" class="hidden-print">print</button>
    <button class="hidden-print" disabled>send</button>
    <?php
      }else{
    ?>
    <a href='print.php?tst=printed&b_id=<?php echo $b_id ; ?>&p_id=<?php echo $p_id?>&price=54' class='btn btn-warning' 
    <?php
      if($mony=='not paid'){echo "disabled";}
    ?>
    >finished</a>
<?php
}
?>
    <a onclick="window.history.back()" class="hidden-print">return</a>
</div>



<?php
}elseif($tst == 'printed'){

    $id=$_GET['b_id'];
    finished($id);
   header('Location: '. $_SERVER['HTTP_REFERER']);; exit();



}else{ header("location:404.php"); exit();}



}}else{header("location:signin.php"); exit();}
