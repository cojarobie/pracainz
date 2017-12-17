<?php
	session_start();
	$correctData = true;
	
	$firstName  = $_POST['form-first-name'];
	$lastName   = $_POST['form-last-name'];
	$nickname   = $_POST['form-nickname'];
	$email      = $_POST['form-email'];
	$password1  = $_POST['form-password'];
	$password2  = $_POST['form-repeat-password'];
	$response   = $_POST['g-recaptcha-response'];
    
	$_SESSION['form-first-name']      = $_POST['form-first-name'];
	$_SESSION['form-last-name']       = $_POST['form-last-name'];
	$_SESSION['form-nickname']        = $_POST['form-nickname'];
	$_SESSION['form-email']           = $_POST['form-email'];
	$_SESSION['form-password']        = $_POST['form-password'];
	$_SESSION['form-repeat-password'] = $_POST['form-repeat-password'];
	
	//***First Name***	
	if (has_special($firstName)) {
		$correctData = false;
		$_SESSION['e-form-first-name'] = "First name can contain only alphanumeric characters"; 
	}
  
  if ((strlen($firstName) < 2) || (strlen($firstName) > 50)) {
		$correctData = false;
		$_SESSION['e-form-first-name'] = "First name must contain from 2 to 50 characters";
	}
	
	//***Last Name***	
	if (has_special($lastName)) {
		$correctData = false;
		$_SESSION['e-form-last-name'] = "Last name can contain only alphanumeric characters"; 
	}
  
  if ((strlen($lastName) < 2) || (strlen($lastName) > 50)) {
		$correctData = false;
		$_SESSION['e-form-last-name'] = "Last name must contain from 2 to 50 characters";
	}
	
	//***Nickname***	
	if (has_special($nickname)) {
		$correctData = false;
		$_SESSION['e-form-nickname'] = "Nickname can contain only alphanumeric characters"; 
	}
  
  if ((strlen($nickname) < 2) || (strlen($nickname) > 30)) {
		$correctData = false;
		$_SESSION['e-form-nickname'] = "Nickname must contain from 2 to 30 characters";
	}
	
	//***Email***
	$emailFilter = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if (filter_var($emailFilter, FILTER_VALIDATE_EMAIL) == false) {
		$correctData = false;
		$_SESSION['e-form-email'] = "Invalid email address";
	}
	
	//***Password***	
	if ($password1 != $password2) {
		$correctData = false;
		$_SESSION['e-form-password'] = "Passwords are not the same";
	}
  
  if ((strlen($password1) < 8) || (strlen($password1) > 30)) {
		$correctData = false;
		$_SESSION['e-form-password'] = "Password must contain from 8 to 30 characters";
	}
  
  if (preg_match('/\'"/', $password1)) {
    $correctData = false;
    $_SESSION['e-form-password'] = "Password password cannot contain ' or \"";
  }
	
	//***reCaptcha***
	$secret = "6LdzTz0UAAAAAOsYBumnWYzRUj84V45dQuJGgqG1";
	
	$postdata = http_build_query(
		array(
			'secret' => $secret,
			'response' => $response
		)
	);
	
	$opts = array('http' =>
		array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => $postdata
		)
	);
	
	$context = stream_context_create($opts);
	$resource = "https://www.google.com/recaptcha/api/siteverify";
	$apiResponse = file_get_contents($resource, false, $context);
	
	$result = json_decode($apiResponse);
	
	if ($result->success == false) {
		$correctData = false;
		$_SESSION['e-form-recaptcha'] = "Prove that your not a robot";
	}
  
  if ($correctData == false) {
    header("Location: index.php");
    exit();
  }
  
  require_once 'connection.php';
  mysqli_report(MYSQLI_REPORT_STRICT);
  
  try {
    $conncection = new mysqli($host, $db_user, $db_password), $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
        //Connection succeeded
        
        $conncection->close();
    }
  
  function has_special($text) {
    $special = false;
    if (preg_match('/[\'"^$%&*()}{@#~?><>,.;:|=_+�]/', $text)) {
      $special = true;
    }
    return $special;
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
  </head>
  
  <body>
  <?php
    if (isset($_SESSION['e-form-first-name'])) echo $_SESSION['e-form-first-name']."<br/>";
    if (isset($_SESSION['form-first-name'])) echo $_SESSION['form-first-name']."<br/>";
    
    if (isset($_SESSION['e-form-last-name'])) echo $_SESSION['e-form-last-name']."<br/>";
    if (isset($_SESSION['form-last-name'])) echo $_SESSION['form-last-name']."<br/>";
    
    if (isset($_SESSION['e-form-nickname'])) echo $_SESSION['e-form-nickname']."<br/>";
    if (isset($_SESSION['form-nickname'])) echo $_SESSION['form-nickname']."<br/>";
    
    if (isset($_SESSION['e-form-email']))  echo $_SESSION['e-form-email']."<br/>";
    if (isset($_SESSION['form-email']))  echo $_SESSION['form-email']."<br/>";
    
    if (isset($_SESSION['e-form-password']))  echo $_SESSION['e-form-password']."<br/>";
    if (isset($_SESSION['form-password']))  echo $_SESSION['form-password']."<br/>";
    
    if (isset($_SESSION['e-form-recaptcha']))  echo $_SESSION['e-form-recaptcha']."<br/>";
  ?> 
  </body>
</html>
