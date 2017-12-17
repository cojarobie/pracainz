<?php
  session_start();
  if (!isset($_POST['login-email'])) {
    session_unset();
    header('Location: index.php');
    exit();
  }
  
  $email = $_POST['login-email'];
  $password = $_POST['login-password'];
  
  $_SESSION['login-email'] = $email;
  $_SESSION['login-password'] = $password;
  
  require_once('connection.php');
  mysqli_report(MYSQLI_REPORT_STRICT);
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno!=0) {
      throw new Exception(mysqli_connect_errno());
    }
    else {
      
      $email    = htmlentities($email, ENT_QUOTES, "UTF-8");
      $password = htmlentities($password, ENT_QUOTES, "UTF-8");
      
      
      if ($result = $connection->query(sprintf("SELECT * FROM users WHERE email='%s'",
      $connection->real_escape_string($email)))) {
        $rows = $result->num_rows;
        if ($rows > 0) {
          $row = $result->fetch_assoc();
          
          echo $row['name'] . " " . $row['surname'];
        }
      }
           
      $connection->close();
    }
  } catch (Exception $e) {
    echo $e;
  }
  
?>