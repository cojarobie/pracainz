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
      
      $email    = htmlentities($email, ENT_QUOTES, "UTF-8");
      $password = htmlentities($password, ENT_QUOTES, "UTF-8");
      echo $email;
      
      if ($result = $connection->query(sprintf("SELECT * FROM users WHERE email='$email';"))) {
        $rows = $result->num_rows;
        if ($rows > 0) {
          $row = $result->fetch_assoc();
          if (password_verify($password, $row['Password_Hash'])) {
            $_SESSION['logedin'] = true;
            $_SESSION['id'] = $rows['Id'];
            $_SESSION['nickname'] = $rows['Nickname'];
            $result->free_result();
            echo "Your are loged in " . $_SESSION['nickname'];
            //header('Location: main.php');
          }
          else {
            $_SESSION['user-not-found'] = "Invalid user or password";
            header('Location: index.php');            
          }
        }
      }          
      $connection->close();
    }
  } catch (Exception $e) {
    $_SESSION['registration-result'] = '<div style="color: #ff1a1a; border-color: #ff1a1a;" class="server-error">It looks like we have some problems. Please try to login later</div>';
    header('Location: index.php');
  }
  
?>