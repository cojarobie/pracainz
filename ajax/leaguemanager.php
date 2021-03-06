<?php

  session_start();
  
  if (!isset($_POST['leagueId'])) {
    header('location: ../index.php');
    exit();
  }
  
  require_once '../connection.php';
  
  $leagueId = $_POST['leagueId'];
  $teams = [];
  $teamNames = [];
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      if ($result = $connection->query(
      "SELECT t.Name AS 't_Name', tl.id_league AS 'tl_ID_Team', t.ID AS 't_ID' FROM teams_leagues AS tl
       INNER JOIN teams AS t ON t.id = tl.id_team
       WHERE tl.id_league=$leagueId")) {
      
        while ($row = $result->fetch_assoc()) {
          $teamLeagueId = $row['tl_ID_Team'];
          $teamId = $row['t_ID'];
          array_push($teams, $teamId);
          $teamNames["$teamId"] = $row['t_Name'];
        }
        
        $result->free();
      }
    }
    
    $connection->close();
  }
  catch (Exception $e) {
    
  }
  
  $schedule = schedule($teams);
  
  $data = [];
  $data['schedule'] = $schedule;
  $data['teamNames'] = $teamNames;
  
  echo json_encode($data);
  
  function schedule($teams) {
    $teamQuantity = count($teams);
    
    if ($teamQuantity % 2 == 1) {
      $teamQuantity += 1;
    }
    
    $pairs = $teamQuantity / 2;
    $scheduledTable = [];
    
    $firstRow = [];
    $secondRow = [];
    
    for ($teamNo = 0; $teamNo < $pairs; $teamNo++) {
      array_push($firstRow, $teamNo);
      array_push($secondRow, 2 * $pairs - $teamNo - 1);
    }
    
    array_push($scheduledTable, $firstRow, $secondRow);
    
    $scheduled = [];
    
    for ($rounds = 0; $rounds < $teamQuantity-1; $rounds++) {
      $roundFixture = [];
      for ($matchInRound = 0; $matchInRound < $pairs; $matchInRound++) {
        $home = $scheduledTable[0][$matchInRound];
        $away = $scheduledTable[1][$matchInRound];
        
        if ($rounds % 2 == 1) {
          $swap = $home;
          $home = $away;
          $away = $swap;
        }
        $homeTeam = null;
        $awayTeam = null;
        
        if (isset($teams[$home])) {
          $homeTeam = $teams[$home];
        }
        
        if (isset($teams[$away])) {
          $awayTeam = $teams[$away];
        }
        
        if ($awayTeam != null && $homeTeam != null) {
          $matchPair = array($homeTeam, $awayTeam);
          array_push($roundFixture, $matchPair);
        }
        
      }
      array_push($scheduled, $roundFixture);
      
      nextRound($scheduledTable, $pairs);
    }   
    
    return $scheduled;
  }
  
  function nextRound(&$scheduledTable, $pairs) {
    for ($teamNo = 0; $teamNo < $pairs; $teamNo++) {
      $scheduledTable[0][$teamNo] -= 1;
      $scheduledTable[1][$teamNo] -= 1;
      
      if ($scheduledTable[0][$teamNo] == 0) {
        $scheduledTable[0][$teamNo] = 2 * $pairs - 1;
      }
      
      if ($scheduledTable[1][$teamNo] == 0) {
        $scheduledTable[1][$teamNo] = 2 * $pairs - 1;
      }
    }
        
    $scheduledTable[0][0] = 0;
  }
  
?>