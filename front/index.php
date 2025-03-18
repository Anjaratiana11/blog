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
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JHFERGL7X5"></script>
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
        <section id="categories">
            <h2>Catégories</h2>
            <form action="index.php" method="get">
                <select name="idcategorie" id="categories-select" onchange="this.form.submit()">
                    <option value="" <?= is_null($idCategorie) ? 'selected' : '' ?>>Toutes les catégories</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>" <?= ($idCategorie == $categorie['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($categorie['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </section>

        <section id="articles">
            <h2><?= $idCategorie ? "Articles de la catégorie : " . htmlspecialchars($categories[array_search($idCategorie, array_column($categories, 'id'))]['name']) : "Derniers Articles" ?></h2>

            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <article>
                        <h3><a href="article.php?id=<?= $article['id'] ?>" 
                        onclick="gtag('event', 'click', { 'event_category': 'Article', 'event_label': '<?= htmlspecialchars($article['title']) ?>' });"><?= htmlspecialchars($article['title']) ?></a></h3>
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
