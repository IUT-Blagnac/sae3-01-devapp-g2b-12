<?php

session_start();

if ($_SESSION["connecte"] == "oui") {
  $nom = $_SESSION["nom"];
  $prenom = $_SESSION["prenom"];
  $bouton = "<a href='deconnexion.php' class='item bouton-rouge' id='bouton-connexion'>DECONNEXION</a>";
  $compte = "<a href='monCompte.php' class='item mon-compte'>Mon compte</a>";
  $agri = "";

  if ($_SESSION["agriculteur"] == 1) {
    $agri = "<a href='ajouterProduit.php' class='item ajouter-produit'>Ajouter un produit</a>";
    }
}
else {
  $nom = "";
  $prenom = "";
  $bouton = "<a href='connexion.php' class='item bouton-orange' id='bouton-connexion'>CONNEXION</a>";
  $compte = "";
  $agri = "";
}

// Pour ne pas écraser le panier à chaque chargement de page
if(!isset($_SESSION["panier"])){
    $_SESSION["panier"] = array();
}

?>

<nav>
    <div class="haut">
        <a href="index.php"><img src="img/logo.png" alt="Logo LéguMania" class="item"></a>
        <a href="index.php"><h1 class="item">LéguMania</h1></a>

        <form action="recherche.php" method="get" class="item search">
            <input type="text" placeholder="Rechercher" name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <a href="panier.php"><img src="img/panier.png" alt="Icône panier" class="panier"></a>

        <div>
          <a href="monCompte.php">
            <?php echo $nom ?>
            <?php echo $prenom ?>
          </a>
        </div>
    </div>

    <div class="bas">
        <a href="legumes.php" class="item">Nos légumes</a>
        <a href="fruits.php" class="item">Nos fruits</a>
        <a href="compositions.php" class="item">Nos compositions</a>
        <a href="aPropos.php" class="item">À propos</a>
        <?php echo $compte; ?>
        <?php echo $agri; ?>
        <?php echo $bouton; ?>
    </div>
</nav>
<div style="height: 155px"></div>