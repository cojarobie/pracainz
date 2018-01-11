<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
  }
  $id = $_SESSION['id'];
  $teamName = $_POST['teamName'];
  $invitedPlayersId = $_POST['invitedPlayers'];
  
  require_once '../connection.php';
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      
      $connection->set_charset("utf8");
      
      $connection->query("INSERT INTO teams(Name,ID_Captain,Active) VALUES('$teamName', $id, 1)");
      
      if ($result = $connection->query("SELECT ID FROM teams WHERE name='$teamName'")) {
        $team = $result->fetch_assoc();
        $teamId = $team['ID'];
        echo ('Team added: '. $teamId);
        $result->free();
        
        foreach($invitedPlayersId as $invitedId) {
          $connection->query("INSERT INTO teams_users(ID_Teams,ID_Users,Ustatus) VALUES($teamId, $invitedId,'invited')");
        }
      }
      $connection->close();
    }
  }
  catch (Exception $e) {    
    exit();
  }
  
  header('Location: ../main.php');
  exit();
?>