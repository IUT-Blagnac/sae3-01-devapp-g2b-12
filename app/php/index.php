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
            <a href="index.php"><img src="img/logo.png" alt="Logo LéguMania" class="item"></a>
            <a href="index.php"><h1 class="item">LéguMania</h1></a>

            <form action="recherche.php" method="get" class="item search">
                <input type="text" placeholder="Rechercher" name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>

            <a href="panier.php"><img src="img/panier.png" alt="Icône panier" class="panier"></a>
        </div>

        <div class="bas">
            <a href="legumes.php" class="item">Nos légumes</a>
            <a href="fruits.php" class="item">Nos fruits</a>
            <a href="compositions.php" class="item">Nos compositions</a>
            <a href="aPropos.php" class="item">A propos</a>
            <a href="connexion.php" class="item bouton-orange">CONNEXION</a>
        </div>
    </nav>
    <div style="height: 155px"></div>
    <!-- -->


    <div class="baseline">
        <h1>Bienvenue sur LéguMania!</h1>
        <p>Sur notre site, ...</p>
    </div>

    <h1 class="index-h1">Produits populaires</h1>

    <div class="populaire">

        <div class="produit">
            <a href=""><img src="img/pommes.png" alt="image produit"></a>
            <p>Cagette de pommes rouges</p>
            <p>3,49€</p>
        </div>

        <div class="produit">
            <a href=""><img src="img/tomates.png" alt="image produit"></a>
            <p>Cagette de tomates</p>
            <p>2€59</p>
        </div>

        <div class="produit">
            <a href=""><img src="img/courgettes.png" alt="image produit"></a>
            <p>Cagette de courgettes</p>
            <p>1,59€</p>
        </div>

    </div>

    <h1 class="index-h1">Nos produits de saison</h1>

    <div class="saison">

        <div class="saison-ligne">

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>


        </div>

        <div class="saison-ligne">

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <a href=""><img src="img/pommes.png" alt="image produit"></a>
                <p>Cagette de pommes rouges</p>
                <p>3,49€</p>
            </div>


        </div>

        <a href="" id="index-plus-produits">Voir plus de produits</a>

    </div>

</body>

</html>