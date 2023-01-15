<?php
	include("include/header.php");
	require_once("include/connect.inc.php");

	// charge le mode (CRUD mais sans le R)
	if (isset($_GET["mode"])) {
		$mode = htmlspecialchars($_GET["mode"]);
	} else {
		$mode = "";
	}
	if ($mode == "U") {
		$title = "Modifier un produit";
		$bouton = "Modifier le produit";
	} else if ($mode == "D") {
		$title = "Retirer un produit";
		$idproduit = htmlspecialchars($_POST["idprod"]);
		$req = "DELETE FROM PRODUIT WHERE IDCLIENT = :idclient AND IDPRODUIT = :idprod";
		$reqprep = oci_parse($connect, $req);
		oci_bind_by_name($reqprep, ":idclient", $_SESSION["idClient"]);
		oci_bind_by_name($reqprep, ":idprod", $idproduit);
		error_reporting(0);
		$result = oci_execute($reqprep);
		error_reporting(22527);
		if ($result) {
			oci_free_statement($reqprep);
			header("location: listeProduitMisEnVente.php");
			die();
		} else {
			$e = oci_error($reqprep);
			oci_free_statement($reqprep);
			$_SESSION["erreur"] = "Erreur (pour la requete ".$e["sqltext"].") : ".$e["message"].".";
			if (strpos($_SESSION["erreur"], "FK_QUANTITE_PRODUIT") || strpos($_SESSION["erreur"], "FK_PANIER_PRODUIT")) {
				$_SESSION["erreur"] = "Le produit que vous essayez de supprimer a été commandé par des clients, vous ne pouvez donc pas le supprimer, si vous souhaitez qu'il ne soit plus listé sur le site, vous devez définir le stock à 0.";
			}
		}
	} else { // mode par défaut => C
		$title = "Ajouter un produit";
		$bouton = "Ajouter le produit";
	}
?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<link rel="icon" type="image/png" href="img/icon/favicon.png">
	<link rel="stylesheet" href="include/style/general.css">
	<link rel="stylesheet" href="include/style/gestionProduit.css">
</head>

