<?php

  session_start();
  
  if (!isset($_POST['userName'])) {
    header('Location: index.php');
    exit();
  }

  $userName = $_POST['userName'];
  $id = $_SESSION['id'];
  $_SESSION['name'] = $userName;
  
  require_once '../connection.php';
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      $connection->query("UPDATE users SET Name='$userName' WHERE ID=$id");
      
      $connection->close();
    }
  } catch(Exception $e) {
    
  }
?>