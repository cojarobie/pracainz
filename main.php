<?php
  session_start();
  if (!isset($_SESSION['logedin'])) {
    header('Location: index.php');
    exit();
  }
  
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
  $surname = $_SESSION['surname'];
  $nickname = $_SESSION['nickname'];
  $email = $_SESSION['email'];
  $avatar = $_SESSION['avatar'];
  $description = $_SESSION['description'];
  
  require_once 'connection.php';
  mysqli_report(MYSQLI_REPORT_STRICT);
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      //Find my teams
      $connection->close();
    }
  } catch (Exception $e) {
    
  }
  
  
?>

<!doctype html>
<html lang="pl">
  <head>
    <title>E-sport</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="resources/css/style.css">
	  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&amp;subset=latin-ext" rel="stylesheet">
	  <link rel="stylesheet" href="resources/font-awesome/css/font-awesome.min.css">
  </head>
  
  <body>
  
    <div class="top-content">
      <div class="container">
        
        <div class="row box">
          <div class="col-md-4">
            <img src="resources/img/user_large.png" alt="user icon">
          </div>
          <div class="col-md-6">
              <table class="user-info">
                <tr>
                  <td>First Name:</td>
                  <td><?php echo "$name"; ?></td>
                </tr>
                <tr>
                  <td>Last Name:</td>
                  <td><?php echo "$surname"; ?></td>
                </tr>
                <tr>
                  <td>Nickname:</td>
                  <td><?php echo "$nickname"; ?></td>
                </tr>
              </table>
          </div>
          <div class="col-md-2">
            [<a href="logout.php">Logout</a>]
          </div>
        </div>
        
      </div>
    </div>
  
  
    <!-- Optional JavaScript -->
    <!-- jQuery, Bootstrap JS -->
    <script src="resources/js/jquery-3.2.1.min.js"></sript>
    <script src="resources/bootstrap/js/bootstrap.min.js"></script>	
	
  </body>
</html>