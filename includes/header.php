<?php 
session_start();

require 'database.php';
 ?>

<!DOCTYPE html>
<html>

<head>
  <title>Rencontres sports</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="includes/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
  <a class="navbar-brand" href="index.php">Meetings Sportifs</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="
        <?php
          if(isset($_COOKIE['email'])) {
            echo 'recherche.php';
          } else {
            echo 'inscription.php';
          }
        ?>
        ">Rechercher</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <?php 
      if (!isset($_COOKIE['email'])) {

      echo "<a class=\"btn bouton bouton-login my-2 my-sm-0\" role=\"button\" href=\"connexion.php\">Se connecter</a>";
      } else {
        echo "<ul class=\"navbar-nav\">";
        echo "<li class=\"nav-item\">";
        echo "<a class=\"nav-link\" href=\"compte.php\">Mon compte</a>";
        echo "</li>";
        echo "<li class=\"nav-item\">";
        echo "<a style=\"color: #FA347F;\"class=\"nav-link\" href=\"./process/deconnexion.php\">Me déconnecter</a>";
        echo "</li>";
        echo "</ul>";
      }
      ?>
    </form>
  </div>
  </div>
</nav>