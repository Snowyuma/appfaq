<?php
// Démarrer la session PHP
session_start();
// Inclure le fichier de liaison pour la base de données
include "include/liaison.php";
// Se connecter à la base de données
$dbh = db_connect();

// Vérifier si le formulaire a été soumis
$submit = isset($_POST['submit']);
// Récupérer les valeurs du formulaire ou les initialiser à une chaîne vide si non définies
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$mail = isset($_POST['email']) ? $_POST['email'] : '';
$id_ligue = isset($_POST['ligue']) ? $_POST['ligue'] : '';
$mdp1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$mdp2 = isset($_POST['password2']) ? $_POST['password2'] : '';
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
                <!-- Liens de navigation -->
                <a href="Accueil.php" class="lien-social">Accueil</a>
                <a href="Connexion.php" class="lien-social">Connexion</a>
                <a href="#" class="lien-social">Inscription</a>
            </div>
        </nav>
    </header>

    <?php
    // Vérifier si le formulaire a été soumis
    if ($submit) {
        // verification qu le pseudo n'existe pas dans la base de donnée
        if ($verifpseudo == false) {
            // verification que le mail n'existe pas dans la base de donnée
            if ($verifemail == false) {
                // verification que le pseudo n est pas nul  et que le mail n'est pa null et que les 2 pseudo sont les meme
                if ($verifpseudo == $pseudo && $pseudo != '' || $verifemail == $mail && $mail != '' || $mdp1 != $mdp2 && $mdp1 != '') {
                    if ($verifpseudo == $pseudo && $pseudo != '') {
                        //message d'erreur si le pseudo est null
                        echo "<p>veuilleer choisir un  pseudo</p>";
                    }
                    if ($verifemail == $mail &&$mail != '') {
                        //message d'erreur si le mail est null
                        echo "<p>veuiller utiliser un email</p>";
                    }
                    if ($mdp1 != $mdp2 && $mdp1 != '') {
                        //mesage d'erreur si les 2 mdp sont différent
                        echo "<p>mot de passe différent</p>";
                    }
                } else {
                    //hache du mot de passe
                    $mdp1 = password_hash($mdp1, PASSWORD_DEFAULT);
                    // insertion des donnée dans la base de donnée
                    $sql = 'insert into `user` (pseudo,mdp,mail,id_usertype,id_ligue)
                            VALUES (:pseudo,:mdp,:mail, 1, :id_ligue)';
                    try {
                        $sth = $dbh->prepare($sql);
                        $sth->execute(array(
                            ':pseudo' => $pseudo,
                            ':mdp' =>  $mdp1,
                            ':mail' => $mail,
                            ':id_ligue' => $id_ligue
                        ));
                    } catch (PDOException $ex) {
                        die("Erreur lors de la requête SQL : " . $ex->getMessage());
                    }

                    header("Location: Connexion.php"); // va a la connexion
                    exit();
                }
            } else {
                // message d'erreur si le mail existe deja dans la base de donnée
                echo "<p>le mail est deja utilisée</p>";
            }
        } else {
            // Afficher les erreurs d'inscription
            if (!$verifpseudo) {
                echo "<p>Le pseudo est déjà utilisé.</p>";
            }
            if (!$verifemail) {
                echo "<p>L'email est déjà utilisé.</p>";
            }
            if ($mdp1 != $mdp2) {
                echo "<p>Les mots de passe ne correspondent pas.</p>";
            }
            if ($pseudo == '') {
                echo "<p>Veuillez choisir un pseudo.</p>";
            }
            if ($mail == '') {
                echo "<p>Veuillez utiliser une adresse email.</p>";
            }
            if ($mdp1 == '') {
                echo "<p>Veuillez entrer un mot de passe.</p>";
            }
        }
    }
    ?>

    <div class="form">
        <!-- Formulaire d'inscription -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="sub-form">
            <div class="upper-form">
                <h2>Inscription à la FAQ</h2>
                
                <!-- Champs du formulaire -->
                <label>Nom d'utilisateur*</label><br>
                <input type="text" name="pseudo" required><br>

                <label>Adresse Mail*</label><br>
                <input type="email" name="email" required><br>

                <label>Ligue*</label><br>
                <select name="ligue" id="ligue">
                    <option value="1">Ligue Football</option>
                    <option value="2">Ligue Basket</option>
                    <option value="3" selected="selected">Ligue Volley</option>
                    <option value="4">Ligue Handball</option>
                </select><br>

                <label>Mot de Passe*</label><br>
                <input type="password" name="password1" required><br>

                <label>Retaper le Mot de Passe*</label><br>
                <input type="password" name="password2" required><br>

                <div class="btn">
                    <button type="submit" name="submit">S'inscrire</button><br>
                </div>
            </div>

            <div class="bottom-form">
                <!-- Lien de connexion -->
                <div class="compte">Vous avez déjà un compte ?</div>
                <a href="Connexion.php" class="inscrire">Se Connecter</a>
            </div>
            
            <br>
            <p>( * ) Champ Obligatoire</p>
            <br>
        </form>
    </div>

    <div class="légale">
        <!-- Informations légales -->
        <p>
            <h4>Projet AP2 site N2L FAQ</h4>
            <h5>2023-2024<br>
                BTS SIO: Service Informatique aux Organisations<br>
                option SLAM: Solutions Logicielles Applications Métier<br>
                Créateurs: <br>
                Chef de projet: Mathieu Fraux <br>
                Développeur principal: Lucas Rauzy <br>
                Développeur secondaire: Colmagro Mathias </h5>
        </p>
    </div>

</body>

</html>