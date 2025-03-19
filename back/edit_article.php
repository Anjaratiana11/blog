<?php
include_once 'includes/FonctionsBack.php';   

// Récupérer l'ID de l'article à modifier depuis l'URL
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];
} else {
    die("L'article n'a pas été trouvé.");
}

// Récupérer l'article à partir de la base de données
$article = findArticleById($article_id);
if (!$article) {
    die("L'article demandé n'existe pas.");
}

// Vérifier si le formulaire est soumis pour mettre à jour l'article
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];

    // Mettre à jour l'article
    if (updateArticle($article_id, $title, $content, $author, $category_id)) {
        header("Location: gestion_article.php?message=Article mis à jour avec succès");
        exit;
    } else {
        $error_message = "Erreur lors de la mise à jour de l'article.";
    }
}

// Récupérer toutes les catégories pour le menu déroulant
$categories = findAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de modification d'article - Modifier les détails d'un article existant.">
    <meta name="keywords" content="modifier, article, administration, gestion, SEO">
    <meta name="author" content="Votre Nom ou Nom de l'entreprise">
    <title>Modifier l'Article</title>
    <link rel="icon" type="image/png" href="../front/images/logo.png">
    <link rel="stylesheet" href="css/stylesback.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="liste_contact.php">Contacts</a></li>
                <li><a href="gestion_article.php">Articles</a></li>
                <li><a href="api_google_analytics.php">Goggle analytics & tag manager</a></li>
            </ul>
        </nav>
    </header>
    <h1>Modifier l'Article</h1>
    <section class="message">
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </section>

    <section class="edit-article-form">
        <h2>Modifier l'Article "<?php echo htmlspecialchars($article['title']); ?>"</h2>

        <form action="edit_article.php?id=<?php echo $article['id']; ?>" method="POST">
            <label for="title">Titre de l'article :</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>

            <label for="content">Contenu de l'article :</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>

            <label for="author">Auteur :</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($article['author']); ?>" required>

            <label for="category_id">Catégorie :</label>
            <select id="category_id" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $article['category_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Mettre à jour l'article</button>
        </form>
    </section>

    <footer>
        &copy; 2025 Designova - Modification des articles
    </footer>
</body>
</html>
