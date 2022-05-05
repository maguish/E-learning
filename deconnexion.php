<?php
    //on démarre la session
    session_start();

    //on protège la page
    if(!isset($_SESSION["user"])){
      header("Location: connexion.php");
      exit;
    }

    //supprimer la partie session de l'utilisateur
    unset($_SESSION["user"]);

    header("Location: accueil.php")
?>
