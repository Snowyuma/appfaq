<?php
session_start();

include "include/liaison.php";
$dbh = db_connect();
// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['id_user'])) {
    header("Location: Connexion.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Question</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="lien-parent">
                <a href="FAQ.php" class="lien-social">FAQ</a>
                <a href="Deconnexion.php" class="lien-social">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="form">
        <form action="#" method="POST" class="sub-form"> <!-- Ajout de method="POST" -->
            <div class="upper-form">
                <h2>Ajouter une Question</h2>
            </div>
            <label class="labeladd">Quelle question voulez-vous ajouter ?</label>
            <input class="inputadd" type="text" name="Question"> <br>
            <button type="submit">Valider</button>
            <br>
        </form>
    </div>
    <?php
    // Vérification si la méthode de requête est POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si le champ Question est défini et non vide
    if(isset($_POST['Question']) && !empty($_POST['Question'])) {
        $question = $_POST['Question'];
        // Vérification si $_SESSION['id_user'] est un tableau
        $id_user = (is_array($_SESSION['id_user'])) ? implode(',', $_SESSION['id_user']) : $_SESSION['id_user'];
        // Requête SQL pour insérer la question dans la base de données
        $sql = "INSERT INTO faq (question, dat_question, id_user) VALUES (:question, now(), :id_user)";
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':question' => $question,
                ':id_user' => $id_user
            ));
            // Redirection après insertion réussie
            header("Location: FAQ.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de la requête SQL : " . $e->getMessage();
        }
    } else {
        // Si la question est vide, affichage d'un message d'erreur
        echo "<p>Veuillez entrer une question.</p>";
    }
}
    ?>

    <div class="légale">
        <p>
            <h4>Projet AP2 site N2L FAQ</h4>
            <h5>2023-2024<br>
            BTS SIO: Service Informatique aux Organisations<br>
            option SLAM: Solutions Logicielles Applications Métier<br>
            Créateurs: <br>
            Chef de projet: Mathieu Fraux <br>
            Développeur principal: Lucas Rauzy <br>
            Développeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>
</body>

</html>