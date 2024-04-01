<?php
// Démarre une session PHP pour gérer les variables de session
session_start();

// Inclut le fichier de liaison contenant la fonction de connexion à la base de données
include "include/liaison.php";

// Établit une connexion à la base de données
$dbh = db_connect();

// Vérifie si l'utilisateur est authentifié, sinon le redirige vers la page de connexion
if (!isset($_SESSION['id_user'])) {
    header("Location: Connexion.php");
    exit();
}

// Récupère les variables de session pertinentes pour l'utilisateur
$id_usertype = isset($_SESSION['id_usertype']) ? $_SESSION['id_usertype'] : '';
$id_ligue = isset($_SESSION['id_ligue']) ? $_SESSION['id_ligue'] : '';
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : '';

// Vérifie le type de ligue de l'utilisateur pour déterminer la requête SQL à exécuter
if ($_SESSION['id_ligue'] == 5) {
    // Requête SQL pour récupérer toutes les questions/réponses pour l'administrateur
    $sql = "SELECT * FROM faq , user, ligue 
    WHERE faq.id_user=user.id_user  
    AND user.id_ligue=ligue.id_ligue";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        // En cas d'erreur lors de l'exécution de la requête, affiche un message d'erreur et arrête le script
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
} elseif ($_SESSION['id_ligue'] == 1 || $_SESSION['id_ligue'] == 2 || $_SESSION['id_ligue'] == 3 || $_SESSION['id_ligue'] == 4) {
    // Requête SQL pour récupérer les questions/réponses spécifiques à la ligue de l'utilisateur
    $sql = "SELECT  *
    FROM faq, user, ligue
    WHERE faq.id_user=user.id_user 
    AND user.id_ligue=ligue.id_ligue
    AND ligue.id_ligue=:id_ligue 
    GROUP BY faq.id_faq";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            ':id_ligue' => $_SESSION['id_ligue']
        ));
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        // En cas d'erreur lors de l'exécution de la requête, affiche un message d'erreur et arrête le script
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
                <!-- Titre de la FAQ -->
                <h2>FAQ de <?php echo $_SESSION["lib_ligue"] ?></h2>
            </div>

            <!-- Tableau pour afficher les questions et réponses -->
            <table>
                <tr>
                    <!-- Entêtes de colonne -->
                    <th class="p">Auteur</th>
                    <th class="p">Question</th>
                    <th class="p">Réponse</th>
                    
                    <?php 
                    // Vérifie le type d'utilisateur pour afficher les colonnes supplémentaires si nécessaire
                    if ($id_usertype == 3 || $id_usertype == 2) {
                        echo '<th class="p">Action</th>';
                        if ($id_usertype == 3){
                            echo '<th class="p">Ligue</th>';
                        }
                    } ?>
                </tr>
                <?php
                // Boucle sur les résultats de la requête SQL et affiche chaque question et réponse dans des lignes de tableau
                foreach ($rows as $row) {
                    echo '<tr class="tr">';
                    echo '<td class="p">' . $row["pseudo"] . '</td>';
                    echo '<td class="p">' . $row["question"] . '</td>';
                    echo '<td class="p">' . $row["reponse"] . '</td>';
                    
                    // Vérifie si l'utilisateur est l'administrateur ou le super administrateur pour afficher les liens de modification/suppression
                    if ($_SESSION['id_usertype'] == 3 || $_SESSION['id_usertype'] == 2) {
                        $id_faq = $row['id_faq'];
                        echo '<td><a href="Supr.php?id=' . $id_faq . '" class="action_tab">Supprimer </a><br>';
                        echo '<a href="Modif.php?id=' . $id_faq . '" class="action_tab">Modification</a>';
                        
                        // Affiche la colonne de la ligue si l'utilisateur est un super administrateur
                        if ($_SESSION['id_usertype'] == 3){
                            echo '<td class="p">' . $row["lib_ligue"] . '</td>';
                        }
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
                option SLAM: Solutions Logicielles Applications Métiers<br>
                Créateurs: <br>
                Chef de projet: Mathieu Fraux <br>
                Développeur principal: Lucas Rauzy <br>
                Développeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>
</body>

</html>