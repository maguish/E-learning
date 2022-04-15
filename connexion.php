<?php
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
        require_once "connect.php";

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

        //on démarre la session php
        session_start();

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
        header("Location: profil.php"); //attention pas d'espace entre "Location" et ":"
      }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
	    <title>Inscription</title>
	    <meta charset="utf-8">
    </head>

    <body>
        <h1>Connexion</h1>

        <form method="post">
            <div>
                <label for="email">Email<label>
                <input type="email" name="email" id="email">
            </div>

            <div>
                <label for="pass">Mot de passe<label>
                <input type="password" name="pass" id="pass">
            </div>

            <div>
                <button type="submit">Me connecter</button>
            </div>
        </form>
    </body>
</html>
