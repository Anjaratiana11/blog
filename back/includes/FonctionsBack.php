<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/back/includes/dbconnect.php';

function findAllArticles() {
    global $conn;  

    $sql = "SELECT * FROM articles ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $articles = [];
        while($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
        return $articles;
    } else {
        return [];
    }
}

function findArticleById($id) {
    global $conn;

    $sql = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null; // Si l'article n'existe pas
    }
}

function createArticle($title, $content, $author, $category_id) {
    global $conn;

    $sql = "INSERT INTO articles (title, content, author, category_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $author, $category_id);

    if ($stmt->execute()) {
        return $conn->insert_id; 
    } else {
        return false;
    }
}

function updateArticle($id, $title, $content, $author, $category_id) {
    global $conn;

    $sql = "UPDATE articles SET title = ?, content = ?, author = ?, category_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $title, $content, $author, $category_id, $id);

    return $stmt->execute(); 
}

function deleteArticle($id) {
    global $conn;

    $sql = "DELETE FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}

function findAllContact() {
    global $conn;

    $sql = "SELECT * FROM contact ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $contacts = [];
        while($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }
        return $contacts;
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
?>