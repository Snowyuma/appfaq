<?php
//démarage de la session,
session_start();
//inclusion du fichier de fonction
include "include/liaison.php";
//connexion a la base de donnée
$dbh=db_connect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <nav class="container">

            <div class="lien-parent">
                <a href="Accueil.php" class="lien-social">Accueil</a>
                <a href="Connexion.php" class="lien-social">Connexion</a>
                <a href="#" class="lien-social">Inscription</a>
                
            </div>
        </nav>
    </header>
    <div class="form">
        <form action="#" class="sub-form">
            <div class="upper-form">
                <h2>Inscription à la FAQ</h2>

                <label>Nom d'utilisateur*</label> <br>
                <input type="text" name="username"> <br>

                <label>Adresse Mail*</label> <br>
                <input type="email" name="email"> <br>

                <label>Date Anniversaire</label> <br>
                <input type="date" name="date" value="jj/MM/AAAA"> <br>

                <label>Ligue*</label> <br>
                <select name="destination" id="destination">
                <option value="FO" >Ligue Football</option>
                <option value="BA" >Ligue Basket</option>
                <option value="VO" selected="selected" >Ligue Volley</option>
                <option value="HA" >Ligue Handball</option>
                </select>
                <br>

                <label>Mot de Passe*</label> <br>
                <input type="password" name="password"> <br>

                <label>Retaper le Mot de Passe*</label> <br>
                <input type="password" name="password"> <br>

                <div class="btn">
                    <button type="submit">S'inscrire</button>
                    <br>
                </div>
                </div>
            <div class="bottom-form">
                <div class="Compte">Vous avez dèja un compte ?</div>
                <a href="Connexion.php" class="sinscrire">Se Connecter</a>
            </div>
            <br>
            <p>( * ) Champ Obligatoire</p>
            <br>
        </form>
    </div>
                <?php
$submit = isset($_POST['submit']);
$sql = "insert into user(pseudo,mdp,mail,id_ligue)
values (:pseudo,:mdp,:mail,:id_ligue)";
try {
$sth = $dbh->prepare($sql);
$sth->execute(array(
':pseudo' => $pseudo,
':mdp' => $mdp,
':mail' => $mail,
':id_ligue' => $id_ligue,
));
} catch (PDOException $ex) {
die("Erreur lors de la requête SQL : ".$ex->getMessage());
}
echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
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