<?php
session_start();
include "include/liaison.php";
$dbh = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        echo "Nom d'utilisateur et mot de passe sont obligatoires.";
    } else {
        $sql = "SELECT pseudo, mdp FROM user WHERE pseudo=:pseudo";
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(':pseudo' => $username));
            $row = $sth->fetch(PDO::FETCH_ASSOC);

            // Vérification si l'utilisateur existe dans la base de données
            if ($row) {
                // Vérification du mot de passe avec password_verify
                if (password_verify($password, $row['mdp'])) {
                    $_SESSION['user'] = $row;
                    header("Location: FAQ.php");
                    exit();
                } else {
                    echo "Mot de passe incorrect. Veuillez réessayer.";
                }
            } else {
                echo "Nom d'utilisateur incorrect. Veuillez réessayer.";
            }
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }
    }
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
        <form action="#" method="post" class="sub-form">
            <div class="upper-form">
                <h2>Connexion à la FAQ</h2>
                <label>Nom d'utilisateur</label> <br>
                <input type="text" name="username" required><br>
                <label>Mot de Passe</label> <br>
                <input type="password" name="password" required><br>
                <div class="btn">
                    <button type="submit" class="buttonco">Se Connecter</button>
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
                option SLAM: Solutions Logicielles Applications Métiers<br>
                Créateurs: <br>
                Chef de projet: Mathieu Fraux <br>
                Développeur principal: Lucas Rauzy <br>
                Développeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>
</body>

</html>