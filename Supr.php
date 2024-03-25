<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de liaison à la base de données
include "include/liaison.php";

// Connexion à la base de données
$dbh = db_connect();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['id_user'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas authentifié
    header("Location: Connexion.php");
    exit(); // Arrêt de l'exécution du script après la redirection
}

// Traitement du formulaire de suppression de question
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si l'identifiant de la FAQ est passé en tant que paramètre POST
    if(isset($_POST['id_faq'])){
        // Récupération de l'identifiant de la FAQ à supprimer
        $id_faq = $_POST['id_faq'];
        // Requête de suppression d'une question de la FAQ
        $sql = "DELETE FROM `faq` WHERE id_faq=:id_faq";
        try {
            $sth = $dbh->prepare($sql);
            // Exécution de la requête avec l'identifiant de la FAQ à supprimer
            $sth->execute(array(':id_faq' => $id_faq));
            // Redirection vers la page FAQ.php après la suppression
            header("Location: FAQ.php");
            exit();
        } catch (PDOException $ex) {
            // En cas d'erreur, affichage du message d'erreur
            echo "Erreur lors de la requête SQL : " . $ex->getMessage();
        }
    }
    if(isset($_POST['reset'])){
        header("Location: FAQ.php");
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="lien-parent">
                <!-- Liens vers différentes pages -->
                <a href="FAQ.php" class="lien-social">FAQ</a>
                <a href="ajoutQuestion.php" class="lien-social">Ajout-Question</a>
                <a href="déconnexion.php" class="lien-social">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="form">
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Suppression de question de la FAQ</h2>
            </div>
            <!-- Champ de saisie pour l'identifiant de la FAQ à supprimer (caché) -->
            <input type="hidden" name="id_faq" value="<?php echo $_GET['id']; ?>">
            <div class="marginebuttom">
                <button class="bd3" type="submit" name="submit">Valider</button>
                <!-- Lien pour annuler et retourner à la page FAQ.php -->
                <button class="rest bd4" type="submit" name="reset">annuler</button>
            </div>
        </form>
    </div>

    <div class="légale">
        <p>
            <h4>Projet AP2 site N2L FAQ</h4>
            <h5>2023-2024<br>
                BTS SIO: Service Informatique aux Organisations<br>
                option SLAM: Solutions Logicielles Application Métier<br>
                Créateurs:<br>
                Chef de projet: Mathieu Fraux<br>
                Développeur principal: Lucas Rauzy<br>
                Développeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>
</body>

</html>