<?php
session_start();
if(isset($_SESSION['lab'])){
$title='manage test';
$tst   = $_GET['tst'] ?? 'manage';


if($tst == 'manage'){

	include "init.php";
	
	$labs  = getLab();
	$group = getGroup();
	
	
	// if(isset($_GET['lab'])){echo "you add labrotary succesful";}
	// if(isset($_GET['group'])){echo "you add group succesful";}
?>
	
<div class="container">
<div class="breadcrumbss">
			<div class="breadcrumbs_inner">
				<ul>
					<li><a href="index.php">Home</a><span>«</span></li>
					<li>Manage test</li>
					
				</ul>
			</div>
		</div>

	<div class="testimge"></div>
 <div class="intro"><h1><i class="fa fa-heartbeat"></i>Manage Test</h1></div>
    <div class="test-control">
       
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd1">+ lab</button>
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd2">+ group</button>
            <button class="btn btn-primary" data-toggle="modal" data-target=".bd3">+ test</button>

     </div>
     
<div class="selectgroup">
        <select id='groip'>
        <option></option>
            <?php
                foreach($group as $gro){

                    echo "<option value=".$gro['tc_id']." id='gro'>".$gro['tc_name']."</option>";
                
                    }

            ?>
        </select>
         <button id="searchgroup" class="btn btn-info ri"> filter </button>
</div>

     <div class="datat" >
    <table class="" id="table">
        <thead>
            <tr><th>T_Name</th><th>T_acrynom</th><th>T_normalValues</th><th>T_price</th><th>Control</th><th></th></tr>
        </thead>
        <tbody id="testshow">
            <?php
                foreach (testAll() as $value) {
            ?>
            <tr>
                <td><?php echo $value['t_name']; ?></td>
                <td><?php echo $value['t_acrynom']; ?></td>
                <td><?php echo $value['t_normalvalue']; ?></td>
                <td><?php echo $value['t_price']; ?></td>
                <td>
    <a href="test.php?tst=edit&id=<?php echo $value['t_id'];?>" class="btn btn-info" data-toggle="modal" data-target=".bd4" >edit</td>
                <td>
    <a href="test.php?tst=delete&id=<?php echo $value['t_id']; ?>" class="btn btn-danger sure">delete</a></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
    </table>
</div>
<?php
                ?>
    </div>
<div class="modal fade bd1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <button class="close" type="button" data-dismiss="modal">&times</button> 
      	<div class="form-group">
     		<h2>Add lab</h2>
     			<form action="test.php?tst=addl" method="post">
     				<input type="text"  name="lab" class="form-control" placeholder="labrotary Name" />
     				<input type="submit" class="form-control btn btn-primary"  > 
     			</form>
		</div>
    </div>
  </div>
</div>
<div class="modal fade bd2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <button class="close" type="button" data-dismiss="modal">&times</button> 
      	<div class="form-group">
     		<h2>Add Group</h2>
     			<form action="test.php?tst=addg" method="POST">
     					<input type="text" name="group" class="form-control" placeholder="group name" />
						<select name="lab" class="form-control" required>
								<option>labrotary</option>
								<?php
									foreach ($labs as $lab) {
										echo "<option  value= '".$lab['l_id']."'>".$lab['l_name']."</option>";
									}

								?>
						</select>
						 <input type="submit" class="form-control btn btn-primary" /> 

	     			</form>
		</div>
    </div>
  </div>
</div>
<div class="modal fade bd3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <button class="close" type="button" data-dismiss="modal">&times</button> 
      	<div class="form-group">
     		<h2>Add Test</h2>
     		<form action ="test.php?tst=addt" method="POST">
     			<input type="text" name="name" class="form-control" placeholder="Test Name" />
     			<input type="text" name="acy" class="form-control" placeholder="Test Acrynom" />
     			<input type="text" name="normal" class="form-control" placeholder="Test normalValue" />
     			<input type="text" name="unit" class="form-control" placeholder="Test Units" />
     			<input type="number" name="price" class="form-control" placeholder="Test price" />
     				<select name="group" class="form-control" required>
								<option>Test Grop</option>
								<?php
									foreach ($group as $lab) {
										echo "<option  value= '".$lab['tc_id']."'>".$lab['tc_name']."</option>";
									}

								?>
						</select>
     			<input type="submit" class="form-control btn btn-primary" /> 
     		</form>
		</div>
    </div>
  </div>
</div>
<div class="modal fade bd4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      	<div class="form-group">
     		
		</div>
    </div>
  </div>
</div>
<?php
}elseif($tst == 'addl'){
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$lab=$_POST['lab'];
	addLab($lab);
	header('location:test.php?lab=sucess');
	exit();
}
}elseif($tst == "addg"){
	include "init.php";
	if($_SERVER['REQUEST_METHOD'] == "POST"){

			$name = $_POST['group'];
			$lab  = $_POST['lab'];
			addGroup($name,$lab);
			header("location:test.php?group=success");
			exit();

	}

}elseif($tst == "addt"){
	include "init.php";
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			$name = $_POST['name'];
			$acr  = $_POST['acy'];
			$norma= $_POST['normal'];
			$unit = $_POST['unit'];
			$price= $_POST['price'];
			$group= $_POST['group'];
			addTestT($name,$acr,$price,$norma,$unit,$group);
			header("location:test.php?test=su");
			exit();

}
}elseif($tst == 'edit'){
	$left ="";
	$foot="";
	include "init.php";
	$group = getGroup();
	$id = $_GET['id'];

			foreach(getTest($id) as $test){
			?>
						 <button class="close" type="button" data-dismiss="modal">&times</button> 

			<h2> Edit test</h2>
		<form action ="test.php?tst=edit1" method="POST">
     			<input type="text" name="name" class="form-control"  value="<?php echo $test['t_name']; ?>"/>
     			<input type="text" name="acy" class="form-control"  value="<?php echo $test['t_acrynom']; ?>"/>
     			<input type="text" name="normal" class="form-control"  value="<?php echo $test['t_normalvalue']; ?>"/>
     			<input type="text" name="unit" class="form-control" value="<?php echo $test['units']; ?>" />
     			<input type="number" name="price" class="form-control"  value="<?php echo $test['t_price']; ?>"/>
     			<input type="hidden" name="id" value="<?php echo $test['t_id']; ?>"/>
     		
     				<select name="group" class="form-control" required>
								<option value="<?php echo $test['tc_id'];?>" selected>
										<?php
				foreach(groupid($test['tc_id']) as $so) {
				    echo $so['tc_name'];
						}
							?>
								</option>
						<?php
								foreach($group as $gr){
									echo '<option value='.$gr['tc_id'].'>'.$gr['tc_name'].'</option>';
								}
						?>
						</select>
					
					<?php
							// var_dump(groupid($test['tc_id']));
					?>
     			<input type="submit" class="form-control btn btn-primary" /> 
     		</form>
<?php
}
}elseif($tst == 'edit1'){
	include "init.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$tid  = $_POST['id'];
			$name = $_POST['name'];
			$acr  = $_POST['acy'];
			$norma= $_POST['normal'];
			$unit = $_POST['unit'];
			$price= $_POST['price'];
			$group= $_POST['group'];
			echo $group;
			editTestT($name,$acr,$price,$norma,$unit,$group,$tid );
			header("location:test.php?update=su");
			exit();

}



}elseif($tst == 'delete'){
include "init.php";
			$id= $_GET['id'];
			delete('tests','t_id',$id);
			header("location:test.php");
			exit();



}else{header("location:404.php"); exit();}


}else{

	header("location:signin.php"); exit();
}

	include $temple."footer.php";
