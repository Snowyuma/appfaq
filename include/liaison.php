<?php
//
// ph20b : pays de l'U.E. avec une BD
//

/**
 * Connexion à la base de données
 *
 * @return PDO objet de connexion
 */
function db_connect()
{
  // Définition des informations de connexion à la base de données
  $dsn = 'mysql:host=localhost;dbname=appfaq';  // contient le nom du serveur et de la base
  $user = 'root';
  $password = '';

  // Tentative de connexion à la base de données
  try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $ex) {
    // En cas d'erreur lors de la connexion, affiche un message d'erreur et arrête le script
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
  }
  
  // Retourne l'objet de connexion PDO
  return $dbh;
}

// Fonction pour la page de connexion
function connexion()
{
  // Lien avec la base de données
  $dbh = db_connect();
  
  // Récupération du pseudo et du mot de passe depuis le formulaire
  $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
  $motdepasse = isset($_POST['mdp']) ? $_POST['mdp'] : '';

  // Requête pour récupérer le pseudo depuis la base de données
  $sql_pseudo = "SELECT pseudo FROM user WHERE pseudo=:pseudo";
  try {
    $sth = $dbh->prepare($sql_pseudo);
    $sth->execute(array(
      ':pseudo' => $pseudo
    ));
    $resultat_pseudo = $sth->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
  }
  
  // Vérification si le pseudo existe
  if (count($resultat_pseudo) > 0) {
    // Requête pour récupérer le mot de passe correspondant au pseudo
    $sql_mdp = "SELECT mdp FROM user WHERE pseudo=:pseudo";
    try {
      $sth = $dbh->prepare($sql_mdp);
      $sth->execute(array(
        ':pseudo' => $pseudo
      ));
      $resultat_mdp = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    
    // Vérification si le mot de passe est correct
    if ($resultat_mdp && password_verify($motdepasse, $resultat_mdp['mdp'])) {
      // Requête pour récupérer le type d'utilisateur
      $sqlid_usertype = "SELECT id_usertype FROM user WHERE pseudo=:pseudo";
      try {
        $sth = $dbh->prepare($sqlid_usertype);
        $sth->execute(array(
          ':pseudo' => $pseudo
        ));
        $resultat_id_usertype = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
      }
      
      // Requête pour récupérer l'id de la ligue
      $sql_ligue = "SELECT id_ligue FROM user WHERE pseudo=:pseudo";
      try {
        $sth = $dbh->prepare($sql_ligue);
        $sth->execute(array(
          ':pseudo' => $pseudo
        ));
        $resultat_id_ligue = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
      }
      
      // Requête pour récupérer l'id de l'utilisateur
      $sql_user = "SELECT id_user FROM user WHERE pseudo=:pseudo";
      try {
        $sth = $dbh->prepare($sql_user);
        $sth->execute(array(
          ':pseudo' => $pseudo
        ));
        $resultat_id_user = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
      }

      // Requête pour récupérer le libellé de la ligue
      $sql_lib_ligue = "SELECT lib_ligue FROM user INNER JOIN ligue ON user.id_ligue=ligue.id_ligue WHERE user.pseudo=:pseudo";
      try {
        $sth = $dbh->prepare($sql_lib_ligue);
        $sth->execute(array(
          ':pseudo' => $pseudo
        ));
        $resultat_lib_ligue = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
      }

      // Affichage d'un message de connexion réussie
      echo "<p>Connecté</p>";
    
      // Définition des variables de session
      $_SESSION['pseudo'] = implode($resultat_pseudo);
      $_SESSION['id_usertype'] = implode($resultat_id_usertype);
      $_SESSION['id_ligue'] = implode($resultat_id_ligue);
      $_SESSION['id_user'] = implode($resultat_id_user);
      $_SESSION['lib_ligue'] = implode($resultat_lib_ligue);
      
      // Redirection vers la page FAQ après la connexion
      header("Location: FAQ.php");
      exit();
    } else {
      // Affichage d'un message en cas de mot de passe incorrect
      echo "Mot de passe incorrect";
    }
  } else {
    // Affichage d'un message en cas d'identifiant inconnu
    echo "Identifiant inconnu !";
  }
}
?>
