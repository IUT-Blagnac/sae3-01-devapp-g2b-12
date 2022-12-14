<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="include/style.css">
</head>

<?php
  include("include/header.php"); 
  require_once("include/connect.inc.php");

  if(isset($_COOKIE["cookConnexion"])){
    $login = $_COOKIE["cookConnexion"];
    $cookie = "checked";
  }
  else{
    $login = "";
    $cookie = "";
  }

  if(isset($_SESSION["erreur"]) && $_SESSION["erreur"] == "oui"){
    $erreur = "Email ou mot de passe invalide.";
    $_SESSION["erreur"] = "non";
  }
  else{
    $erreur = "";
  }
  
?>

<div style="text-align: center;">
  <p> <?php echo $erreur ?> </p>
</div>

<form method="post">
  <div class="box">
      <div class="connexion">Connexion</div>
      <div class="email">
        <label for="email">Email :</label>
        <input type="text" name="email" required value=<?php echo "$login" ?>>
        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" required>
        <label for="accepterCookie">Rester connecté</label>
        <input type="checkbox" name="accepterCookie" <?php echo $cookie ?> checked>
      </div>
      <div class="bco"><!-- bco = Bouton connexion-->
          <input type="submit" value="Se connecter" name="valider" id="form-connexion">
          <div style="margin-top: 26px">
            <a href="inscription.php" id="buttonCreerCompte"> Créer un compte </a>
          </div>
      </div>
    </div>
</form>


<?php

if(isset($_POST["valider"]) && isset($_POST["email"]) && isset($_POST["mdp"])){

  
  $login = $_POST["email"];
  $mdp =  $_POST["mdp"];

  $req = "Select * from Client Where mail = :mail";
  $client = oci_parse($connect, $req);
  oci_bind_by_name($client, ":mail", $login);
  $result = oci_execute($client);

  if (!$result) {
    $_SESSION["erreur"] == "oui";
    oci_free_statement($client);
    $e = oci_error($client);
    print htmlentities($e['message'].' pour cette requete : '.$e['sqltext']); 
    header("location:connexion.php");
    exit();
  }
  else{

    while (($donnees = oci_fetch_assoc($client)) != false) {
      $mdp_client = $donnees["MDP"];
      $id_client = $donnees["IDCLIENT"];
      $nom_client = $donnees["NOM"];
      $prenom_client = $donnees["PRENOM"];
      $est_agriculteur = $donnees["AGRICULTEUR"];
    }

    if(password_verify($mdp, $mdp_client)){
      $_SESSION["nom"] = $nom_client;
      $_SESSION["prenom"] = $prenom_client;
      $_SESSION["connecte"] = "oui";
      $_SESSION["agriculteur"] = $est_agriculteur;
      $_SESSION["idClient"] = $id_client;

      if($_POST["accepterCookie"] == "on"){
        setcookie('cookConnexion', $login, time() + 3600);
      }

      $_SESSION["erreur"] = "non";
      header("location:index.php");
    }
    else{
      $_SESSION["erreur"] = "oui";
      header("location:connexion.php");
    }

    oci_free_statement($client);
    exit();
  }

}

?>

</html> 
