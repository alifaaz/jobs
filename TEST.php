<?php
session_start();
if(isset($_SESSION['lab'])){
  $left="";
    include "init.php";
$tests=array();
$testt = testAll();
$patient  = getPatients();
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
$tests=$_POST['test'];
    var_dump($tests);
    echo count($tests);
  }


?>
<input type='text' name='date' id='date'  />
<input type='hidden' name='id' id='id' vlaue='100'  />
<input type='button' class='btn btn-info' id='filter' name='filter' value='filter'>
  <div id='pa-tab'>
      <table class='' >
          <tr>
            <td>
              name
            </td>
          </tr>
        <?php foreach($patient as $pait){
          ?>
              <tr>
              <td>

             <?php echo $pait['p_name'];?>  </td>
              </tr>
        <?php
         }
        ?>
      </table>
</div>
</div></div>
<?php

include $temple."footer.php";
}else{header("location:signin.php"); exit();}
