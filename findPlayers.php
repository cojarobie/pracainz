<?php

  $input = $_POST['input'];
  $players = Array();
  
  require_once 'connection.php';
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      if ($result = $connection->query("SELECT * FROM users WHERE  Name LIKE '$input%'")) {
        while ($row = $result->fetch_assoc()) {
          $counter = 0;
          $player = Array('id'=>$row['ID'], 'name'=>$row['Name'], 'surname'=>$row['Surname'], 'nick'=>$row['Nickname'], 'email'=>$row['Email']);
          $players[$counter] = $player;
          $counter++;
        }
      }
      echo json_encode($players);
      $connection->close();
    }
  } catch(Exception $e) {
    
  }
?>