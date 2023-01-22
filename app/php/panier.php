<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Panier</title>
    <link rel="icon" type="image/png" href="img/icon/favicon.png">
    <link rel="stylesheet" href="include/style/general.css">
    <link rel="stylesheet" href="include/style/panier.css">
    <script type="text/javascript">
        function hideCardForm() {
            document.getElementById("cardNumber").disabled = true;
            document.getElementById("cardExpMouth").disabled = true;
            document.getElementById("cardExpYear").disabled = true;
            document.getElementById("cardDigit").disabled = true;
        }
        function showCardForm() {
            document.getElementById("cardNumber").disabled = false;
            document.getElementById("cardExpMouth").disabled = false;
            document.getElementById("cardExpYear").disabled = false;
            document.getElementById("cardDigit").disabled = false;
        }
    </script>
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php

    $tableauPanier = ""; // Affichage du panier
    $prixTotal = 0;
    $erreur = ""; // Message erreur lors du paiement
    $formPanier = "";

    if(!isset($_SESSION["commande-passee"])){
        $_SESSION["commande-passee"] = "oui";
    }
    
    /**
     * Traitement du panier si l'utilisateur est connecté
     * 
     */
    if(isset($_SESSION["connecte"]) && $_SESSION["connecte"] == "oui"){

        // Si l'utilisateur accède au panier après avoir changer la quantité d'un produit,
        // on fait un update dans la table panier
        if(isset($_POST["nvlle-qt"]) && isset($_POST['changer-qt'])){
            
            $req = "Update Panier Set quantite = :qt Where idclient = :idcli and idproduit = :idprod";
            $panier = oci_parse($connect, $req);
            oci_bind_by_name($panier, ":qt", $_POST["nvlle-qt"]);
            oci_bind_by_name($panier, ":idcli", $_SESSION["idClient"]);
            oci_bind_by_name($panier, ":idprod", $_POST["id-produit"]);
            $result = oci_execute($panier);
            oci_commit($connect);
            oci_free_statement($panier);
        }

        // Si l'utilisateur accède au panier depuis la page produit.php,
        // on ajoute l'id et la quantite dans la table Panier
        if(isset($_POST["id-produit"]) && isset($_POST["quantite"]) && isset($_POST["valider"])){
            
            $req = "Insert into Panier Values(:idclient, :idproduit, :qt)";
            $panier = oci_parse($connect, $req);
            oci_bind_by_name($panier, ":idclient", $_SESSION["idClient"]);
            oci_bind_by_name($panier, ":idproduit", $_POST["id-produit"]);
            oci_bind_by_name($panier, ":qt", $_POST["quantite"]);
            error_reporting(0);
            $result = oci_execute($panier);
            error_reporting(22527);
            oci_commit($connect);
            oci_free_statement($panier);
            $_SESSION["commande-passee"] = "non";
        }

        // Si l'utilisateur accède au panier via le boutton supprimer un article,
        // on supprime la ligne dans la table panier
        if(isset($_GET["suppr"])){
            $req = "Delete from Panier Where idproduit = :idpro and idclient = :idcli";
            $panier = oci_parse($connect, $req);
            oci_bind_by_name($panier, ":idpro", $_GET["suppr"]);
            oci_bind_by_name($panier, ":idcli", $_SESSION["idClient"]);
            $result = oci_execute($panier);
            oci_commit($connect);
            oci_free_statement($panier);
        }

        // Parcours du panier stocké dans la base de données
        
        //Requête 1: récupérer l'id des articles sélectionnés
        $req = "Select * from Panier Where idclient = :idcli";
        $panier = oci_parse($connect, $req);
        oci_bind_by_name($panier, ":idcli", $_SESSION["idClient"]);
        $result = oci_execute($panier);
        
        while(($donnees = oci_fetch_assoc($panier)) != false){
            $idProd = $donnees["IDPRODUIT"];
            $quantiteProduit = $donnees["QUANTITE"];

            //Requête 2: récupérer le nom, le prix et l'id de la catégorie des articles sélectionnés
            $req2 = "Select * from Produit Where idproduit = :idpro";
            $article = oci_parse($connect, $req2);
            oci_bind_by_name($article, ":idpro", $idProd);
            $result = oci_execute($article);

            while(($donnees2 = oci_fetch_assoc($article)) != false){
                $nomProduit = $donnees2["NOM"];
                $idCateg = $donnees2["IDCATEGORIE"];
                $prix = $donnees2["PRIX"];
            }

            oci_free_statement($article);

            //Requête 3: récupérer le nom de la catégorie des articles sélectionnés
            $req3 = "Select * from Categorie Where idcategorie = :idcateg";
            $categ = oci_parse($connect, $req3);
            oci_bind_by_name($categ, ":idcateg", $idCateg);
            $result = oci_execute($categ);

            while(($donnees3 = oci_fetch_assoc($categ)) != false){
                $nomCategorie = $donnees3["NOM"];
            }

            oci_free_statement($categ);

            //Regex pour remplacer les espaces du nom du produit
            $nomRegex = preg_replace('" "', '%20', $nomProduit);
            $lien = $nomRegex . '.png';

            //Affichage du produit
            $tableauPanier .= "<table class='panier-table'> 
                            <tr> 
                                <td style='background-color: #bbb7b7'> <img src='img/" . $lien ."' alt='image article' width='70%' height='70%'> </td>
                                <td> <p style='text-align: center;'>" . $nomProduit . "</p> </td>
                                <td> <p style='text-align: center;'>" . $nomCategorie . "</p> </td>
                                <td> <a style='margin-left: 30%;' href=\"panier.php?suppr=$idProd\"><img src='img/icon/retirer_du_panier.png' id='icon'></a> </td>
                                <td> 
                                    <form method='post' action='panier.php'>
                                        <input type='number' min='1' value='" . $quantiteProduit ."' name='nvlle-qt'>
                                        <input type='hidden' name='id-produit' value= $idProd>
                                        <input type='submit' name='changer-qt' value='Changer la quantité'>
                                    </form>
                                </td> 
                            </tr>
                        </table>";

            $prixTotal += floatval($prix) * floatval($quantiteProduit);
        }
        oci_free_statement($panier);
        }


    /**
     * Traitement du panier si l'utilisateur n'est pas connecté
     * 
     */
    if(!isset($_SESSION["connecte"]) || $_SESSION["connecte"] == "non"){

        // Si l'utilisateur accède au panier après avoir changer la quantité d'un produit
        if(isset($_POST["nvlle-qt"]) && isset($_POST['changer-qt'])){
            $_SESSION["panier"][$_POST["id-produit"]] = $_POST["nvlle-qt"];
            header("location:panier.php");
            exit();
        }

        // Si l'utilisateur accède au panier depuis la page produit.php,
        // on ajoute l'id et la quantite dans la session
        if(isset($_POST["id-produit"]) && isset($_POST["quantite"]) && isset($_POST["valider"])){
            $id = $_POST["id-produit"];
            $quant = $_POST["quantite"];
            $_SESSION["panier"][$id] = $quant;
            $_SESSION["commande-passee"] = "non";
        }

        // Si l'utilisateur accède au panier via le boutton supprimer un article
        if(isset($_GET["suppr"])){
            if(array_key_exists($_GET["suppr"], $_SESSION["panier"])){
                unset($_SESSION['panier'][$_GET["suppr"]]);
            }
        }

        // Parcours du panier stocké dans la session
        foreach($_SESSION["panier"] as $idProduit => $quantiteProduit){
            //Requête pour récupérer les données du produit
            $req = "Select * from Produit Where idproduit = :id";
            $produit = oci_parse($connect, $req);
            oci_bind_by_name($produit, ":id", $idProduit);
            $result = oci_execute($produit);

            while(($donnees = oci_fetch_assoc($produit)) != false){
                $idCategorie = $donnees["IDCATEGORIE"];
                $prix = $donnees["PRIX"];
                $nom = $donnees["NOM"];
            }

            //Requête pour récupérer la catégorie
            $req2 = "Select * from Categorie Where idcategorie = :id";
            $categorie = oci_parse($connect, $req2);
            oci_bind_by_name($categorie, ":id", $idCategorie);
            $result = oci_execute($categorie);

            while(($donnees = oci_fetch_assoc($categorie)) != false){
                $nomCategorie = $donnees["NOM"];
            }

            //Regex pour remplacer les espaces du nom du produit
            $nomRegex = preg_replace('" "', '%20', $nom);
            $lien = $nomRegex . '.png';

            //Affichage du produit

            $tableauPanier .= "<table class='panier-table'> 
                                <tr> 
                                    <td style='background-color: #bbb7b7'> <img src='img/" . $lien ."' alt='image article' width='70%' height='70%'> </td>
                                    <td> <p style='text-align: center;'>" . $nom . "</p> </td>
                                    <td> <p style='text-align: center;'>" . $nomCategorie . "</p> </td>
                                    <td> <a style='margin-left: 30%;' href=\"panier.php?suppr=$idProduit\"><img src='img/icon/retirer_du_panier.png' id='icon'></a> </td>
                                    <td> 
                                        <form method='post' action='panier.php'>
                                            <input type='number' min='1' value='" . $quantiteProduit ."' name='nvlle-qt'>
                                            <input type='hidden' name='id-produit' value= $idProduit>
                                            <input type='submit' name='changer-qt' value='Changer la quantité'>
                                        </form>
                                    </td> 
                                </tr>
                            </table>";

            $prixTotal += floatval($prix) * floatval($quantiteProduit);

            oci_free_statement($produit);
            oci_free_statement($categorie);
        }

    }

    /**
     * Traitement du panier si l'utilisateur a rempli son panier puis s'est connecté
     * Le panier est dans la session. Il faut le déplacer dans la BD.
     */
    if(!empty($_SESSION["panier"]) && isset($_SESSION["connecte"]) && $_SESSION["connecte"] == "oui"){

        // Parcours du panier dans la sessions
        foreach($_SESSION["panier"] as $idProduit => $quantiteProduit){

            // Ajout du panier dans la BD
            $req = "Insert into Panier Values(:idclient, :idproduit, :qt)";
            $panier = oci_parse($connect, $req);
            oci_bind_by_name($panier, ":idclient", $_SESSION["idClient"]);
            oci_bind_by_name($panier, ":idproduit", $idProduit);
            oci_bind_by_name($panier, ":qt", $quantiteProduit);
            $result = oci_execute($panier);
            oci_commit($connect);
            oci_free_statement($panier);

            // Récupération des données du produit
            $req2 = "Select * from Produit Where idproduit = :idPro";
            $article = oci_parse($connect, $req2);
            oci_bind_by_name($article, ":idPro", $idProduit);
            $result = oci_execute($article);
            while(($donnees = oci_fetch_assoc($article)) != false){
                $nom = $donnees["NOM"];
                $idCategorie = $donnees["IDCATEGORIE"];
                $prix = $donnees["PRIX"];
            }
            oci_free_statement($article);

            // Récupération du nom de la catégorie
            $req3 = "Select * from Categorie Where idcategorie = :idCat";
            $categorie = oci_parse($connect, $req3);
            oci_bind_by_name($categorie, ":idCat", $idCategorie);
            $result = oci_execute($categorie);
            while(($donnees = oci_fetch_assoc($categorie)) != false){
                $nomCategorie = $donnees["NOM"];
            }
            oci_free_statement($categorie);

            //Regex pour remplacer les espaces du nom du produit
            $nomRegex = preg_replace('" "', '%20', $nom);
            $lien = $nomRegex . '.png';

            //Affichage du produit

            $tableauPanier .= "<table class='panier-table'> 
                                <tr> 
                                    <td style='background-color: #bbb7b7'> <img src='img/" . $lien ."' alt='image article' width='70%' height='70%'> </td>
                                    <td> <p style='text-align: center;'>" . $nom . "</p> </td>
                                    <td> <p style='text-align: center;'>" . $nomCategorie . "</p> </td>
                                    <td> <a style='margin-left: 30%;' href=\"panier.php?suppr=$idProduit\"><img src='img/icon/retirer_du_panier.png' id='icon'></a> </td>
                                    <td> 
                                        <form method='post' action='panier.php'>
                                            <input type='number' min='1' value='" . $quantiteProduit ."' name='nvlle-qt'>
                                            <input type='hidden' name='id-produit' value= $idProduit>
                                            <input type='submit' name='changer-qt' value='Changer la quantité'>
                                        </form>
                                    </td> 
                                </tr>
                            </table>";

            $prixTotal += floatval($prix) * floatval($quantiteProduit);

        }

        // On vide le panier de la session
        $_SESSION["panier"] = array();
    }

    /**
     * Traitement du panier lorsque l'utilisateur valide la commande
     * On insère le règlement dans la BD
     * On appelle la procédure qui transforme un panier en commande
     * 
     */
    if(isset($_POST["payer"]) ){

        // Paiement avec carte bancaire
        if($_POST["paiement"] == "cb"
            && isset($_POST["cardNumber"]) && $_POST["cardExpMounth"] != ""
            && $_POST["cardExpYear"] != "" && $_POST["cardDigit"] != ""){

            // Vérification du numéro de cb
            $numLength = strlen((string)$_POST["cardNumber"]);
            if($numLength != 16){
                $erreur .= " Numéro de carte invalide.";
            }
            else{

                // Insert dans Reglement
                $req = "Insert into Reglement Values(seq_reglement.nextval)";
                $reglement = oci_parse($connect, $req);
                $result = oci_execute($reglement);
                oci_commit($connect);
                oci_free_statement($reglement);
                
                // On récupère l'id inséré
                $req = "Select max(idreglement) from Reglement";
                $reglement = oci_parse($connect, $req);
                $result = oci_execute($reglement);
                $donnees = oci_fetch_assoc($reglement);
                $idReg = $donnees["MAX(IDREGLEMENT)"];
                oci_free_statement($reglement);

                // Insert dans CarteBancaire
                $req = "Insert into CARTEBANCAIRE Values(:idReg, :numCb, :crypto, :moisExp, :anneeExp)";
                $carteB = oci_parse($connect, $req);
                $carteNum = intval($_POST["cardNumber"]);
                $carteMois = intval($_POST["cardExpMounth"]);
                $carteAnnee = intval($_POST["cardExpYear"]);
                $carteCode = intval($_POST["cardDigit"]);
                oci_bind_by_name($carteB, ":idReg", $idReg);
                oci_bind_by_name($carteB, ":numCb", $carteNum);
                oci_bind_by_name($carteB, ":crypto", $carteCode);
                oci_bind_by_name($carteB, ":moisExp", $carteMois);
                oci_bind_by_name($carteB, ":anneeExp", $carteAnnee);
                $result = oci_execute($carteB);
                oci_commit($connect);
                oci_free_statement($carteB);

                // Appel de la procédure
                $req = "Begin Commander(:idCli, :idReg, :adr, :ville, :codeP); end;";
                $commande = oci_parse($connect, $req);
                $codePostal = intval($_POST["codeP"]);
                oci_bind_by_name($commande, ":idCli", $_SESSION["idClient"]);
                oci_bind_by_name($commande, ":idReg", $idReg);
                oci_bind_by_name($commande, ":adr", $_POST["adresse"]);
                oci_bind_by_name($commande, ":ville", $_POST["ville"]);
                oci_bind_by_name($commande, ":codeP", $codePostal);
                $result = oci_execute($commande);
                oci_free_statement($commande);

                $_SESSION["commande-passee"] = "oui";
                header("location:index.php");
                exit();
                
            } 

            }
            else{
                $erreur = "Information(s) manquante(s) !";
            }

            if($_POST["paiement"] == "paypal"){
   
                // Insert dans Reglement
                $req = "Insert into Reglement Values(seq_reglement.nextval)";
                $reglement = oci_parse($connect, $req);
                $result = oci_execute($reglement);
                oci_commit($connect);
                oci_free_statement($reglement);
                
                // On récupère l'id inséré
                $req = "Select max(idreglement) from Reglement";
                $reglement = oci_parse($connect, $req);
                $result = oci_execute($reglement);
                $donnees = oci_fetch_assoc($reglement);
                $idReg = $donnees["MAX(IDREGLEMENT)"];
                oci_free_statement($reglement);
    
                // Insert dans Paypal
                $req = "Insert into Paypal Values(:idReg)";
                $paypal = oci_parse($connect, $req);
                oci_bind_by_name($paypal, ":idReg", $idReg);
                $result = oci_execute($paypal);
                oci_commit($connect);
                oci_free_statement($paypal);
    
                // Appel de la procédure
                $req = "Begin Commander(:idCli, :idReg, :adr, :ville, :codeP); end;";
                $commande = oci_parse($connect, $req);
                $codePostal = intval($_POST["codeP"]);
                oci_bind_by_name($commande, ":idCli", $_SESSION["idClient"]);
                oci_bind_by_name($commande, ":idReg", $idReg);
                oci_bind_by_name($commande, ":adr", $_POST["adresse"]);
                oci_bind_by_name($commande, ":ville", $_POST["ville"]);
                oci_bind_by_name($commande, ":codeP", $codePostal);
                $result = oci_execute($commande);
                oci_free_statement($commande);
                
                $_SESSION["commande-passee"] = "oui";
                header("location:index.php");
                exit();
            }
            
        }
        
