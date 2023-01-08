<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php
	
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
      $consult = "<a href='consultationProduit.php' id='lien-consult'><input type='submit' value='Consulter vos produits' name='consulter' id='bouton-consulter-produits'></a>";
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
  <a href="modifierCompte.php" id="lien-modif"><input type="submit" value="Modifier les informations du compte" name="modif" id="bouton-modifierCompte"></a>
</div>

<?php echo $consult; ?>


</body>