<?php
session_start(); // Démarre la session
// Récupération du contenu du formulaire
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$submit = isset($_POST['submit']);
// Si authentification OK, on crée la variable de session
if ($submit) {
if ($username == 'jef' && $password=='jefjef') {
$_SESSION['username'] = $username;
}
}
?>
