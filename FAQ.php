<?php
session_start();
include "include/liaison.php";
$dbh = db_connect();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['id_user'])) {
    header("Location: Connexion.php");
    exit();
}

$id_usertype = isset($_SESSION['id_usertype']) ? $_SESSION['id_usertype'] : '';
$id_ligue = isset($_SESSION['id_ligue']) ? $_SESSION['id_ligue'] : '';

if ($_SESSION['id_ligue'] == 5) {
    $sql = "SELECT * FROM faq ";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
} else {
    $sql = "SELECT * FROM faq, user WHERE faq.id_user=:id_user group by id_FAQ";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ':id_user' => $id_user,
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
    <form action="<?php $_SERVER["PHP_SELF"] ?>" class="sub-formfaq">
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
                    <?php if ($id_usertype == 3 || $id_usertype == 2) {
                    echo '<th class="p">Action</th>';
                    } ?>
                </tr>
                <?php
                $sql = "SELECT  pseudo, question, reponse FROM user, faq where user.id_user=faq.id_user ";
      //and user.id_ligue= faq.id_ligue
                try {
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchall(PDO::FETCH_ASSOC);
                } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
                }
                // Boucle résultats de la requête SQL et affiche chaque question et réponse dans des lignes de tableau
                foreach ($rows as $row) {
                    echo '<tr class="tr">';
                    echo '<td class="p">' . $row["pseudo"] . '</td>';
                    echo '<td class="p">' . $row["question"] . '</td>';
                    echo '<td class="p">' . $row["reponse"] . '</td>';
                  
                    // Vérifie si l'utilisateur est l'administrateur ou le super administrateur pour afficher les liens de modification/suppression

                   

                    if ($_SESSION['id_usertype'] == 3 || $_SESSION['id_usertype'] == 2) {
                        $id_faq=$row['id_faq'];
                        echo '<td><a href="Supr.php?id=' . $id_faq . '" class="action_tab">Supprimer </a><br>';
                        echo '<a href="Modif.php?id=' . $id_faq . '" class="action_tab">Modification</a></td>';

                    echo '</tr>';
                }
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