<?php
	if ((empty($_SESSION["connecte"]) || $_SESSION["connecte"] != "oui")
		|| (empty($_SESSION["agriculteur"]) || $_SESSION["agriculteur"] != "1")) {
		header("location: connexion.php");
		die();
	}


	// lorsque le formulaire est validé
	if (isset($_POST["valider"])) {
		if (!empty($_POST["nom"]) && !empty($_POST["description"]) && !empty($_POST["idcat"]) && !empty($_POST["poids"]) && !empty($_POST["prix"]) && isset($_POST["stock"]) && isset($_POST["solde"]) && !empty($_POST["region"]) && !empty($_FILES["image"])) {
			// on stock chaque champ
			$nom = htmlspecialchars($_POST["nom"]);
			$description = htmlspecialchars($_POST["description"]);
			$idcategorie = htmlspecialchars($_POST["idcat"]);
			$poids = htmlspecialchars($_POST["poids"]);
			$prix = htmlspecialchars($_POST["prix"]);
			$stock = htmlspecialchars($_POST["stock"]);
			$solde = htmlspecialchars($_POST["solde"]);
			$region = htmlspecialchars($_POST["region"]);
			$image = $_FILES["image"];
			$imageinfo = pathinfo($image["name"]);
			$allowed_extensions = ["jpg", "jpeg", "jfif", "pjpeg", "pjp", "png", "webp", "gif"];

			$_SESSION["erreur"] = "";

			// on vérifie chaque champs;
			if (!preg_match("#^\S.{0,126}\S$#", $nom)) {
				$_SESSION["erreur"] = "Le nom doit être compris entre 2 et 128 charactères, et ne doit pas commencer ou finir par un espace blanc.";
			}
			if (!preg_match("#^\S.{0,2046}\S$#", $description)) {
				$_SESSION["erreur"] = "La description doit être compris entre 2 et 2048 charactères, et ne doit pas commencer ou finir par un espace blanc.";
			}
			if (!preg_match("#^[1-9][0-9]{0,9}$#", $idcategorie)) {
				$_SESSION["erreur"] = "La categorie doit être une catégorie existante.";
			}
			$poids = preg_replace("#,#", ".", $poids);
			if (!preg_match("#^[1-9][0-9]{0,2}(.[0-9]{1,2})?$#", $poids)) {
				$_SESSION["erreur"] = "Le poids doit être un nombre de maximum 3 chiffres avant la virgule et maximum 2 chiffres après.";
			}
			$prix = preg_replace("#,#", ".", $prix);
			if (!preg_match("#^[1-9][0-9]{0,7}(.[0-9]{1,2})?$#", $prix)) {
				$_SESSION["erreur"] = "Le prix doit être un nombre de maximum 8 chiffres avant la virgule et maximum 2 chiffres après.";
			}
			if (!preg_match("#^[1-9][0-9]{0,9}$|^0$#", $stock)) {
				$_SESSION["erreur"] = "Le stock doit être une nombre entier positif de maximum 10 chiffres ou 0.";
			}
			if (!preg_match("#^[1-9][0-9]{0,2}$|^0$#", $solde)) {
				$_SESSION["erreur"] = "Le solde doit être un nombre entier positif de maximum 2 chiffres ou 0.";
			}
			if (!preg_match("#^\S.{0,126}\S$#", $region)) {
				$_SESSION["erreur"] = "Le région doit être compris entre 2 et 128 charactères, et ne doit pas commencer ou finir par un espace blanc.";
			}
			if ($image["error"] != 0 || !in_array($imageinfo["extension"], $allowed_extensions) || $image["size"] > 1000000) {
				$_SESSION["erreur"] = "L'image s'est mal envoyée ou elle n'est pas d'un type autorisé ou alors sa taille est supérieur à 1 000 000 octets autorisés.";
			}

			// si il n'y a pas eu d'erreur
			if ($_SESSION["erreur"] == "") {
				// insertion ou mise à jour
				if ($mode == "U") {
					$idproduit = htmlspecialchars($_POST["idprod"]);
					$req = "UPDATE PRODUIT SET IDCATEGORIE = :idcat, NOM = :nom, DESCRIPTION = :description, POIDS = :poids, PRIX = :prix, STOCK = :stock, SOLDE = :solde, REGION = :region WHERE IDCLIENT = :idclient AND IDPRODUIT = :idprod";
					$reqprep = oci_parse($connect, $req);
					oci_bind_by_name($reqprep, ":idprod", $idproduit);
				} else {
					$req = "INSERT INTO PRODUIT VALUES(seq_produit.nextval, :idcat, :idclient, :nom, :description, :poids, :prix, :stock, :solde, :region)";
					$reqprep = oci_parse($connect, $req);
				}
				oci_bind_by_name($reqprep, ":idcat", $idcategorie);
				oci_bind_by_name($reqprep, ":idclient", $_SESSION["idClient"]);
				oci_bind_by_name($reqprep, ":nom", $nom);
				oci_bind_by_name($reqprep, ":description", $description);
				oci_bind_by_name($reqprep, ":poids", $poids);
				oci_bind_by_name($reqprep, ":prix", $prix);
				oci_bind_by_name($reqprep, ":stock", $stock);
				oci_bind_by_name($reqprep, ":solde", $solde);
				oci_bind_by_name($reqprep, ":region", $region);
				error_reporting(0);
				$result = oci_execute($reqprep);
				error_reporting(22527);
				if ($result) {
					oci_free_statement($reqprep);
					// enregistre l'image
					move_uploaded_file($image["tmp_name"], "img/".$nom.".png");
					// redirige
					if ($mode == "U") {
						header("location: listeProduitMisEnVente.php");
					} else {
						header("location: produit.php?nom=".$nom);
					}
				} else {
					$e = oci_error($reqprep);
					oci_free_statement($reqprep);
					$_SESSION["erreur"] = "Erreur (pour la requete ".$e["sqltext"].") : ".$e["message"].".";
				}
			}
		} else {
			// il manque un ou plusieurs champs
			$_SESSION["erreur"] = "Un ou plusieurs champs n'ont pas été remplis.";
		}
	}
