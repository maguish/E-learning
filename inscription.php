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
        //var_dump($_POST);

        //verifier que tous les champs requis sont remplis
        //"isset" permet de vérifier que chaque champs existe, même s'il est vide
        if (isset($_POST["username"], $_POST["email"], $_POST["pass"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
            //formulaire complet
            //on récupère les données en les protégeant

            //"strip_tags" enlève les balises html et php d'une chaîne, sachant qu'on peut en autoriser certaines
            $pseudo = strip_tags($_POST["username"]);

            //on vérifie que $_POST["email"] est bien un email avant de le néttoyer
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                die("L'adresse email est incorrecte");
            }

            //on hache le mot de passe
            $m_pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            /*die($m_pass);*/

            //on ajouter ici tous les autres contrôles souhaités (mot de passe et pseudo uniques, adresse mail unique, 2 mots de passe identiqes, ...)

            //on enrégistre le tout en base de données
            //on se connecte à la base de donnée, en utilisant "include" ou "require"
            require_once "connectBD.php";

            //pour inscrire un utilisateur
            $sql = "INSERT INTO `users`(`username`, `email`, `pass`) VALUES (:pseudo, :email, '$m_pass')";

            //préparer ma requête
            $query = $db->prepare($sql);

            //pour connecter les variables php à leurs paramètres sql
            $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

            //pour executer la requête
            $query->execute();

            //on récupère "id" nécessaire pour notre session
            $id = $db->lastInsertId(); //permet de récupérer l'id du dernier INSERT

            //connecter l'utilisateur
            //la session est déjà démarrée

            //"$_SESSION" est une super globale et elle n'existe qu'à partir du moment ou on écrit la ligne précédente
            //on va stocker dans "$_SESSION" les infos de l'utilisateur mais surtout pas le mot de passe pour des raison de sécurité
            $_SESSION["user"] = [   //ie dans la partie user de ma session on stocke
                "id" => $id,
                "pseudo" => $pseudo,
                "email" => $_POST["email"]
            ];

            var_dump($_SESSION);

            //l'utilisateur est maintenant connecté

            //on peut rediriger vers la page qu'on veut (la page de profil par exemple)
            header("Location: profil.php"); //attention pas d'espace entre "Location" et ":"
        }
        else {
            die("Le formulaire est incomplet");
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
	    <title>Inscription</title>
	    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->

      <link rel="stylesheet" type="text/css" href="style_log.css">
    </head>

    <body>

        <div class="container">

          <h1 class="login-text">Inscription</h1>

          <form method="post" class="login">
            <div class="input-user">
                <label for="pseudo">Pseudo<label>
                <input type="text" name="username" id="pseudo">
            </div>

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
                <button type="submit" class="btn">S'inscrire</button>
            </div>

            <p class="login-register-text">Déjà un compte? <a href="connexion.php">S'identifier</a>.</p>
         </form>
        </div>
    </body>
</html>
