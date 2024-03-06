<?php
// Permet au client de se déconnecter de la session
session_start();

// Détruire toutes les données de la session
session_destroy();

// Rediriger vers la page d'accueil ou une autre page de votre choix
header('Location: compte.php');
exit;
