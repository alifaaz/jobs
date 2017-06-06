<?php
session_start();
if(isset($_SESSION['lab'])){
$title="insert patient";
	$tst       =$_GET['tst']??'manage';
	$error_box =array();


	if($tst == 'manage'){
	$suc  =	$_GET['success']??NULL;
	include "init.php";
		$doctors   =getDoc();
		$user      =$_SESSION['id'];
	?>
	<!-- <div class='message-su'> -->
	<div class="container">
		<div class="breadcrumbss">
			<div class="breadcrumbs_inner">
				<ul>
					<li><a href="index.php">Home</a><span>«</span></li>
					<li>Add patients</li>
					
				</ul>
			</div>
		</div>
    <div class="imgpat"></div>


	
<div class="row">
  <div class="col-md-7">
    <div class="addpatientform patient-info">
  <img src="img/addpat.png" class="addpat" alt="Smiley face" height="42" width="42">


  <div class="heding"><h1> Add patient </h1></div>
  <br>
      <form action="patient.php?tst=add" method="POST" class="form-horizontal" >
        
                        <?php
                        if($suc == 1){ ?>
        <div class='alert alert-success ' id='success-alert'> you add new patient </div>
    
    <?php
}

                    ?>

           <div class="form-group">
        <label class="col-md-2 control-label" for='name'>Name</label>
        <div class="col-md-8">
            <div class="input-group">                           
                
                 <input type="text" class=" form-control"  id='name' name="name" placeholder="paitent name" required />
            </div>
        </div>
    </div>
      <div class="form-group">
        <label class="col-md-2 control-label" for='birth'>BirthYear</label>
        <div class="col-md-8">
            <div class="input-group">                           
                
            <input type="text" class= "form-control" id='birth'  name="age" placeholder="BirthYear" required />
            </div>
        </div>
    </div>
      <div class="form-group">
        <label class="col-md-2 control-label" for='mail' >Email</label>
        <div class="col-md-8">
            <div class="input-group">                           
                
            <input type="text" class="form-control"  id='mail' name="email" placeholder="Email" required />
            </div>
        </div>
    </div>
     <div class="form-group">
        <label class="col-md-2 control-label" for="pho">Phone</label>
        <div class="col-md-8">
            <div class="input-group">                           
                
            <input type="text" id='pho' class="form-control" name="phone" placeholder="phone number" required />
            </div>
        </div>
    </div>
     <div class="form-group">
        <label class="col-md-2 control-label" for="adds">Adress</label>
        <div class="col-md-8">
            <div class="input-group">                           
                
            <input type="text" id="adds" class="form-control" name="Adress" placeholder="Adress" required />
            </div>
        </div>
    </div>
                               
                
            <input type="hidden" class="form-control" name="user" value="<?php echo $user ; ?>"/>
     


<div class="form-group">
    <label for="selector1" class="col-sm-2 control-label">Gender</label>
    <div class="col-sm-8">
    <select name="gender" required  id="selector1" class="form-control1">
               <option>gender</option>
                <option value=1 >male</option>
                <option value=0 >female</option>
    </select>
</div>
</div>

             <div class="" >
   
            <div class="form-group">
            	<label for="selector11" class="col-sm-2 control-label">Doctor</label>
            	<div class="col-sm-8">
            		<select  name="doctor" required  id="selector11" class="form-control1">
            			<option value=100>*****</option>
            			  <?php
                        foreach($doctors as $doc){

                            echo "<option value=".$doc['d_id'].">".$doc['d_name']."</option>";
                        }

                ?>
            		</select>  <a   href="patient.php?tst=addd" data-toggle="modal" data-target=".bd" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Add doctor</a>
            	</div>
            </div>




          
                </div>
<button type="submit" class="btn btn-primary">Submit</button>    </form>
		</div>
	</div>
	<div class="col-md-5">
			
  <table class="patient-table table table-hover" id="table-breakpoint">
             <thead class="thead-default"><tr><th>#Id</th><th>name</th><th>phone</th><th>email</th></tr></thead>
             <tbody>
            <?php
                    foreach(patientable($user) as $ptit){

                            echo "<tr><td>".$ptit['p_id']."</td>";
                            echo "<td><a href='patients.php?id=".$ptit['p_id']."'>".$ptit['p_name']."<a/></td>";
                            echo "<td>".$ptit['p_phoneNumber']."</td>";
                            echo "<td>".$ptit['p_email']."</td>";
                            echo "</tr>";


                    }

            ?>
            </tbody>
        </table>


	</div>

</div>
  <!-- patient table  -->
   
</div>

<!-- 	</div> -->

<!-- Button trigger modal -->

<div class="modal fade bd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    </div>
  </div>
</div>

<?php
}elseif($tst == 'addd'){
			//add doctors  by form here
	$foot="";
	$left="";
	include "init.php";
	?>
	<h2>Add Doctor</h2>
	<form method="post" action="patient.php?tst=updated">
		<input type="text" class="form-control" name="name" placeholder="Doctor name" required />
		<input type="text" class="form-control" name="spc" placeholder="spacilist" required /><br>
		<input type="submit" class="form-control btn btn-primary" />
	</form>
  <div class='modal-footer' class="btn btn-default" data-dismiss="modal" >
                  Close
                </div>

<?php

}elseif($tst == 'updated'){
						//add doctor to database
	include "init.php";
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

          		$name       =   $_POST['name'];
          		$spacilist  =   $_POST['spc'];
          		$er=addDoctor($name,$spacilist);
          	if(!$er){

          		header("location:patient.php");
          	exit();}
          	else{echo "error happen chek out the moron who program thissite";}

          		}

	}elseif($tst == "add"){
		include "init.php";
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

					$name   = $_POST['name'];
					$age    = $_POST['age'];
					$addre  = $_POST['Adress'];
					$email  = $_POST['email'];
					$phone  = $_POST['phone'];
					$gender = $_POST['gender'];
					$doctor = $_POST['doctor'];
					$use   = $_POST['user'];
				$patient   = addpatient($name,$age,$gender,$email,$phone,$addre,$doctor,$use);
				if(!$patient){

					header("location:patient.php?success=1");
          	exit();
				       }
				       else{echo "error happen chek out the moron who program thissite";}

          												}

									}

	else{header("location:signin.php"); exit();}
	}else{header("location:signin.php"); exit();}
	include $temple."footer.php";
