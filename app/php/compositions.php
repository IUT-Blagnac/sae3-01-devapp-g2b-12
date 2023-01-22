<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Nos compositions</title>
    <link rel="icon" type="image/png" href="img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
    <link rel="stylesheet" href="include/style/compositions.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php

// Requête pour récupérer l'ensemble des produits

    $req = "Select * from Produit Where (idcategorie = 18 or idcategorie = 19 or idcategorie = 20) and stock > 0";
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
            $prix = $donnees["PRIX"];

            if($cpt != 4){

                // On remplace les espaces dans le nom du produit par leur code pour créer un lien valide
                // Oignon rouge --> Oignon%20rouge

                if (file_exists("img/".$nom.".png")) {
                    $nomRegex = preg_replace('" "', '%20', $nom);
                } else {
                    $nomRegex = "produit/inconnu";
                }
                $image = "img/".$nomRegex.".png";

                $affichage = $affichage."
                    <a href='produit.php?nom=".$nom."' class='boite-produit'>
                        <div class='produit'>
                            <img src='img/vide.png' style='background-image: url(\"".$image."\")'>
                            <p>".$nom."</p>
                            <strong>".$prix." €</strong>
                        </div>
                    </a>";

                $cpt++;

            }
            else{
                // On ferme la ligne et on en crée une nouvelle

                $affichage = $affichage.'</div> <div class="flex-row">';

                if (file_exists("img/".$nom.".png")) {
                    $nomRegex = preg_replace('" "', '%20', $nom);
                } else {
                    $nomRegex = "produit/inconnu";
                }
                $image = "img/".$nomRegex.".png";

                $affichage = $affichage."
                    <a href='produit.php?nom=".$nom."' class='boite-produit'>
                        <div class='produit'>
                            <img src='img/vide.png' style='background-image: url(\"".$image."\")'>
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

    <h1 class="produits-titre">Nos compositions</h1>

    <div class="saison">
        
        <?php 
                if(isset($affichage)){
                    echo $affichage;
                }
            
            ?>

    </div>
    

</body>

</html>