?>

<body>
	<div class="erreur">
		<?php
			echo $_SESSION["erreur"];
			if ($mode == "D") {
				$_SESSION["erreur"] = "";
				die();
			}
			$_SESSION["erreur"] = "";
		?>
	</div>

	<form method="POST" enctype="multipart/form-data">
		<div class="boite-contour">
			<div class="texte-contour"><?php echo $title; ?></div>

			<div class="formulaire-deux-colonnes">
				<div class="sous-formulaire">
					<label for="nom">Nom du produit</label>
					<input type="text" name="nom" id="nom" required <?php if (!empty($_POST["nom"])) { echo "value=\"".htmlspecialchars($_POST["nom"])."\""; } ?> >
					<label for="description">Description</label>
					<textarea name="description" id="description" required><?php if (!empty($_POST["description"])) { echo htmlspecialchars($_POST["description"]); } ?></textarea>
					<label for="stock">Stock</label>
					<input type="number" name="stock" id="stock" min="0" max ="9999999999" required <?php if (isset($_POST["stock"])) { echo "value=\"".htmlspecialchars($_POST["stock"])."\""; } ?> >
					<label for="solde">Pourcentage de réduction</label>
					<input type="number" name="solde" id="solde" min="0" max ="99" required <?php if (isset($_POST["solde"])) { echo "value=\"".htmlspecialchars($_POST["solde"])."\""; } ?> >
				</div>

				<div class="sous-formulaire">
					<label for="categorie">Catégorie</label>
					<select name="idcat" id="categorie" required>
						<?php
							$req = "SELECT IDCATEGORIE, NOM FROM CATEGORIE";
							$categories = oci_parse($connect, $req);
							error_reporting(0);
							$result = oci_execute($categories);
							error_reporting(22527);
							if ($result) {
								while (($cat = oci_fetch_assoc($categories)) != false) {
									echo "<option value=\"".$cat["IDCATEGORIE"]."\"";
									if (!empty($_POST["idcat"]) && htmlspecialchars($_POST["idcat"]) == $cat["IDCATEGORIE"]) {
										echo " selected";
									}
									echo ">".$cat["NOM"]."</option>";
								}
								oci_free_statement($categories);
							} else {
								$e = oci_error($categories);
								oci_free_statement($categories);
								print htmlentities("Erreur (pour la requete ".$e["sqltext"].") : ".$e["message"].".");
							}
						?>
					</select>

					<div class="formulaire-deux-colonnes">
						<div class="sous-formulaire">
							<label for="poids">Taille/poids cagette</label>
							<input type="text" name="poids" id="poids" required <?php if (!empty($_POST["poids"])) { echo "value=\"".htmlspecialchars($_POST["poids"])."\""; } ?> >
						</div>
						<div class="sous-formulaire">
							<label for="prix">Prix</label>
							<input type="text" name="prix" id="prix" required <?php if (!empty($_POST["prix"])) { echo "value=\"".htmlspecialchars($_POST["prix"])."\""; } ?> >
						</div>
					</div>

					<label for="img">Image du produit</label>
					<input type="file" name="image" id="img" accept="image/png, image/jpeg, image/webp" required>
					<label for="region">Région d'origine</label>
					<input type="text" name="region" id="region" required <?php if (!empty($_POST["region"])) { echo "value=\"".htmlspecialchars($_POST["region"])."\""; } ?> >

				</div>
			</div>

			<input type="hidden" name="idprod" <?php if (!empty($_POST["idprod"])) { echo "value=\"".htmlspecialchars($_POST["idprod"])."\""; } ?> >
			<input type="submit" value="<?php echo $bouton; ?>" name="valider" id="bouton-jaune">
		</div>
	</form>
</body>
</html>