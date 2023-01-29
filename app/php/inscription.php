<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="icon" type="image/png" href="uploads/img/icon/favicon.png">
  <link rel="stylesheet" href="include/style/general.css">
  <link rel="stylesheet" href="include/style/inscription.css">
  
</head>

<?php
  include("include/header.php");
  require_once("include/connect.inc.php");

  if ((isset($_SESSION["connecte"]) && $_SESSION["connecte"] == "oui")) {
    header("location: connexion.php");
    die();
  }

  $_SESSION["erreur"] = "";


  //Bouton Créer un compte est pressé
  if (isset($_POST["create-acc"])) {
  	//on stocke les champs
  	  $nom = htmlspecialchars($_POST["nom"]);
      $prenom = htmlspecialchars($_POST["prenom"]);
      $email = htmlspecialchars($_POST["email"]);
      $mdp = htmlspecialchars($_POST["mdp"]);
      $confirmMdp = htmlspecialchars($_POST["confirmMdp"]);
      //Puis on vérifie qu'ils soient tous conformes
  	if (!preg_match("#^\S.{0,126}\S$#", $nom)) {
				$_SESSION["erreur"] = "Le nom doit être compris entre 2 et 128 charactères, et ne doit pas commencer ou finir par un espace blanc.";
	}
	if (!preg_match("#^\S.{0,126}\S$#", $prenom)) {
				$_SESSION["erreur"] = "Le prenom doit être compris entre 2 et 128 charactères, et ne doit pas commencer ou finir par un espace blanc.";
	}
	if (!preg_match("#^\S.{0,126}\S$#", $email)){
				$_SESSION["erreur"] = "L'adresse email doit être comprise entre 2 et 128 charactères, et ne doit pas commencer ou finir par un espace blanc.";
	}
	if (!preg_match("#^\S.{10,126}\S$#", $mdp)){
        $_SESSION["erreur"] = "Le mot de passe doit être compris entre 12 et 128 charactères, et ne doit pas commencer ou finir par un espace blanc.";
	}
	if (!preg_match("#^\S.{10,126}\S$#", $confirmMdp)){
        $_SESSION["erreur"] = "Le mot de passe doit être compris entre 12 et 128 charactères, et ne doit pas commencer ou finir par un espace blanc.";
	}

	if ($_SESSION["erreur"] == "") {
		//Si il n'y a aucune erreur on vérifie que les deux mots de passe soient égaux
		if (($_POST["mdp"]) == ($_POST["confirmMdp"])){
			//Si les mots de passes sont conformes on vérifie si l'utilisateur souhaite posséde un compte agriculteur
			//Si oui on crée le compte agriculteur
        	if (isset($_POST["agriculteur"])) {
          		$mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
         		$req = "Insert into client Values (SEQ_CLIENT.nextVal, '$nom', '$prenom', '$email', '$mdp', 1)";
          		$inscription = oci_parse($connect, $req);
          		error_reporting(0);
          		$result = oci_execute($inscription);
          		error_reporting(22527);
          		if (!$result){
          			// $e = oci_error($inscription);
          			$_SESSION["erreur"] = "L'adresse email que vous avez entré est déjà utilisée, veuillez en entrer une nouvelle.";
          		} else {
          			header("location: connexion.php");
          			oci_commit($connect);
          		}
         	//Sinon on crée le compte sans les droits d'agriculteur
        	} else {
          		$mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
          		$req2 = "Insert into client Values (SEQ_CLIENT.nextVal, '$nom', '$prenom', '$email', '$mdp', 0)";
          		$inscription2 = oci_parse($connect, $req2);
          		error_reporting(0);
          		$result2 = oci_execute($inscription2);
          		error_reporting(22527);
          		if (!$result2){
          			// $e = oci_error($inscription2);
          			$_SESSION["erreur"] = "L'adresse email que vous avez entré est déjà utilisée, veuillez en entrer une nouvelle.";
          		} else {
          			header("location: connexion.php");
          			oci_commit($connect);
          		}
        	}
      	//Si les mots de passes entrés ne sont pas égaux, on en alerte l'utilisateur
    		} else {
    			$_SESSION["erreur"] = "Veuillez entrer des mots de passe identiques pour valider l'inscription.";
    		}
		}	
  }
 

?>


<div class="erreur"><?php echo $_SESSION["erreur"]; $_SESSION["erreur"] = ""; ?></div>


<form method="post" id="form-inscription">
<div class="boite-contour">
 <div class="texte-contour">Inscription</div>
 <div class="blabla">
  <div class="gauche">
   <div class="ins-nom">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required>
   </div>
   <div class="ins-prenom">
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" required>
   </div>
   <div class="ins-emailadress">
    <label for="email">Adresse email :</label>
    <input type="email" name="email" required>
   </div>
 </div>
   <div class="droite">
   <div class="ins-mdp">
    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" required>
   </div>
   <div class="ins-confirmMdp">
    <label for="confirmMdp">Confirmation du mot de passe :</label>
    <input type="password" name="confirmMdp" required>
   </div>
   <div id="check">
    <p><input type="checkbox" name="agriculteur" id="agriculteur">
    <label for="agriculteur">Utilisateur agriculteur ?</label></p>
    <p><input type="checkbox" name="check-conditions" required id="check-conditions">
    <label for="check-conditions">J'accepte les conditions d'utilisation</label></p>
   </div>
   </div>
  </div>
 <button type="submit" name="create-acc" id="bouton-jaune">Créer un compte</button>
</div>
</form>

<div style="border: solid 2px; border-radius: 20px; margin: 3%;">
	<h1 style="color: #13a527; text-shadow: 3px 2px #B7B7B7; margin-top: 30px; margin-left: 3%;">Conditions d'utilisation</h1>
	<p style="margin-left: 3%;">En créant un compte, vous acceptez que vos données personnelles soit stockées et traitées. Les informations demandées à l'inscription sont nécessaires et obligatoires pour la création de ce compte. Nous assurons une collecte et un traitement de vos informations personnelles conformes à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés.</p>
</div>

</html> 