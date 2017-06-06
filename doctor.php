<?php
session_start();
if(isset($_SESSION['lab'])){
	$title='manage doctors';
	$tst    = $_GET['tst'] ?? 'manage';
	
if($tst == 'manage'){
	include "init.php";
	$doctor =getDoct();
?>
<div class="container">
		<div class="breadcrumbss">
			<div class="breadcrumbs_inner">
				<ul>
					<li><a href="index.php">Home</a><span>«</span></li>
					<li>Doctors</li>
					
				</ul>
			</div>
		</div>
		<div class="imgdoc"></div>
		<DIV class="intro">
	<h1><i class="fa fa-user-md"></i> Doctors</h1></DIV>

	<div class='inser-doc'>
		<button type="button" name='add' id='add' data-toggle="modal" data-target="#add_mat" class='btn btn-primary btn-flat btn-pri'><i class="fa fa-plus" ></i> Add Doctor</button>
	</div>
	<table class="table table-hover" id='table' >
		<thead>	
			<tr><th>Dr</th><th>Spatilist</th><!-- <th>Num.of.patient</th> --><th>control</th></tr>
		</thead>
		<?php
		foreach($doctor as $doc){

			echo "<tr>";
			echo "<td><a href='doctors.php?id=".$doc['d_id']."'>".$doc['d_name']."</a></td>";
			echo "<td>".$doc['d_specilist']."</td>";
			// foreach(numOfPatient($doc['d_id']) as $count){
			// 	echo "<td>".$count['Num']."</td>";
			// }

			echo "<td><a href='doctor.php?tst=delete&d_id=".$doc['d_id']."'class='btn btn-danger btn-sm sure' >delete</a></td>";
			echo "</tr>";
		}
		?>
	</table>
</div>
   

<div class="modal fade bd-example" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">


        </div>
    </div>
</div>



<div class="modal fade" id="add_mat">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
          <!--   <button class="close" type="button" data-dismiss="modal">&times</button> -->
            <!-- <h3 class="modal-title">insert mterila this month</h3> -->
            <div class="modal-body">
              <div class='material-form'>
                <h3 class="modal-title">add doctor </h3>
                <form action="doctor.php?tst=add" method="POST" >

      		<input type="text" name="name" class="form-control " placeholder ="doctorName" required />
      		<input type="text" name="spa" class="form-control " placeholder ="Spatilist" required />
     	<input type='text' class='form-control '  placeholder="Adress" name='adres'>
				<input type='text' class='form-control'  placeholder="phone" name='phone'>
				<input type='text' class='form-control ' placeholder="email"  name='email'>
      		<input type="submit" value =" insert Doctor" class="btn btn-primary inser-doc "/>

		</form>
                <div class='modal-footer' class="btn btn-default" data-dismiss="modal" >
                  Close
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php
}elseif($tst == 'add'){
		include "init.php";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$name = $_POST['name'];
		$spas = $_POST['spa'];
		$adres = $_POST['adres'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		adddoctorr($name,$spas,$adres,$phone,$email);
		header("location:doctor.php"); exit();


	}else{echo "out of her dont come back please";}



}elseif($tst == 'edit'){
	$left="";
	$foot="";
		include "init.php";

	$id = $_GET['d_id'];
?>

	<h2>Edit info</h2>
	<form action="doctor.php?tst=edit1" method ="POST">
		<?php
			foreach(getDoctorD($id) as $doc)
			echo "<input type='text' class='form-control' value='".$doc['d_name']."' name='name'>";
			echo "<input type='text' class='form-control' value='".$doc['d_specilist']."' name='spas'>";
	
			echo "<input type='hidden'  value='".$doc['d_id']."' name='id'>";
		?>
		<input type ='submit' class="btn btn-primary form-control btn-sm" />
	</form>
	<?php
}elseif($tst == 'delete'){
	include "init.php";

	$d_id = $_GET['d_id'];
	delete('doctors','d_id',$d_id);
	header("location:doctor.php"); exit();


}elseif($tst == 'edit1'){
		include "init.php";

	 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	 	$id   = $_POST['id'];
	 	$name = $_POST['name'];
	 	$spas = $_POST['spas'];

	 	editDoctor($id,$name,$spas);
	 	header("location:doctor.php"); exit();


	 }else{header("location:404.php"); exit();}

}else{header("location:404.php"); exit();}


}else{

	header("location:signin.php"); exit();
}

	include $temple."footer.php";
