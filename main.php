<?php
  session_start();
  if (!isset($_SESSION['logedin']) {
    header('Location: index.php');
    exit();
  }
?>

<!doctype html>
<html lang="en">
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
  
	  <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  
  <body>
  
    <?php
      echo "You are logged: ".$_SESSION['nickname'] . "</br>";
    ?>
    
    [<a href="logut.php">Logout</a>]
  
    <!-- Optional JavaScript -->
    <!-- jQuery, Bootstrap JS -->
    <script src="resources/js/jquery-3.2.1.min.js"></sript>
    <script src="resources/bootstrap/js/bootstrap.min.js"></script>	
	
  </body>
</html>