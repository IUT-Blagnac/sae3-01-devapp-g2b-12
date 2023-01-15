<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon compte</title>
    <link rel="icon" type="image/png" href="img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
    <link rel="stylesheet" href="include/style/monCompte.css">
</head>

<?php
  include("include/header.php");
  require_once("include/connect.inc.php");

  if ((empty($_SESSION["connecte"]) || $_SESSION["connecte"] != "oui")) {
    header("location: connexion.php");
    die();
  }

	
	  $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
  	
    //Requête utilisée pour sélectionner les informations à afficher qui ne sont pas indiquées dans la session.
  	$req = "Select mail, agriculteur from Client Where nom = :nom And prenom = :prenom";
  	$infos = oci_parse($connect, $req);
  	oci_bind_by_name($infos, ":nom", $nom);
  	oci_bind_by_name($infos, ":prenom", $prenom);
  	$result = oci_execute($infos);
    
    while(($donnees = oci_fetch_assoc($infos)) != false) {
      $email = $donnees["MAIL"];
      $agriculteur = $donnees["AGRICULTEUR"];
    }

    if ($agriculteur == 1) {
      $agriculteur = "Ce compte est inscrit en tant qu'agriculteur.";
      // $consult = "<a href='listeProduitMisEnVente.php' id='lien-consult'><input type='submit' value='Consulter vos produits' name='consulter' id='bouton-consulter-produits'></a>";
      $consult = '<a href="listeProduitMisEnVente.php" class="bouton-vert">Consulter vos produits</a>';
     } else {
        $agriculteur = "Ce compte n'est pas inscrit en tant qu'agriculteur.";
        $consult = "";
     }

     oci_free_statement($infos);
?>

<body>
<div class="boxInfos">
  <div id="titreInfos">Informations du compte</div>
  <div class="nom-wrap">
    <label for="nomCompte">Nom enregistré :</label>
    <div id="nomCompte"><?php echo $nom; ?></div>
  </div>
   <div class="prenom-wrap">
    <label for="prenomCompte">Prenom enregistré :</label>
    <div id="prenomCompte"><?php echo $prenom; ?></div>
  </div>
  <div class="email-wrap">
   <label for="emailCompte">Adresse email enregistrée :</label>
   <div id="emailCompte"><?php echo $email; ?></div>
  </div>
  <div id="compteAgriculteur"><?php echo $agriculteur; ?></div>
  <!-- <a href="modifierCompte.php" id="lien-modif"><input type="submit" value="Modifier les informations du compte" name="modif" id="bouton-modifierCompte"></a> -->
  <div class="boutons">
    <a href="modifierCompte.php" id="bouton-jaune">Modifier les informations du compte</a>
    <?php echo $consult; ?>
  </div>
</div>

</body>
</html>