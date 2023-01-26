<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Accueil - LéguMania</title>
    <link rel="icon" type="image/png" href="uploads/img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
    <link rel="stylesheet" href="include/style/index.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<body>
    
    <div class="baseline">
        <h1>Bienvenue sur LéguMania!</h1>
        <p>Sur notre site, vous pouvez acheter des fruits et des légumes de qualité!</p>
        <p>Vos achats soutiennent directement les producteurs locaux.</p>
    </div>

    <h1 class="titre">Produits populaires</h1>

    <!-- Produits choisis manuellement -->

    <div class="populaire">

        <a href="produit.php?nom=Betterave%20potagère" class="boite-produit">
            <div class="produit">
                <img style="background-image: url('uploads/img/produit/Betterave%20potagère.png')">
                <p>Betteraves potagères</p>
                <strong>6.28 €</strong>
            </div>
        </a>

        <a href="produit.php?nom=Tomates%20Rose%20de%20Berne" class="boite-produit">
            <div class="produit">
                <img style="background-image: url('uploads/img/produit/Tomates%20Rose%20de%20Berne.png')">
                <p>Tomates Roses de Berne</p>
                <strong>2.59 €</strong>
            </div>
        </a>

        <a href="produit.php?nom=Pomme%20Granny%20Smith" class="boite-produit">
            <div class="produit">
                <img style="background-image: url('uploads/img/produit/Pomme%20Granny%20Smith.png')">
                <p>Pommes Granny Smith</p>
                <strong>2.49 €</strong>
            </div>
        </a>

    </div>

    <h1 class="titre">Nos produits de saison</h1>

    <?php

        // Requête pour récupérer l'ensemble des produits

        if(isset($_GET["affich"]) && $_GET["affich"] == "more"){

            $req = "Select * from Produit Where idproduit != 1 
                    and idproduit != 9 and idproduit != 17 
                    and idproduit != 44 and idproduit != 2
                    and idproduit != 42 and idproduit != 43
                    and stock > 0";
            $produit = oci_parse($connect, $req);
            $result = oci_execute($produit);

            if (!$result){
                exit();
            }
            else{

                // On crée un compteur pour faire des lignes de 4 produits

                $affichage = "<div class='flex-row'>";
                $cpt = 0;

                while(($donnees = oci_fetch_assoc($produit)) != false) {
                    $nom = $donnees["NOM"];
                    // change le prix en fonction du % soldé
                    $prix = $donnees["PRIX"] * (1-($donnees["SOLDE"]/100));

                    if($cpt != 6){

                        // On remplace les espaces dans le nom du produit par leur code pour créer un lien valide
                        // Oignon rouge --> Oignon%20rouge

                        if (file_exists("uploads/img/produit/".$nom.".png")) {
                            $nomRegex = "produit/".preg_replace('" "', '%20', $nom);
                        } else {
                            $nomRegex = "inconnu";
                        }
                        $image = "uploads/img/".$nomRegex.".png";

                        $affichage = $affichage."
                            <a href='produit.php?nom=".$nom."' class='boite-produit'>
                                <div class='produit'>
                                    <img style='background-image: url(\"".$image."\")'>
                                    <p>".$nom."</p>
                                    <strong>".$prix." €</strong>
                                </div>
                            </a>";

                        $cpt++;

                    }
                    else {
                        // On ferme la ligne et on en crée une nouvelle

                        $affichage = $affichage.'</div> <div class="flex-row">';

                        if (file_exists("uploads/img/produit/".$nom.".png")) {
                            $nomRegex = "produit/".preg_replace('" "', '%20', $nom);
                        } else {
                            $nomRegex = "inconnu";
                        }
                        $image = "uploads/img/".$nomRegex.".png";

                        $affichage = $affichage."
                            <a href='produit.php?nom=".$nom."' class='boite-produit'>
                                <div class='produit'>
                                    <img style='background-image: url(\"".$image."\")'>
                                    <p>".$nom."</p>
                                    <strong>".$prix." €</strong>
                                </div>
                            </a>";

                        $cpt = 1;

                    }
                    
                }

                oci_free_statement($produit);

            }

        }


    ?>

    <div class="flex-column">

        <!-- Produits choisis manuellement -->
        
        <div class="flex-row">

            <a href="produit.php?nom=Laitue%20frisée%20amérique" class="boite-produit">
                <div class="produit">
                    <img style="background-image: url('uploads/img/produit/Laitue%20frisée%20amérique.png')">
                    <p>Cagette de laitues frisées</p>
                    <strong>4.50 €</strong>
                </div>
            </a>

            <a href="produit.php?nom=Chou-fleur%20Sud-Ouest" class="boite-produit">
                <div class="produit">
                    <img style="background-image: url('uploads/img/produit/Chou-fleur%20Sud-Ouest.png')">
                    <p>Cagette de chou-fleur Sud-Ouest</p>
                    <strong>3.49 €</strong>
                </div>
            </a>

            <a href="produit.php?nom=Pomme%20Gala%20bio" class="boite-produit">
                <div class="produit">
                    <img style="background-image: url('uploads/img/produit/Pomme%20Gala%20bio.png')">
                    <p>Pommes Gala Bio</p>
                    <strong>1.99 €</strong>
                </div>

            <a href="produit.php?nom=Pomme%20Golden%20bio" class="boite-produit">
                <div class="produit">
                    <img style="background-image: url('uploads/img/produit/Pomme%20Golden%20bio.png')">
                    <p>Pommes Golden Bio</p>
                    <strong>1.33 €</strong>
                </div>
            </a>

        </div>

        <?php 

            if(isset($affichage)){
                echo $affichage;
            }

        ?>

        <?php 
        
        if(!isset($_GET["affich"])){

            echo '<a href="index.php?affich=more" class="bouton-vert">Voir tout les produits</a>';
        }

        ?>

      

    </div>

</body>

</html>