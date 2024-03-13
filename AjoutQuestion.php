<?php
session_start();
include "include/liaison.php"
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajoutQuestion</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <nav class="container">

            <div class="parent-link">
                
                <a href="FAQ.php" class="social-links">FAQ</a>
                <a href="Deconnexion.php" class="social-links">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="form">
        <form action="#" class="sub-form">
            <div class="upper-form">
                <h2>Ajouter une Question </h2>
            </div>
            <label class="labeladd">Quelle question voulez-vous ajouter ?</label> 
            <input class ="inputadd"type="text" name="Question"> <br>
            <button type="submit">Valider</button>
            <br>
        </form>
    </div>
<?php
$sql = "insert into faq(question, dat_question,id_user)
values (:question, :dat_question, :id_user)";
try {
$sth = $dbh->prepare($sql);
$sth->execute(array(
':question' => $question,
':dat_question' => $dat_question,
':id_user' => $id_user
));
} catch (PDOException $ex) {
die("Erreur lors de la requête SQL : ".$ex->getMessage());
}
echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
?>

    <div class="legal">
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