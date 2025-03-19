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
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-JHFERGL7X5');
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MFH5GXK7');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFH5GXK7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
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
                        ><?= htmlspecialchars($article['title']) ?></a></h3>
                        <p><?= htmlspecialchars($article['content']) ?></p>
                        <a href="article.php?id=<?= $article['id'] ?>" class="btn" onclick="gtag('event', 'click', { 'event_category': 'Article', 'event_label': '<?= htmlspecialchars($article['title']) ?>' });">Lire l’article</a>
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
</body>
</html>
