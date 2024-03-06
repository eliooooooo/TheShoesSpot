<?php
// Permet d'inscrire un utilisateur dans la base de données et dans la foulées de s'y inscrire
include('include/connexion.php');
include('include/securite.php');
$pdo = connexion();

// récupération des données du formulaire
$username = post_string('username');
$email = post_string('email');
$password = post_string('password');
$password_confirmation = post_string('password_confirmation');

// Vérification que le mot de passe et la confirmation sont identiques
if ($password !== $password_confirmation) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

// hashage du mot de passe
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Vérifier si l'utilisateur existe déjà
$sql = "SELECT * FROM Client WHERE username = :username";
$query = $pdo->prepare($sql);
$query->bindParam(':username', $username);
$query->execute();
$user = $query->fetch();

if ($user) {
    // Si l'utilisateur existe déjà, retourner une erreur
    echo "Un compte avec ce nom d'utilisateur existe déjà.";
    exit;
} else {
    // Si l'utilisateur n'existe pas encore, insérer les données dans la base de données
    $sql = "INSERT INTO Client (username, email_client, mdp_client) VALUES (:username, :email, :password)";
    $query = $pdo->prepare($sql);
    $query->bindParam(':username', $username);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password_hashed);
    if ($query->execute()) {
        // Récupération de l'id du nouvel utilisateur
        $id = $pdo->lastInsertId();
    
        // Création de la session de l'utilisateur
        session_start();
        $_SESSION['id_client'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
    
        // Redirection vers la page compte.php si l'inscription a été réussie
        header('Location: compte.php');
        exit;
    } else {
        echo 'erreur d\'insertion dans la base de données';
    }
}