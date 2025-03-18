<?php 
    // Inclure ici les fichiers nécessaires comme header et navbar si besoin.
    // include('includes/header.php');
    // include('includes/navbar.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez les détails de l'article sur les dernières tendances du design graphique et digital. Lisez, partagez et donnez votre avis sur cet article.">
    <meta name="keywords" content="article, tendances, design, digital, avis, partager, marketing digital">
    <meta name="author" content="Designova Team">
    <title>Détails de l'article - Designova</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="about.php">À propos</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="article-details">
            <h1>Les tendances UI/UX en 2025</h1>
            <p><em>Publié le 25 mars 2025 par Designova</em></p>
            <p>Le design d'interface et l'expérience utilisateur (UI/UX) continuent d'évoluer, et en 2025, nous verrons de nouvelles pratiques et tendances. Dans cet article, nous explorons ces nouvelles tendances et leur impact sur la manière dont les utilisateurs interagiront avec les applications et les sites web.</p>

            <h2>Introduction</h2>
            <p>Les utilisateurs sont de plus en plus exigeants en matière de design interactif. Les tendances UI/UX en 2025 visent à améliorer l'expérience de navigation, de l'interaction tactile aux expériences immersives...</p>

            <h2>Principales tendances</h2>
            <ul>
                <li>Design minimaliste et épuré</li>
                <li>Expérience mobile-first</li>
                <li>Animations et transitions fluides</li>
                <li>Utilisation de la réalité augmentée (AR)</li>
            </ul>

            <p>Et bien d'autres... Pour en savoir plus, continuez à explorer cet article !</p>

            <!-- Boutons -->
            <div class="article-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://votre-url-article'); ?>" target="_blank" class="btn-share">Partager sur Facebook</a>
                <a href="avis.php" class="btn-avis">Lire les avis</a>
            </div>
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