?>

<body>
    <?php
        echo $tableauPanier;
        echo "<p style='color: red; margin-left: 5%;'> $erreur </p>";
    
        if(isset($_SESSION["connecte"]) && $_SESSION["connecte"] == "oui") {

            if($_SESSION["commande-passee"] == "non"){

                $formPanier = "
                    <form method='post' action='panier.php'>

                    <div class='panier-form-column'>
                        <h2>Moyen de paiement</h2>
            
                        <div>
                            <input type='radio' name='paiement' id='cb' onclick='showCardForm()' value='cb'checked>
                            <label for='cb'>Carte bancaire</label>
                        </div>
            
                        <div>
                            <input type='radio' name='paiement' id='pp' onclick='hideCardForm()' value='paypal'>
                            <label for='pp'>PayPal</label>
                        </div>
            
                        <p>Numéro de carte</p>
                        <input type='number' name='cardNumber' id='cardNumber'>
            
                        <p>Mois</p>
                        <input type='number' name='cardExpMounth' id='cardExpMouth' min='01' max='12'>
            
                        <p>Année</p>
                        <input type='number' name='cardExpYear' id='cardExpYear' min='2023'>
        
                        <p>Code</p>
                        <input type='number' name='cardDigit' id='cardDigit' min='000' max='999'>
            
                        <p id='prix-panier'>Prix total: $prixTotal €</p>
                        <input type='submit' value='Payer' name='payer'>

                    </div>
                        <div class='panier-form-column'>
                            <h2>Données de livraison</h2>
                
                            <p>Adresse</p>
                            <input type='text' required name='adresse'>
                
                            <p>Ville</p>
                            <input type='text' required name='ville'>
                
                            <p>Code Postal</p>
                            <input type='number' required name='codeP' min='11111' max='99999'>
                        </div>
                    </form> ";

                echo $formPanier;

            }
            else{
                echo "<p style='text-align: center;'> Votre panier est vide. </p>";
            }
           
        }
        else{
            echo "<p style='text-align: center;'> Connectez-vous pour régler votre commande. </p>";
        }
    ?>
</body>
</html>