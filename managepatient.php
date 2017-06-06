<?php

session_start();
if(isset($_SESSION['lab'])){
	$title='manage patients';
	if(!isset($_GET['page'])){

$page=1;
}else{
$page=$_GET['page'];

}
	$tst = $_GET['tst']?? 'manage';


		if($tst == 'manage'){
			include "init.php";
			$patient  = getPatients();
		// foreach($patient as $pait){
		// 	foreach(billTestResult($pait['p_id']) as $pt){
		// 			if(empty($pt['result'])){
		// 			$tr ="<tr class='table-warning'>";
		// 		}else{$tr= "<tr>";}
		// 	}
		// }

			// static $count=0;
			// $number_of_patient =10;
			// $number_of_patients=count($patient);
			// $number_of_pages   = ceil($number_of_patients/$number_of_patient);
			// $limit =($page-1)*$number_of_patient;
			// $patients =getPatientPagination($limit,$number_of_patient);
						?>


				<div class="container">
                    <div class="breadcrumbss">
            <div class="breadcrumbs_inner">
                <ul>
                    <li><a href="index.php">Home</a><span>«</span></li>
                    <li>Manage patients</li>
                    
                </ul>
            </div>
        </div>
                <div class="imgmana"></div>
            
            <div class="intro">
				<h1><i class="fa fa-users"></i> Patients </h1>
                </div>
					       <table id='table'>
            <thead>

            <tr><th>ID#</th><th>patients</th><th>phone</th><th>email</th><th>Address</th><th></th></tr>
</thead>
<tbody>


            <?php
                foreach($patient as $pait){

                    echo "<tr class='table-'>

                    <td>".$pait['p_id']."</td>";
                    echo "<td><a href='patients.php?id=".$pait['p_id']."' >".$pait['p_name']."</a></td>";
                    echo "<td>".$pait['p_phoneNumber']."</td>";
                    echo "<td>".$pait['p_email']."</td>";
                    echo "<td>".$pait['p_adress']."</td>";
                    echo '<td><a href="managepatient.php?tst=edit&id='.$pait['p_id'].'" class="btn btn-info" data-toggle="modal" data-target=".bd-exampl">edit</a></td>';
                    echo "</tr>";

                }
            ?>
            </tbody>
        </table>

				</div>

			<div class="modal fade bd-exampl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <h2>Edit info</h2>
    </div>
  </div>
</div>

		<?php
		
	}elseif($tst == 'edit'){
            $left="";
            $foot="";
            include "init.php";
            $id     = $_GET['id'];

            $patients =getpatient($id);

        foreach($patients as  $pa){
        ?>
            <form action="managepatient.php?tst=edit1" method="POST">
            <h1>edit patient</h1>
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
        <div class='modal-footer' class="btn btn-default" data-dismiss="modal" >
                  Close
                </div>

<?php
        }}elseif($tst == 'edit1'){
		include "init.php";
		  if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$name  = $_POST['name'];
			$age   = $_POST['age'];
			$email = $_POST['mail'];
			$phone = $_POST['phone'];
			$adres = $_POST['adress'];
			$gender= $_POST['gender'];
			$id    = $_POST['id'];
			editPatient($name,$age,$email,$adres,$gender,$phone,$id);
			header("location:managepatient.php"); exit();

}

	}else{header("location:404.php"); exit();}

}else{header("location:index.php"); exit();}

include $temple."footer.php";
