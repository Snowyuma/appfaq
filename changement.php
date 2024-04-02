<?php
//démarage cession
session_start();
//inclusion de la page liaison.php
include "include/liaison.php";
$dbh = db_connect();
//verification si le form a été envoyé
$submit = isset($_POST['submit']);
//récupération des informations
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

if ($submit) {
    // Vérification de la correspondance pseudo et email dans la table 'users'
    $stmt = $dbh->prepare("SELECT * FROM user WHERE pseudo = :pseudo AND mail = :mail");
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':mail', $mail); // Correction : Utilisation de ':mail' au lieu de ':email'
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Vérification que les deux mots de passe correspondent
        if ($password1 === $password2) {
            // Cryptage du mot de passe
            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
            
            // Mise à jour du mot de passe dans la table 'users'
            $update_stmt = $dbh->prepare("UPDATE user SET mdp = :mdp, dateheure = CURRENT_TIMESTAMP() WHERE pseudo = :pseudo");
            $update_stmt->bindParam(':mdp', $hashed_password);
            $update_stmt->bindParam(':pseudo', $pseudo);
            $update_stmt->execute();
            
            // Redirection vers Connexion.php
            header("Location: Connexion.php");
            exit();
        } else {
            $error = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $error = "Les informations saisies ne correspondent pas à nos enregistrements.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe</title>
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
    <!-- Formulaire de changement de mot de passe -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="sub-form">
        <div class="upper-form">
            <h2>Mot de passe oublié</h2>
            
            <!-- Champs du formulaire -->
            <label>Nom d'utilisateur*</label><br>
            <input type="text" name="pseudo" value="<?php echo $pseudo; ?>" required><br>

            <label>Adresse Mail*</label><br>
            <input type="email" name="mail" value="<?php echo $mail; ?>" required><br>

            <label>Nouveau mot de passe*</label><br>
            <input type="password" name="password1" required><br>

            <label>Retaper le Mot de Passe*</label><br>
            <input type="password" name="password2" required><br>

            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

            <div class="btn">
                <button type="submit" name="submit">Changer le mot de passe</button><br>
            </div>
        </div>
    </form>
</div>

</body>
</html>