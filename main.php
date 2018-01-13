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
        <div class="row" id="userRow">
          <div class="col-lg-2">
          </div>
          <div class="col-lg-8">
            <div class="box">
              <div class="main-box">
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
                <div class="data-type">Birth date:</div>
                <div class="data"><?php echo $birth_date; ?></div>
                <div class="clear-both"></div>
                <div class="data-type">Description:</div>
                <div class="data"><?php echo $description; ?></div>
                <div class="clear-both"></div>
              </div>
              <div class="user-settings">
                <div class="menu-buttons">
                  <button type="button" class="btn btn-default margin-10 my-button" onclick="settings()">Settings<i class="icon-cog"></i></button>
                </div>
                <div class="menu-buttons">
                  <button type="button" class="btn btn-default margin-10 my-button" id="logoutButton" onclick="logout()">Log out<i class="icon-logout"></i></button>
                </div>
                <div style="clear-both"></div>
              </div>
              <div class="clear-both"></div>
            </div>
            </div>
          </div>
          <div class="col-lg-2">
          </div>
        </div>
        
        <div class="row" id="contentRow">
          <div class="col-lg-6">
            <div class="box">
              <div class="box-top">
                <div class="box-left box-title">
                  Your teams
                </div>
                <div class="box-right">
                  <button type="button" class="btn btn-success add-button" id="addTeam">
                  Add<i class="icon-plus-circled"></i></button>
                </div>
                <div class="clear-both"></div>
              </div>
              <div class="box-bottom box-content">
              <?php
                echo '<table>';
                echo '<tr>';
                echo '<th class="column-name">Team Name</th>';
                echo '<th class="column-status">Status</th>';
                echo '<th class="column-action">Action</th>';
                echo '</tr>';
                foreach ($teams as $team) {
                  echo '<tr>';
                  echo '<td class="column-name">'.$team['name'].'</td>';
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
                <div class="box-left box-title">
                    Your leagues
                </div>
                <div class="box-right">
                  <button type="button" class="btn btn-success add-button">
                  Add<i class="icon-plus-circled"></i></button>
                </div>
                <div class="clear-both"></div>
              </div>
              <div class="box-bottom box-content">
                <?php
                echo '<table>';
                echo '<tr>';
                echo '<th class="column-name">League Name</th>';
                echo '<th class="column-status">Status</th>';
                echo '<th class="column-action">Action</th>';
                echo '</tr>';
                foreach ($leagues as $league) {
                  echo '<tr>';
                  echo '<td class="column-name">'.$league['name'].'</td>';
                  echo '<td class="column-status">'.$league['status'].'</td>';
                  echo '<td class="column-action">'.$league['action'].'</td>';
                  echo '</tr>';
                }                
                
                echo '</table>';
               ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row" id="addTeamRow">
          <div class="col-lg-2">
          </div>
          <div class="col-lg-8">
            <div class="box" id="addTeamBox">
              <div class="box-top">
                <div class="box-left box-title" id="addTeamTitle">
                  Add Team
                </div>
                <div class="clear-both"></div>
                <div class="close-button" id="closeAddTeam">
                  <i class="icon-cancel"></i>
                </div>
              </div>
              <div class="box-bottom" id="addTeamPanel">
                <form class="form-horizontal" id="addTeamForm" action="addteam.php" method="post">
                  <div class="form-group has-feedback row" id="teamNameGroup">
                    <div class="col-sm-3">
                      <label class="control-label input-label" for="teamName">Enter team name:
                      </label>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="teamName" class="form-control" id="teamName" aria-describedby="inputTeamNameStatus">
                      <div id="teamNameHelpBlock" class="help-block"></div>
                    </div>
                  </div>
                  <div class="form-group has-feedback row" id="playerNameGroup">
                    <div class="col-sm-3">
                      <label class="control-label input-label" for="invitePlayer">Invite player: </label>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="invitePlayer" aria-describedby="invitePlayerStatus">
                      <span id="invitePlayerHelpBlock" class="help-block"></span>
                      <div id="foundPlayers">
                      </div>
                    </div>
                  </div>
                  <div id="invitedPlayersList"></div>
                  <button class="btn my-button" type="submit">Create team</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
          </div>
        </div>
        
        <div class="row" id="manageTeamRow">
          <div class="col-lg-2">
          </div>
          <div class="col-lg-8">
            <div class="box" id="manageTeamBox">
              <div class="box-top">
                <div class="box-left box-title" id="manageTeamTitle">
                  Manage Team
                </div>
                <div class="clear-both"></div>
                <div class="close-button" id="closeManageTeam">
                  <i class="icon-cancel"></i>
                </div>
              </div>
              <div class="box-bottom" id="manageTeamPanel">
              </div>
            </div>
          </div>
          <div class="col-lg-2">
          </div>            
        </div>
        
      </div>
    </div>
  
  
    <!-- Optional JavaScript -->
    <!-- jQuery, Bootstrap JS -->
    <script src="resources/js/jquery-3.2.1.min.js"></sript>
    <script src="resources/bootstrap/js/bootstrap.min.js"></script>
    <script src="resources/js/jquery.scrollTo.min.js"></script>
    
    <script src="resources/js/myjquery.js"></script>   
    <script src="resources/js/myscripts.js"></script>
    <script src="resources/js/validateteam.js"></script>
    <script src="resources/js/searchusers.js"></script>
	
  </body>
</html>