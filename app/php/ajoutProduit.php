<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <link rel="stylesheet" href="style/styleAjoutProduit.css">
  <link rel="stylesheet" href="style/styleHeader.css"> <!--  Temporaire -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
include("include/header.php");
?>

<body>

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


  <h1 class="center">Ajouter un produit</h1>


  <div class="formulaire" id="borderTop">

    <form method="post" action="">

      <div class="form-gauche">
        <p>Nom du produit</p>
        <input type="text">

        <p>Description</p>
        <textarea name="description"></textarea>
      </div>

      <div class="from-droite">
        <p>Catégorie</p>
        <select name="categorie">
          <option value=""></option>
          <option value="cat1">Catégorie1</option>
          <option value="cat2">Catégorie2</option>
          <option value="cat3">Catégorie3</option>
        </select>

        <div class="ensemble">

          <div class="part">
            <p>Taille/poids cagette</p>
            <input type="text">
          </div>

          <div class="part">
            <p>Prix</p>
            <input type="number">
          </div>

        </div>

        <p>Image produit</p>
        <input type="file" name="imgProduit" accept="image/png, image/jpeg" value="choisir un fichier">

      </div>

    </form>

    <input type="submit" value="Ajouter le produit" class="center">

  </div>

</body>

</html>