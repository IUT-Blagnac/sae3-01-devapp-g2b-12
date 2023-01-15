<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Modifier mon compte</title>
    <link rel="icon" type="image/png" href="img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
    <link rel="stylesheet" href="include/style/modifierCompte.css">
</head>

<?php
  include("include/header.php");
  require_once("include/connect.inc.php");

  if ((empty($_SESSION["connecte"]) || $_SESSION["connecte"] != "oui")) {
    header("location: connexion.php");
    die();
  }

    
    $id_client = $_SESSION['idClient'];
    $nomBefore = $_SESSION["nom"];
    $prenomBefore = $_SESSION["prenom"];

    //On va chercher le mail pour pouvoir préremplir le champ de l'adresse email
    $req = "Select mail from Client Where nom = :nom And prenom = :prenom";
    $mail = oci_parse($connect, $req);
    oci_bind_by_name($mail, ":nom", $nomBefore);
    oci_bind_by_name($mail, ":prenom", $prenomBefore);
    $resultReq= oci_execute($mail);
   

    while(($donnees = oci_fetch_assoc($mail)) != false) {
        $emailBefore = $donnees["MAIL"];
       }

    //Si le bouton "Enregistrer" est pressé, on enregistre les changements dans la session et on modifie la BD
    if (isset($_POST['save'])) {
      $newNom = $_POST['nom-area'];
      $newPrenom = $_POST['prenom-area'];
      $newEmail = $_POST['email-area'];
      $_SESSION["nom"] = $newNom;
      $_SESSION["prenom"] = $newPrenom;
      $req2 = "Update Client Set nom = '$newNom', prenom = '$newPrenom', mail = '$newEmail' where idclient = '$id_client'";
      $modif = oci_parse($connect, $req2);
      oci_execute($modif);
      if (isset($_POST['new-mdp']) and isset($_POST['confirm-area'])) {
        if ($_POST['new-mdp'] == $_POST['confirm-area']) {
          if ($_POST['new-mdp'] != "") {
            $newMdp = password_hash($_POST['new-mdp'], PASSWORD_DEFAULT);
            $req3 = "Update Client Set mdp = '$newMdp' where idclient = '$id_client'";
            $modif2 = oci_parse($connect, $req3);
            oci_execute($modif2);
          }
        } else {
          // afficher message d'erreur
        }
      }
      oci_commit($connect);
      header("location: monCompte.php");
    }
     oci_free_statement($mail);

?>
<body>
<div class="boxModifierCompte">
  <div id="titre-modif-compte">Modification du compte</div>
  <form method="post" id="form-modif">
    <div class="modifier-nom">
      <label for="nom-area">Modifier votre nom :</label>
      <input type="text" id="nom-area" name="nom-area" required value="<?php echo $nomBefore; ?>">
    </div>
    <div class="modifier-prenom">
      <label for="prenom-area">Modifier votre prénom :</label>
      <input type="text" name="prenom-area" id="prenom-area" required value="<?php echo $prenomBefore; ?>">
    </div>
    <div class="modifier-email">
      <label for="email-area">Modifier votre adresse email :</label>
      <input type="text" name="email-area" id="email-area" required value="<?php echo $emailBefore; ?>">
    </div>
    <div class="modifier-mdp">
      <label for="new-mdp">Entrez le nouveau mot de passe :</label>
      <input type="password" name="new-mdp" id="new-mdp" placeholder="Nouveau mot de passe">
    </div>
    <div class="confirm-mdp">
      <label for="confirm-area" id="label-confirm">Confirmez le nouveau mot de passe :</label>
      <input type="password" name="confirm-area" id="confirm-area" placeholder="Confirmation du mot de passe">
    </div>
    <div class="bouttons">
      <button type="submit" id='bouton-jaune' name="save" value="Enregistrer">Enregistrer</button>
    </div>
  </form> 
</div>


</body>