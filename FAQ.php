<?php
session_start();
include "include/liaison.php";
$dbh = db_connect();
/*
if (!isset($_SESSION['user_id'])) {
    header("Location: Connexion.php");
    exit();
}
*/

//$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

$user_type = isset ($_SESSION['user_type'])? $_SESSION['user_type'] : '';

if ($id_ligue=5) {
    $sql = "SELECT * FROM faq, user WHERE faq.id_user = user.id_user " ;
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }   
}
else{
    $sql = "SELECT * FROM faq, user WHERE faq.id_user = user.id_user and faq.id_user=:id_user" ;
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ':id_user' => $user_id,
        ));
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
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
    <title>FAQ</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <!-- En-tête de la page -->
    <header>
        <nav class="container">
            <div class="lien-parent">
                <!-- Liens de navigation -->
                <a href="AjoutQuestion.php" class="lien-social">Ajout-Question</a>
                <a href="Deconnexion.php" class="lien-social">Déconnexion</a>
            </div>
        </nav>
    </header>

    <!-- Formulaire de FAQ -->
    <div class="formfaq">
        <form action="#" class="sub-formfaq">
            <div class="upper-form">
                <h2>FAQ</h2>
            </div>

            <!-- Tableau pour afficher les questions et réponses -->
            <table>
                <tr>
                    <!-- Entêtes de colonne -->
                   
                    <th class="p">Auteur</th>
                    <th class="p">Question</th>
                    <th class="p">Réponse</th>
                    <th class="p">Action</th>
                </tr>
                <?php
                // Boucle résultats de la requête SQL et affiche chaque question et réponse dans des lignes de tableau
                foreach ($rows as $row) {
                    echo '<tr class="tr">';
                    echo '<td class="p">' . $row["pseudo"] . '</td>';
                    echo '<td class="p">' . $row["question"] . '</td>';
                    echo '<td class="p">' . $row["reponse"] . '</td>';
                    // Vérifie si l'utilisateur est l'administrateur ou le super administrateur pour afficher les liens de modification/suppression
                    if ($user_id == 1 || $user_id == 2) {
                        echo '<td><a href="Supr.php?id=' . $row['id_faq'] . '" class="action_tab">Supprimer </a><br>';
                        echo '<a href="Modif.php?id=' . $row['id_faq'] . '" class="action_tab">Modification</a></td>';
                    }
                    echo '</tr>';
                }
                ?>
            </table>
            <br>
            <br>
        </form>
    </div>

    <!-- Pied de page -->
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
</body>

</html>