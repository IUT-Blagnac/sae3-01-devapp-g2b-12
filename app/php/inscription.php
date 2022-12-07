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

<!-- Temporaire -->
  <nav>
    <div class="haut">
      <img src="img/logo.png" alt="logo" width="5%" height="5%" class="item">
      <h1 class="item">LéguMania</h1>

      <form action="" method="post" class="item">
        <input type="text" placeholder="Rechercher" name="search1">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>

      <img src="img/panier.png" alt="image panier" class="img-panier" width="5%" height="5%">
    </div>

    <div class="bas">
      <a href="" class="item">Nos légumes</a>
      <a href="" class="item">Nos fruits</a>
      <a href="" class="item">Nos compositions</a>
      <a href="" class="item">A propos</a>
      <input type="button" value="CONNEXION " class="item">
    </div>
  </nav>
<!-- -->

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
     <div id="mdpConfirmation"
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