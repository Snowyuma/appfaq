<?php
session_start();
include "include/liaison.php";
$dbh=db_connect();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>

    <div class="formacc">
    <form action="#" class="sub-formacc">
    <div class="bandeau">
    <h2>Accueil site N2L:</h2>
    <?php
    if (isset($_SERVER["username"]))
    echo "Bienvenu".$_SERVER["username"]
    ?>
     <button type="button" class="bdco"><a href="Connexion.php"> connexion</a></button>
     <button type="button" class="bdins"><a href="Inscription.php"> Inscription</a></button> <br>
    </div>
    </div>
    </form>
</body>
<div class="legalacc">
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
</html>