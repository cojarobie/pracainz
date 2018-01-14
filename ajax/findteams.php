<?php

  session_start();
  
  if (!isset($_POST['input'])) {
    header ('Location: ../index.php');
    exit();
  }

  $input = strtolower($_POST['input']);
  $invited = json_decode($_POST['invited']);
  
  $id = $_SESSION['id'];
  $teams = Array();
  
  require_once '../connection.php';
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      if (strlen($input) > 0 && $result = $connection->query("SELECT * FROM teams WHERE  LOWER(Name) LIKE '$input%' AND ID_Captain != $id")) {
        while ($row = $result->fetch_assoc()) {
          if (!in_array($row['ID'], $invited)) {
            array_push($teams, Array('id'=>$row['ID'], 'name'=>$row['Name']));
          }
        }
        $result->free();
      }
      echo json_encode($teams);
      
      $connection->close();
    }
  } catch(Exception $e) {
    
  }
?>