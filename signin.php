<?php
  session_start();
  $left="";
  $title='sign In';
  include "init.php";

      if(isset($_SESSION['lab'])){
           header('location:index.php');
               exit();
      }

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
          $name    = trim($_POST['lab']);
          $pass    = trim($_POST['pass']);
          $hashpas = sha1($pass);
          
          //database check
          $stmt=$con->prepare("SELECT u_id, name ,password,u_state FROM user WHERE name= ? AND password=? ");
          $stmt->execute(array($name,$hashpas));
          
          $found=$stmt->rowCount();
          if($found>0){
                  $record = $stmt->fetch();
                  $_SESSION['lab']    =$name;
                  $_SESSION['id']     =$record['u_id'];
                  $_SESSION['admin']  =$record['u_state'];
               header('location:index.php'  );
               exit();
          }
            }

      ?>

        <!--    form for doctor-->
<!--         <div class="images"><img src ="img/flatmix_06.png"></div>
 -->        <div class="images1"><img src ="img/45240-O4FYFK.jpg">
      <div class="container">
          <div  class="form-sign">
              <h2 class="lab-n">Life labrotary</h2>

                <form method='POST' action='<?php  echo $_SERVER['PHP_SELF']?>' >
                  <h5 class="form-into">Welcome To the Life labrotary</h5>
                  <input class="form-in form-control" type='text' name="lab" placeholder='userName' autocomplete='off' required  />
                  <input class="form-in form-control" type='password' name="pass" placeholder='password' autocomplete='new-password' required  />
                    <button type="submit" class="form-in btn btn-primary" />Sign In <i class='fa fa-sign-in' aria-hidden='true'></i></button>

                  

              </form>
              <?php
                      if(isset($found) && $found<=0){
                          echo '<div class="alert alert-danger">password or username is failed</div>';
                      }
              
              ?>

              </div>

        </div>
        <div class="introduction">
          <h2>Lorem upsum</h2>
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
          Lorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsumLorem upsum
        </div>
   </div> 

       