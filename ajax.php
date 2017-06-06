<?php

$left="";
include "init.php";
global $con;
  $id = $_GET['id'] ?? 0;
    $stmt1 =$con->prepare("SELECT * FROM tests WHERE t_id = ? ");
    $stmt1->execute(array($id));
    $tests = $stmt1->fetchAll();

    foreach ($tests as $key) {

      echo '<pre>';
      var_dump($key);
      # code...
    }
