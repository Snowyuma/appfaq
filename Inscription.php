<?php
//démarage de la session,
session_start();
//inclusion du fichier de fonction
include "include/liaison.php";
//connexion a la base de donnée
$dbh = db_connect();
//recuperation de toutes les données
$submit = isset($_POST['submit']);
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$mail = isset($_POST['email']) ? $_POST['email'] : '';
$id_ligue = isset($_POST['ligue']) ? $_POST['ligue'] : '';
$mdp1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$mdp2 = isset($_POST['password2']) ? $_POST['password2'] : '';



$sql = "SELECT pseudo FROM user WHERE pseudo=:pseudo ";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(':pseudo' => $pseudo));
    $verifpseudo = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
$sql = "SELECT mail FROM user WHERE mail=:mail ";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(':mail' => $mail));
    $verifemail = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
//debut de veriication

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
<?php
    if ($submit) {
        if ($verifpseudo == $pseudo && $pseudo != '' || $verifemail == $mail && $mail != '' || $mdp1 != $mdp2 && $mdp1 != '') {
            if ($verifpseudo == $pseudo && $pseudo != '') {
                echo "<p>veuilleer choisir un autre pseudo, celui que vous avez choisi existe deja</p>";
            }
            if ($verifemail == $mail && $mail != '') {
                echo "<p>veuiller utiliser un autre email, celui que vous avez choisi existe deja</p>";
            }
            if ($mdp1 != $mdp2 && $mdp1 != '') {
                echo "<p>mot de passe différent</p>";
            }
        } else {
            $mdp1 = password_hash($mdp1, PASSWORD_DEFAULT);

            $sql = 'insert into `user` (pseudo,mdp,mail,id_usertype,id_ligue)
        VALUES (:pseudo,:mdp,:mail,:id_ligue,:id_usertype)';
            try {
                $sth = $dbh->prepare($sql);
                $sth->execute(array(
                    ':pseudo' => $pseudo,
                    ':mdp' =>  $mdp1,
                    ':mail' => $mail,
                    ':id_ligue' => $id_ligue,
                    ":id_usertype" => 1,
                ));
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
            header("Location: Connexion.php"); // va a la connexion
            exit();
        }
    }
    ?>
    <div class="form">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="Post" class="sub-form">
            <div class="upper-form">
                <h2>Inscription à la FAQ</h2>

                <label>Nom d'utilisateur*</label> <br>
                <input type="text" name="pseudo" required> <br>


                <label>Adresse Mail*</label> <br>
                <input type="email" name="email" required> <br>

                <label>Ligue*</label> <br>
                <select name="ligue" id="ligue">
                    <option value="1">Ligue Football</option>
                    <option value="2">Ligue Basket</option>
                    <option value="3" selected="selected">Ligue Volley</option>
                    <option value="4">Ligue Handball</option>
                </select>
                <br>

                <label>Mot de Passe*</label> <br>
                <input type="password" name="password1" required> <br>

                <label>Retaper le Mot de Passe*</label> <br>
                <input type="password" name="password2" required> <br>

                <div class="btn">
                    <input type="submit" name="submit" value="s'inscrire"></input>
                    <br>
                </div>
            </div>
            <div class="bottom-form">
                <div class="compte">Vous avez dèja un compte ?</div>
                <a href="Connexion.php" class="inscrire">Se Connecter</a>
            </div>
            <br>
            <p>( * ) Champ Obligatoire</p>
            <br>
        </form>
    </div>

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
    </form>

</body>

</html>