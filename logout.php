<?php
  session_start();
  unset($_SESSION['id']);
  unset($_SESSION['name']);
  unset($_SESSION['access_token'])
  session_destroy();
  header("Location: index.php");
  die();
?>
