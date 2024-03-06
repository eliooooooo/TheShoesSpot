<?php
// Formulaire permettant l'inscription de l'utilisateur
session_start();

// Vérifiez si l'utilisateur est connecté
$username = '';
if (isset($_SESSION['username'])) {
    // Afficher l'username de l'utilisateur
    $username = $_SESSION['username'];
}

// Initialise Twig
include('include/twig.php');
$twig = init_twig();

// Récupère les données GET sur l'URL
if (isset($_GET['id'])) $id = $_GET['id']; else $id = 0;

// Convertit l'identifiant en entier
// $id = intval($id);

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupération des données : exemples
include('include/select.php');
include('include/select_stats.php');
$count_categorie = count_categorie($pdo);

// Lancement du moteur Twig avec les données
echo $twig->render('inscription.twig', [
    'username' => $username,
    'count' => $count_categorie
]);