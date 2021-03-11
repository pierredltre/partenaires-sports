<?php
require_once '../includes/database.php';

if (isset($_POST['email']) && isset($_POST['mdp'])) {
  $email = $_POST['email'];
  $mdp = $_POST['mdp'];

  $sql = $db->prepare("SELECT * FROM `utilisateurs` WHERE `email` = :email AND `mot_de_passe` = SHA1(:mdp)");
  $sql->bindParam(':email', $email);
  $sql->bindParam(':mdp', $mdp);
  $sql->execute();

  if (count($sql->fetchAll()) == 1) {
    session_start();
    setcookie('email', $email, time()+24*3600, '/');
    setcookie('mdp', $mdp, time()+24*3600, '/');
    echo $_COOKIE['email'];
    header("Location:../index.php");
  } else {
    $msg = "Identifiants incorrects";
    header("Location:../connexion.php?msg=$msg");
  }
}
?>