<?php
// Permet de supprmier un des articles dans le panier
session_start();

include('include/connexion.php');
include('include/securite.php');
$pdo = connexion();

// Récupération des variables du boutton Retirer du panier
$id = post_integer('id_panier');

// Retirer l'article du panier
$sql = "DELETE FROM Favoris WHERE id_client = :id_client AND id_article = :id LIMIT 1";
$query = $pdo->prepare($sql);
$query->bindValue(':id_client',$_SESSION['id_client'],PDO::PARAM_INT);
$query->bindValue(':id',$id,PDO::PARAM_INT);
$query->execute();

// Redirection vers le panier afin de consulter le panier
header('Location: panier.php');
