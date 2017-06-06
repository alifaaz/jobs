<?php
session_start();
if(isset($_SESSION['lab']) && $_SESSION['admin'] == 0){
	$title='manage users';
include "init.php";
$tst=$_GET['tst']??'manage';
$user =getData();//data from data base in model.php
$error_box=array();


if($tst == 'manage'){
?>

	<div class="container">
  <div class="breadcrumbss">
      <div class="breadcrumbs_inner">
        <ul>
          <li><a href="index.php">Home</a><span>«</span></li>
          <li>Users</li>
          
        </ul>
      </div>
    </div>
    <div class="imguser"></div>
    <div class="intro">    <h1> <i class="fa fa-male" aria-hidden="true"></i> Users</h1>
</div>
  <div class='inser-doc'>
    <button class="btn btn-primary btn-flat btn-pri " data-toggle="modal" data-target=".bd">
    <i class="fa fa-plus"></i> user</button>
</div>
    <div class="modal fade bd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="form-group">
                <h3> Add user </h3>
                <hr />
                <form   action="user.php?tst=add" method ="POST" >
                   <input type="text"     name ="name"       class="form-control" placeholder="name"      autocomplete="off" />
                   <input type="password" name ="pass"       class="form-control" placeholder="password"  autocomplete="new-password" />
                   <input type="number"   name ="salary"     class="form-control" placeholder="salary"   />
                   <input type="date"     name ="date-hire"  class="form-control" placeholder="hire_date"   />
                   <select name="state" class="form-control ">
                    <option value =-1>user_state</option>
                    <option value = 1 >level-1 (manage patient and doctor)</option>
                    <option value = 2 >level-2 (plus more  purchases , statistics) </option>
                    <option value = 3 >level-3 (plus more manage tests)</option>
                    <option value = 4 >super ( all functions)</option>
                    <option value = 0 >Admin</option>

                </select>
                <br />
                <input type ="submit" class="btn btn-primary  form-control" >
            </form>
            <div class='modal-footer' class="btn btn-default" data-dismiss="modal" >
                  Close
                </div>

        </div>
        <!-- <button class="close" data-dismiss="modal" type="button">cancel</button> -->
    </div>
</div>
</div>
<table class=' ' id="table">
  <thead>
    <tr>
        <th>#ID</th>
        <th>Users</th>
        <th>email</th>
        <th>Phone</th>
        <th>Control</th>
        <th></th>
    </tr>
   </thead>
   <tbody>
    <?php
    foreach ($user as $use){
        echo '<tr>';
        echo '<td>'.$use['u_id'].'</td>';
        echo '<td><a href = "users.php?id='.$use['u_id'].'">'.$use['name'].'</td>';
        echo '<td>'.$use['email'].'</td>';
        echo '<td>'.$use['phone'].'</td>';
        echo '<td><a href= "user.php?tst=delete&id='.$use['u_id'].'" class="btn btn-danger sure">delete</a></td>';
        echo '<td><a href="managepatient.php?tst=edit&id='.$use['u_id'].'" class="btn btn-info" data-toggle="modal" data-target=".bd-exampl">edit</a></td>';
        echo '</tr>';}
        ?>
        </tbody>
    </table>
</div>


<div class="modal fade bd-example" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      	<h2>Edit info</h2>

    </div>
  </div>
</div>


<?php
}elseif($tst == 'add'){


	if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_GET['update'])){

			$name  = $_POST['name'];
			$pass  = $_POST['pass'] ;
			$salary  = $_POST['salary'];
			$date  = $_POST['date-hire'];
			$state  = $_POST['state'] ;
			$hashpass=sha1($pass);


if(empty($error_box)){

		$stmt=$con->prepare("INSERT INTO user(name , password, hire_date,salary,u_state)
			                VALUES (:USER ,:des ,:country,:cas,:use)");
			               $stmt->execute(array(
							'USER'    =>$name,
							'des'     =>$hashpass,
							'country' =>$date  ,
							'cas'     =>$salary,
							'use'     =>$state  ));
			header("location:user.php"); exit();

}

	}



}elseif($tst == 'delete'){

$id=isset($_GET['id']) & is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
	 	$stmt=$con->prepare('DELETE  FROM user WHERE u_id = ? ');
		$stmt->execute(ARRAY($id));
		header("location:user.php"); exit();


}
else{header("location:404.php"); exit();}


}else{header("location:signin.php");
    exit();
}
include $temple."footer.php";
