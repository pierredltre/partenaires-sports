<?php include_once 'includes/header.php' ?>
<div class="container form">
  <h2>Je me connecte</h2>
  <form class="bg-light col-5" method="post" action="process/connexion_process.php">
  <?php
    if(isset($_GET['msg'])) {
      echo "<div class=\"form-group\">";
      echo "<p style=\"color: red;\">" . $_GET['msg'] . "</p>";
      echo "</div>";
    }
  ?>

    <div class="form-group">
      <label name="email">Adresse e-mail</label>
      <input type="email" name="email" class="form-control" placeholder="nom@exemple.com" required>
    </div>
    <div class="form-group">
      <label name="mdp">Mot de passe</label>
      <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
    </div>
    <div class="form-group">
      <button type="submit" class="btn bouton">Se connecter</button>
    </div>
    <div class="form-group">
      <small class="text-muted">Si vous n'avez pas déjà un compte,
        <a href="inscription.php">cliquez ici</a>.
      </small>
    </div>
  </form>
</div>
<?php include_once 'includes/footer.php' ?>