la page  ne sert a rien
<?php
$username = "";
$password = "";
$sql = "select * from personnes where prenom =:";
try {
$sth = $dbh->prepare($sql);
$sth->execute(array(':prenom' => $prenom));
$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
if (count($rows)>0) {
echo "<ul>";
foreach ($rows as $row) {
echo "<li>" . $row["prenom"] . " " . $row["nom"] . "</li>";
}
echo "</ul>";
} else {echo "<p>Rien à afficher</p>"; }
?>