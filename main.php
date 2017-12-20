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
  $birth_date = $_SESSION['birth_date'];
  $avatar = $_SESSION['avatar'];
  $description = $_SESSION['description'];
  
  $my_teams = [];
  $my_tournaments = [];
  $teams_memeber = [];
  $tournaments_member = [];
  
  require_once 'connection.php';
  mysqli_report(MYSQLI_REPORT_STRICT);
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      
      if ($result = $connection->query("SELECT * FROM teams WHERE id_captain=$id")) {
         while ($row = $result->fetch_assoc()) {
          array_push($my_teams, $row);
         }
         $result->free();
      }

      if ($result = $connection->query("SELECT * FROM leagues WHERE id_organizer=$id")) {
         while ($row = $result->fetch_assoc()) {
          array_push($my_tournaments, $row);
         }
         $result->free();
      }
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
	  <link rel="stylesheet" href="resources/fontello/css/fontello.css">
  </head>
  
  <body>
  
    <div class="top-content">
      <div class="container">
        
        <div class="row main-box">
          <div class="col-md-4">
            <div class="user-logo">
              <img src="resources/img/user_large.png" alt="user icon">
            </div>
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
                <tr>
                  <td>Email:</td>
                  <td><?php echo "$email"; ?></td>
                </tr>
                <tr>
                  <td>Birth Date:</td>
                  <td><?php echo "$birth_date"; ?></td>
                </tr>
                <tr>
                  <td>Description:</td>
                  <td><?php echo "$description"; ?></td>
                </tr>
              </table>
          </div>
          <div class="col-md-2" style="font-size: 2rem;">
            <a href="#"><i class="demo-icon icon-cog"></i></a>
            <a href="logout.php"><i class="demo-icon icon-logout"></i></a>
          </div>
        </div>
        
        <div class="row">
          <div class="col-sm-5">
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
              <div class="box-bottom">
              <?php
                for ($team = 0; $team < count($my_teams); $team++) {
                  if ($team == 0) {
                    echo '<table>';
                  }
                  echo '<tr>';
                  echo '<td>' . $my_teams[$team]['Name'] . '</td>';
                  echo '<td><a href="#"><i class="demo-icon icon-cog"></i></a></td>';
                  echo '</tr>';
                  if ($team == count($my_teams) - 1) {
                    echo '</table>';
                  }
                }?>
              </div>
            </div>
          </div>
          
          <div class="col-sm-1 middle-border"></div>
					<div class="col-sm-1"></div>
          
          <div class="col-sm-5">
            <div class="box">
              <div class="box-top">
                <div class="box-left">
                    <h3>Your tournaments</h3>
                  </div>
                  <div class="box-right">
                    <a href="#"><i class="demo-icon icon-plus-circled"></i></a>
                  </div>
              </div>
              <div class="box-bottom">
                <?php
                for ($team = 0; $team < count($my_tournaments); $team++) {
                  if ($team == 0) {
                    echo '<table>';
                  }
                  echo '<tr>';
                  echo '<td>' . $my_tournaments[$team]['Name'] . '</td>';
                  echo '<td><a href="#"><i class="demo-icon icon-cog"></i></a></td>';
                  echo '</tr>';
                  if ($team == count($my_tournaments) - 1) {
                    echo '</table>';
                  }
                }?>
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