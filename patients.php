<?php
session_start();
if(isset($_SESSION['lab'])){
  $title ='patient page';
include "init.php";
    $tests=array();//array to hold value of tests
    //patent record
    $tst=$_GET['tst']??'manage';
    $counter =0;
      if(!isset($_GET['page'])){
          $page=1;
              }else{
          $page=$_GET['page'];
        }
    if(!isset($_GET['id'])){echo " dont be smart please";}else{
    $id=isset($_GET['id']) & is_numeric($_GET['id']) ? intval($_GET['id']) : 0 ;//VALIDATE itema AND SECURE IT FROM SMARTASS
      }
   $patient          =getpatient($id);
   $bills            =bill($id) ;
   $check_epmty_bill =empty($bills);
    $number_of_bill =3;
                    $number_of_bills=count($bills);
                    $number_of_pages   = ceil($number_of_bills/$number_of_bill);
                    $limit =($page-1)*$number_of_bill;
                    $billpags =getbillPagination($limit,$number_of_bill,$id);
                    // echo '<pre>';
                    // var_dump($billpags);
     // echo "The time is " . date("h:i:sa");


if($tst == 'manage'){
$crumbs = explode("/",$_SERVER['HTTP_REFERER']);
        if(in_array("patient.php", $crumbs)){
            $link="patient.php";
                 }else{
            $link="managepatient.php";
             }
  foreach($patient as $pait){


?>

        <div class="container">
             <div class="breadcrumbss">
              <div class="breadcrumbs_inner">
                <ul>
                  <li><a href="index.php">Home</a><span>«</span></li>
                  <li><a href="<?php echo $link; ?>">Patients</a><span>«</span></li>
              <li>patientPage</li>
            </ul>
            </div>
         </div>   
         <div class="imag imgpsts"></div>

<?php
if($pait['p_gender'] == 1){$gender ="male";}else{$gender="female";}
 $c= $pait['p_age'];
                    $y= date('Y');
                    $age=$y-$c;

?>
         <div class="row">
              <div class="col-md-6">
                  <div class="patient-info">
                  <div class="heding"><i class="fa fa-user"></i>Patient info</div>
                  <h3><span class="fa">Name:</span><?php echo $pait['p_name'] ;?></h3>
                    <p><i class=" fa fa-birthday-cake fa-fw w3-margin-right w3-large w3-text-teal"></i><?php   
                  echo $age; ?></p>
                  <p><i class=" fa fa-venus-mars fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $gender ;?></p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $pait['p_adress'] ;?></p>
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $pait['p_email']; ?></p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $pait['p_phoneNumber'] ;?></p> 
                    
                    <p><i class=" fa fa-user-md fa-fw w3-margin-right w3-large w3-text-teal"></i><?php   foreach(getdoctor($pait['d_id']) as $doc){
                  echo $doc['d_name'];  }
                  ?></p>
                  
                  <img src="img/nlkj.png"/>
                    <div class="editpatient">
                    <button type="button" name="edit" id="edit" data-toggle='modal' data-target="#addmodal" class="btn btn-primary"> Edit</button>
                </div>
                  </div>

              </div>
              <div class="col-md-6">
                  <div class="bills">
                  <div class="heding">Patient Bills </div>
                   <div class="marginn">
                   
                    <input type="text" name='from' id='from' placeholder='fromDate (yy-mm-dd)' class='date_pi form-control1'  />
                    <input type="text" name='to' id='to' placeholder='toDate (yy-mm-dd)' class='date_pi form-control1' />
                    <input type="hidden" name='id' id='id' value="<?php echo $id; ?>" />

                    <input type='button' class='btn btn-info' id='filter1' value='filiter' />
                </div>

                          <table>
                            <thead>
                              <tr><th>#Num</th><th>Date</th><th>BillNum</th><th>State</th></tr>
                            </thead>
                            <tbody id='list-bills'>
                              <?php
          if($check_epmty_bill == 1){  echo "<tr><td rowspan=4>no bill yet</td></tr>";   }else{
                foreach($billpags as $bill)
                          {
                            
                            switch($bill['b_status']){
                              case 0 :$state ='pending..';break;
                              case 1 :$state ='finished';break;
                              case 2 :$state ='delivered';break;
                              default:$state= 'pending';
                            }
                              ++$counter;
                           ?>
                          <tr>
                         
                          <td><?php echo $counter; ?></td>
                           <td>  <a  href='bill.php?p_id=<?php echo $id ;?>&b_id=<?php echo $bill['b_id'] ; ?>' ><?php echo $bill['b_date']?></a></td>
                          <td><?php echo $bill['b_number']?></td>
                          <td>  <a  href='bill.php?p_id=<?php echo $id ;?>&b_id=<?php echo $bill['b_id'] ; ?>' ><?php echo $state; ?></a></td>
                           
                          </tr>

                       <?php
                               } 
                             }
                      ?>
                            </tbody>
                     
                          </table>
                                 
            <ul class="pagination">
                            <?php
                    for($con=1;$con<=$number_of_pages;$con++){
                      echo '<li><a href="patients.php?id='.$id.'&page='.$con.'">'.$con.'</a></li>';
                    }
                    ?>
</ul>
  <a  href="patients.php?tst=addbill&id=<?php echo $id ?>" class="btn btn-primary" > <i class="fa fa-plus"></i>Bill</a>
                  </div>
              </div>


         </div>

<?php
  } 
  // endforeach
?>




 <div class="modal fade" id="addmodal">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button class="close" type="button" data-dismiss="modal">&times</button> -->
            <!-- <h3 class="modal-title">insert mterila this month</h3> -->
            <div class="modal-body">
              <div class='material-form'>
                <h3 class="modal-title">Edit patient </h3>
                        <hr>
 <?PHP                       foreach($patient as  $pa){
    ?>
      <form action="patients.php?tst=edit1" method="POST">
     <!--  <h1>edit patient</h1> -->
    <?php


    ?>
      <input type="text" name="name" class="form-control" value="<?php echo $pa['p_name'] ?>" />
      <input type="text" name="age" class="form-control" value="<?php echo $pa['p_age'] ?>" />
      <input type="text" name="mail" class="form-control" value="<?php echo $pa['p_email'] ?>" />
      <input type="text" name="phone" class="form-control" value="<?php echo $pa['p_phoneNumber'] ?>" />
      <input type="text" name="adress" class="form-control" value="<?php echo $pa['p_adress'] ?>" />
      <input type="hidden" name="id" class="form-control" value="<?php echo $pa['p_id'] ?>" />

  <?php
      if($pa['p_gender'] == 1){$cor ="selected";}else{$cors ="selected";}

    ?>
    <select class="form-control" name ="gender">
      <option value=1 <?php if(isset($cor)){echo $cor; }   ?> >male</option>
      <option value=0 <?php if(isset($cors)){echo $cors ;} ?> >female</option>
    </select>
    <input type="submit" class="form-control btn btn-primary" />
    </form>

    <?php
    }
    ?>
                <div class='modal-footer' class="btn btn-default" data-dismiss="modal" >
                  Close
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>


















        </div>
      
  <?php
}elseif($tst =='addbill'){
                    ++$Bill;
                if(!addbill($Bill,$_GET['id'])){

                   header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
                       }else{echo "error happen chek out the moron who program thissite";}

}elseif($tst == 'edit1'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name  = $_POST['name'];
      $age   = $_POST['age'];
      $email = $_POST['mail'];
      $phone = $_POST['phone'];
      $adres = $_POST['adress'];
      $gender= $_POST['gender'];
      $id    = $_POST['id'];
      editPatient($name,$age,$email,$adres,$gender,$phone,$id);
      header("location:patients.php?id=$id"); exit();

}}



}else{
    header("location:signin.php");
    exit();
}

include $temple."footer.php";
