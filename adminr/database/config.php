<?php

   $dsn='mysql:host=localhost;dbname=labrotary';
   $user='root';
   $pass='root';
   $opt=array(
   PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
   );
  try{ 
  $con=new PDO($dsn,$user,$pass,$opt);
  
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
  
  }
  catch(PDOException $ex)
  {
  echo 'loss connection \n'. $ex->getMessage();
  }

