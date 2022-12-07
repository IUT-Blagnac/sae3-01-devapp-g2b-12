<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="include/style.css">
  <link rel="stylesheet" href="include/styleConnexion.css">
  
</head>

<?php
   include ("header.php"); 
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

<div class="box">
	<div class="connexion">Connexion</div>
	<div class="email">
		<label for="email">Email :</label>
		<input type="text" name="email">
		<label for="mdp">Mot de passe :</label>
		<input type="text" name="mdp">
	</div>
  <div class="bco"><!-- bco = Bouton connexion-->
      <input type="button" value="Se connecter">
      <div id="buttonCreerCompte">
        Créer un compte
      </div>
  </div>
</div>


</html> 
