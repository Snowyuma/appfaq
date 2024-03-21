<?php
session_start();
include "include/liaison.php";
$dbh = db_connect();

$submit = isset($_POST['submit']);
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$motdepasse = isset($_POST['mdp']) ? $_POST['mdp'] : '';


if ($submit) {
    connexion();
    }

?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Connexion</title>
            <link rel="stylesheet" href="main.css">
        </head>

        <body>
            <header>
                <nav class="container">
                    <div class="lien-parent">
                        <a href="Accueil.php" class="lien-social">Accueil</a>
                        <a href="#" class="lien-social">Connexion</a>
                        <a href="Inscription.php" class="lien-social">Inscription</a>
                    </div>
                </nav>
            </header>
      
    <div class="form">
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Connexion à la FAQ</h2>
                <label>Nom d'utilisateur</label> <br>
                <input type="text" name="pseudo" required><br>
                <label>Mot de Passe</label> <br>
                <input type="password" name="mdp" required><br>
                <div class="btn">
                    <button type="submit" name="submit" class="buttonco">Se Connecter</button>
                </div>
            </div>
            <div class="bottom-form">
                <div class="pas-de-compte">Vous n'avez pas de compte ?</div>
                <a href="Inscription.php" class="seconnecter">Inscription</a>
            </div>
        </form>
    </div>

    <div class="légale">
        <h4>Projet AP2 site N2L FAQ</h4>
        <h5>2023-2024<br>
            BTS SIO: Service Informatique aux Organisations<br>
            option SLAM: Solutions Logicielles Applications Métiers<br>
            Créateurs: <br>
            Chef de projet: Mathieu Fraux <br>
            Développeur principal: Lucas Rauzy <br>
            Développeur secondaire: Colmagro Mathias </h5>
    </div>
        </body>

        </html>