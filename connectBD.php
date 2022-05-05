<?php
    //créer des constantes d'environnement
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "root");
    define("DBNAME", "ins-user");

    //ne rien changer ci-dessous
    //il existe 2 façons de se connecter à la base de données (PDO(Php Data Object) ou mysqli)
    //on définit le DSN (Data Source Name) de connection pour PDO
    $dsn = "mysql:host=" .DBHOST .";dbname=" .DBNAME; //le ponit(.) pour concaténer

    //on se connecte à la base
    try {
        //on se connecte à la base de données en istanciant PDO
        $db = new PDO($dsn, DBUSER, DBPASS);
        /*echo "On est connecté";*/

        //on définit le charset à "utf8" pour que les accents s'affichent bien dans la base de données
        $db->exec("SET NAMES utf8");

        //on définit la méthode de récupération (fetch) des données par défaut
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        /*$db = null;*/
   } catch (PDOException $e) {
        //PDOException $e -> on attrape l'erreur provoquée par
        die("Erreur: ".$e->getMessage());
    }

    //Ici on est connecter à la base et on va pouvoir la lire
/*    //récupérer la liste des utilisateurs
    $sql = "SELECT * FROM `users`";

    //on exécute directement la requête
    $requete = $db->query($sql);

    //on récupère les données avec "fetch" (un seul, le 1er) ou "fetchAll" (tous)
    $user = $requete->fetchAll();

    echo "<pre>";
    var_dump($user);
    echo "</pre>";
*/

?>
