<?php
session_start();
if(isset($_SESSION['lab'])){
	$title = 'doctor page';
	include "init.php";
	$tst=$_GET['tst']??'manage';
	$id=isset($_GET['id']) & is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
		if($_SESSION['admin'] == 1){$id = $_SESSION['id']; }

		
	$user=getDoctorD($id);
	if($tst == 'manage'){

  foreach($user as $use){
?>
		<div class="container">
			<div class="breadcrumbss">
			<div class="breadcrumbs_inner">
				<ul>
					<li><a href="index.php">Home</a><span>«</span></li>
					<li><a href="doctor.php">Doctors</a><span>«</span></li>
					<li>Doctor</li>
					
				</ul>
			</div>
		</div>
		<div class="patient-info docss">
		<img src= "img/OMUNMN1.png" >

				<div class="heding">Docror #<?php echo $use['d_name']; ?> Info</div>
				<h3><span class="fa">Name:</span> <?php echo $use['d_name']; ?><?php ?></h3>
                  <p>
                  <i class=" fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal">
                  </i>
                  <?php echo $use['d_email'];?>
                  </p>
                  <p><i class=" fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $use['d_phone'];?></p>
	                  <p><i class=" fa fa-home  fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $use['d_adres'];?></p>  
	                  <p><i class=" fa fa-user-md  fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $use['d_specilist'];?></p>
                 <div class="Patient">                  <button class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bd"> <i class="fa fa-plus"></i>edit</button></div>


		</div>

		<div class="patient-info">

		  <div class="heding"> <i style="color:#fff" class="fa fa-calendar" aria-hidden="true"></i> <?php echo date('M') ?></div>
		  <div class="name"></div>
			  <div class="form-group">
                            <input type="text" id="doctype" name ='datee' class="form-control1 " placeholder="choose Month"> 
                            <input type="number" id="rate" name ='rate' class="form-control1" placeholder="Rate"> 
                             <input type="hidden" id="did" value="<?php echo $use['d_id'];?>" />
                            <button class="btn btn-info" id="filterdoc">filter</button>
                        </div>
                        <div class="doctorstatistics" id='doctorstatistics'>
                            
                                <!-- <div class='staticss'><span>
                                    
                                </span>
                                <span>
                                </span></div> -->
                                <div class="row" id="row">
                                <div class="col-md-12">
                              </div>
                                    <div class="col-md-4">
                                        <div class="static">
                                         <h1 class="stahead"><i class="fa fa-users"></i> patients</h1>
                                        <span > 

                                       
                                                <?php 
                                            foreach(getPatientDoc($use['d_id']) as $doc){
                                            	$con=$doc['con'];
                                                echo $doc['con'];
                                                        }
                                                ?>
                                         <p>
                                            
                                          </p> </span>
                                      </div>
                                    </div>
                                <!--     <div class=' col-md-4'>
                                        <div class="static">
                                         <h1 class="stahead"><i class="fa fa-money"></i> money</h1>
                                        <span>
                                        
                                        <?php
                                        	// if(isset($con)){
                                        	// 	echo ($con * 2) . "$";
                                        	// }
                                        ?>

                                        </span>
                                      </div>
                                    </div> -->
                                </div>
                        </div>  
		</div>
	</div>
	 


<?php

}
?>
<div class="modal fade bd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      	<div class="form-group">
      		<h3> edit Doctor</h3>
      		<hr />
      		<?php
      			foreach($user as $us){
      		?>
		<form   action="doctors.php?tst=updatep" method ="POST" >
			 <input type="text"   name ="name"   class="form-control" placeholder="name"   value="<?php echo $us['d_name'] ;?>" />
			 <input type="text"   name ="spas"   class="form-control" placeholder="spasilist" value="<?php echo $us['d_specilist'] ;?>" />
			  <input type="text"  name ="phone"   class="form-control" placeholder="PoneNumber" value="<?php echo $us['d_phone'] ;?>" />
			 <input type="email"  name ="email" class="form-control" placeholder="email"  value="<?php echo $us['d_email'] ;?>" />
			 <input type="text"   name ="address"  class="form-control" placeholder="Adress"  value="<?php echo $us['d_adres'] ;?>" />
			 
			 <input type="hidden"    name ="id"  class="form-control" placeholder="Adress"  value="<?php echo $us['d_id'] ;?>" />
			
						<br />
			 <input type ="submit" class="btn btn-primary  form-control" >
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

<?php
	}elseif($tst == 'updatep'){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$name   = $_POST['name'];
				$mail   = $_POST['email'];
				$phone  = $_POST['phone'];
				$addres = $_POST['address'];
				$spas   = $_POST['spas'];
				$id     = $_POST['id'];
				
				editDoctorr($name,$spas,$phone,$mail,$addres,$id);
				header("location:doctors.php?id=".$id); exit();
			
			}
		}else{ echo "error 404";}


}else{

	header("location:signin.php");
}
include $temple."footer.php";