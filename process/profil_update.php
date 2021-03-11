<?php
require_once '../includes/database.php';

if (!empty($_POST)) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $mdp = $_POST['mdp'];
  $ville = $_POST['ville'];
  $sportPratique = $_POST['sportPratique'];
  $niveau = $_POST['niveau'];
  $nouveauSport = $_POST['nouveauSport'];

  $err = 0;
  if (empty($nom))
    $err = 1;
  if (empty($prenom))
    $err = 1;
  if (empty($email))
    $err = 1;
  if (empty($mdp))
    $err = 1;
  if (empty($ville))
    $err = 1;
  if (empty($sportPratique) && empty($nouveauSport))
    $err = 1;
  if (empty($niveau))
    $err = 1;
  if ($err == 0) {

    $requete = $db->prepare("SELECT `id` FROM `utilisateurs` WHERE `email` = $email");
    $requete->execute();
    $resultat = $requete->fetchAll();

    echo $resultat[0];

    $sql = $db->prepare("UPDATE `utilisateurs` SET `nom` = :nom, `prenom` = :prenom, `email` = :email, `mot_de_passe` = :mdp, `ville` = :ville, `sport_pratique` = :sport, `niveau` = :niveau) WHERE `id` = $resultat");
    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':prenom', $prenom);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':mdp', $mdp);
    $sql->bindParam(':ville', $ville);
    
    if (empty($sportPratique) && !empty($nouveauSport)) {
      $sportQuery = $db->prepare("SELECT * FROM `sports` WHERE `nom`= :nom");
      $sportQuery->bindParam(':nom', $nouveauSport);
      $sportQuery->execute();
      $count = $sportQuery->rowCount();

      if ($count == 0) {
        $sqlSport = $db->prepare("INSERT INTO `sports` (`nom`) VALUES (:nouveauSport)");
        $sqlSport->bindParam(':nouveauSport', $nouveauSport);
        $sqlSport->execute();
      }
        $sql->bindParam(':sportPratique', $nouveauSport);
      } else {
        $sql->bindParam(':sportPratique', $sportPratique);
      }
    
    $sql->bindParam(':niveau', $niveau);

    if (!empty($_FILES['avatar'])) {
      $uploadDir = '../uploads/';
      move_uploaded_file($_FILES['avatar']['tmp_name'],$uploadDir.$avatar);
    }
    if ($sql->execute()) {
      header("Location:../profil.php");
    } else {
      exit('Erreur bdd');
    }
  } else {
    $msg = "Veuillez-remplir tout les champs";
    // header("Location:../profil.php?msg=$msg");
  }
}
?>