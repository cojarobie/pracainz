<?php
  require 'maindata.php';
?>

<!doctype html>
<html lang="pl">
  <head>
    <title>E-sport</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="resources/img/gamepad.png"/>

    <!-- CSS -->
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="resources/css/style.css">
	  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&amp;subset=latin-ext" rel="stylesheet">
	  <link rel="stylesheet" href="resources/fontello/css/fontello.css">
  </head>
  
  <body>
  
    <div class="top-content">
      <div class="container">
        
        <div class="row main-box">
          <div class="col-md-3">
            <div class="user-logo">
              <img src="resources/img/user_large.png" alt="user icon">
            </div>
          </div>
          <div class="col-md-7">
              <?php
                echo '<div class="left-user">First name: </div>';
                echo '<div class="right-user">'.$name.'</div>';
                echo '<div class="clear-both"></div>';
                echo '<div class="left-user">Last name: </div>';
                echo '<div class="right-user">'.$surname.'</div>';
                echo '<div class="clear-both"></div>';
                echo '<div class="left-user">Nickname: </div>';
                echo '<div class="right-user">'.$nickname.'</div>';
                echo '<div class="clear-both"></div>';
                echo '<div class="left-user">Birth date: </div>';
                echo '<div class="right-user">'.$birth_date.'</div>';
                echo '<div class="clear-both"></div>';
                echo '<div class="left-user">Description: </div>';
                echo '<div class="right-user">'.$description.'</div>';
                echo '<div class="clear-both"></div>';
              ?>
          </div>
          <div class="col-md-2" style="font-size: 2rem;">
            <a href="#"><i class="demo-icon icon-cog"></i></a>
            <a href="logout.php"><i class="demo-icon icon-logout"></i></a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-5">
            <div class="box">
              <div class="box-top">
                <div class="box-left">
                  <h3>Your teams</h3>
                </div>
                <div class="box-right">
                  <a href="#"><i class="demo-icon icon-plus-circled"></i></a>
                </div>
                <div class="clear-both"></div>
              </div>
              <div class="box-bottom box-content">
              <?php
                echo '<table>';
                echo '<tr>';
                echo '<th>Name</th>';
                echo '<th>Status</th>';
                echo '<th>Action</th>';
                echo '</tr>';
                
                
                echo '</table>';
                /*
                for ($team = 0; $team < count($my_teams); $team++) {
                  echo '<div class="box-left-content">' . $my_teams[$team]['Name'] . '</div>';
                  echo '<div class="box-right-content"><a href="#"><i class="demo-icon icon-cog"></i></a></div>';
                }
                for ($team = 0; $team < count($teams_member); $team++) {                 
                  echo '<div class="box-left-content">' . $teams_member[$team]['t_name'] . '</div>';
                  echo '<div class="box-right-content"><a href="#"><i class="demo-icon icon-logout"></i></a></div>';
                }
                echo '<div class="clear-both"></div>';*/
               ?>
                
              </div>
            </div>
          </div>
          
          <div class="col-md-1 middle-border"></div>
					<div class="col-md-1"></div>
          
          <div class="col-md-5">
            <div class="box">
              <div class="box-top">
                <div class="box-left">
                    <h3>Your leagues</h3>
                </div>
                <div class="box-right">
                  <a href="#"><i class="demo-icon icon-plus-circled"></i></a>
                </div>
              </div>
              <div class="box-bottom box-content">
                <?php/*
                for ($league = 0; $league < count($my_leagues); $league++) {
                  echo '<div class="box-left-content">' . $my_leagues[$league]['Name'] . '</div>';
                  echo '<div class="box-right-content"><a href="#"><i class="demo-icon icon-cog"></i></a></div>';
                }
                for ($league = 0; $league < count($leagues_member); $league++) {                 
                  echo '<div class="box-left-content">' . $leagues_member[$league]['l_name'] . '</div>';
                  echo '<div class="box-right-content"><a href="#"><i class="demo-icon icon-logout"></i></a></div>';
                }
                echo '<div class="clear-both"></div>';*/
                ?>
              </div>
            <div>
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