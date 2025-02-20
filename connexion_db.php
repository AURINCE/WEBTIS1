<?php
$servername = "localhost";
$username = "root"; 
$password = "AURINCEDB";
$dbname = "footconnect"; // Le nom de ta base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
// Si la connexion réussit, affiche un message
echo "Connexion réussie.";
?>