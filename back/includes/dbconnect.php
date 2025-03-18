<?php

$servername = "localhost";
$username = "root";        
$password = "root";          
$dbname = "designova";   

// Création de la connexion
// $conn = new mysqli($servername, $username, $password, $dbname);
$conn=null;
// Vérifier si la connexion est réussie
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Si la connexion est réussie, cette ligne sera exécutée
// echo "Connexion réussie";

// Paramétrer le jeu de caractères pour éviter les problèmes de codage
$conn->set_charset("utf8");

?>
