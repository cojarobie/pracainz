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
	
	
	//***First Name***
	if ((strlen($firstName) < 2) || (strlen($firstName) > 50)) {
		$correctData = false;
		$_SESSION['e-form-first-name'] = "First name must contain from 2 to 50 characters";
	}
	
	if (!ctype_alnum($firstName)) {
		$correctData = false;
		$_SESSION['e-form-first-name'] = "First name can contain only alphanumeric characters"; 
	}
	
	//***Last Name***
	if ((strlen($lastName) < 2) || (strlen($lastName) > 50)) {
		$correctData = false;
		$_SESSION['e-form-last-name'] = "Last name must contain from 2 to 50 characters";
	}
	
	if (!ctype_alnum($lastName)) {
		$correctData = false;
		$_SESSION['e-form-last-name'] = "Last name can contain only alphanumeric characters"; 
	}
	
	//***Nickname***
	if ((strlen($nickname) < 2) || (strlen($nickname) > 50)) {
		$correctData = false;
		$_SESSION['e-form-nickname'] = "Nickname must contain from 2 to 50 characters";
	}
	
	if (!ctype_alnum($nickname)) {
		$correctData = false;
		$_SESSION['e-form-nickname'] = "Nickname can contain only alphanumeric characters"; 
	}
	
	//***Email***
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) == false || strlen($email) == 0) {
		$correctData = false;
		$_SESSION['e-form-email'] = "Invalid email address";
	}
	
	//***Password***
	if ((strlen($password1) < 8) || (strlen($password1) > 30)) {
		$correctData = false;
		$_SESSION['e-form-password'] = "Password must contain from 8 to 30 characters";
	}
	
	if ($password1 != $password2) {
		$correctData = false;
		$_SESSION['e-form-password'] = "Passwords are not the same";
	}
	
	//***reCaptcha***
	$secret = "6Lf97CYTAAAAAF_8m4a2xs_Y1IiI8s40CbetFMUB";
	
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
    if (isset($_SESSION['e-form-last-name'])) echo $_SESSION['e-form-last-name']."<br/>";
    if (isset($_SESSION['e-form-nickname'])) echo $_SESSION['e-form-nickname']."<br/>";
    if (isset($_SESSION['e-form-email']))  echo $_SESSION['e-form-email']."<br/>";
    if (isset($_SESSION['e-form-password']))  echo $_SESSION['e-form-password']."<br/>";
    if (isset($_SESSION['e-form-recaptcha']))  echo $_SESSION['e-form-recaptcha']."<br/>";
  ?> 
  </body>
</html>
