<?php
// Informations de connexion à la base de données
$servername = "localhost"; // Nom de l'hôte (localhost pour une connexion locale)
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$dbname = "hr_management"; // Nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Définir l'encodage des caractères pour éviter les problèmes avec les caractères spéciaux
$conn->set_charset("utf8");
?>
