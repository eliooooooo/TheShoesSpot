<?php
// Permet a l'utilisateur de se connecter à son compte préalablement inscrit
include('include/connexion.php');
include('include/securite.php');
$pdo = connexion();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $username = post_string('username');
    $password = post_string('password');


    // Vérification des informations d'identification de l'utilisateur
    $sql = "SELECT * FROM Client WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['mdp_client'])) {
        // Si les informations d'identification sont correctes, créer une session pour l'utilisateur
        session_start();

        $_SESSION['id_client'] = $user['id_client'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email_client'];

        // Redirection vers la page d'accueil ou vers une page spécifique pour les utilisateurs connectés
        header('Location: compte.php');
        exit;
    } else {
        // Si les informations d'identification sont incorrectes, afficher un message d'erreur
        echo 'Nom d\'utilisateur ou mot de passe incorrect';
        header('Location: compte.php');
    }
}