<?php
session_start();
include "include/liaison.php";
$dbh = db_connect();

$submit = isset($_POST['submit']);
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$motdepasse = isset($_POST['mdp']) ? $_POST['mdp'] : '';


if ($submit) {
        $sql_pseudo = "SELECT pseudo FROM user WHERE pseudo=:pseudo";
        try {
            $sth = $dbh->prepare($sql_pseudo);
            $sth->execute(array(
                ':pseudo' => $pseudo
            ));
            $resultat_pseudo = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

       if(count($resultat_pseudo) > 0)
       {
        $sql_mdp = "SELECT mdp FROM user WHERE pseudo=:pseudo";
        try {
            $sth = $dbh->prepare($sql_mdp);
            $sth->execute(array(
                ':pseudo' => $pseudo
            ));
            $resultat_mdp = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            
            die("Erreur lors de la requête SQL : " . $ex->getMessage());

            if($resultat_mdp && password_verify($motdepasse, $resultat_mdp['mdp']))
            {
                echo "<p>Connecté</p>";
                $_SESSION['pseudo'] = $row['pseudo'];
                $_SESSION['id_usertype'] = $row['id_usertype'];
                $_SESSION['id_ligue'] = $row['id_ligue'];
                header("Location: FAQ.php");
                exit();
            }
            else{
                echo "mot de passe incorrect";
            }
        }
       }
       else {
        echo "Identifiant inconnu !";
       }
    }




?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Connexion</title>
            <link rel="stylesheet" href="main.css">
        </head>

        <body>
            <header>
                <nav class="container">
                    <div class="lien-parent">
                        <a href="Accueil.php" class="lien-social">Accueil</a>
                        <a href="#" class="lien-social">Connexion</a>
                        <a href="Inscription.php" class="lien-social">Inscription</a>
                    </div>
                </nav>
            </header>
      
    <div class="form">
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="sub-form">
            <div class="upper-form">
                <h2>Connexion à la FAQ</h2>
                <label>Nom d'utilisateur</label> <br>
                <input type="text" name="pseudo" required><br>
                <label>Mot de Passe</label> <br>
                <input type="password" name="mdp" required><br>
                <div class="btn">
                    <input type="submit" name="submit" class="buttonco" value="Se Connecter">
                </div>
            </div>
            <div class="bottom-form">
                <div class="pas-de-compte">Vous n'avez pas de compte ?</div>
                <a href="Inscription.php" class="seconnecter">Inscription</a>
            </div>
        </form>
    </div>

    <div class="légale">
        <h4>Projet AP2 site N2L FAQ</h4>
        <h5>2023-2024<br>
            BTS SIO: Service Informatique aux Organisations<br>
            option SLAM: Solutions Logicielles Applications Métiers<br>
            Créateurs: <br>
            Chef de projet: Mathieu Fraux <br>
            Développeur principal: Lucas Rauzy <br>
            Développeur secondaire: Colmagro Mathias </h5>
    </div>
        </body>

        </html>