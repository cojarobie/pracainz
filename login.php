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
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    }
    else {
      
      $connection->set_charset("utf8");
      
      $email    = htmlentities($email, ENT_QUOTES, "UTF-8");
      $password = htmlentities($password, ENT_QUOTES, "UTF-8");
      
      if ($result = $connection->query(sprintf("SELECT * FROM users WHERE email='$email' AND active=1;"))) {
        $rows = $result->num_rows;
        if ($rows > 0) {
          $row = $result->fetch_assoc();
          if (password_verify($password, $row['Password_Hash'])) {
            $_SESSION['logedin'] = true;
            $_SESSION['id'] = $row['ID'];
            $_SESSION['name'] = $row['Name'];
            $_SESSION['surname'] = $row['Surname'];
            $_SESSION['nickname'] = $row['Nickname'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['avatar'] = $row['Avatar'];
            $_SESSION['description'] = $row['Description'];
            $result->free_result();
            $connection->close(); 
            header('Location: main.php');
            exit();
          }
        }
      }     
      $connection->close(); 
    }
    $_SESSION['user-not-found'] = "Invalid user or password";
    header('Location: index.php');
  } catch (Exception $e) {
    $_SESSION['registration-result'] = '<div style="color: #ff1a1a; border-color: #ff1a1a;" class="server-error">It looks like we have some problems. Please try to login later</div>';
    header('Location: index.php');
  }
  
?>