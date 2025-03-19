<?php  
require_once('includes/fonctions.php'); // Inclusion du fichier contenant la fonction// Assurez-vous que la connexion est correcte

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article = findArticleById($_GET['id']);

    if (!$article) {
        echo "<p>Article introuvable.</p>";
        exit;
    }
} else {
    echo "<p>ID invalide.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($article['title']) ?>">
    <meta name="keywords" content="article, tendances, design, digital, avis, partager, marketing digital">
    <meta name="author" content="<?= htmlspecialchars($article['author']) ?>">
    <link rel="icon" type="image/png" href="images/logo.png">
    <title><?= htmlspecialchars($article['title']) ?> - Designova</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-JHFERGL7X5');
    </script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Articles</a></li>
                <li><a href="about.php">À propos</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="article-details">
            <h1><?= htmlspecialchars($article['title']) ?></h1>
            <p><em>Publié le <?= date('d M Y', strtotime($article['created_at'])) ?> par <?= htmlspecialchars($article['author']) ?></em></p>
            <p><?= nl2br(htmlspecialchars($article['content'])) ?></p>

            <!-- Boutons de partage -->
            <div class="article-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://votre-url-article?id=' . $article['id']); ?>" target="_blank" class="btn-share">Partager sur Facebook</a>
                <a href="avis.php?idarticle=<?= $article['id'] ?>" class="btn-avis">Lire les avis</a>
            </div>
        </section>
    </main>

    <footer>
        &copy; 2025 Designova 2686-2824 - Tous droits réservés
    </footer>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXXXXX');
    </script>
</body>
</html>
