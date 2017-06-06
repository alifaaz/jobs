<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" >
<meta name="viewport" content="width=device-width , initial-scale =1">
<title>
   <?php  echo $title; ?>
</title>
    <link rel="shortcut icon" href="/lab_project/img/lab.ico" />
    <link rel='stylesheet' href='<?php echo $css; ?>bootstrap.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>dataTables.bootstrap.min.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>dataTables.bootstrap.min.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>font-awesome.min.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>jquery-ui.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>jquery.selectBoxIt.css'/>
    <link rel="stylesheet" href='<?php echo $css; ?>multi-select.css' type="text/css">
    <link rel='stylesheet' href='<?php echo $css; ?>dataTables.bootstrap.min.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>select2.min.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>fullcalendar.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>sweetalert.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>flipclock.css'/>
    
    <link rel='stylesheet' href='<?php echo $css; ?>tablestyle.css'/>
    <link rel='stylesheet' href='<?php echo $css; ?>basictable.css'/>
<link rel='stylesheet' href='<?php echo $css; ?>style.css'/>
</head>
<body>
<?php
    if(!isset($left)){
?>
<div class="shy-menu">
  <a class="shy-menu-hamburger">
    <span class="layer top"></span>
    <span class="layer mid"></span>
    <span class="layer btm"></span>
    </a>
   
  <div class="shy-menu-panel">

    <ul>
      <a href="patient.php"><li><i class="fa fa-user" aria-hidden="true"></i> Add Patien</li><a>
      <a href="managepatient.php"><li><i class="fa fa-users" aria-hidden="true"></i> Mangae patients</li></a>
      <a href="doctor.php"><li><i class="fa fa-user-md"></i> Manage Doctor</li></a>
      <a href="user.php"><li><i class="fa fa-male" aria-hidden="true"></i> Manage User</li></a>
      <a href="test.php"><li><i class="fa fa-heartbeat" aria-hidden="true"></i> Manage Test</li></a>
      <a href="statistics.php"><li><i class=" fa fa-area-chart" aria-hidden="true"></i> statistics</li></a>
      <a href="material.php"><li><i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </i>buying</li></a>
      <a ><li>
    <div class="userphoto">
        
        <img src="img/usss.png" id="show" />
        <?php echo $_SESSION['lab']; ?>
        <div class="menu">
            <ul >
            <?php

              // if($_SESSION['id'] == 0){

            ?>
                <li> <a href="users.php?id=<?php echo $_SESSION['id'] ;?>"> profile</a> </li>
            <?php

// }

            ?>

                <li> <a href="logout.php" ><i class="fa fa-sign-out" aria-hidden="true"></i> logOut</a></li>
            </ul>
        </div>
    </div>
     </li>
     </a>

                     <form method="get" action="search.php">
                     <input type="search" name="sech"  placeholder="search_patent">
                     </form>

              <div class="looog">
                <a href="index.php">Home</a>
              </div>
                
    </ul>
      <div class ="foter">
        copyright &copy for alifaaz & Omar Hasan 
      </div>
  </div>
 <!--    <ul class="dropdown-menu">
                        <li>
                            <div class="">
                                <div class="">
                                    <div class="">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>Salman Khan</strong></p>
                                        <p class="text-left small">crazytodevelop@@gmail.com</p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Profile</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                      </ul> -->
</div>

<!-- <div class="menu open">
  <a class="hamburger">
    <span class="layer top"></span>
    <span class="layer mid"></span>
  <span class="layer btm"></span>
  </a>
</div> -->
    <?php
}
    ?>
   