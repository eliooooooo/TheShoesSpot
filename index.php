<?php
session_start();

// Vérifiez si l'utilisateur est connecté
$username = '';
$marque = '';
$mode_affichage = '';
$mode_tri = '';
$genre = '';
if (isset($_SESSION['username'])) {
    // Afficher l'username de l'utilisateur
    $username = $_SESSION['username'];
}

if (isset($_POST['marque']) && $_POST["marque"]) {
    $marque = $_POST['marque'];
    $_SESSION['marque'] = $marque;
}else{
    $marque = '1, 2, 3, 4, 5, 6, 7, 8';
    $_SESSION['marque'] = $marque;
}
if (isset($_SESSION['marque'])) {
    $marque = $_SESSION['marque'];
}

if (isset($_POST['mode_affichage'])){
    $_SESSION['mode_affichage'] = $_POST['mode_affichage'];
}
if (isset($_SESSION['mode_affichage'])){
    $mode_affichage =  $_SESSION['mode_affichage'];
}

if (isset($_POST['mode_tri'])){
    $_SESSION['mode_tri'] = $_POST['mode_tri'];
}
if (isset($_SESSION['mode_tri'])){
    $mode_tri =  $_SESSION['mode_tri'];
}

if (isset($_POST['genre'])){
    $_SESSION['genre'] = $_POST['genre'];
}
if (isset($_SESSION['genre'])){
    $genre =  $_SESSION['genre'];
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
if ($id == 0){
    $article = select_article_genre_marque($pdo);
} else {
    $article = select_article_genre_marque_cat($pdo, $id);
};
$count_categorie = count_categorie($pdo);
$count_marques = count_marques($pdo);
$count_all = count_all_genre($pdo, $id);
$count_marques_cat = count_marques_cat_genre($pdo, $id);
$show_cat = show_cat($pdo, $id);
$moyenne = count_moyenne_note($pdo, $id);
$marques = init_marque($pdo);
$count_all_marque_cat_genre = count_all_marque_genre_cat($pdo, $id);

// Lancement du moteur Twig avec les données
echo $twig->render('aside.twig', [
    'id' => $id,
	'article' => $article,
    'count' => $count_categorie,
    'count_all' => $count_all,
    'count_marques' => $count_marques,
    'count_marques_cat' => $count_marques_cat,
    'cat' => $show_cat,
    'username' => $username,
    'moyenne' => $moyenne,
    'marque' => $marque,
    'mode_affichage' => $mode_affichage,
    'mode_tri' => $mode_tri,
    'genre' => $genre,
    'count_all_marque_cat_genre' => $count_all_marque_cat_genre,
]);