<?php
  //on démarre la session
  session_start();

  //on protège la page
  if(isset($_SESSION["user"])){
    header("Location: cours.php");
    exit;
  }

  session_start();
  header("Location: accueil.html");
?>
