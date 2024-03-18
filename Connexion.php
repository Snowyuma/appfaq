<?php
session_start();
include "include/liaison.php";
$dbh = db_connect();
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$submit = isset($_POST['submit']);

if ($submit) {
    $sql = "select pseudo,mdp from user where pseudo=:pseudo and mdp=:mdp";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ':pseudo' => $username,
            ':mdp' => $password   
        ));
        $row = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
}
if ((count($row))!=0){
    
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
        <form action="#" class="sub-form">
            <div class="upper-form">
                <h2>Connexion à la FAQ</h2>


                <label>Nom d'utilisateur</label> <br>
                <input type="text" name="username" required><br>

                <label>Mot de Passe</label> <br>
                <input type="password" name="password" required></a>
                <br>

                <div class="btn">

                    <button type="submit" traget="_BLANK" class="buttonco"> <a href="FAQ.php">Se Connecter</a></button>
                    <br>
                </div>
            </div>
            <div class="bottom-form">
                <div class="pas-de-compte">Vous n'avez pas de compte ?</div>
                <a href="Inscription.php" class="seconnecter">Inscription</a>

            </div>
        </form>
    </div>

    <div class="légale">
        <p>
        <h4>Projet AP2 site N2L FAQ</h4>
        <h5>2023-2024<br>
            BTS SIO: Service Informatique aux Organisations<br>
            option SLAM: Solutions Locigielles Application Metier<br>
            Créateurs: <br>
            Chef de projet: Mathieu Fraux <br>
            Developpeur principal: Lucas Rauzy <br>
            Developpeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>

    </form>
</body>

</html>