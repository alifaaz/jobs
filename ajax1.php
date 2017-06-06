<?php
  include 'adminr/database/config.php';
  $date = $_POST['dat'];
  $id=$_POST['id'];
  $output='';
  global $con;
  $stmt= $con->prepare("SELECT * FROM `patient` WHERE p_date = ? AND p_id =?");
  $stmt->execute(array($date,$id));
  $record = $stmt->fetchAll();

  $output .="<table>
          <tr>
            <td>
              name
            </td>
          </tr>
          ";
          if($stmt->rowcount()  > 0){
                foreach($record as $rec){
                      $output .="<tr>
                      <td>
                      ".$rec['p_name']."
                      </td>
                      </tr>";
                }

          }else{
            $output .= '<tr>
              <td >
              no such patient
            </td>
            </tr>';
          }
          echo $output;
?>
