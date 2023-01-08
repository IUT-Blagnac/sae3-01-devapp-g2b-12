<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="include/style.css">
  
</head>

<?php
   include("include/header.php"); 
?>

<?php

/*
  Ajouter limite de taille pour les mots de passe
  et vérifier avec regex
*/
?>

<div class="boite">
  <div id="inscription">Inscription</div>
  <div class="informations">
    <div class="gauche">
     <label for="nom">Nom :</label>
     <input type="text" name="nom">
     <div id="prenom">
      <label for="prenom">Prénom :</label>
      <input type="text" name="prenom">
     </div>
     <div id="emailadress">
      <label for="email">Adresse mail :</label>
      <input type="text" name="email">
     </div>
    </div>
    <div class="droite">
      <label for="mdp">Mot de passe :</label>
      <input type="text" name="mdp">
     <div id="mdpConfirmation">
      <label for="confirmMdp">Confirmation du mot de passe :</label>
      <input type="text" name="confirmMdp">
     </div>
     <div id="check">
      <input type="checkbox" name="agriculteur">
      <label for="agriculteur">Utilisateur agriculteur ?</label>
     </div>
    </div>
  </div>
  <div class="buttins"><!-- buttins = Bouton inscription-->
      <input type="button" value="Créer un compte">
  </div>
</div>

</html> 