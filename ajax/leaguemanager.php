<?php

  session_start();
  
  // if (!isset($_POST['leagueId'])) {
    // header('location: ../index.php');
    // exit();
  // }
  
  require_once '../connection.php';
  
  $leagueId = 11;//$_POST['leagueId'];
  $teams = [];
  
  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      if ($result = $connection->query("SELECT * FROM teams_leagues WHERE id_league=$leagueId")) {
      
        while ($row = $result->fetch_assoc()) {
          array_push($teams, $row['ID_Team']);
        }
        
        $result->free();
      }
    }
    
    $connection->close();
  }
  catch (Exception $e) {
    
  }
  
  $scheduled = scheduled($teams);
  
  for ($roundNo = 0; $roundNo < count($scheduled) - 1; $roundNo++) {
    echo "Fixture: ".($roundNo+1)."</br>";
    foreach ($scheduled[$roundNo] as $match) {
      echo $match['0'] . "-" . $match['1'] . '</br>';      
    }
    echo '</br>';
  }
  
  function scheduled($teams) {
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
        
        $matchPair = array($homeTeam, $awayTeam);
        array_push($roundFixture, $matchPair);
      }
      array_push($scheduled, $roundFixture);
      
      nextRound($scheduledTable, $pairs);
    }
    
    
    for ($rounds = 0; $rounds < $teamQuantity-1; $rounds++) {
      echo 'Fixture: ' . ($rounds + 1) . '<br/>';
      foreach ($scheduled[$rounds] as $matchPair) {
        echo $matchPair[0] . '-' . $matchPair[1] . '<br/>';
      }
      echo '<br/>';
    }    
    
    /*$diagonaScheme = [];
    
    for ($homeTeam = 1; $homeTeam < $teamQuantity; $homeTeam++) {
      $roundFixture  = [];
      for ($awayTeam = 1; $awayTeam < $teamQuantity; $awayTeam++) {
        $roundNo = $homeTeam + $awayTeam - 1;
        if ($roundNo >= $teamQuantity) {
          $roundNo -= ($teamQuantity - 1);         
        }
        
        
          $roundFixture[$awayTeam - 1] = $roundNo;
          $match = array($homeTeam, $awayTeam);
          $home = $homeTeam;
          $away = $awayTeam;
          if ($home == $away) {
            if ($roundNo % 2 == 1) {
              $away = $teamQuantity; 
            }
            else {
              $home = $teamQuantity; 
            }
          }
          $match = array($home, $away);
          array_push($scheduled[$roundNo - 1], $match);
        }

      
      $diagonaScheme[$homeTeam -1] = $roundFixture;
      foreach ($roundFixture as $rounds) {
        echo "$rounds ";
      }
      echo "</br>";
    }
    
    return $scheduled;*/
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