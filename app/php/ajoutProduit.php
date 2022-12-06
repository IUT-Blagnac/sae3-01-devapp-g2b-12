<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <link rel="stylesheet" href="style/styleAjoutProduit.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
  include("header.php");
?>

<body>

<!-- A ENLEVER -->
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


<h1>Ajouter un produit</h1>


<form method="post" action="">

    <div class="form-gauche">
        <p>Nom du produit</p>
        <input type="text">
        <p>Description</p>
        <input type="textarea">
    </div>

    <div class="from-droite">

    </div>

</form>






</body>

</html>