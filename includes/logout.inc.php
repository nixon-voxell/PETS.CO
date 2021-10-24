<?php

  session_start();
  session_unset();
  session_destroy();

  // Remove cookie variables
  setcookie ("remember_me", "", time() - (30 * 24 * 1000) );
  
  header("location: ../index.php");
  exit();
?>