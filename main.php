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
  
    <div class="container">
      <div class="main-content">
        <div class="row">
          <div class="visible-lg-2">
          </div>
          <div class="col-lg-8 main-box">
            <div class="user-image">
              <img src="
              <?php
              if ($avatar == null) {
                echo 'resources/img/user_large.png';
              } else {
                echo $avatar;
              }
              ?>
              " alt="user-image" class="img-thumbnail">
            </div>
            <div class="user-data">
              <div class="data-type">First name:</div>
              <div class="data"><?php echo $name; ?></div>
              <div class="clear-both"></div>
              <div class="data-type">Last name:</div>
              <div class="data"><?php echo $surname; ?></div>
              <div class="clear-both"></div>
              <div class="data-type">Nickname:</div>
              <div class="data"><?php echo $nickname; ?></div>
              <div class="clear-both"></div>
              <div class="data-type">Birth Date:</div>
              <div class="data"><?php echo $birth_date; ?></div>
              <div class="clear-both"></div>
              <div class="data-type">Description:</div>
              <div class="data"><?php echo $description; ?></div>
              <div class="clear-both"></div>
            </div>
            <div class="user-settings">
              <button type="button" class="btn btn-default menu-button" onclick="settings()">Settings<i class="icon-cog"></i></button>
              <button type="button" class="btn btn-default menu-button" onclick="logout()">
              Log out<i class="icon-logout"></i></div></button>
            </div>
            <div class="clear-both">
              
            </div>
          </div>
          <div class="visible-lg-2">
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-6">
            <div class="box">
              <div class="box-top">
                <div class="box-left teams-title">
                  <h3>Your teams</h3>
                </div>
                <div class="box-right">
                  <button type="button" class="btn btn-success add-team">
                  Add<i class="icon-plus-circled"></i></button>
                </div>
                <div class="clear-both"></div>
              </div>
              <div class="box-bottom box-content">
              <?php
                echo '<table>';
                echo '<tr>';
                echo '<th class="column-team">Team Name</th>';
                echo '<th class="column-status">Status</th>';
                echo '<th class="column-action">Action</th>';
                echo '</tr>';
                foreach ($teams as $team) {
                  echo '<tr>';
                  echo '<td class="column-team">'.$team['name'].'</td>';
                  echo '<td class="column-status">'.$team['status'].'</td>';
                  echo '<td class="column-action">'.$team['action'].'</td>';
                  echo '</tr>';
                }                
                
                echo '</table>';
               ?>
                
              </div>
            </div>
          </div>
          
          
          <div class="col-lg-6">
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
                <?php
                /*
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
    
    <script>
      function logout() {
        window.location.href = 'logout.php';
      }
    </script>
	
  </body>
</html>