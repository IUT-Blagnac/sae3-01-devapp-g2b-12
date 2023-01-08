<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Produit</title>
    <link rel="stylesheet" href="include/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
    include("include/header.php");
    require_once("include/connect.inc.php");
?>


<?php
    if(isset($_GET["nom"])){

        $nom = $_GET["nom"];

        // Requete 1 - Recherche du produit

        $req = "Select * from Produit Where nom = :nom";
        $produit = oci_parse($connect, $req);
        oci_bind_by_name($produit, ":nom", $nom);
        $result = oci_execute($produit);

        if (!$result){
          oci_free_statement($produit);
          header("location:index.php");
          exit();
        }
        else{

            // Récupération des valeurs
      
            while(($donnees = oci_fetch_assoc($produit)) != false) {
                $id = $donnees["IDPRODUIT"];
                $description = $donnees["DESCRIPTION"];
                $idCategorie = $donnees["IDCATEGORIE"];
                $poids = $donnees["POIDS"];
                $prix = $donnees["PRIX"];
                $region = $donnees["REGION"];
            }

            oci_free_statement($produit);

            $image = $nom.".png";

            // Requete 2 - Recherche de la catégorie

            $req2 = "Select * from Categorie Where idcategorie = :id";
            $categorie = oci_parse($connect, $req2);
            oci_bind_by_name($categorie, ":id", $idCategorie);
            $result = oci_execute($categorie);

            while (($donnees2 = oci_fetch_assoc($categorie)) != false) {
                $nomCategorie = $donnees2["NOM"];
            }

            oci_free_statement($categorie);

            $nomRegex = preg_replace('" "', '%20', $nom);

        }
        
    }
    else{
        header("location:index.php");
        exit();
    }

?>

<body>
    <div class="div-centree">
        <div class="consultation">

            <img src="img/<?php echo $image ?>" alt="image produit">

            <div class="description-produit">
                <p id="titreProduitConsultation"> <?php echo $nom; ?> </p>
                <p>Description: <?php echo $description; ?> </p>
                <p>Catégorie: <?php echo $nomCategorie; ?> </p>
                <p>Région: <?php echo $region; ?> </p>
                <p>Poids: <?php echo $poids; ?> kg</p>
                <h2>Prix: <?php echo $prix; ?> €</h2>

                <div class="consultation-bouttons">
        
                    <form method="post" action="panier.php">
                        <!-- Champ caché pour envoyer l'id du produit -->
                        <input type="hidden" name="id-produit" value= <?php echo $id; ?> >
                    
                        <label for="qt"> Quantité </label>
                        <input type="number" id="qt" min="1" name="quantite" value="1">
                        <input type="submit" name="valider" value="Ajouter au panier">
                    </form>

                </div>

            </div>

        </div>
    </div>

</body>

</html>
