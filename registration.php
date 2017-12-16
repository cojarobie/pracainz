<?php
	session_start();
	$correctData = true;
	
	$firstName  = $_POST['form-first-name'];
	$lastName   = $_POST['form-last-name'];
	$nickname   = $_POST['form-nickname'];
	$email      = $_POST['form-email'];
	$password   = $_POST['form-password'];
	$repeatPass = $_POST['form-repeat-password'];
	
	if ((strlen($firstName) < 2) || (strlen($firstName) > 50)) {
		$correctData = false;
		$_SESSION['e-form-first-name'] = "First name must contain from 2 to 50 characters";
	}
	
	if (!ctype_alnum($firstName)) {
		$correctData = false;
		$_SESSION['e-form-first-name'] = "First name can contain only alphanumeric characters"; 
	}
	
	if ((strlen($lastName) < 2) || (strlen($lastName) > 50)) {
		$correctData = false;
		$_SESSION['e-form-last-name'] = "Last name must contain from 2 to 50 characters";
	}
	
	if (!ctype_alnum($lastName)) {
		$correctData = false;
		$_SESSION['e-form-last-name'] = "Last name can contain only alphanumeric characters"; 
	}
	
	if ((strlen($nickname) < 2) || (strlen($nickname) > 50)) {
		$correctData = false;
		$_SESSION['e-form-nickname'] = "Nickname must contain from 2 to 50 characters";
	}
	
	if (!ctype_alnum($nickname)) {
		$correctData = false;
		$_SESSION['e-form-nickname'] = "Nickname can contain only alphanumeric characters"; 
	}
	
?>