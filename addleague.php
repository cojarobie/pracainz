<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
  }
  $id = $_SESSION['id'];
  $leagueName = $_POST['leagueName'];
  $invitedTeamsId = $_POST['invitedTeams'];
  
  require_once 'connection.php';
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      
      $connection->set_charset("utf8");
      
      $connection->query("INSERT INTO leagues(Name, ID_Organizer) VALUES('$leagueName', $id)");
      
      if ($result = $connection->query("SELECT ID FROM leagues WHERE name='$leagueName'")) {
        $league = $result->fetch_assoc();
        $leagueId = $league['ID'];
        echo ('League added: '. $leagueId);
        $result->free();
        
        foreach($invitedTeamsId as $invitedId) {
          $connection->query("INSERT INTO teams_leagues (ID_Team,ID_League) VALUES($invitedId, $leagueId)");
        }
      }
      $connection->close();
    }
  }
  catch (Exception $e) {    
    exit();
  }
  
  header('Location: main.php');
  exit();
?>