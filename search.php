<?php
session_start();
if(isset($_SESSION['lab'])){
    $title="search";
    include "init.php";
    
    $search=$_GET['sech']??'no';
    $stmt=$con->prepare("SELECT * from patient where p_name like '%$search%'");
    $stmt->execute();
    $pate=$stmt->fetchAll();
    
 ?>   
 <div class="container">   
 <div class="breadcrumbss">
      <div class="breadcrumbs_inner">
        <ul>
          <li><a href="index.php">Home</a><span>«</span></li>
          <li>search patients</li>
          
        </ul>
      </div>
    </div>
    <h1><i class="fa fa-search"></i>Search</h1>
<div >
<table id="table">
<thead>
<tr><th>#Id</th><th>name</th><th>phone</th><th>email</th></tr></thead>
<tbody>
            <?php
                    foreach($pate as $ptit){
         

                            echo "<tr><td>".$ptit['p_id']."</td>";
                            echo "<td><a href='patients.php?id=".$ptit['p_id']."'>".$ptit['p_name']."<a/></td>";
                            echo "<td>".$ptit['p_phoneNumber']."</td>";
                            echo "<td>".$ptit['p_email']."</td>";
                            echo "</tr>";


                    }
?>
           
           </tbody>
        </table>
         <?php
    if(empty($pate)){
        echo " ther is no patien like this name =>".$_GET['sech'];
    }
?>
    
</table>
</div>
</div>
<?php    
    
}else{header("location:signin.php"); exit();}
include $temple."footer.php";
