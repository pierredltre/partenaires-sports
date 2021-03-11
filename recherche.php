<?php include_once 'includes/header.php' ?>

<div class="container rounded" id="accueil">
  <div class="row">
    <h1>Sportifs trouvés</h1>
  </div>
  <div class="row">
    <div class="col-3 h-auto border rounded p-3">
      <h3>Filtres</h3>
      <form action="recherche.php" method="GET">
        <div class="form-group">
            <label for="sport">Sport</label>
            <select class="form-control col-12" name="sport">
              <option value="">Tous</option>
              <?php
                $sql = "SELECT `nom` from sports;";
                foreach ($db->query($sql) as $ligne) {
                  echo "<option value=". $ligne['nom'] . ">" . str_replace("_", " ", $ligne['nom']) . "</option>";
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="niveau">Niveau</label>
            <select class="form-control col-12" name="niveau">
              <option value="">Tous</option>
              <?php
              $sql = "SELECT `niveau` from niveaux_sportifs;";
              foreach ($db->query($sql) as $ligne) {
                echo "<option value=".$ligne['niveau'] . ">" . $ligne['niveau'] . "</option>";
              }
              ?>
            </select>
          </div>
          <button type="submit" class="btn bouton">Filtrer</button>
          <?php 
            if(!empty($_GET)) {
              echo "<a class=\"btn bouton\" href=\"recherche.php\">Reset</a>";
            }
          ?>
      </form>
    </div>

    <div class="col-9 cardsSports">
    <?php
    if(isset($_GET['sport']) && isset($_GET['niveau'])) {
      $sport = htmlspecialchars(str_replace("_", " ", $_GET['sport']));
      $niveau = htmlspecialchars($_GET['niveau']);

      $sql = "SELECT `nom`, `prenom`, `ville`, `email`, `sport_pratique`, `niveau`, `avatar` from `utilisateurs` WHERE";
            
      if (!empty($_GET['sport']) && empty($_GET['niveau'])) {
        $sql = $sql . " `sport_pratique` = :sport";
      } 
      if (!empty($_GET['niveau']) && empty($_GET['sport'])) {
        $sql = $sql . " `niveau` = :niveau";
      } 
      if (!empty($_GET['niveau']) && !empty($_GET['sport'])) {
        $sql = $sql . " `sport` = :sport AND `niveau` = :niveau";
      }

      $filtre = $db->prepare($sql);
      if (!empty($_GET['sport']) && empty($_GET['niveau'])) {
        $filtre->bindParam(':sport', $sport);
      } 
      if (!empty($_GET['niveau']) && empty($_GET['sport'])) {
        $filtre->bindParam(':niveau', $niveau);
      } 
      if (!empty($_GET['niveau']) && !empty($_GET['sport'])) {
        $filtre->bindParam(':sport', $sport);
        $filtre->bindParam(':niveau', $niveau);
      }
      $filtre->execute();
      $profils = $filtre;
      
      foreach ($profils as $ligne) {
        $src = "uploads/";
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        if(!empty($ligne['avatar'])) {
          echo "<div style=\"display:flex; justify-content:center; padding-top: 10px;\">";
          echo "<img height=\"100px\" width=\"100px\" alt=\"Avatar\" class=\"rounded-circle\" src=". $src . $ligne['avatar'] . ">";
          echo "</div>";
        }
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\">" . $ligne['nom'] . " " . $ligne['prenom'] . "</h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "<li class=\"list-group-item\">" . $ligne['sport_pratique'] . " - " . $ligne['niveau'] . "</li>";
        echo "<li class=\"list-group-item\">" . $ligne['ville'] . "</li>";
        echo "<li class=\"list-group-item\">". $ligne['email'] ."</li>";
        echo "</ul>";
        echo "</div>";
      }
      
    } else {
      $sql = "SELECT `nom`, `prenom`, `ville`, `email`, `sport_pratique`, `niveau`, `avatar` from `utilisateurs`";
      foreach ($db->query($sql) as $ligne) {
        $src = "uploads/";
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        if(!empty($ligne['avatar'])) {
          echo "<div style=\"display:flex; justify-content:center; padding-top: 10px;\">";
          echo "<img height=\"100px\" width=\"100px\" alt=\"Avatar\" class=\"rounded-circle\" src=". $src . $ligne['avatar'] . ">";
          echo "</div>";
        }
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\">" . $ligne['nom'] . " " . $ligne['prenom'] . "</h5>";
        echo "</div>";
        echo "<ul class=\"list-group list-group-flush\">";
        echo "<li class=\"list-group-item\">" . $ligne['sport_pratique'] . " - " . $ligne['niveau'] . "</li>";
        echo "<li class=\"list-group-item\">" . $ligne['ville'] . "</li>";
        echo "<li class=\"list-group-item\">". $ligne['email'] ."</li>";
        echo "</ul>";
        echo "</div>";
      }
    }
    ?>
    </div>
  </div>
</div>

<?php include_once 'includes/footer.php' ?>