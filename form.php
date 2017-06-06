<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = $_POST['name'];
        $age  = $_POST['age'];
        $mail = $_POST['mail'];

          if(empty($name)){$error_name = 'invalid name';}
          if(empty($age) || $age > 90 || $age <0 || !intval($age)){$error_age = 'invalid age';}
          if(empty($mail)){$error_mail = 'invalid email';}


}
?>






<html></head><title>phpForm</title></head>
    <body>
            <form method="post" action"<?php echo $_SERVER['PHP_SELF']?>">

                Name  : <input type="text" name="name" > <?php if(isset($error_name ) ){echo $error_name ;} ?><br>
                age   : <input type="text" name="age" > <?php if(isset($error_age)){echo $error_age ;}?><br>
                Email : <input type="text" name="mail" ><?php if(isset($error_mail)){ echo $error_mail;}?><br>
                <input type="submit" value="send"><br>
            </form>
    </body>
    </html>
