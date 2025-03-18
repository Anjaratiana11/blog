<?php 
    require_once('includes/fonctions.php');

    // Récupérer toutes les catégories
    $categories = findAllCategories();

    // Vérifier si une catégorie est sélectionnée
    $idCategorie = isset($_GET['idcategorie']) ? intval($_GET['idcategorie']) : null;

    // Récupérer les articles en fonction de la catégorie sélectionnée
    $articles = $idCategorie ? findArticleByCategories($idCategorie) : findAllArticles();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez les dernières tendances du digital et du design graphique. Articles, analyses et conseils SEO pour les créateurs de contenu.">
    <meta name="keywords" content="digital, design, tendances, SEO, communication, graphisme">
    <meta name="author" content="Designova Team">
    <title>Designova - Blog Digital & Design</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
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
        <section id="categories">
            <h2>Catégories</h2>
            <ul>
                <li><a href="index.php" <?= is_null($idCategorie) ? 'class="active"' : '' ?>>Toutes les catégories</a></li>
                <?php foreach ($categories as $categorie): ?>
                    <li>
                        <a href="index.php?idcategorie=<?= $categorie['id'] ?>" <?= ($idCategorie == $categorie['id']) ? 'class="active"' : '' ?>>
                            <?= htmlspecialchars($categorie['name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section id="articles">
            <h2><?= $idCategorie ? "Articles de la catégorie : " . htmlspecialchars($categories[array_search($idCategorie, array_column($categories, 'id'))]['name']) : "Derniers Articles" ?></h2>

            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <article>
                        <h3><a href="article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
                        <p><?= htmlspecialchars($article['content']) ?></p>
                        <a href="article.php?id=<?= $article['id'] ?>" class="btn">Lire l’article</a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun article trouvé.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Designova - Tous droits réservés</p>
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
