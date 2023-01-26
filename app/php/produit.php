<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Consultation d'un produit</title>
	<link rel="icon" type="image/png" href="uploads/img/icon/favicon.png">
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
			// change le prix en fonction du % soldé
			$prix = $donnees["PRIX"] * (1-($donnees["SOLDE"]/100));
			$region = $donnees["REGION"];
			$nomCategorie = $donnees["NOM"];

			oci_free_statement($reqprep);

			if (file_exists("uploads/img/produit/".$nom.".png")) {
				$image = "produit/".$nom;
			} else {
				$image = "inconnu";
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
		<p id="titreProduitConsultation"><?php echo $nom; ?></p>
		<div class="consultation">

			<img style="background-image: url('uploads/img/<?php echo $image ?>.png');">

			<div class="description-produit">
				
				<p><strong>Description</strong> : <?php echo $description; ?></p>
				<p><strong>Catégorie</strong> : <?php echo $nomCategorie; ?></p>
				<p><strong>Région</strong> : <?php echo $region; ?></p>
				<p><strong>Poids</strong> : <?php echo $poids; ?> kg</p>
				<h2><strong>Prix</strong> : <?php echo $prix; ?> €</h2>

				<div class="consultation-bouttons">
					<form method="post" action="panier.php">
						<?php
							if ((isset($_SESSION["idClient"]) && $_SESSION["idClient"] != $idclient) or !isset($_SESSION["idClient"])) {
								echo "<!-- Champ caché pour envoyer l'id du produit -->";
								echo '<input type="hidden" name="id-produit" value='.$id.'>';
								echo '<label for="quantite">Quantité</label>';
								echo '<input type="number" id="quantite" min="1" name="quantite" value="1">';
							}
						?>
						<p></p>
						<?php
							if ((isset($_SESSION["idClient"]) && $_SESSION["idClient"] != $idclient) or !isset($_SESSION["idClient"])) {
								echo '<input type="submit" name="valider" value="Ajouter au panier" class="bouton-vert">';
							}

							if (!empty($_SESSION["agriculteur"]) && !empty($_SESSION["idClient"]) && $_SESSION["agriculteur"] == "1" && $_SESSION["idClient"] == $idclient) {
								echo '<a href="listeProduitMisEnVente.php?idprod='.$id.'#highlighted" id="bouton-jaune">Gérer votre produit</a>';
							}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>