<?php

$servername = "trolley.proxy.rlwy.net";  
$username = "root";                      
$password = "PufACVtDSQDNMhWtQJHIJMNEGmdyKwKa";  
$dbname = "railway";                      
$port = 49046;                   

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérifier si la connexion est réussie
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Si la connexion est réussie, cette ligne sera exécutée

// Paramétrer le jeu de caractères pour éviter les problèmes de codage
$conn->set_charset("utf8");

?>
