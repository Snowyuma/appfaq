<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de fonction pour la connexion à la base de données
include "include/liaison.php";

// Connexion à la base de données
$dbh = db_connect();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['id_user'])) {
    header("Location: Connexion.php");
    exit();
}

// Vérification si l'identifiant de la question est fourni dans l'URL
$id_faq = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupération des informations de la question de la FAQ depuis la base de données
$sql = "SELECT * FROM faq WHERE id_faq = :id_faq";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(':id_faq' => $id_faq));
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC); // Stockage des résultats dans un tableau associatif
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

// Si le formulaire est soumis
if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $id_faq = isset($_POST['id_faq']) ? intval($_POST['id_faq']) : 0;
    $question = isset($_POST['question']) ? $_POST['question'] : '';
    $reponse = isset($_POST['reponse']) ? $_POST['reponse'] : '';

    // Mise à jour de la question et de la réponse dans la base de données
    $sql = "UPDATE faq SET question = :question, reponse = :reponse WHERE id_faq = :id_faq";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ':id_faq' => $id_faq,
            ':question' => $question,
            ':reponse' => $reponse
        ));

        // Redirection vers FAQ.php après la mise à jour
        header("Location: FAQ.php");
        exit();
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="lien-parent">
                <a href="FAQ.php" class="lien-social">FAQ</a>
                <a href="AjoutQuestion.php" class="lien-social">Ajout-Question</a>
                <a href="Deconnexion.php" class="lien-social">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="form">
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Modification de la FAQ</h2>
                <?php foreach ($rows as $row) : ?>
                    <!-- Ajout d'un champ caché pour l'identifiant de la question -->
                    <input type="hidden" name="id_faq" value="<?php echo htmlspecialchars($row['id_faq']); ?>">
                    <!-- Champ de saisie pour la question -->
                    <label for="question"> question:</label>
                    <input type="text"  id="question" name="question" value="<?php echo htmlspecialchars($row['question']); ?>">
                    <!-- Champ de saisie pour la réponse -->
                    <label for="reponse">réponse:</label>
                    <input type="text" id="reponse" name="reponse" value="<?php echo htmlspecialchars($row['reponse']); ?>">
                <?php endforeach; ?>
            </div>
            <div class="marginebuttom">
                <!-- Boutons de soumission et de réinitialisation du formulaire -->
                <button class="bd3" type="submit" name="submit">Valider</button>
                <button class="rest bd" type="reset">Réinitialiser</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        echo "<p>" . $sth->rowCount() . " enregistrement(s) modifié(s)</p>";
    }
    ?>

    <!-- Informations légales sur le projet -->
    <div class="légale">
        <p>
            <h4>Projet AP2 site N2L FAQ</h4>
            <h5>2023-2024<br>
                BTS SIO: Service Informatique aux Organisations<br>
                option SLAM: Solutions Logicielles Application Métier<br>
                Créateurs: <br>
                Chef de projet: Mathieu Fraux <br>
                Developpeur principal: Lucas Rauzy <br>
                Developpeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>
</body>

</html>