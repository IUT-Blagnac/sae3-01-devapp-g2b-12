<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Nos compositions</title>
    <link rel="stylesheet" href="include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php

// Requête pour récupérer l'ensemble des produits

    $req = "Select * from Produit Where idcategorie = 18 or idcategorie = 19 or idcategorie = 20"; 
    $produit = oci_parse($connect, $req);
    $result = oci_execute($produit);

    if (!$result){
        header("location:legumes.php");
        exit();
    }
    else{

        // On crée un compteur pour faire des lignes de produits

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

    ?>

<body>

    <h1 class="produits-titre">Nos compositions: </h1>

    <div class="saison">
        
        <?php 
                if(isset($affichage)){
                    echo $affichage;
                }
            
            ?>

    </div>
    

</body>

</html>