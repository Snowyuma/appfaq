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
  $dsn = 'mysql:host=localhost;dbname=appfaq';  // contient le nom du serveur et de la base
  $user = 'root';
  $password = '';
  try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $ex) {
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
  }
  return $dbh;
}
//pour la page de connexion
function connexion()
{
  //lien avec la BDD
  $dbh = db_connect();
  //recuperation du pseudo et du mot de passe
  $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
  $motdepasse = isset($_POST['mdp']) ? $_POST['mdp'] : '';

  
  // recuperation du pseuso dans la BDD
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
  
  //verification si lme pseudo existe
  if (count($resultat_pseudo) > 0) {
    // verification du mot de passe
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
    
    //verification si le mot de passe est correct
    if ($resultat_mdp && password_verify($motdepasse, $resultat_mdp['mdp'])) {
      //recuperation du type d'utilisateur 
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
      
      //recuperation de la ligue
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
      
      //recuperation de l'id utilisateur
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

      
      // recuperation de libellé de la ligue
      $sql_lib_ligue = "SELECT lib_ligue FROM user inner join ligue on user.id_ligue=ligue.id_ligue WHERE user.pseudo=:pseudo";
      try {
        $sth = $dbh->prepare($sql_lib_ligue);
        $sth->execute(array(
          ':pseudo' => $pseudo
        ));
        $resultat_lib_ligue = $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
      }

      echo "<p>Connecté</p>";
    
      $_SESSION['pseudo'] = implode ($resultat_pseudo);
      $_SESSION['id_usertype'] = implode ($resultat_id_usertype);
      $_SESSION['id_ligue'] = implode ($resultat_id_ligue);
      $_SESSION['id_user'] = implode ($resultat_id_user);
      $_SESSION['lib_ligue'] = implode ($resultat_lib_ligue);
      header("Location: FAQ.php");
      exit();
    } else {
      echo "mot de passe incorrect";
    }
  } else {
    echo "Identifiant inconnu !";
  }
}
