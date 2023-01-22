<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Recherche de produit</title>
    <link rel="icon" type="image/png" href="img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
    <link rel="stylesheet" href="include/style/recherche.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php 

    // Accès à la page depuis le header
    if(isset($_POST["valider"]) && isset($_POST["search"])){

        unset($_SESSION["recherche-produit"]);
        unset($_SESSION["recherche-categorie"]);
        unset($_SESSION["affichage-recherche"]);
        unset($_SESSION["idCat"]);
        $_SESSION["tab-categorie"] = array();

        // L'utilisateur a entré un mot-clé
        // On effectue un traitement différent selon la saisie de l'utilisateur
        if($_POST["search"] != ""){

            $_SESSION["rechercheBio"] = false;
            $nom = ""; // nom de la catégorie

            // Traitement des recherches bio
            // L'utilisateur cherche un produit ou une catégorie bio en particuler
            if(preg_match("#.bio$#", $_POST["search"])){
                $_SESSION["rechercheBio"] = true;
                $recherche = explode(" ", $_POST["search"]);
                $mot = $recherche[0];
                $nom = ucfirst(strtolower($mot));
            }
            else{
                $nom = ucfirst(strtolower($_POST["search"]));
            }
           
            // Traitement 1 - Catégorie
            $_SESSION["affichage-recherche"] = $_POST["search"];
            
            $req = "Select * from Categorie Where nom like :nom";
            $categories = oci_parse($connect, $req);
            $nomCategorie = "%" . $nom . "%";
            oci_bind_by_name($categories, ":nom", $nomCategorie);
            $result = oci_execute($categories);

            $affichage = "<div class='saison-ligne'>";
            $cpt = 0;

            // On entre dans cette boucle uniquement si le mot-clé saisi est une catégorie
            // Pour chaque catégorie, on recherche les produits correspondants
            while(($donnees = oci_fetch_assoc($categories)) != false) {

                $idCateg = $donnees["IDCATEGORIE"];
                array_push($_SESSION["tab-categorie"], $idCateg);
                $produits = "";

                $_SESSION["idCat"] = $idCateg;  // Sert uniquement pour la recherche categorie + bio
               
                if($_SESSION["rechercheBio"] == true){
                    $req = "Select * from Produit Where idcategorie = :id and nom like :nom";
                    $nomProduit = "%" . "bio" . "%";
                    $produits = oci_parse($connect, $req);
                    oci_bind_by_name($produits, ":id", $idCateg);
                    oci_bind_by_name($produits, ":nom", $nomProduit);
                }
                else{
                    $req = "Select * from Produit Where idcategorie = :id";
                    $produits = oci_parse($connect, $req);
                    oci_bind_by_name($produits, ":id", $idCateg);

                }

                $result = oci_execute($produits);

                $_SESSION["recherche-categorie"] = $_POST["search"];

                while(($donnees2 = oci_fetch_assoc($produits)) != false) {

                    $nom = $donnees2["NOM"];
                    $prix = $donnees2["PRIX"];

                    if($cpt != 4){

                        $nomRegex = preg_replace('" "', '%20', $nom);
                        $image = $nomRegex.'.png';
                        $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";

                        $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';

                        $cpt++;
                    }
                    else{
                        // On ferme la ligne et on en crée une nouvelle
                        $affichage = $affichage.'</div> <div class="saison-ligne">';

                        $nomRegex = preg_replace('" "', '%20', $nom);
                        $image = $nomRegex.'.png';
                        $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";

                        $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';

                        $cpt = 1;
                    } 

                }

                oci_free_statement($produits);

            }

            oci_free_statement($categories);
          
            // Traitement 2 - Produit

            // On entre dans ce test uniquement si le mot-clé n'est pas une catégorie
            if(!isset($_SESSION["recherche-categorie"])){

                // La recherche change en fonction du mot-clé
                //

                // Recherche des produits bio d'une catégorie
                if($_SESSION["rechercheBio"] == true && isset($_SESSION["idCat"])){
                    $req = "Select * from Produit Where nom like :nom and idcategorie = :id";
                    $produits = oci_parse($connect, $req);
                    $nomProduit = "%" . $nom . "%";
                    oci_bind_by_name($produits, ":nom", $nomProduit);
                    oci_bind_by_name($produits, ":id", $_SESSION["idCat"]);
                }
                else{

                    // Recherche d'un produit bio
                    if($_SESSION["rechercheBio"] == true){

                        $req = "Select * from Produit Where nom like :nom";
                        $produits = oci_parse($connect, $req);
                        $nomProduit = "%" . $nom . "%" . "bio";
                        oci_bind_by_name($produits, ":nom", $nomProduit);

                    }
                    else{

                        // Recherche uniquement sur le nom
                        $req = "Select * from Produit Where nom like :nom";
                        $produits = oci_parse($connect, $req);
                        $nomProduit = "%" . $nom . "%";
                        oci_bind_by_name($produits, ":nom", $nomProduit);
                    }

            
                }

                $_SESSION["recherche-produit"] = $nom;
            
                $result = oci_execute($produits);

                if(!$result){
                    oci_free_statement($produits);
                }
                else{
                    // On crée un compteur pour faire des lignes de 4 produits
                    $affichage = "<div class='saison-ligne'>";
                    $cpt = 0;

                    while(($donnees = oci_fetch_assoc($produits)) != false) {
                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];

                        if($cpt != 4){

                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";

                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';

                            $cpt++;
                        }
                        else{
                            // On ferme la ligne et on en crée une nouvelle
                            $affichage = $affichage.'</div> <div class="saison-ligne">';

                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";

                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';

                            $cpt = 1;
                        } 
                    }
                }
            }        
        }
    }

    // Accès à la page depuis le formulaire des filtres
    // Le traitement change si l'utilisateur a entré ou non un mot-clé
    // Recherche non bio
    if(isset($_POST["validerForm"]) && $_SESSION["rechercheBio"] = false){

        $affichage = "<div class='saison-ligne'>";
        $cpt = 0;

        // L'utilisateur a cherché une catégorie
        // Il filtre par région
        if(isset($_SESSION["recherche-categorie"])){
        
            if($_POST["region"] != ""){

                $_SESSION["affichage-recherche"].= " + " . $_POST["region"];
                foreach($_SESSION["tab-categorie"] as $id){
                    $req = "Select * from Produit Where idcategorie = :id and region = :region";
                    $produit = oci_parse($connect, $req);
                    oci_bind_by_name($produit, ":id", $id);
                    oci_bind_by_name($produit, ":region", $_POST["region"]);
                    $result = oci_execute($produit);

                    while(($donnees = oci_fetch_assoc($produit)) != false){

                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];
    
                        if($cpt != 4){
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';
                            $cpt++;
                        }
                        else{
                            $affichage = $affichage.'</div> <div class="saison-ligne">';
    
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';
    
                            $cpt = 1;
                        }  
                    }
                }
            }
        }

        // L'utilisateur a cherché un produit
        // Il peut filtrer par région et catégorie
        if(isset($_SESSION["recherche-produit"])){
           
            if($_SESSION["recherche-produit"] != ""){
                $nom = $_SESSION["recherche-produit"];
                $filtre = "";
                $idCateg = "";
        
                // On récupère l'id de la catégorie choisie par l'utilisateur
                if($_POST["categorie"] != ''){
                    $req = "Select * from Categorie Where nom = :nomC";
                    $categ = oci_parse($connect, $req);
                    oci_bind_by_name($categ, ":nomC", $_POST["categorie"]);
                    $result = oci_execute($categ);
                    $donnees = oci_fetch_assoc($categ);
                    $idCateg = $donnees["IDCATEGORIE"];
                    oci_free_statement($categ);
                }
    
                // Si l'utilisateur filtre sur la région
                if($_POST["categorie"] == '' && $_POST["region"] != ''){
                    $req = "Select * from Produit Where region = :nomR and nom like :nomP";
                    $filtre = oci_parse($connect, $req);
                    $nomProduit = "%" . $nom . "%";
                    oci_bind_by_name($filtre, ":nomR", $_POST["region"]);
                    oci_bind_by_name($filtre, ":nomP", $nomProduit);
                    $_SESSION["affichage-recherche"].= " + " . $_POST["region"];
                }
    
                // Si l'utilisateur filtre sur la catégorie
                if($_POST["categorie"] != '' && $_POST["region"] == ''){
                    $req = "Select * from Produit Where idcategorie = :idC and nom like :nomP";
                    $filtre= oci_parse($connect, $req);
                    $nomProduit = "%" . $nom . "%";
                    oci_bind_by_name($filtre, ":idC", $idCateg);
                    oci_bind_by_name($filtre, ":nomP", $nomProduit);
                    $_SESSION["affichage-recherche"].= " + " . $_POST["categorie"];
                }
    
                // Si l'utilisateur filtre sur la catégorie et la région
                if($_POST["categorie"] != '' && $_POST["region"] != ''){
                    $req = "Select * from Produit Where idcategorie = :idC and nom like :nomP and region = :nomR";
                    $filtre= oci_parse($connect, $req);
                    $nomProduit = "%" . $nom . "%";
                    oci_bind_by_name($filtre, ":idC", $idCateg);
                    oci_bind_by_name($filtre, ":nomP", $nomProduit);
                    oci_bind_by_name($filtre, ":nomR", $_POST["region"]);
                    $_SESSION["affichage-recherche"].= " + " . $_POST["categorie"] . " + " . $_POST["region"];
                } 
    
                // Exécution de la requête
                $result = oci_execute($filtre);
            
                if(!$result){
                    oci_free_statement($filtre);
                }
                else{
                    $affichage = "<div class='saison-ligne'>";
                    $cpt = 0;
                        
                    while(($donnees = oci_fetch_assoc($filtre)) != false) {
                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];
    
                        if($cpt != 4){
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';
                            $cpt++;
                        }
                        else{
                            $affichage = $affichage.'</div> <div class="saison-ligne">';
    
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';
    
                            $cpt = 1;
                        } 
                    }
                }
                oci_free_statement($filtre);
            }
        }

        // L'utilisateur n'a pas entré de mot-clé
        if(!isset($_SESSION["recherche-produit"]) && !isset($_SESSION["recherche-categorie"])){

            // Si l'utilisateur n'a pas entré de mot-clé et recherche par région
            if($_POST["categorie"] == '' && $_POST["region"] != ''){
                $req = "Select * from Produit Where region = :nomR";
                $produit = oci_parse($connect, $req);
                oci_bind_by_name($produit, ":nomR", $_POST["region"]);
                $_SESSION["affichage-recherche"] = $_POST["region"];

                $result = oci_execute($produit);
        
                if(!$result){
                    oci_free_statement($produit);
                }
                else{
                    $affichage = "<div class='saison-ligne'>";
                    $cpt = 0;
                    while(($donnees = oci_fetch_assoc($produit)) != false) {
                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];
    
                        if($cpt != 4){
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';
                            $cpt++;
                        }
                        else{
                            $affichage = $affichage.'</div> <div class="saison-ligne">';
    
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';
    
                            $cpt = 1;
                        } 
                    }
                }
                oci_free_statement($produit);
            }

            // Si l'utilisateur n'a pas entré de mot-clé et recherche par catégorie
            if($_POST["categorie"] != '' && $_POST["region"] == ''){

                $_SESSION["affichage-recherche"] = $_POST["categorie"];
                // Requête pour récupérer les catégories
                $req = "Select * from Categorie Where nom = :nomCat";
                $categorie = oci_parse($connect, $req);
                oci_bind_by_name($categorie, ":nomCat", $_POST["categorie"]);
                $result = oci_execute($categorie);
                $donnees = oci_fetch_assoc($categorie);
                $idCategorie = $donnees["IDCATEGORIE"]; 
                oci_free_statement($categorie);

                $req = "Select * from Produit Where idcategorie = :idCat";
                $produit = oci_parse($connect, $req);
                oci_bind_by_name($produit, ":idCat", $idCategorie);

                $result = oci_execute($produit);
        
                if(!$result){
                    oci_free_statement($produit);
                }
                else{
                    $affichage = "<div class='saison-ligne'>";
                    $cpt = 0;
                    while(($donnees = oci_fetch_assoc($produit)) != false) {
                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];
    
                        if($cpt != 4){
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';
                            $cpt++;
                        }
                        else{
                            $affichage = $affichage.'</div> <div class="saison-ligne">';
    
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';
    
                            $cpt = 1;
                        } 
                    }
                }
                oci_free_statement($produit);
            }

            // Si l'utilisateur n'a pas entré de mot-clé et recherche par catégorie et par région
            if($_POST["categorie"] != '' && $_POST["region"] != ''){

                $_SESSION["affichage-recherche"] = $_POST["categorie"] . " + " . $_POST["region"];

                // Requête pour récupérer les catégories
                $req = "Select * from Categorie Where nom = :nomCat";
                $categorie = oci_parse($connect, $req);
                oci_bind_by_name($categorie, ":nomCat", $_POST["categorie"]);
                $result = oci_execute($categorie);
                $donnees = oci_fetch_assoc($categorie);
                $idCategorie = $donnees["IDCATEGORIE"]; 
                oci_free_statement($categorie);

                $req = "Select * from Produit Where region = :nomR and idcategorie = :idCat";
                $produit = oci_parse($connect, $req);
                oci_bind_by_name($produit, ":nomR", $_POST["region"]);
                oci_bind_by_name($produit, ":idCat", $idCategorie);
                $result = oci_execute($produit);
        
                if(!$result){
                    oci_free_statement($produit);
                }
                else{
                    $affichage = "<div class='saison-ligne'>";
                    $cpt = 0;
                    while(($donnees = oci_fetch_assoc($produit)) != false) {
                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];
    
                        if($cpt != 4){
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';
                            $cpt++;
                        }
                        else{
                            $affichage = $affichage.'</div> <div class="saison-ligne">';
    
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';
    
                            $cpt = 1;
                        } 
                    }
                }
                oci_free_statement($produit);
            }
        }

    }

    // Accès à la page depuis le formulaire des filtres
    // Recherche bio
    if(isset($_POST["validerForm"]) && $_SESSION["rechercheBio"] = true){

        $affichage = "<div class='saison-ligne'>";
        $cpt = 0;

        // L'utilisateur a cherché une catégorie
        // Il filtre par région
        if(isset($_SESSION["recherche-categorie"])){
        
            if($_POST["region"] != ""){

                $_SESSION["affichage-recherche"].= " + " . $_POST["region"];
                foreach($_SESSION["tab-categorie"] as $id){
                    $req = "Select * from Produit Where idcategorie = :id and region = :region and nom like :nom";
                    $produit = oci_parse($connect, $req);
                    $nomP = "%" . "bio" . "%";
                    oci_bind_by_name($produit, ":id", $id);
                    oci_bind_by_name($produit, ":region", $_POST["region"]);
                    oci_bind_by_name($produit, ":nom", $nomP);
                    $result = oci_execute($produit);

                    while(($donnees = oci_fetch_assoc($produit)) != false){

                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];
    
                        if($cpt != 4){
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';
                            $cpt++;
                        }
                        else{
                            $affichage = $affichage.'</div> <div class="saison-ligne">';
    
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';
    
                            $cpt = 1;
                        }  
                    }
                }
            }
        }

        // L'utilisateur a cherché un produit
        // Il peut filtrer par région et catégorie
        if(isset($_SESSION["recherche-produit"])){
           
            if($_SESSION["recherche-produit"] != ""){
                $nom = $_SESSION["recherche-produit"];
                $filtre = "";
                $idCateg = "";
        
                // On récupère l'id de la catégorie choisie par l'utilisateur
                if($_POST["categorie"] != ''){
                    $req = "Select * from Categorie Where nom = :nomC";
                    $categ = oci_parse($connect, $req);
                    oci_bind_by_name($categ, ":nomC", $_POST["categorie"]);
                    $result = oci_execute($categ);
                    $donnees = oci_fetch_assoc($categ);
                    $idCateg = $donnees["IDCATEGORIE"];
                    oci_free_statement($categ);
                }
    
                // Si l'utilisateur filtre sur la région
                if($_POST["categorie"] == '' && $_POST["region"] != ''){
                    $req = "Select * from Produit Where region = :nomR and nom like :nomP";
                    $filtre = oci_parse($connect, $req);
                    $nomProduit = "%" . $nom . "%" . "bio";
                    oci_bind_by_name($filtre, ":nomR", $_POST["region"]);
                    oci_bind_by_name($filtre, ":nomP", $nomProduit);
                    $_SESSION["affichage-recherche"].= " + " . $_POST["region"];
                }
    
                // Si l'utilisateur filtre sur la catégorie
                if($_POST["categorie"] != '' && $_POST["region"] == ''){
                    $req = "Select * from Produit Where idcategorie = :idC and nom like :nomP";
                    $filtre= oci_parse($connect, $req);
                    $nomProduit = "%" . $nom . "%" . "bio";
                    oci_bind_by_name($filtre, ":idC", $idCateg);
                    oci_bind_by_name($filtre, ":nomP", $nomProduit);
                    $_SESSION["affichage-recherche"].= " + " . $_POST["categorie"];
                }
    
                // Si l'utilisateur filtre sur la catégorie et la région
                if($_POST["categorie"] != '' && $_POST["region"] != ''){
                    $req = "Select * from Produit Where idcategorie = :idC and nom like :nomP and region = :nomR";
                    $filtre= oci_parse($connect, $req);
                    $nomProduit = "%" . $nom . "%" . "bio";
                    oci_bind_by_name($filtre, ":idC", $idCateg);
                    oci_bind_by_name($filtre, ":nomP", $nomProduit);
                    oci_bind_by_name($filtre, ":nomR", $_POST["region"]);
                    $_SESSION["affichage-recherche"].= " + " . $_POST["categorie"] . " + " . $_POST["region"];
                } 
    
                // Exécution de la requête
                $result = oci_execute($filtre);
            
                if(!$result){
                    oci_free_statement($filtre);
                }
                else{
                    $affichage = "<div class='saison-ligne'>";
                    $cpt = 0;
                        
                    while(($donnees = oci_fetch_assoc($filtre)) != false) {
                        $nom = $donnees["NOM"];
                        $prix = $donnees["PRIX"];
    
                        if($cpt != 4){
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . '€</p></div>';
                            $cpt++;
                        }
                        else{
                            $affichage = $affichage.'</div> <div class="saison-ligne">';
    
                            $nomRegex = preg_replace('" "', '%20', $nom);
                            $image = $nomRegex.'.png';
                            $lien = "<a href='produit.php?nom=$nomRegex'> <img src='img/$image'> </a>";
    
                            $affichage = $affichage . '<div class="produit">' . $lien . '<p>' . $nom . '</p> <p>' . $prix . ' €</p></div>';
    
                            $cpt = 1;
                        } 
                    }
                }
                oci_free_statement($filtre);
            }
        }

    }

    // Création du formulaire de recherche
    // Si l'utilisateur a cherché une catégorie, on filtre uniquement par région
    // Si l'utilisateur a cherché un produit, on filtre par région et/ou catégorie
    // Si l'utilisateur n'a pas saisi de mot-clé, on filtre par région et/ou catégorie
    $formulaire = "<div class='recherche-form'>
                        <p>Filtres de recherche:</p>
                        <form method='post' action ='recherche.php'>";

    // L'utilisateur a cherché une catégorie
    if(isset($_SESSION["recherche-categorie"]) /*&& $_SESSION["recherche-categorie"] != ""*/){
        $formulaire .= "</select> <select name='region'> <option value=''>-- Choisir une région --</option>";

        // Requête pour récupérer les régions
        $req = "Select unique region from Produit";
        $region = oci_parse($connect, $req);
        $result = oci_execute($region);
        while(($donnees = oci_fetch_assoc($region)) != false){
            $nomRegion = $donnees["REGION"];
            $formulaire .= '<option>' . $nomRegion . '</option>';
        }
        oci_free_statement($region);

        /*
        if(isset($_POST["region"])){
            $message = "Recherche de: " . $_SESSION["recherche-categorie"] . " + " . $_POST["region"];
        }
        else{
            $message = "Recherche de: " . $_SESSION["recherche-categorie"];
        }*/
        
    }

    // L'utilisateur a cherché un produit
    if(isset($_SESSION["recherche-produit"]) /*&& $_SESSION["recherche-produit"] != ""*/ ){

        $formulaire .= "<select name='categorie'> <option value=''>-- Choisir une catégorie --</option>";

        // Requête pour récupérer les catégories
        $req = "Select * from Categorie Where idcategorie != 1 and idcategorie != 2 and idcategorie != 3";
        $categorie = oci_parse($connect, $req);
        $result = oci_execute($categorie);
        while(($donnees = oci_fetch_assoc($categorie)) != false){
            $nomCategorie = $donnees["NOM"];
            $formulaire .= '<option>' . $nomCategorie . '</option>';
        }
        oci_free_statement($categorie);

        $formulaire .= "</select> <select name='region'> <option value=''>-- Choisir une région --</option>";

        // Requête pour récupérer les régions
        $req = "Select unique region from Produit";
        $region = oci_parse($connect, $req);
        $result = oci_execute($region);
        while(($donnees = oci_fetch_assoc($region)) != false){
            $nomRegion = $donnees["REGION"];
            $formulaire .= '<option>' . $nomRegion . '</option>';
        }
        oci_free_statement($region);

        /*
        $message = "Recherche de: " . $_SESSION["recherche-produit"];

        if(isset($_POST["region"])){
            $message .= " + " . $_POST["region"];
        }

        if(isset($_POST["categorie"])){
            $message .= " + " . $_POST["categorie"];
        }*/
    }

    // L'utilisateur n'a pas entré de mot-clé
    if(isset($_POST["valider"]) && isset($_POST["search"]) && $_POST["search"] == ""){
        $formulaire .= "<select name='categorie'> <option value=''>-- Choisir une catégorie --</option>";

        // Requête pour récupérer les catégories
        $req = "Select * from Categorie Where idcategorie != 1 and idcategorie != 2 and idcategorie != 3";
        $categorie = oci_parse($connect, $req);
        $result = oci_execute($categorie);
        while(($donnees = oci_fetch_assoc($categorie)) != false){
            $nomCategorie = $donnees["NOM"];
            $formulaire .= '<option>' . $nomCategorie . '</option>';
        }
        oci_free_statement($categorie);

        $formulaire .= "</select> <select name='region'> <option value=''>-- Choisir une région --</option>";

        // Requête pour récupérer les régions
        $req = "Select unique region from Produit";
        $region = oci_parse($connect, $req);
        $result = oci_execute($region);
        while(($donnees = oci_fetch_assoc($region)) != false){
            $nomRegion = $donnees["REGION"];
            $formulaire .= '<option>' . $nomRegion . '</option>';
        }
        oci_free_statement($region);

        $message = "Aucun mot-clé saisi. Utilisez les filtres ci-dessous pour rechercher un produit.";

    }

    // L'utilisateur n'a pas entré de mot-clé et filtre ses résultats
    if(isset($_POST["validerForm"]) && !isset($_SESSION["recherche-produit"]) && !isset($_SESSION["recherche-categorie"])){
        $formulaire .= "<select name='categorie'> <option value=''>-- Choisir une catégorie --</option>";

        // Requête pour récupérer les catégories
        $req = "Select * from Categorie Where idcategorie != 1 and idcategorie != 2 and idcategorie != 3";
        $categorie = oci_parse($connect, $req);
        $result = oci_execute($categorie);
        while(($donnees = oci_fetch_assoc($categorie)) != false){
            $nomCategorie = $donnees["NOM"];
            $formulaire .= '<option>' . $nomCategorie . '</option>';
        }
        oci_free_statement($categorie);

        $formulaire .= "</select> <select name='region'> <option value=''>-- Choisir une région --</option>";

        // Requête pour récupérer les régions
        $req = "Select unique region from Produit";
        $region = oci_parse($connect, $req);
        $result = oci_execute($region);
        while(($donnees = oci_fetch_assoc($region)) != false){
            $nomRegion = $donnees["REGION"];
            $formulaire .= '<option>' . $nomRegion . '</option>';
        }
        oci_free_statement($region);

        /*
        $message = "Recherche de produits";

        if(isset($_POST["region"])){
            $message .= " + " . $_POST["region"];
        }

        if(isset($_POST["categorie"])){
            $message .= " + " . $_POST["categorie"];
        }*/

    }


    
    $formulaire .= "</select> <input type='submit' name='validerForm' value='Valider'> </form> </div>";

?>

<body>

    <h3 class="recherche-nom" style="font-style: italic;"> <?php if(isset($message)) echo $message; ?> </h3>

    <h3 class="recherche-nom" style="font-style: italic;"> <?php if(isset($_SESSION["affichage-recherche"])) echo "Recherche de: " . $_SESSION["affichage-recherche"]; ?> </h3>

    <?php echo $formulaire; ?>
    
    <?php if(isset($affichage)) echo $affichage; ?>
    
</body>
</html>