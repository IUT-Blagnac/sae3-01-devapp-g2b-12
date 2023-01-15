<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Produits mis en vente</title>
	<link rel="icon" type="image/png" href="img/icon/favicon.png">
	<link rel="stylesheet" href="include/style/general.css">
	<link rel="stylesheet" href="include/style/listeProduitMisEnVente.css">
</head>

<?php
	include("include/header.php");
	require_once("include/connect.inc.php");

	if ((empty($_SESSION["connecte"]) || $_SESSION["connecte"] != "oui")
		|| (empty($_SESSION["agriculteur"]) || $_SESSION["agriculteur"] != "1")) {
		header("location: connexion.php");
		die();
	}
?>

<body>

<?php
	$req = "SELECT P.NOM as PNOM, C.NOM as CNOM, P.IDCATEGORIE as IDCATEGORIE, IDPRODUIT, PRIX, STOCK, SOLDE, POIDS, DESCRIPTION, REGION FROM PRODUIT P, CATEGORIE C WHERE IDCLIENT = :idclient AND C.IDCATEGORIE = P.IDCATEGORIE";
	$reqprep = oci_parse($connect, $req);
	oci_bind_by_name($reqprep, ":idclient", $_SESSION["idClient"]);
	$result = oci_execute($reqprep);
	if ($result) {
		$table = "<h2>Vos produits mis en vente</h2>
				<table><tr>
				<th>Nom produit</th>
				<th>Nom catégorie</th>
				<th>Prix</th>
				<th>Quantité en stock</th>
				<th>Pourcentage de réduction</th>
				<th>Modifier</th>
				<th>Supprimer</th>
				<th>Afficher</th>
				</tr>";
		while (($donnee = oci_fetch_assoc($reqprep)) != false) {
			$table = $table."<tr";
			if (!empty($_GET["idprod"]) && $_GET["idprod"] == $donnee["IDPRODUIT"]) {
				$table = $table." id='highlighted'";
			}
			$table = $table."><td>".$donnee["PNOM"]."</td>";
			$table = $table."<td>".$donnee["CNOM"]."</td>";
			$table = $table."<td>".$donnee["PRIX"]."</td>";
			$table = $table."<td>".$donnee["STOCK"]."</td>";
			$table = $table."<td>".$donnee["SOLDE"]."</td>";
			$table = $table."<td>
					<form method='POST' action='gestionProduit.php?mode=U'>
						<input type='hidden' name='nom' value='".$donnee["PNOM"]."'>
						<input type='hidden' name='description' value='".htmlspecialchars_decode($donnee["DESCRIPTION"])."'>
						<input type='hidden' name='idcat' value='".$donnee["IDCATEGORIE"]."'>
						<input type='hidden' name='poids' value='".$donnee["POIDS"]."'>
						<input type='hidden' name='prix' value='".$donnee["PRIX"]."'>
						<input type='hidden' name='stock' value='".$donnee["STOCK"]."'>
						<input type='hidden' name='solde' value='".$donnee["SOLDE"]."'>
						<input type='hidden' name='region' value='".$donnee["REGION"]."'>
						<input type='hidden' name='idprod' value='".$donnee["IDPRODUIT"]."'>
						<button type='submit'><img src='img/icon/crayon.png' height='32px'></button>
					</form>
				</td>";
			$table = $table."<td>
					<form method='POST' action='gestionProduit.php?mode=D'>
						<input type='hidden' name='idprod' value='".$donnee["IDPRODUIT"]."'>
						<button type='submit'><img src='img/icon/corbeille.png' height='32px'></button>
					</form>
				</td>";
			$table = $table."<td><a href=\"produit.php?nom=".$donnee["PNOM"]."\"><img src='img/icon/oeil.png' height='32px'></a></td></tr>";
		}
		oci_free_statement($reqprep);
		echo $table;
	} else {
		$e = oci_error($reqprep);
		oci_free_statement($reqprep);
		print htmlentities("Erreur (pour la requete ".$e["sqltext"].") : ".$e["message"].".");
	}
?>

</body>
</html>