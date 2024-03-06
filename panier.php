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

// Récupère les données GET sur l'URL
if (isset($_GET['id'])) $id = $_GET['id']; else $id = 0;

// Convertit l'identifiant en entier
// $id = intval($id);

// Connexion à la base de données
include('include/connexion.php');
include('include/securite.php');
$pdo = connexion();

// Permet d'ajouter un article au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id = post_integer('id_panier');

    // Insertion de l'article dans le panier
    $sql = "INSERT INTO Favoris (id_client, id_article) VALUES (:id_client, :id)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id_client',$_SESSION['id_client'],PDO::PARAM_INT);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
}

include('include/select.php');
include('include/select_stats.php');
$count_categorie = count_categorie($pdo);
$count_panier = count_panier($pdo, $id_client);
$article = select_article_favoris($pdo, $id_client);

// Lancement du moteur Twig avec les données
echo $twig->render('panier.twig', [
    'id' => $id,
    'count' => $count_categorie,
    'username' => $username,
    'id_client' => $id_client,
    'count_panier' => $count_panier,
    'article' => $article,
]);