<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Panier</title>
    <link rel="stylesheet" href="include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        function hideCardForm() {
            document.getElementById("cardNumber").disabled = true;
            document.getElementById("cardExpMouth").disabled = true;;
            document.getElementById("cardExpYear").disabled = true;;
            document.getElementById("cardDigit").disabled = true;;
        }
        function showCardForm() {
            document.getElementById("cardNumber").disabled = false;;
            document.getElementById("cardExpMouth").disabled = false;;
            document.getElementById("cardExpYear").disabled = false;;
            document.getElementById("cardDigit").disabled = false;;
        }
    </script>
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>

<?php
    // Si l'utilisateur accède au panier depuis la page produit.php
    if(isset($_POST["id-produit"]) && isset($_POST["quantite"]) && isset($_POST["valider"])){

        // On ajoute le nom et la quantite dans la session

        $id = $_POST["id-produit"];
        $quant = $_POST["quantite"];

        array_push($_SESSION["panier"], [$id => $quant]);

        // indice 0: [id => quantite]
        // indice 1: [id => quantite]
    }

    $tableauPanier = "";
    $prixTotal = 0;

    // Parcours du panier stocké dans la session
    foreach($_SESSION["panier"] as $produit){

        foreach($produit as $idProduit => $quantiteProduit){
            // echo $idProduit . ' ' . $quantiteProduit;

            //Requête pour récupérer les données du produit
            $req = "Select * from Produit Where idproduit = :id";
            $produit = oci_parse($connect, $req);
            oci_bind_by_name($produit, ":id", $idProduit);
            $result = oci_execute($produit);

            while(($donnees = oci_fetch_assoc($produit)) != false) {
                $idCategorie = $donnees["IDCATEGORIE"];
                $prix = $donnees["PRIX"];
                $nom = $donnees["NOM"];
            }

            //Requête pour récupérer la catégorie
            $req2 = "Select * from Categorie Where idcategorie = :id";
            $categorie = oci_parse($connect, $req2);
            oci_bind_by_name($categorie, ":id", $idCategorie);
            $result = oci_execute($categorie);

            while (($donnees = oci_fetch_assoc($categorie)) != false) {
                $nomCategorie = $donnees["NOM"];
            }

            //Regex pour remplacer les espaces du nom du produit
            $nomRegex = preg_replace('" "', '%20', $nom);
            $lien = $nomRegex . '.png';

            //Affichage du produit

            $tableauPanier .= "<table> 
                                <tr> 
                                    <td style='background-color: #bbb7b7'> <img src='img/" . $lien ."' alt='image article' width='70%' height='70%'> </td>
                                    <td> <p>" . $nom . "</p> </td>
                                    <td> <p>" . $nomCategorie . "</p> </td>
                                    <td> <p>" . $quantiteProduit . "</p> </td>
                                    <td> <a href=\"\">supprimer</a> </td>
                                </tr>
                            </table>";

            $prixTotal .= $prix * $quantiteProduit;

        oci_free_statement($produit);
        oci_free_statement($categorie);

        }
    }
?>

<body>
    <?php
        echo $tableauPanier;
        // var_dump($_SESSION["panier"]);
    ?>

    <!-- A ne pas afficher si on est pas connecté -->
    <form method="post" action="">

        <div class="panier-form-column">
            <h2>Moyen de paiement</h2>

            <div>
                <input type="radio" name="paiement" id="cb" onclick="showCardForm()" checked>
                <label for="cb">Carte bancaire</label>
            </div>

            <div>
                <input type="radio" name="paiement" id="pp" onclick="hideCardForm()">
                <label for="pp">PayPal</label>
            </div>

            <p>Numéro de carte</p>
            <input type="text" name="cardNumber" id="cardNumber">

            <p>Mois</p>
            <input type="number" name="cardExpMouth" id="cardExpMouth">

            <p>Année</p>
            <input type="number" name="cardExpYear" id="cardExpYear">

            <p>Code</p>
            <input type="number" name="cardDigit" id="cardDigit">

            <p id="prix-panier">Prix total: ... €</p>
            <?php echo $prixTotal ?>
            <input type="submit" value="Payer">
        </div>

        <div class="panier-form-column">
            <h2>Données de livraison</h2>

            <p>Adresse</p>
            <input type="text" required>

            <p>Ville</p>
            <input type="text" required>

            <p>Code Postal</p>
            <input type="number" required>
        </div>
    </form>
</body>
</html>