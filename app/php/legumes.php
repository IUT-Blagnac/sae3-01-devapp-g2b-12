<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Nos légumes</title>
    <link rel="icon" type="image/png" href="uploads/img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php

// Requête pour récupérer l'ensemble des produits

    $req = "Select * from Produit Where (idcategorie = 1 or idcategorie = 4 or idcategorie = 5 or idcategorie = 6 or idcategorie = 7 or idcategorie = 8 or idcategorie = 9 or idcategorie = 10 or idcategorie = 11) and stock > 0";
    $produit = oci_parse($connect, $req);
    $result = oci_execute($produit);

    if (!$result){
        exit();
    }
    else{

        // On crée un compteur pour faire des lignes de produits

        $affichage = " <div class='flex-row'>";
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
            else{
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

    ?>

<body>

    <h1 class="produits-titre">Nos légumes</h1>

    <div class="saison">
        
        <?php 
                if(isset($affichage)){
                    echo $affichage;
                }
            
            ?>

    </div>
    

</body>

</html>