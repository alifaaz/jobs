<?php
session_start();
if(isset($_SESSION['lab'])){
    $title="purchases";
include "init.php";
$tst  = $_GET['tst']??'manage';
$sum=0;
if($tst == 'manage'){
?>
  


<div class="container">
<div class="breadcrumbss">
      <div class="breadcrumbs_inner">
        <ul>
          <li><a href="index.php">Home</a><span>«</span></li>
          <li>Purchases</li>
          
        </ul>
      </div>
    </div>
    <div class="buying"></div>
   <div class="intro"> <h1 ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Monthly  Purchases </h1></div>

    <div class='inser-mat'>
        <button type="button" name='add' id='add' data-toggle="modal" data-target="#add_mat" class='btn btn-primary'><i class="fa fa-plus"></i> Add_item </button><br/>
        <input type="text" id="material" /><button id="filtermat" class="btn btn-info">filter</button>
    </div>
    <div id="materi">
      <div class=' ' >
                   <h4  style="background-color:#f3faff; padding:10px;">Purchases for #<?php echo date('M');?></h4> 

          <table class='' id="table">

             
             <thead>
                 <tr>
                   <th> item</th><th> num</th><th> unit</th><th> price</th><th> date</th><th> control </th>
               </tr>
           </thead>
           <tbody>
           <?php foreach(getMat() as $mat) {?>
           <tr> 
             <td> <?php echo $mat['m_name'] ;?> </td> 
             <td> <?php echo $mat['m_num'] ;?> </td> 
             <td> <?php echo $mat['m_unit'] ;?> </td> 
             <td> <?php echo $mat['price'] ;?> </td> 
             <td>
               <?php echo $mat['m_date'] ; ?>
           </td>
           <td>
              <a href="material.php?tst=delete&id=<?php echo $mat['m_id']; ?>" class="btn btn-danger"><i class="fa fa-cross"></i>delete</a></td>
        </tr>
        <?php 
        $sum=$sum+$mat['price'];

    }


    ?>
    </tbody>
</table>
</div>
<div class="matprice">Total Amount : <?php echo $sum ;?></div>
</div>
</div>

<div class="modal fade" id="add_mat">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button class="close" type="button" data-dismiss="modal">&times</button> -->
            <!-- <h3 class="modal-title">insert mterila this month</h3> -->
            <div class="modal-body">
              <div class='material-form'>
                <h3 class="modal-title">insert items </h3>
                <form action="material.php?tst=add" method="POST">
                    <input type="text" name="name" id="name" class="form-control " placeholder ="itemName" required />
                    <input type="number" name="num"  id="num" class="form-control " placeholder ="itemNum" required />
                    <input type='text' class='form-control '  placeholder="unit" name='unit' id='unit' />
                    <input type='money' class='form-control '  placeholder="price" name='price' id='price'>

                    <input type="submit" style="margin:5px;" value ="insert" class="btn btn-primary btn-sm" name='insert' id='insert'/>

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
            <!-- -->


</div>
<?php
}elseif($tst == 'add'){
      if($_SERVER['REQUEST_METHOD'] == "POST"){
        $name     = $_POST['name'];
        $Num      = $_POST['num'];
        $unit     = $_POST['unit'];
        $price    = $_POST['price'];
        inserMAt($name,$Num,$unit,$price);
        header("location:material.php"); exit();
      }

}elseif($tst == 'delete'){
          $id= $_GET['id'];
          deleteMat($id);
          header("location:material.php"); exit();

}elseif($tst== 'edit'){


  }else{header('location:404.php'); exit();}
include $temple."footer.php";
}else{header("location:signin.php"); exit();}
 ?>
