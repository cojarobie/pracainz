<?php
	session_start();
	$correctData = true;
	
	$firstName  = $_POST['form-first-name'];
	$lastName   = $_POST['form-last-name'];
	$nickname   = $_POST['form-nickname'];
	$email      = $_POST['form-email'];
	$password1  = $_POST['form-password'];
	$password2  = $_POST['form-repeat-password'];
	
	
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
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
		$correctData = false;
		$_SESSION['e-form-email'] = "Invalid email address";
	}
	
	//***Password***
	if ((strlen(password) < 8) || (strlen(password) > 30)) {
		$correctData = false;
		$_SESSION['e-form-password'] = "Password must contain from 8 to 30 characters";
	}
	
	if ($password1 != $password2) {
		$correctData = false;
		$_SESSION['e-form-password'] = "Passwords are not the same";
	}
	
		
?>