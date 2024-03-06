<?php
// Permet d'ajouter des commentaire quand on est connecté à un compte 
session_start();

include('include/connexion.php');
include('include/securite.php');
$pdo = connexion();

// Récupération des variables du formulaire
$com_article = post_string('com_article');
$id_article = post_integer('id_article');
$note_article = post_integer('note_article');

// Si jamais la note dépasse 5 ou est inférieure à 1
if ($note_article > 5){
    $note_article = 5;
} elseif ($note_article < 1){
    $note_article = 1;
}

// Si jamais le texte dépasse 200 caractères
if ( strlen($com_article) > 200 ) {
    header('Location: article.php?id='.$id_article.'');
    exit;
}

if ( $note_article =='' ){
    header('Location: article.php?id='.$id_article.'');
    exit;
}

// Ajout du commentaire dans la base de données
$sql = "INSERT INTO Feedback (id_article, note_article, com_article, id_client) VALUES (:id_article, :note_article, :com_article, :id_client)";
$query = $pdo->prepare($sql);
$query->bindValue(':id_article',$id_article,PDO::PARAM_INT);
$query->bindValue(':id_client',$_SESSION['id_client'],PDO::PARAM_INT);
$query->bindValue(':note_article',$note_article,PDO::PARAM_INT);
$query->bindValue(':com_article',$com_article,PDO::PARAM_STR);
$query->execute();

// Redirection vers la page de l'article en question
header('Location: article.php?id='.$id_article.'');