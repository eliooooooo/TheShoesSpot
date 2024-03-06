<?php
// Page affichant les détail d'un article en particulier
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

// Connexion à la base de données
include('include/connexion.php');
$pdo = connexion();

// Récupération des données : exemples
include('include/select.php');
include('include/select_stats.php');
$count_categorie = count_categorie($pdo);
$article = select_article($pdo, $id);
$image = show_image($pdo, $id);
$commentaire = select_article_commentaire($pdo, $id);
$moyenne = count_moyenne_note($pdo, $id);
$nb_avis = count_avis($pdo, $id);

// Lancement du moteur Twig avec les données
echo $twig->render('article.twig', [
    'id' => $id,
    'count' => $count_categorie,
	'article' => $article,
    'image' => $image,
    'username' => $username,
    'commentaire' => $commentaire,
    'moyenne' => $moyenne,
    'nb_avis' => $nb_avis
]);