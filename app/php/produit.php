<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Consultation d'un produit</title>
	<link rel="icon" type="image/png" href="img/icon/favicon.png">
	<link rel="stylesheet" href="include/style/general.css">
	<link rel="stylesheet" href="include/style/produit.css">
</head>

<?php
	include("include/header.php");
	require_once("include/connect.inc.php");

	if(!empty($_GET["nom"])){
		$nom = htmlspecialchars($_GET["nom"]);

		$req = "SELECT * FROM Produit P, Categorie C WHERE P.nom = :nom AND C.IDCATEGORIE = P.IDCATEGORIE";
		$reqprep = oci_parse($connect, $req);
		oci_bind_by_name($reqprep, ":nom", $nom);
		$result = oci_execute($reqprep);
		if ($result) {
			$donnees = oci_fetch_assoc($reqprep);
			$id = $donnees["IDPRODUIT"];
			$idclient = $donnees["IDCLIENT"];
			$description = $donnees["DESCRIPTION"];
			$poids = $donnees["POIDS"];
			$prix = $donnees["PRIX"];
			$region = $donnees["REGION"];
			$nomCategorie = $donnees["NOM"];

			oci_free_statement($reqprep);

			if (file_exists("img/".$nom.".png")) {
				$image = $nom.".png";
			} else {
				$image = "produit/inconnu.png";
			}
			
		} else {
			$e = oci_error($reqprep);
			oci_free_statement($reqprep);
			print htmlentities("Erreur (pour la requete ".$e["sqltext"].") : ".$e["message"].".");
		}
	} else {
		header("location: index.php");
	}
?>

<body>
	<div class="div-centree">
		<div class="consultation">

			<img src="img/vide.png" style="background-image: url('img/<?php echo $image ?>');" alt="image produit">

			<div class="description-produit">
				<p id="titreProduitConsultation"><?php echo $nom; ?></p>
				<p>Description : <?php echo $description; ?></p>
				<p>Catégorie : <?php echo $nomCategorie; ?></p>
				<p>Région : <?php echo $region; ?></p>
				<p>Poids : <?php echo $poids; ?> kg</p>
				<h2>Prix : <?php echo $prix; ?> €</h2>

				<div class="consultation-bouttons">
					<form method="post" action="panier.php">
						<!-- Champ caché pour envoyer l'id du produit -->
						<input type="hidden" name="id-produit" value= <?php echo $id; ?> >
						<label for="quantite">Quantité</label>
						<input type="number" id="quantite" min="1" name="quantite" value="1">
						<input type="submit" name="valider" value="Ajouter au panier" class="bouton-vert">
						<?php
							if (!empty($_SESSION["agriculteur"]) && !empty($_SESSION["idClient"]) && $_SESSION["agriculteur"] == "1" && $_SESSION["idClient"] == $idclient) {
								echo '<a href="listeProduitMisEnVente.php?idprod='.$id.'#highlighted" id="bouton-jaune">Actions</a>';
							}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>