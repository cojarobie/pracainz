<?php
	session_start();
  if (isset($_SESSION['logedin']) {
    header('Location: main.php');
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
	
	<!-- Header -->
	<header>
		<div class="container">
			<div class="row header">
				<div class="col-sm-8 text">
					<h1>The Engineering Thesis Project</h1>
					<div class="description">
						<p>
							WEB based application for the managment of the e-sport competitions
						</p>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Top content -->
	<main>
		<div class="top-content">
	
			<div class="container">
      
        <?php
          if (isset($_SESSION['registration-result'])) {
            echo '<div class="row">';
            echo $_SESSION['registration-result'];
            echo '</div>';
          }         
        ?>
				
				<div class="row main">
					<div class="col-sm-5">
					
						<div class="form-box">
							<div class="form-top">
								<h3>Login to our site</h3>
								<p>Enter email and passwored to log on:</p>
							</div>
							<div class="form-bottom">
								<form role="form" action="login.php" method="post">
									<div class="form-group">
										<label class="sr-only" for="login-email">Email</label>
										<input type="text" name="login-email" placeholder="Email..." class="login-email form-control" id="login-email"<?php
                      if (isset($_SESSION['login-email'])) {
                        echo ' value="'.$_SESSION['login-email'].'"';
                      }?>>
									</div>
									<div class="form-group">
										<label class="sr-only" for="login-password">Password</label>
										<input type="password" name="login-password" placeholder="Password..." class="login-password form-control" id="login-password"<?php
                      if (isset($_SESSION['login-password'])) {
                        echo ' value="'.$_SESSION['login-password'].'"';
                      }?>>
                    <?php
                        if (isset($_SESSION['user-not-found'])) {
                          echo '<div class="error-info">';
                          echo $_SESSION['user-not-found'];
                          echo '</div>';
                        }
                      ?>
									</div>
									<button type="submit" class="btn">Sign in!</button>
								</form>
							</div>
						</div>
						
					</div>
					
					<div class="col-sm-1 middle-border"></div>
					<div class="col-sm-1"></div>
					
					<div class="col-sm-5">
						<div class="form-box">
							<div class="form-top">
								<h3>Sign up now</h3>
								<p>Fill in the form below to get instant access:</p>
							</div>
							<div class="form-bottom">
								<form role="form" action="registration.php" method="post" class="registration-form">
									<div class="form-group">
										<label class="sr-only" for="form-first-name">First name</label>
										<input type="text" name="form-first-name" placeholder="First name..." class="form-first-name form-control" id="form-first-name"<?php
                      if (isset($_SESSION['form-first-name'])) {
                        echo ' value="'.$_SESSION['form-first-name'].'"';
                      }?>>
                      <?php
                        if (isset($_SESSION['e-form-first-name'])) {
                          echo '<div class="error-info">';
                          echo $_SESSION['e-form-first-name'];
                          echo '</div>';
                        }
                      ?>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-last-name">Last name</label>
										<input type="text" name="form-last-name" placeholder="Last name..." class="form-last-name form-control" id="form-last-name"<?php
                      if (isset($_SESSION['form-last-name'])) {
                        echo ' value="'.$_SESSION['form-last-name'].'"';
                      }?>>
                      <?php
                        if (isset($_SESSION['e-form-last-name'])) {
                          echo '<div class="error-info">';
                          echo $_SESSION['e-form-last-name'];
                          echo '</div>';
                        }
                      ?>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-nickname">Nickname</label>
										<input type="text" name="form-nickname" placeholder="Nickname..." class="form-nickname form-control" id="form-nickname"<?php
                      if (isset($_SESSION['form-nickname'])) {
                        echo ' value="'.$_SESSION['form-nickname'].'"';
                      }?>>
                      <?php
                        if (isset($_SESSION['e-form-nickname'])) {
                          echo '<div class="error-info">';
                          echo $_SESSION['e-form-nickname'];
                          echo '</div>';
                        }
                      ?>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-email">Email</label>
										<input type="text" name="form-email" placeholder="Email..." class="form-email form-control" id="form-email"<?php
                      if (isset($_SESSION['form-email'])) {
                        echo ' value="'.$_SESSION['form-email'].'"';
                      }?>>
                      <?php
                        if (isset($_SESSION['e-form-email'])) {
                          echo '<div class="error-info">';
                          echo $_SESSION['e-form-email'];
                          echo '</div>';
                        }
                      ?>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-password">Password</label>
										<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password"<?php
                      if (isset($_SESSION['form-password'])) {
                        echo ' value="'.$_SESSION['form-password'].'"';
                      }?>>
                      <?php
                        if (isset($_SESSION['e-form-password'])) {
                          echo '<div class="error-info">';
                          echo $_SESSION['e-form-password'];
                          echo '</div>';
                        }
                      ?>
									</div>
									<div class="form-group">
										<label class="sr-only" for="form-repeat-password">Repeat password</label>
										<input type="password" name="form-repeat-password" placeholder="Repeat password..." class="form-password form-control" id="form-repeat-password"<?php
                      if (isset($_SESSION['form-password'])) {
                        echo ' value="'.$_SESSION['form-password'].'"';
                      }?>>
									</div>
									<div class="form-group">
										<div class="g-recaptcha" data-sitekey="6LdzTz0UAAAAAPzt8ywGo2j3IdTS9U0MnsD7b4vA"></div>
                    <?php
                        if (isset($_SESSION['e-form-recaptcha'])) {
                          echo '<div class="error-info">';
                          echo $_SESSION['e-form-recaptcha'];
                          echo '</div>';
                        }
                      ?>
									</div>
									<button type="submit" class="btn">Sign me up!</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</main>
	
	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row footer">
				
				<div class="col-sm-8 text">
					<p>
						Author: Gaspar Kwiecień Supervisor: Rafał‚ Zawiślak, PhD &copy;2017
					</p>
				</div>
				
			</div>
		</div>
	</footer>
	
    <!-- Optional JavaScript -->
    <!-- jQuery, Bootstrap JS -->
	<script src="resources/js/jquery-3.2.1.min.js"></sript>
	<script src="resources/bootstrap/js/bootstrap.min.js"></script>	
	
  </body>
</html>

<?php
  session_unset();
?>