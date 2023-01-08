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
    require_once("include/connect.inc.php");
?>

<body>
    
    <div class="baseline">
        <h1>Bienvenue sur LéguMania!</h1>
        <p>Sur notre site, ...</p>
    </div>

    <h1 class="index-h1">Produits populaires</h1>

    <!-- Produits choisis manuellement -->

    <div class="populaire">

        <div class="produit">
            <a href="produit.php?nom=Betterave%20potagère"> <img src="img/Betterave%20potagère.png" alt="image produit"> </a>
            <p>Betteraves potagères</p>
            <p>6,28€</p>
        </div>

        <div class="produit">
            <a href="produit.php?nom=Tomates%20Rose%20de%20Berne"> <img src="img/Tomates%20Rose%20de%20Berne.png" alt="image produit"> </a>
            <p>Tomates Roses de Berne</p>
            <p>2€59</p>
        </div>

        <div class="produit">
            <a href="produit.php?nom=Pomme%20Granny%20Smith"><img src="img/Pomme%20Granny%20Smith.png" alt="image produit"></a>
            <p>Pommes Granny Smith</p>
            <p>2,49€</p>
        </div>

    </div>

    <h1 class="index-h1">Nos produits de saison</h1>

    <?php

        // Requête pour récupérer l'ensemble des produits

        if(isset($_GET["affich"]) && $_GET["affich"] == "more"){

            $req = "Select * from Produit Where idproduit != 1 
                    and idproduit != 9 and idproduit != 17 
                    and idproduit != 44 and idproduit != 2
                    and idproduit != 42 and idproduit != 43";
            $produit = oci_parse($connect, $req);
            $result = oci_execute($produit);

            if (!$result){
                header("location:index.php");
                exit();
            }
            else{

                // On crée un compteur pour faire des lignes de 4 produits

                $affichage = " <div class='saison-ligne'>";
                $cpt = 0;

                while(($donnees = oci_fetch_assoc($produit)) != false) {
                    $nom = $donnees["NOM"];
                    $prix = $donnees["PRIX"];

                    if($cpt != 4){

                        // On remplace les espaces dans le nom du produit par leur code pour créer un lien valide
                        // Oignon rouge --> Oignon%20rouge

                        $nomRegex = preg_replace('" "', '%20', $nom);
                        $image = $nomRegex.'.png';

                        $lien = "
                            <a href='produit.php?nom=$nomRegex'>
                                <img src='img/$image'>
                            </a>";

                        // On ajoute le produit dans la ligne

                        $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';

                        $cpt++;

                    }
                    else{
                        // On ferme la ligne et on en crée une nouvelle

                        $affichage = $affichage.'</div> <div class="saison-ligne">';

                        $nomRegex = preg_replace('" "', '%20', $nom);
                        $image = $nomRegex.'.png';

                        $lien = "
                            <a href='produit.php?nom=$nomRegex'>
                                <img src='img/$image'>
                            </a>";

                        $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';

                        $cpt = 1;

                    }
                    
                }

                oci_free_statement($produit);

            }

        }


    ?>

    <div class="saison">

        <!-- Produits choisis manuellement -->
        
        <div class="saison-ligne">

            <div class="produit">
                <a href="produit.php?nom=Laitue%20frisée%20amérique"><img src="img/Laitue%20frisée%20amérique.png" alt="image produit"></a>
                <p>Cagette de laitues frisées</p>
                <p>4.5€</p>
            </div>

            <div class="produit">
                <a href="produit.php?nom=Chou-fleur%20Sud-Ouest"><img src="img/Chou-fleur%20Sud-Ouest.png" alt="image produit"></a>
                <p>Cagette de chou-fleur Sud-Ouest</p>
                <p>3,49€</p>
            </div>

            <div class="produit">
                <a href="produit.php?nom=Pomme%20Gala%20bio"><img src="img/Pomme%20Gala%20bio.png" alt="image produit"></a>
                <p>Pommes Gala Bio</p>
                <p>1,99€</p>
            </div>

            <div class="produit">
                <a href="produit.php?nom=Pomme%20Golden%20bio"><img src="img/Pomme%20Golden%20bio.png" alt="image produit"></a>
                <p>Pommes Golden Bio</p>
                <p>1,33€</p>
            </div>

        </div>

        <?php 

            if(isset($affichage)){
                echo $affichage;
            }

        ?>

        <?php 
        
        if(!isset($_GET["affich"])){

            echo '<a href="index.php?affich=more" id="index-plus-produits">Voir plus de produits</a>';
        }

        ?>

      

    </div>

</body>

</html>