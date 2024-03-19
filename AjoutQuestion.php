<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Connexion.php");
    exit(); 
}

include "include/liaison.php";
$dbh = db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['Question']) && !empty($_POST['Question'])) {
        $question = $_POST['Question'];
        $dat_question = date("Y-m-d H:i:s");
        $id_user = $_SESSION['user_id'];

        // Requête SQL pour insérer la question dans la base de données
        $sql = "INSERT INTO faq(question, dat_question, id_user) VALUES (:question, :dat_question, :id_user)";
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':question' => $question,
                ':dat_question' => $dat_question,
                ':id_user' => $id_user
            ));
            // Affichage du nombre d'enregistrements ajoutés
            echo "<p>".$sth->rowCount()." enregistrement(s) ajouté(s)</p>";
        } catch (PDOException $ex) {
            // En cas d'erreur, affichage du message d'erreur
            die("Erreur lors de la requête SQL : ".$ex->getMessage());
        }
    } else {
        // Si la question est vide, affichage d'un message d'erreur
        echo "<p>Veuillez entrer une question.</p>";
    }
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