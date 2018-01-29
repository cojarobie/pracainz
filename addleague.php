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
        
        $connection->query("
          CREATE VIEW `games_$leagueName` AS
          SELECT 
            t.Name               AS 'Team_Name', 
            l.Name               AS 'League_Name', 
            s.first_team_points  AS 'Points_Forward',
            s.second_team_points AS 'Points_Against',
            s.first_team_points - s.second_team_points AS 'Points_Difference'
          FROM teams_leagues AS tl
          INNER JOIN teams AS t ON tl.ID_Team=t.ID
          INNER JOIN leagues AS l ON tl.ID_League=l.ID
          INNER JOIN scheduled AS s ON tl.ID_Team=s.ID_First_Team_League
          WHERE l.Name='$leagueName'
          UNION ALL
          SELECT 
            t.Name               AS 'Team_Name', 
            l.Name               AS 'League_Name', 
            s.second_team_points  AS 'Points_Forward',
            s.first_team_points AS 'Points_Against',
            s.second_team_points - s.first_team_points AS 'Points_Difference'
          FROM teams_leagues AS tl
          INNER JOIN teams AS t ON tl.ID_Team=t.ID
          INNER JOIN leagues AS l ON tl.ID_League=l.ID
          INNER JOIN scheduled AS s ON tl.ID_Team=s.ID_Second_Team_League
          WHERE l.Name='$leagueName'");
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