<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
	    <title>Page de profil</title>
	    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>

      <header>

        	<!--POUR SE CONNECTER-->
        	<div class="preheader">

            <div class="linkContainer">

            <div class="action">
    	        <div class="profil" onclick="menuToggle0();">
                <img src="logo.png">
    	        </div>

    	        <div class="menu0">
    		        <h3><?= $_SESSION["user"]["pseudo"]?><br><span>Bienvenue!</span></h3>
    		        <ul>
    			        <li><a href="profil.php">Mon profil</a></li>
    			        <li><a href="cours.php">Mes cours</a></li>
    		         	<li><a href="#">Forum</a></li>
    			        <li><a href="deconnexion.php">Déconnexion</a></li>
    		        </ul>
    	       </div>
           </div>

           </div>

        		<!--<div class="linkContainer">
              <ul class="menu">
                <li class="hasChildren">
                  <a href="#">Bienvenue             !</a>
                  <ul class="sousMenu">
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="#">Forum</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                  </ul>
                </li>
              </ul>
        		</div>-->
        	</div>

        	<div class="header">

        		<!--NOTRE LOGO-->
                <div>
                    <img src="logo.png" alt="logo" class="logo">
                </div>

        		<!--NOTRE MENU DEROULANT-->
                <div class="nav">
                    <nav>

                        <ul class="menu">

                            <li>
                                <a href="#" class="link active">A propos</a>
                            </li>

                            <li class="hasChildren">
                                <a href="#" class="link">Cours</a>
                                <ul class="sousMenu">
                                    <li><a href="#" class="link">HTML</a></li>
                                    <li><a href="#" class="link">CSS</a></li>
                                    <li><a href="#" class="link">PHP/SQL</a></li>
                                    <li><a href="#" class="link">JavaScript</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#" class="link">Documentation</a>
                            </li>

                            <li>
                                <a href="#" class="link">Contacts</a>
                            </li>

                        </ul>

                    </nav>

                </div>

                <div class="menuHam">
                    <input type="checkbox" id="menu_cb" class="menu_cb">

                    <span></span>
                    <span></span>
                    <span></span>
                </div>

        	</div>

            <!--NOTRE BANNIERE-->
            <div class="banner">
                <div class="bannerText">
                    <h1>DU CMSI (Création et Maintenance des Sites Internet)</h1>
                    <h2>Bienvenue!</h2>
                </div>
            </div>

        </header>

      <div class="container">

        <h1 class="login-text">Profil de <?= $_SESSION["user"]["pseudo"] ?></h1>

        <p>Pseudo : <?= $_SESSION["user"]["pseudo"] ?></p>
        <p>Email : <?= $_SESSION["user"]["email"] ?></p>

       </div>



       <!--fermer ouvrir barre utilisateur-->
       <script type="text/javascript">
    	   function menuToggle0(){
    		   const toggleMenu = document.querySelector('.menu0');
    		   toggleMenu.classList.toggle('active');
    	   }
       </script>


       <!--fermer ouvrir menu-->
       <script type="text/javascript">
           const menuToggle = document.querySelector('.menuHam input');
           const navbar = document.querySelector('.nav .menu');

           menuToggle.addEventListener('click', function(){
               navbar.classList.toggle('slide');
           });
       </script>





       <!--Pied de page-->
       <footer>
           <section class="piedPage">
               <div class="média">
                   <a href="#"><i class="fab fa-facebook "></i></a>
                   <a href="#"><i class="fab fa-instagram "></i></a>
                   <a href="#"><i class="fab fa-twitter "></i></a>
                   <a href="#"><i class="fab fa-linkedin "></i></a>
                   <a href="#"> <i class="fab fa-youtube "></i></i></a>
                   <a href="#"><i class="fab fa-pinterest "></i></i></a>
               </div>

               <ul class="liste">
                   <li> <a href="#">Accueil</a></li>
                   <li> <a href="#">qui sommes-nous</a></li>
                   <li> <a href="#">Services</a></li>
                   <li> <a href="#">Nous contacter</a></li>
               </ul>

               <p>Copyright &copy;2022 designed by RSK & MS</p>
           </section>
       </footer>



    </body>
</html>
