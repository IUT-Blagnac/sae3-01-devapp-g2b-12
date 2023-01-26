<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Nos fruits</title>
    <link rel="icon" type="image/png" href="uploads/img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php

    // Requête pour récupérer l'ensemble des produits
    $req = "Select * from Produit Where (idcategorie = 2 or idcategorie = 12 or idcategorie = 13 or idcategorie = 14 or idcategorie = 15 or idcategorie = 16 or idcategorie = 17) and stock > 0";
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

    <h1 class="produits-titre">Nos fruits</h1>

    <div class="flex-column">
        <?php 
                if (isset($affichage)){
                    echo $affichage;
                }
            
            ?>
    </div>

</body>
</html>