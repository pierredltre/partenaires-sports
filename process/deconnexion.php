<?php
  session_start();
  session_unset();
  session_destroy();
  setcookie('email', '', time()-3600, '/', '', false, false);
  setcookie('mdp', '', time()-3600, '/', '', false, false);
  header("Location:../index.php?logout");
?>