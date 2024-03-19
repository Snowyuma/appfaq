<?php
//démarage de la session,
session_start();
//inclusion du fichier de fonction
include "include/liaison.php";
//connexion a la base de donnée
$dbh=db_connect();

$id_faq='';
$sql = "DELETE FROM `faq` where `faq`.`id_faq` = 1 id_faq=:id_faq";
try {
$sth = $dbh->prepare($sql);
$sth->execute(array(
':id_faq' => $id_faq
));
} catch ( PDOException $ex) {
die("Erreur lors de la requête SQL : ".$ex->getMessage());
}
echo "<p>".$sth->rowcount()." enregistrement(s) supprimé(s)</p>";
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
                
                <a href="FAQ.php" class="lien-social">FAQ</a>
                <a href="ajoutQuestion.php" class="lien-social">Ajout-Question</a>
                <a href="déconnexion.php" class="lien-social">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="form">
        <form action=<?php $_SERVER["PHP_SELF"] ?> method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Suppression de question de la FAQ</h2>
                </div>
               <input type="text" value="Quels livres ont eu la plus grande influence sur toi?"></input>
                    <input type="text" value="reponse"></input>

            <div class="marginebuttom">
            <button class="bd3">Valider</button>
            
            <button class="rest bd4" type="rest">Annuler</button>
            </div>
        </form>
    </div>

    <div class="légale">
        <p>
            <h4>Projet AP2 site N2L FAQ</h4>
            <h5>2023-2024<br>
            BTS SIO: Service Informatique aux Organisations<br> 
            option SLAM: Solutions Locigielles Application Metier<br>
            Créateurs:  <br>
            Chef de projet: Mathieu Fraux <br>
            Developpeur principal: Lucas Rauzy  <br>
            Developpeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>
    </form>
</body>

</html>