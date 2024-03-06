<?php
session_start();

// Vérifiez si l'utilisateur est connecté
$username = '';
$id_client = '';
if (isset($_SESSION['username'])) {
    // Afficher l'username de l'utilisateur
    $username = $_SESSION['username'];
    $id_client = $_SESSION['id_client'];
}

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Connexion à la base de données
include('include/connexion.php');
include('include/securite.php');
$pdo = connexion();


include('include/select.php');
include('include/select_stats.php');
$count_categorie = count_categorie($pdo);



echo $twig->render('erreur/403.twig', [
    'count' => $count_categorie,
    'username' => $username
]);
