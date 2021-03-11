<?php include_once 'includes/header.php' ?>
<div class="container">
  <?php 
    if (isset($_GET['logout'])) {
    echo "<div class=\"alert alert-success\" role=\"alert\">";
    echo "Vous vous êtes déconnecté";
    echo "</div>";
    }
  ?>
  <div class="row" id="jumbo">
    <div class="jumbotron jumbotron-fluid">
      <div class="container container-fluid">
        <h1 class="display-4">Faites des rencontres</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit placeat illo omnis, assumenda
          ullam tempora sunt eum vero fuga ipsam? Numquam minima optio officia aspernatur, minus corrupti! Doloremque,
          voluptate consequuntur?</p>
        <?php 
        if (!isset($_COOKIE['email'])) {
        echo "<a class=\"bouton btn\" href=\"inscription.php\" role=\"button\">Inscrivez-vous !</a>";
        } else {
          echo "<a class=\"bouton btn\" href=\"recherche.php\" role=\"button\">Rechercher</a>";
        }
        ?>
      </div>  
    </div>
  </div>
</div>

<?php include_once 'includes/footer.php' ?>