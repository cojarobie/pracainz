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
  $leagues = [];
  
  require_once 'connection.php';
  mysqli_report(MYSQLI_REPORT_STRICT);
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      
      /* selcet teams where user is captain */
      if ($result = $connection->query("SELECT * FROM teams WHERE id_captain=$id")) {
         while ($row = $result->fetch_assoc()) {
           $team = to_array($row['Name'], 'Owner', '<button type="button" class="btn btn-success manage" id="manageTeam'.$row['ID'].'" onclick="manageTeam('.$row['ID'].')">Manage <i class="icon-cog"></i></button>'); 
           $_SESSION['manageteam' . $row['ID']] = true;
           array_push($teams, $team);
         }
         $result->free();
      }
      
      /* select teams where user is memeber */
      if ($result = $connection->query("SELECT t.Name AS t_name, tu.ID as tu_id FROM users AS u INNER JOIN teams_users AS tu ON tu.id_users=u.id INNER JOIN teams AS t ON t.id=tu.id_teams WHERE u.id=$id AND tu.ustatus='member'")) {
         while ($row = $result->fetch_assoc()) {
           $team = to_array($row['t_name'], 'Member',  '<div id="leave'.$row['tu_id'].'" ><button type="button" class="btn btn-danger leave" onclick="leave('. $row['tu_id'] .')">Leave<i class="icon-logout"></button></div>');
           $_SESSION['leave' . $row['tu_id']] = true;
           array_push($teams, $team);
         }
         $result->free();
      }
      
      /* select teams where user is invited */
      if ($result = $connection->query("SELECT t.Name AS t_name, tu.ID AS tu_id FROM users AS u INNER JOIN teams_users AS tu ON tu.id_users=u.id INNER JOIN teams AS t ON t.id=tu.id_teams WHERE u.id=$id AND tu.ustatus='invited'")) {
         while ($row = $result->fetch_assoc()) {
           $team = to_array($row['t_name'], 'Invited','<div class="invited" id="invited'. $row['tu_id'] .'"><div class="accept-container"><button type="button" class="btn btn-success accept" onclick="accept('.$row['tu_id'].')">Accept<i class="icon-ok-circled"></i></button></div> <div class="decline-container"><button type="button" class="btn btn-danger decline" onclick="decline('.$row['tu_id'].')">Decline<i class="icon-cancel-circled"></i></button></div><div class="clear-both"></div></div>');
           $_SESSION['invited' . $row['tu_id']] = true;
           array_push($teams, $team);
         }
         $result->free();
      }
      
      if ($result = $connection->query("SELECT * FROM leagues WHERE id_organizer=$id")) {
        while ($row = $result->fetch_assoc()) {
          $league = to_array($row['Name'], 'Organizer', '<button type="button" class="btn btn-success manage" onclick="manage()">Manage <i class="icon-cog"></i></button>');
          array_push($leagues, $league);
        } 
        $result->free(); 
      }
      
      if ($result = $connection->query("SELECT l.Name AS l_name FROM teams AS t LEFT JOIN teams_users AS tu ON t.id = tu.id_teams INNER JOIN teams_leagues AS tl ON t.id = tl.id_Team INNER JOIN leagues AS l ON l.id = tl.id_league WHERE t.id_captain=$id OR tu.id_users=$id;")) {
         while ($row = $result->fetch_assoc()) {
          $league = to_array($row['l_name'], 'Participant', '<button type="button" class="btn btn-info details" onclick="details()">Details <i class="icon-cog"></i></button>');
          array_push($leagues, $league);
         }
         $result->free();
      }
      
      $connection->close();
    }
  } catch (Exception $e) {
    
  }
  
  function to_array($name, $status, $action) {
    $array = array(
      'name' => $name,
      'status' => $status,
      'action' => $action
    );
    return $array;
  }
?>