<?php
    //on démarre la session
    session_start();

    //on protège la page
    if(isset($_SESSION["user"])){
      header("Location: cours.php");
      exit;
    }

    //vérifier si le formulaire a été envoyé
    if (!empty($_POST)) {
      //recharge les infos qui ont été rentrés dans le formulaire
      //verifier que tous les champs requis sont remplis
      if (isset($_POST["email"], $_POST["pass"]) && !empty($_POST["pass"]) && !empty($_POST["email"])) {

        //on vérifie que $_POST["email"] est bien un email
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse email est incorrecte");
        }

        //on se connecte à la base de données
        require_once "connectBD.php";

        $sql = "SELECT * FROM `users` WHERE `email` = :email";

        //préparer la requête
        $query = $db->prepare($sql);

        //connecter la variable php "email" à son paramètre sql
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        //pour chercher notre utilisateur
        $user = $query->fetch();

        if (!$user) {
          die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        //on a un utilisateur existant et on doit vérifier son mot de pass
        //"password_verify" verifie la concordance entre le mot de passe entré par l'utilisateur et celui haché
        if (!password_verify($_POST["pass"], $user["pass"])) {
          die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        //ici l'utilisateur et le mot de passe sont corrects
        //on ouvre la session pour connecter l'utilisateur

        //la session est déjà démarrée plus haut

        //"$_SESSION" est une super globale et elle n'existe qu'à partir du moment ou on écrit la ligne précédente
        //on va stocker dans "$_SESSION" les infos de l'utilisateur mais surtout pas le mot de passe pour des raison de sécurité
        $_SESSION["user"] = [   //ie dans la partie user de ma session on stocke
            "id" => $user["id"],
            "pseudo" => $user["username"],
            "email" => $user["email"]
        ];

        var_dump($_SESSION);

        //l'utilisateur est maintenant connecté

        //on peut rediriger vers la page qu'on veut (la page de profil par exemple)
        header("Location: cours.php"); //attention pas d'espace entre "Location" et ":"
      }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
	    <title>Connexion</title>
	    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->

      <link rel="stylesheet" type="text/css" href="style_log.css">
    </head>

    <body>

      <div class="container">

        <h1 class="login-text">Connexion</h1>

        <form method="post" class="login">
            <div class="input-user">
                <label for="email">Email<label>
                <input type="email" name="email" id="email">
            </div>

            <div class="input-user">
                <label for="pass">Mot de passe<label>
                <input type="password" name="pass" id="pass">
            </div>

            <div class="espace"> </div>

            <div class="input-user">
                <button type="submit" class="btn">Se connecter</button>
            </div>

            <p class="login-register-text">Pas de compte? <a href="inscription.php">S'inscrire</a>.</p>
         </form>
       </div>
    </body>
</html>
