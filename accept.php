<?php

  if (!isset($_GET['id'])) {
    /*no get variable*/
    header('Location: index.php');
    exit();
  }
  
  $id = $_GET['id'];
  session_start();
  
  if (!isset($_SESSION['invited'.$id])) {
    /*no session variable*/
    header('Location: index.php');
    exit();
  }
  
  require_once 'connection.php';
  mysqli_report(MYSQLI_REPORT_STRICT);
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->query("UPDATE teams_users SET Ustatus='member' WHERE id=$id;");
    $connection->close();
    }
  } catch (Exception $e) {
    
  }
  unset($_SESSION['invited'.$id]);
  header('Location: main.php');
  exit();
  
?>