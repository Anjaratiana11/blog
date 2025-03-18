<?php
include_once 'includes/fonctionsBack.php';   // Les fonctions CRUD (findAllArticles, deleteArticle, etc.)

// Récupérer tous les articles
$articles = findAllArticles();

// Si un article doit être supprimé
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if (deleteArticle($delete_id)) {
        header("Location: adminarticles.php?message=Article supprimé avec succès");
        exit;
    } else {
        $error_message = "Erreur lors de la suppression de l'article.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page d'administration des articles - Gestion des articles, ajout, modification et suppression.">
    <meta name="keywords" content="administration, articles, gestion, supprimer, modifier">
    <meta name="author" content="Designova Team">
    <title>Administration des Articles</title>
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
    <h1>Gestion des Articles</h1>
    <section class="message">
        <?php if (isset($_GET['message'])): ?>
            <p class="success"><?php echo $_GET['message']; ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </section>

    <section class="article-list">
        <h2>Liste des Articles</h2>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Date de Création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($articles)): ?>
                    <tr>
                        <td colspan="4">Aucun article trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($article['title']); ?></td>
                            <td><?php echo htmlspecialchars($article['author']); ?></td>
                            <td><?php echo date("d/m/Y H:i", strtotime($article['created_at'])); ?></td>
                            <td>
                                <a href="edit_article.php?id=<?php echo $article['id']; ?>" class="btn-edit">Modifier</a>
                                <a href="gestion_article.php?delete_id=<?php echo $article['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
    <!-- Bouton Nouveau Article -->
    <section class="new-article-btn">
        <a href="create_article.php" class="btn-new-article">Nouveau Article</a>
    </section>
    <footer>
        &copy; 2025 Designova - Administration des articles
    </footer>
</body>
</html>
