<?php
//démarage de la session,
session_start();
//inclusion du fichier de fonction
include "include/liaison.php";
//connexion a la base de donnée
$dbh=db_connect();

// Vérification de l'authentification de l'utilisateur
if (!isset($_SESSION['id_user'])) {
    header("Location: Connexion.php");
    exit();
}

$reponse = isset($_POST['reponse']) ? $_POST['reponse'] : '';
$id_faq=$_GET['id'];

//recuperation des info de la question
$sql = "SELECT  * FROM  faq where id_faq=:id_faq ";
          try {
          $sth = $dbh->prepare($sql);
          $sth->execute(array(':id_faq'=>$id_faq));
          $rows = $sth->fetchall(PDO::FETCH_ASSOC);
          } catch (PDOException $ex) {
          die("Erreur lors de la requête SQL : " . $ex->getMessage());
          }
if($submit){
 $sql = "UPDATE  faq set reponse=:reponse WHERE id_faq=:id_faq ";
try {
$sth = $dbh->prepare($sql);
$sth->execute(array(
':id_faq' => $id_faq,
':reponse' => $reponse
));
} catch ( PDOException $ex) {
die("Erreur lors de la requête SQL : ".$ex->getMessage());
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
        <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Modification de la FAQ</h2>

               <input type="text" value="<?php ?>"></input></li>
                    <input type="text"  name="reponse" value="<?php ?>"></input> 
            </div>
            
            <div class="marginebuttom">
            <button class="bd3" type="submit" name="submit">Valider</button>
            <button class="rest bd" type="rest">Réinitialiser</button>
            </div>
        </form>
    </div>
            <?php

echo "<p>".$sth->rowcount()." enregistrement(s) modifié(s)</p>";
            ?>


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