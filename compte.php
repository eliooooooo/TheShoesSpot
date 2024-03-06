<?php
// Page permettant la connexion, l'inscription et la déconnexion de l'utilisateur
session_start();

// Vérifiez si l'utilisateur est connecté
$username = '';
$email = '';
if (isset($_SESSION['username'])) {
    // Afficher l'username de l'utilisateur
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
}

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Récupère les données GET sur l'URL
if (isset($_GET['id'])) $id = $_GET['id']; else $id = 0;

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupération des données : exemples
include('include/select.php');
include('include/select_stats.php');
$count_categorie = count_categorie($pdo);

// Lancement du moteur Twig avec les données
echo $twig->render('compte.twig', [
    'count' => $count_categorie,
    'username' => $username,
    'email' => $email
]);