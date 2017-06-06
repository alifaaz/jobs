<?php



session_start();
if(isset($_SESSION['lab'])){
$title="pending people";
include "init.php";

$pends = pendingstate();
?>
		<div class=" container">

		 <div class="breadcrumbss">
      <div class="breadcrumbs_inner">
        <ul>
          <li><a href="index.php">Home</a><span>«</span></li>
          <li>pending patients</li>
          
        </ul>
      </div>
    </div>
    <div class="bilimg"></div>
		<h1> pending people </h1>
			<table  id="table">
					<thead>
					<tr>	<th>#Name</th><th>billNumber</th><th>billDate</th>
					</tr></thead>
					<?php
					foreach($pends as $pend){
					?>
						<tr>
							<td><a href="bill.php?p_id=<?php echo $pend['p_id'];?>&b_id=<?php echo $pend['b_id']; ?>"><?php echo $pend['p_name']; ?></a></td>
							<td><?php echo $pend['b_number']; ?></td>
							<td><?php echo $pend['b_date']; ?></td>

						</tr>
					<?php
							}
					?>
					
			</table>


		</div>
			





<?php
include $temple."footer.php";
}else{header("location:signin.php"); exit();}