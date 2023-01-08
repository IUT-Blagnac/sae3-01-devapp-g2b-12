<?php

session_start();

if (isset($_SESSION["connecte"])) {
  if ($_SESSION["connecte"] == "oui") {
    $_SESSION["connecte"] = "non";
  }
}

header("location:index.php");

?>