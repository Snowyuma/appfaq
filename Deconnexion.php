<?php
session_start();
include "include/liaison.php";
$dbh=db_connect();
$submit = isset($_POST['submit']);

?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <nav class="container">

            <div class="lien-parent">
                
                <a href="FAQ.php" class="lien-social">FAQ</a>
                <a href="ajoutQuestion.php" class="lien-social">Ajout-Question</a>
                <a href="modif.php" class="lien-social">Modification-Question</a>
                <a href="#" class="lien-social">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="formdeco">

        <form action=<?php $_SERVER["PHP_SELF"] ?> method="POST" class="sub-formdeco">

        <form action="#" class="sub-formdeco">

            <div class="upper-form">
                <h2>Déconnexion de la FAQ</h2>
                <p class="p"> Voulez-vous vraiment vous déconneter ?</p>
            </div>

            <div class="marginebuttom">
           
                <button class="bd1"><a href="FAQ.php" class="p">Ne pas se déconneter</a></button> 
                
                <button class="bd2 p" type="submit" name="submit">Se déconneter</button>
          

            </div>
        </form>
    </div>
  <?php
if ($submit){
    session_unset(); // Détruit toutes les variables de session
    session_destroy(); // Détruit la session (mais pas le cookie)
    setcookie(session_name(),'',-1,'/'); // Détruit le cookie de session
    header("Location: accueil.php"); // Revient à la page d'accueil
    exit();
    }
  ?>
            

    <div class="légale">
        <p>
            <h4>Projet AP2 site N2L FAQ</h4>
            <h5>2023-2024<br>
            BTS SIO: Service Informatique aux Organisations<br> 
            option SLAM: Solutions Locigielles Application Metier<br>
            Créateurs:  <br>
            Chef de projet: Mathieu Fraux <br>
            Developpeur principal: Lucas Rauzy  <br>
            Developpeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>
    </form>
</body>

</html>