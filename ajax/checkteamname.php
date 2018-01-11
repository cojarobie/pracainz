<?php

  session_start();

  $teamName = $_POST['teamName'];
  $exists = false;
  
  require_once '../connection.php';
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      if ($result = $connection->query("SELECT * FROM teams WHERE Name='$teamName'")) {
        if ($result->num_rows > 0) {
          $exists = true;
        }
        $result->free();
      }
      
      echo json_encode(array('nameExists' => $exists));
      
      $connection->close();
    }
  } catch(Exception $e) {
    
  }
?>