<?php
  session_start();
  if (!isset($_POST['login-email'])) {
    session_unset();
    header('Location: index.php');
    exit();
  }
?>