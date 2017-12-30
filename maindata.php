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
  
  $teams = [];
  
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
           $team = team_arrays($row['Name'], 'Owner', 'Manage'); 
           array_push($teams, $team);
         }
         $result->free();
      }

      /*if ($result = $connection->query("SELECT * FROM leagues WHERE id_organizer=$id")) {
         while ($row = $result->fetch_assoc()) {
          array_push($my_leagues, $row);
         }
         $result->free();
      }*/
      
      if ($result = $connection->query("SELECT t.Name AS t_name FROM users AS u INNER JOIN teams_users AS tu ON tu.id_users=u.id INNER JOIN teams AS t ON t.id=tu.id_teams WHERE u.id=$id AND tu.ustatus='member'")) {
         while ($row = $result->fetch_assoc()) {
           $team = team_arrays($row['t.Name'], 'Member', 'Leave');
           array_push($teams, $team);
         }
         $result->free();
      }
      
      /*if ($result = $connection->query("SELECT l.Name AS l_name FROM teams AS t LEFT JOIN teams_users AS tu ON t.id = tu.id_teams INNER JOIN teams_leagues AS tl ON t.id = tl.id_Team INNER JOIN leagues AS l ON l.id = tl.id_league WHERE t.id_captain=$id OR tu.id_users=$id;")) {
         while ($row = $result->fetch_assoc()) {
          array_push($leagues_member, $row);
         }
         $result->free();
      }*/
      
      $connection->close();
    }
  } catch (Exception $e) {
    
  }
  
  function team_arrays($name, $status, $action) {
    $team = array(
      'name' => $name,
      'status' => $status,
      'action' => $action
    );
    return $team;
  }
?>