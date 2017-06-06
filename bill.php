<?php

session_start();

if(isset($_SESSION['lab'])){
	$title='Patient Bill';
	

	$tst = $_GET['tst'] ?? 'manage';
	if(!isset($_GET['p_id']) || !isset($_GET['b_id'])){echo "nothin here";}else{
    $p_id=isset($_GET['p_id']) & is_numeric($_GET['p_id']) ? intval($_GET['p_id']) : 0 ;//VALIDATE itema AND SECURE IT FROM SMARTASS
    $b_id=isset($_GET['b_id']) & is_numeric($_GET['b_id']) ? intval($_GET['b_id']) : 0 ; }
if($tst == 'manage'){ 

	include "init.php";
	$record =   getRecord($b_id);
      //patient info
	$sum=0;
	$patientDoctor =   getpatient($p_id);
	$testGroup     =  testGroup();
	$bill          =  billl($b_id);
	$billTest      =  testResult($b_id);
	$tests         =  testAll();
	$selectedtest  =  array();

	foreach ($bill as $bil) {
		if($bil['b_status'] == 1 OR $bil['b_status'] == 2 ){$active = 'destroy hahah';}
		if($bil['b_status'] == 2){$printed='ok';}	}
		foreach($billTest as $tesb){
			$sum +=$tesb['t_price'];
		}
		
?>

	<div class="container">
		 <div class="breadcrumbss">
              <div class="breadcrumbs_inner">
                <ul>
                  <li><a href="index.php">Home</a><span>«</span></li>
                  <li><a href="managepatient.php">Patients</a><span>«</span></li>
                  <li><a href="patients.php?id=<?php echo $p_id ; ?>">PatientPage</a><span>«</span></li>
              <li>Bill #<?php 
		         			 foreach ($bill as $key) {
		         		echo 'Bill Number #'.$key['b_number']; 

		         		}
		         		?> </li>
            </ul>
            </div>
         </div>   
         <?php
		         		foreach($patientDoctor as $paiDoc){
		         	?>
         <div class="bilimg"></div>
	         <div class="patient-info">
	         	<div class="heding"><i class="fa fa-user"></i> <?php echo $paiDoc['p_name']; ?></div>
		         <div class="billing">
		         	
		         		<p class='name'></p>
		         		</br>
		         		<?php 
		         			 foreach ($bill as $key) {
		         		echo 'Bill Number #'.$key['b_number']; 

		         		}
		         		?> 
		         		

		         	<?php
		         		}
		         	?>
		         	<p class='name'></p>
		         </div>
			         
		       <!--   <img  class="new" src="img/flatmix_06.png"	/> -->
		       <!-- money -->
		       <?php
		if(!empty($billTest)){
		       foreach($bill as $bil){
		       	?>

		       	<div class="price-bill">
		       		<div class=""><i class="fa fa-money" aria-hidden="true"></i>
		       			money$__$</div>
		       			<ul>
		       			<li><span><?php echo " total price :</span> ".$sum; ?>$</li>
		       				<li><span>Paid</span>:<?php echo $bil['b_paid_amount']; ?>$</li>
		       				<li><span>Remain</span>: <?php echo ($sum - $bil['b_paid_amount']);?> $</li>
		       			</ul>
		       			<?php
		       			if(!isset($printed)){
		       				?>
		       				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd1">check paid info</button>
		       				<?php
		       			}
		       			?>


</div>

		       		<?php

		       	}



		       	?>
</div>
    <!-- here test and edit it  -->
    	<div class="patient-info Patient">
    		<div class="heding">Patient test</div>

    		<table class="name">
    			<thead>
    				<tr><th> test_name </th><th> test_result</th> <th> control</th><th></th></tr>
    			</thead>
    			<?php
    			foreach($billTest as $tesb){
    				$selectedtest[] = $tesb['t_id'];
    				?>
    				<form action ="bill.php?tst=edit" method="POST">
    					<?php
    					echo '<tr>';

    					echo '<td><label for="check'.$tesb['t_id'].'">'.$tesb['t_name'].'</label></td>';
    					if(empty($tesb['result'])){
    						echo '<td> <input type="text" name ="result" class="form-control" value ="'.$tesb['result'].'"/></td>';


    						echo '<td><button type="submit" class="btn btn-info"> <i class="fa fa-pencil" aria-hidden="true"></i> </button>';


    						echo '<a class="btn btn-danger sure" href="bill.php?tst=delete&b_id='.$b_id.'&t_id='.$tesb['t_id'].'&p_id='.$p_id.'"> <i class="fa fa-times" aria-hidden="true"></i></a></td>';
    					}else{echo '<td> '.$tesb['result'].'</td>';
    					if(!isset($active)){
    						echo '<td>
    						<a href="bill.php?tst=edittest&b_id='.$b_id.'&p_id='.$p_id.'&t_id='.$tesb['t_id'].'" class="btn btn-info testmodal btn-sm"  data-id="" data-toggle="modal" data-target=".bdedit" ><i class="fa fa-pencil-square-o " aria-hidden="true"></i> </a></td>';
    					}               

    				}
    				echo '<input type="hidden" name ="pid"  value ="'.$p_id.'"/>';
    				echo '<input type="hidden" name ="billid"  value ="'.$b_id.'"/>';
    				echo '<input type="hidden" name ="tid"  value ="'.$tesb['t_id'].'"/>';
    				if(empty($tesb['result'])){

    				}
    				echo '</tr>';


    				?>
    			</form>
    			<?php   

    			
    		}
    		?>





    	</table>
    	<?php  if(isset($active)){ ?>
    	<a  class="btn btn-primary " href="print.php?b_id=<?php echo $b_id ;?>&p_id=<?php echo $p_id; ?>&price=<?php echo $sum; ?>">print</a>

    	<?php
    }


    if(empty($record)){

    	if(!isset($active)){
    		?>

    		<a  class="btn btn-primary " href="bill.php?tst=repo&id=<?php echo $b_id ; ?>&pid=<?php echo $p_id; ?>" id='record'><!-- <i class="fa fa-plus"></i> --> + Report</a>

    		<?php

    	}           
    }

    ?>
    <?php if(!isset($active)){?>
    <a class="btn btn-danger  pending sure"  id="pending" href="bill.php?tst=pending&billid=<?php echo $b_id; ?>" > pending </a>
<?php
    }
?>
    	</div>
    	<?php
    foreach($record as $rc){
        ?>
        <div class="patient-info">
        <div class="heding">Report</div>
            <form action='bill.php?tst=editRec&id=<?php echo $rc['b_id'] ;?>' method ='post'>
                <textarea class="form-control txt-record" name='rec'>
                    <?php
                    echo htmlspecialchars($rc['b_record']);
                    ?>
                </textarea>
                <input type='hidden' name='pid' value=<?php echo $p_id;?> >
                <input type='submit' value='Edit' class='btn btn-primary btn-sm sure'>
                <a class='btn btn-danger btn-sm sure' href='bill.php?tst=delrec&bid=<?php echo $rc['b_id'] ;?>&pid=<?php echo $p_id ;?>' > Delete </a>
            </form>

        </div>

        <?php
    }
?>


		     
		<?PHP
	}

		?>

	<?php	       if(!isset($active)){
    ?>
  

    <!-- here test and edit it  -->
    <div class="patient-info backpa">
    
    <div class='heding'><i style="color:white;" class='fa fa-hospital-o'></i> choose tests</div>
        <form action="bill.php?tst=add" method="post">
            <select name='testsArray[]' id="mulSelect" class="mul" multiple>
    <?php
            
            
                        foreach($tests  as $test){

                            if(in_array($test['t_id'],$selectedtest)){
                                echo "<option disabled>
                                ".$test['t_name']."
                                </option>";
                            }else{
                                echo "<option value=".$test['t_id'].">
                                ".$test['t_name']."
                                </option>";
                        }
                    }

    ?>
    </select>
            <input type="hidden" value="<?php echo $b_id ;?>" name="bill" />
            <input type="hidden" value="<?php echo $p_id ;?>" name="pat" />
            <div class='butonTestSelect'>
            <input type="submit"  class="btn btn-primary btn-sm btnbill"/></div>
        </form>
    </div>
<?php

        }
?>




















<div class="modal fade bd1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="form-group">

            <h2>check amount</h2>
                <form action="bill.php?tst=addb" method="post">
                    <input type="text"  name="paid" class="form-control"  <?php
                    if(!empty($bil['b_paid_amount']))
                    {echo "value=".$bil['b_paid_amount'];}else{echo "placeholder=paidAmount";}
                    ?>"  />
                    <input type="hidden"  name="sum" class="form-control" value ="<?php echo $sum ; ?>"  />
                    <input type="hidden"  name="id" class="form-control" value ="<?php echo $bil['b_id'] ; ?>"  />
                    <input type="hidden"   class="form-control" value="1234142451564werqw" />
                    <input type="hidden" value="<?php echo $b_id ;?>" name="bill" />
                    <input type="hidden" value="<?php echo $p_id ;?>" name="pat" />
                    <input type="submit" value="update info" class="form-control btn btn-primary btn-sm"  >
                </form>
        </div>
         <div class='modal-footer' class="btn btn-default" data-dismiss="modal" >
                  Close
                </div>
    </div>
  </div>
</div>

<div class="modal fade bd12" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="form-group">

        </div>
    </div>
  </div>
</div>
<div class="modal fade bdedit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="form-group">
        <button class="close" type="button" data-dismiss="modal">&times</button>
            Edit this test <hr>
                <form action="bill.php?tst=edittest" method="post">
                    <input type="test" class=" form-control" name="test" id="test" >
                    <input type="hidden" name="pid" value="<?php echo $p_id;?>" />
                    <input type="hidden" name="billid" value="<?php echo $b_id;?>" />
                    <input type="submit" class="btn btn-primary">
                </form>
        </div>

  </div>
</div>

	</div>


























<?php
	}elseif($tst == 'add'){
		include "init.php";
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$bill_id = $_POST['bill'];
			$pati_id = $_POST['pat'];
			$user_id = $_SESSION['id'];
			$tests   = $_POST['testsArray'];
			$count   = count($tests);
			// var_dump($tests);
			// echo $count;

		for($counter = 0;$counter < $count ;$counter++){
			// echo "<br/>".$tests[$counter];
			addTest($bill_id,$tests[$counter],$user_id);
		}

		// header('location:bill.php?p_id='.$pati_id.'&b_id='.$bill_id );
		 $url = isset($_SERVER['HTTP_REFERER']) &&  $_SERVER['HTTP_REFERER'] !== '' ?  $_SERVER['HTTP_REFERER'] : 'index.php';
header("location:$url ");
			exit();
	}else{echo "out of here -__-";}
	}elseif($tst  == 'edit'){
		include "init.php";
		 if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$result = $_POST['result'];
			$p_id   = $_POST['pid'];
			$t_id   = $_POST['tid'];
			$b_id   = $_POST['billid'];
			
			editTest($result,$b_id,$t_id);
			header("location:bill.php?sucsess=1&p_id=".$p_id."&b_id=".$b_id);
			exit();

	}else{echo "out of here" ;}}elseif($tst == 'delete'){
include'init.php';
		$b_id=$_GET['b_id'];
		$t_id=$_GET['t_id'];
		$P_id=$_GET['p_id'];
		deleteTestBill($b_id,$t_id);
			header("location:bill.php?sucsess=1&p_id=".$P_id."&b_id=".$b_id);
		exit();
	}elseif($tst == 'repo'){
		include "init.php";
			$id  = $_GET['id'];
			$pid = $_GET['pid'];
			if(addRecord($id) == 1)
			{
				header("location:bill.php?sucsess=1&p_id=".$pid."&b_id=".$id);
				exit();

			}



	}elseif($tst == 'editRec'){
		include "init.php";
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$pid   = $_GET['id'];
			$bid   = $_POST['pid'];
		$result = $_POST['rec'];

		editRecord($result,$pid);
		header("location:bill.php?sucsess=1&b_id=".$pid."&p_id=".$bid);
		exit();
	}

}elseif($tst == 'delrec'){
	include "init.php";
			$b_id =$_GET['bid'];
			$p_id =$_GET['pid'];
			delRecord($b_id);
			header("location:bill.php?sucsess=1&p_id=".$p_id."&b_id=".$b_id);
			exit();



}elseif($tst == "pending"){
			include "init.php";
			$id = $_GET['billid'];
			echo $id;
			pending($id);
			header('Location: '. $_SERVER['HTTP_REFERER']);
			exit();


}elseif($tst == 'addb'){
	include "init.php";
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				    $bill_id = $_POST['bill'];
			        $pati_id = $_POST['pat'];
					$id     = $_POST['id'];
					$paid   = $_POST['paid'];
					$sum    = $_POST['sum'];
					updatePaid($paid,$sum,$id);
					header("location:bill.php?p_id=".$pati_id."&b_id=".$bill_id);
					exit();

			}


	}elseif($tst == "edittest"){

				$left='';
				$foot='';
			include'init.php';
			$tid=$_GET['t_id'];
			$bid=$_GET['b_id'];
			foreach(getTestBill($bid,$tid) as $tbl){
			
		?>
			Edit this test 
      			<form action="bill.php?tst=edittest" method="post">
      			<hr/>
      				<input type="test" class=" form-control"  value="<?php echo $tbl['result'];?>" name="test" id="test" >
      				<input type="hidden" name="pid" value="<?php echo $p_id;?>" />
      				<input type="hidden" name="billid" value="<?php echo $b_id;?>" />
      				<input type="hidden" name="tid" value="<?php echo $tid;?>" />
      				<input type="submit" class="btn btn-primary" style="margin:5px;">
      			</form>
      			 <div class='modal-footer' class="btn btn-default" data-dismiss="modal" >
                  Close
                </div>
   
      <?php
  }
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$result = $_POST['test'];
				$bill_id= $_POST['billid'];
				$t_id   = $_POST['tid'];
				$p_id   = $_POST['pid'];
				
			editTest($result,$bill_id,$t_id);
			header("location:bill.php?sucsess=1&p_id=".$p_id."&b_id=".$bill_id);
			exit();

			}
		}else{ header("location:404.php"); exit();}


}else{

	header("location:signin.php"); exit();
}
include $temple."footer.php";

?>
