<?php
require_once(__DIR__ . '/../../back/includes/dbconnect.php');


function findAllArticles() {
    global $conn;  

    $sql = "SELECT * FROM articles ORDER BY created_at DESC";

    // Exécuter la requête
    $result = $conn->query($sql);

    // Vérifier si des articles ont été trouvés
    if ($result->num_rows > 0) {
        // Tableau pour stocker les articles récupérés
        $articles = [];

        // Parcourir les résultats et les ajouter au tableau
        while($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }

        // Retourner le tableau des articles
        return $articles;
    } else {
        // Si aucun article n'est trouvé, retourner un tableau vide
        return [];
    }
}

function findArticleByCategories($idCategorie) {
    global $conn;  

    // Sécuriser l'ID de la catégorie
    $idCategorie = intval($idCategorie);

    // Requête SQL pour récupérer les articles d'une catégorie spécifique
    $sql = "SELECT * FROM articles WHERE category_id = ? ORDER BY created_at DESC";

    // Préparer la requête
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCategorie);
    $stmt->execute();

    // Récupérer les résultats
    $result = $stmt->get_result();

    // Vérifier s'il y a des articles
    if ($result->num_rows > 0) {
        $articles = [];

        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }

        return $articles;
    } else {
        return [];
    }
}

function findAllCategories() {
    global $conn;

    // Requête SQL pour récupérer toutes les catégories
    $sql = "SELECT * FROM categories ORDER BY name ASC";
    $result = $conn->query($sql);

    // Vérifier si des catégories existent
    if ($result->num_rows > 0) {
        $categories = [];

        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }

        return $categories;
    } else {
        return [];
    }
}

function findArticleById($idArticle) {
    global $conn; // Assurez-vous que $conn est bien défini

    $sql = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idArticle);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc(); // Retourne un seul article sous forme de tableau associatif
}

// Fonction pour récupérer les avis d'un article
function findAllAvisByArticle($idArticle) {
    global $conn;
    $idArticle = (int)$idArticle; // Sécurisation
    $sql = "SELECT * FROM avis WHERE article_id = ? ORDER BY created_at DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idArticle);
    $stmt->execute();
    $result = $stmt->get_result();

    $avis = [];
    while ($row = $result->fetch_assoc()) {
        $avis[] = $row;
    }
    return $avis;
}

// Fonction pour ajouter un avis
function ajoutAvis($idArticle, $name, $rating, $review) {
    global $conn;
    $sql = "INSERT INTO avis (article_id, name, rating, review) VALUES (?, ?, ?, ?)";

    // Correction : lier les paramètres dans le bon ordre
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $idArticle, $name, $rating, $review); // "i" pour integer, "s" pour string

    return $stmt->execute(); // Retourne true si l'ajout a réussi
}


// Fonction pour ajouter un message de contact
function ajoutContact($name, $email, $message) {
    global $conn;
    $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    return $stmt->execute();
}
?>