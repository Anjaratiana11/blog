<?php 
include_once 'includes/FonctionsBack.php';  // Les fonctions CRUD (createArticle, findAllCategories)

// Récupérer les catégories disponibles
$categories = findAllCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];

    // Appeler la fonction pour créer l'article
    $article_id = createArticle($title, $content, $author, $category_id);

    if ($article_id) {
        header("Location: gestion_article.php?message=Article créé avec succès");
        exit;
    } else {
        $error_message = "Erreur lors de la création de l'article.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de création d'article. Ajouter un nouvel article à la plateforme.">
    <meta name="keywords" content="création, article, ajouter">
    <meta name="author" content="Designova Team">
    <title>Créer un Nouvel Article</title>
    <link rel="stylesheet" href="css/stylesback.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="admin.php">Statistiques</a></li>
            <li><a href="liste_contact.php">Contacts</a></li>
            <li><a href="gestion_article.php">Articles</a></li>
        </ul>
    </nav>
</header>

<h1>Créer un Nouvel Article</h1>

<section class="message">
    <?php if (isset($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
</section>

<section class="article-form">
    <form action="create_article.php" method="POST">
        <label for="title">Titre de l'article :</label>
        <input type="text" id="title" name="title" required>

        <label for="content">Contenu :</label>
        <textarea id="content" name="content" required></textarea>

        <label for="author">Auteur :</label>
        <input type="text" id="author" name="author" required>

        <label for="category_id">Catégorie :</label>
        <select id="category_id" name="category_id" required>
            <option value="">Sélectionner une catégorie</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn-submit">Créer l'article</button>
    </form>
</section>

<footer>
    &copy; 2025 Designova - Création d'article
</footer>

</body>
</html>
