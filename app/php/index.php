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
            <a href="legumes.php" class="item">Nos légumes</a>
            <a href="fruits.php" class="item">Nos fruits</a>
            <a href="compositions.php" class="item">Nos compositions</a>
            <a href="aPropos.php" class="item">A propos</a>
            <input type="button" value="CONNEXION" class="item">
        </div>
    </nav>
    <!-- -->


    <div class="baseline">
        <h1>Bienvenue sur LéguMania!</h1>
        <p>.</p>
        <p>.</p>
        <p>.</p>
        <p>.</p>
    </div>

    <h1>Produits populaires</h1>

    <div class="populaire">

        <div class="produit">
            <img src="img/pommes.png" alt="image produit">
            <p>Cagette de pommes rouges</p>
            <p>3,49€</p>
        </div>

        <div class="produit">
            <img src="img/pommes.png" alt="image produit">
            <p>Nom</p>
            <p>Prix</p>
        </div>

        <div class="produit">
            <img src="img/pommes.png" alt="image produit">
            <p>Nom</p>
            <p>Prix</p>
        </div>

    </div>

    <h1>Nos produits de saison</h1>

    <div class="saison">

        <div class="saison-ligne">

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>


        </div>

        <div class="saison-ligne">

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <img src="img/pommes.png" alt="image produit">
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>


        </div>

        <a href="">Voir plus de produits</a>

    </div>

</body>

</html>