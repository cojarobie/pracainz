<?php

  session_start();

  $input = $_POST['input'];
  $id = $_SESSION['id'];
  $players = Array();
  
  require_once 'connection.php';
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      if (strlen($input) > 0 && $result = $connection->query("SELECT * FROM users WHERE  (Name LIKE '$input%' OR Surname LIKE '$input%' OR Nickname LIKE '$input%' OR Email LIKE '$input%') AND ID != $id")) {
        while ($row = $result->fetch_assoc()) {
          array_push($players, Array('id'=>$row['ID'], 'name'=>$row['Name'], 'surname'=>$row['Surname'], 'nick'=>$row['Nickname'], 'email'=>$row['Email']));
        }
        $result->free();
      }
      echo json_encode($players);
      
      $connection->close();
    }
  } catch(Exception $e) {
    
  }
?>