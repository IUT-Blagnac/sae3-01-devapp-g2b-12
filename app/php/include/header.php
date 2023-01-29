<?php

session_start();

if (isset($_SESSION["connecte"])) {
  if ($_SESSION["connecte"] == "oui") {
    $HDnom = $_SESSION["nom"];
    $HDprenom = $_SESSION["prenom"];
    $HDbouton = "<a href='deconnexion.php' class='item bouton-rouge' id='bouton-connexion'>DECONNEXION</a>";
    $HDcompte = "<a href='monCompte.php' class='item mon-compte'>Mon compte</a>";
    $HDagri = "";

    if ($_SESSION["agriculteur"] == 1) {
      $HDagri = "<a href='gestionProduit.php' class='item ajouter-produit'>Ajouter un produit</a>";
      }
  }
  else {
    $HDnom = "";
    $HDprenom = "";
    $HDbouton = "<a href='connexion.php' class='item bouton-orange' id='bouton-connexion'>CONNEXION</a>";
    $HDcompte = "";
    $HDagri = "";
  }
} else {
  $HDnom = "";
  $HDprenom = "";
  $HDbouton = "<a href='connexion.php' class='item bouton-orange' id='bouton-connexion'>CONNEXION</a>";
  $HDcompte = "";
  $HDagri = "";
}

// Pour ne pas écraser le panier à chaque chargement de page
if(!isset($_SESSION["panier"])){
    $_SESSION["panier"] = array();
}

?>

<head>
  <link rel="stylesheet" href="include/style/header.css">
</head>

<nav>
    <div class="haut">
        <a href="index.php"><img src="uploads/img/icon/logo.png" alt="Logo LéguMania" class="item"></a>
        <a href="index.php"><h1 class="item">LéguMania</h1></a>

        <form action="recherche.php" method="post" class="item search">
            <input type="text" placeholder="Recherchez ici" name="search"><button type="submit" name="valider"><img src="uploads/img/icon/loupe.png" height="13px"></button>
        </form>

        <a href="panier.php"><img src="uploads/img/icon/panier.png" alt="Icône panier" class="panier"></a>

        <div>
          <a href="monCompte.php">
            <?php echo $HDnom ?>
            <?php echo $HDprenom ?>
          </a>
        </div>
    </div>

    <div class="bas">
        <a href="legumes.php" class="item">Nos légumes</a>
        <a href="fruits.php" class="item">Nos fruits</a>
        <a href="compositions.php" class="item">Nos compositions</a>
        <a href="aPropos.php" class="item">À propos</a>
        <?php echo $HDcompte; ?>
        <?php echo $HDagri; ?>
        <?php echo $HDbouton; ?>
    </div>
</nav>
<div style="height: 155px"></div>