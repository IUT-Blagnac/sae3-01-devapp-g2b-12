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
?>

<body>

    <!-- Temporaire -->
    <nav>
        <div class="haut">
            <img src="img/logo.png" alt="Logo LéguMania" class="item">
            <h1 class="item">LéguMania</h1>

            <form action="recherche" method="get" class="item">
                <input type="text" placeholder="Rechercher" name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>

            <img src="img/panier.png" alt="Icône panier" class="img-panier">
        </div>

        <div class="bas">
            <a href="" class="item">Nos légumes</a>
            <a href="" class="item">Nos fruits</a>
            <a href="" class="item">Nos compositions</a>
            <a href="" class="item">A propos</a>
            <input type="button" value="CONNEXION" class="item">
        </div>
    </nav>
    <!-- -->

    <h1 class="produits-titre">Nos fruits: </h1>

    <table class="produits-table">
        <tr>
            <td><img src="img/pommes.png" alt="image produit"></td>
            <td><img src="img/pommes.png" alt="image produit"></td>
            <td><img src="img/pommes.png" alt="image produit"></td>
        </tr>
        <tr>
            <td><img src="img/pommes.png" alt="image produit"></td>
            <td><img src="img/pommes.png" alt="image produit"></td>
            <td><img src="img/pommes.png" alt="image produit"></td>
        </tr>
    </table>




</body>

</html>