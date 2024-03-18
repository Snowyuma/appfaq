<?php
session_start();
include "include/liaison.php";
$dbh=db_connect();

 $sql = "select * from faq";
 try {
 $sth = $dbh->prepare($sql);
$sth->execute(array(
 ':question' => $question,
 ':reponse' => $reponse
 ));
 $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
 } catch ( PDOException $ex) {
 die("Erreur lors de la requête SQL : ".$ex->getMessage());
 }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <header>
        <nav class="container">

            <div class="lien-parent">

                <a href="AjoutQuestion.php" class="lien-social">Ajout-Question</a>
                <a href="Deconnexion.php" class="lien-social">Déconnexion</a>
            </div>
        </nav>
    </header>
    <div class="formfaq">
        <form action="#" class="sub-formfaq">
            <div class="upper-form">
                <h2>FAQ</h2>
            </div>

            <table>
                <tr>
                    <th class="p">Numéro</th><!--vous étes sur que on met un numéro?-->
                    <th class="p">Auteur</th>
                    <th class="p">Question</th>
                    <th class="p">Réponse</th>
                    <th class="p">Action</th>
                </tr> 
                    <?php

                    foreach ($rows as $row){
                    echo '<tr class="tr">';
                    echo '<td class="p">'.$row["pseudo"].'</td>';
                    echo '<td class="p">'.$row["question"].'</td>';
                    echo '<td class="p">'.$row["reponse"].'</td>';
                    if ($row['id_user']=2 ||$row['id_user']=3 ){
                        echo '<td><a href="Supr.php" class="action_tab">Supprimer </a><br>';
                        echo '<a href="Modif.php" class="action_tab">Modification</a></td>';
                    }
                    echo '</tr>';
                 }
                    ?>
                
                <tr class="tr">
                    <td class="p">1</td>
                    <td class="p">Jean-pierre</td>
                    <td class="tdfaq p">À quelle fréquence pratiquez-vous un sport ou une activité physique chaque semaine ?</td>
                    <td> <p class="inputfaq" type="text" value="réponse"> patate la riche</p> <br></td>
                    <td><a href="Supr.php" class="action_tab">Supprimer </a><br>
                    <a href="Modif.php" class="action_tab">Modification</a></td>
                    
                </tr>
                <tr class="tr">
                    <td class="p">2</td>
                    <td class="p">Jean-caillou</td>
                    <td class="tdfaq p">Quels types de sports ou d'activités physiques aimez-vous ?</td>
                    <td><input class="inputfaq" type="text" value="réponse"></input> <br></td>
                    <td><a href="Supr.php" class="signup">Supprimer </a></td>
                </tr>
                <tr class="tr">
                    <td class="p">3</td>
                    <td class="p">Jean-rocher</td>
                    <td class="tdfaq p">Avez-vous déjà pratiqué un sport de compétition ?</td>
                    <td><input class="inputfaq" type="text" value="réponse"></input> <br></td>
                    <td><a href="Supr.php" class="signup">Supprimer </a></td>
                </tr>
                </tr>
                <tr class="tr">
                    <td class="p">3</td>
                    <td class="p">Jean-Montagne</td>
                    <td class="tdfaq p">Depuis combien de temps pratiquez-vous votre sport ou activité physique préféré ?</td>
                    <td><input class="inputfaq" type="text" value="réponse"></input> <br></td>
                    <td><a href="Supr.php" class="signup">Supprimer </a></td>
                </tr>
            </table>
            <br>
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
</body>

</html>