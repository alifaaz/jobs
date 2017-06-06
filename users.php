<?php
session_start();
if(isset($_SESSION['lab'])){
	$title='user page';
	include "init.php";
	$tst=$_GET['tst']??'manage';
	$id=isset($_GET['id']) & is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
		if($_SESSION['admin'] == 1){$id = $_SESSION['id']; }

		
	$user=getUser($id);
	if($tst == 'manage'){
		foreach($user as $use){

?>
<div class="container">
            <div class="breadcrumbss">
			<div class="breadcrumbs_inner">
				<ul>
					<li><a href="index.php">Home</a><span>«</span></li>
					<li><a href="user.php">Users</a><span>«</span></li>
					<li>User #<?php echo $use['name'] ?></li>
					
				</ul>
			</div>
		</div>
            
            
            <div class="patient-info">
            <div class="person-img">
            <img src="img/usss.png" /></div>
<!--             <div class="name"></div>
 -->                    <?php
                    
                            ?>
                    <div class="heding"><?php echo $use['name'];?></div>
				<h3><span class="fa">Name:</span> <?php echo $use['name']; ?><?php ?></h3>
        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Contact info</b></p>
    <p><i class=" fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $use['phone'];?></p>
    <p><i class=" fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $use['address'];?></p>
    <p><i class=" fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $use['email'];?></p>

     <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Other Infos </b></p>
         <p> <span>Age </span><?php echo $use['age'];?></p>
         <p> <span>Hire_date</span><?php echo $use['hire_date'];?></p>
         <p> <span>Salary </span><?php echo $use['salary'];?></p>
         <p> <span>other info </span><?php echo $use['info'];?></p>

         		<?php
         				if($_SESSION['id'] == $id){
         		?>
                    <div class="Patient"><button class="btn btn-primary btn-lg" data-toggle="modal" data-target=".bd">
                     <i class="fa fa-plus"></i>edit</button>
                    
                     </div>
                  <?php
                  		}
                  ?>

              <?php
               } ?>
            </div>
        </div>
		

<div class="modal fade bd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      	<div class="form-group">
      		<h3> Edit info</h3>
      		<hr />
      		<?php
      			foreach($user as $us){
      		?>
		<form   action="users.php?tst=updatep" method ="POST" >
			 <input type="text"      name ="name"       class="form-control" placeholder="name"   value="<?php echo $us['name'] ;?>" />
			 <input type="email"     name ="email"       class="form-control" placeholder="Email" value="<?php echo $us['email'] ;?>" />
			  <input type="text"     name ="phone"       class="form-control" placeholder="PoneNumber" value="<?php echo $us['phone'] ;?>" />
			 <input type="number"    name ="age"     class="form-control" placeholder="Age"  value="<?php echo $us['age'] ;?>" />
			 <input type="text"      name ="address"  class="form-control" placeholder="Adress"  value="<?php echo $us['address'] ;?>" />
			 
			 <input type="hidden"    name ="id"  class="form-control" placeholder="Adress"  value="<?php echo $us['u_id'] ;?>" />
			 <textarea name="info" class="form-control" placeholder="info about you ,hobeies ,where you study ..."><?php echo $us['info'] ;?></textarea>
			
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
	}
	
		elseif($tst == 'updatep'){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$name   = $_POST['name'];
				$mail   = $_POST['email'];
				$phone  = $_POST['phone'];
				$age    = $_POST['age'];
				$addres = $_POST['address'];
				$id     = $_POST['id'];
				$info   = $_POST['info'];
				editUser($name,$mail,$phone,$age,$addres,$info,$id);
				header("location:users.php?id=".$id); exit();
			
			}
		}else{ header("location:404.php"); exit();}


}else{

	header("location:signin.php");
}
include $temple."footer.php";