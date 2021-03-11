<?php
require_once "./includes/connexion.php";

if (!empty($_POST)) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $mdp = $_POST['mdp'];
  $ville = $_POST['ville'];
  $sportPratique = $_POST['sportPratique'];
  $niveau = $_POST['niveau'];
  $nouveauSport = $_POST['nouveauSport'];

  if(empty($_FILES['avatar'])){
    $avatar = " ";
  } else{
    $avatar = basename($_FILES['avatar']['name']);
  }  

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
    $avatar = str_replace(" ", "", $avatar);
    if(empty($_FILES['avatar'])){
      $avatar = "user.png";
    }
    echo $avatar;

    $sql = $db->prepare("INSERT INTO `utilisateurs` (`nom`, `prenom`, `email`, `mot_de_passe`, `ville`, `sport_pratique`, `niveau`, `avatar`) VALUES (:nom, :prenom, :email, SHA1(:mdp), :ville, :sportPratique, :niveau, :avatar)");
    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':prenom', $prenom);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':mdp', $mdp);
    $sql->bindParam(':ville', $ville);
    $sql->bindParam(':avatar', $avatar);
    
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
      header("Location:../index.php");
    } else {
      exit('Erreur bdd');
    }
  } else {
    $msg = "Veuillez-remplir tout les champs";
    header("Location:../inscription.php?msg=$msg");
  }
}
?>