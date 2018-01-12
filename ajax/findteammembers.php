<?php

  session_start();
  
  if (!isset($_POST['teamId'])) {
    header ('Location: ../index.php');
    exit();
  }
  
  $teamId = $_POST['teamId'];
  $members = [];
  
  require_once '../connection.php';

  try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    
    if ($connection->connect_errno != 0) {
      throw new Exception(mysqli_connect_errno());
    } else {
      $connection->set_charset("utf8");
      if ($result = $connection->query("SELECT u.id AS u_id, u.Name AS u_name, u.surname AS u_surname, u.nickname AS u_nickname, u.email AS u_email, tu.ustatus AS ustatus FROM teams AS t INNER JOIN teams_users tu ON t.ID=tu.ID_Teams INNER JOIN users u ON tu.ID_Users=u.ID WHERE t.ID=$teamId")) {
        while ($row = $result->fetch_assoc()) {
          $member = memebers_to_array($row['u_id'], $row['u_name'], $row['u_surname'], $row['u_nickname'], $row['u_email'], $row['ustatus']);
          array_push($members, $member); 
        }
        $result->free();
      }
      
      echo(json_encode($members));
      
      $connection->close();
    }
  } catch (Exception $e) {
    
  }
  
  function memebers_to_array($id, $name, $surname, $nick, $email, $ustatus) {
    $array = array(
      'id' => $id,
      'name' => $name,
      'surname' => $surname,
      'nick' => $nick,
      'email' => $email,
      'status' => $ustatus
    );
    return $array;
  }
?>