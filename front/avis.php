<?php   
require 'includes/fonctions.php'; // Assurez-vous que cette fonction est bien définie dans votre fichier

// Vérification de l'ID de l'article
if (isset($_GET['idarticle']) && is_numeric($_GET['idarticle'])) {
    $idarticle = $_GET['idarticle'];
    $avis = findAllAvisByArticle($idarticle);

    if (!$avis) {
        echo "<p>Aucun avis pour cet article.</p>";
    }
} else {
    echo "<p>ID invalide.</p>";
    exit;
}

// Traitement de l'ajout d'un avis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['review'], $_POST['rating']) && is_numeric($_POST['rating'])) {
        $name = $_POST['name'];
        $review = $_POST['review'];
        $rating = intval($_POST['rating']);
        $idArticle = $_GET['idarticle'];

        // Appel de la fonction d'ajout de l'avis
        if (ajoutAvis($idArticle, $name, $rating, $review)) {
            header("Location: avis.php?idarticle=$idArticle"); // Rafraîchir la page après l'ajout
            exit;
        } else {
            echo "<p>Erreur lors de l'ajout de l'avis.</p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lisez les avis des utilisateurs sur nos articles et partagez vos propres commentaires.">
    <meta name="keywords" content="avis, article, design, UX, UI, tendances, commentaires, partager">
    <meta name="author" content="Designova Team">
    <link rel="icon" type="image/png" href="images/logo.png">
    <title>Avis sur l'article - Designova</title>
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
        <section id="article-reviews">
            <h1>Avis sur l'article</h1>
            
            <h2>Avis des lecteurs</h2>
            <div class="reviews">
    <?php foreach ($avis as $a) : ?>
        <article class="review">
            <h3><?= htmlspecialchars($a['name']) ?></h3>
            <p><?= htmlspecialchars($a['review']) ?></p>
            
            <div class="rating">
                <?php
                // Affichage des étoiles
                for ($i = 1; $i <= 5; $i++) {
                    // Si la note est supérieure ou égale à l'étoile actuelle, on affiche une étoile pleine
                    if ($i <= $a['rating']) {
                        echo '★'; // Étoile pleine
                    } else {
                        echo '☆'; // Étoile vide
                    }
                }
                ?>
            </div>
            
            <small>Posté le <?= $a['created_at'] ?></small>
            </article>
            <?php endforeach; ?>
            </div>

            <h2>Ajoutez votre avis</h2>
            <form action="avis.php?idarticle=<?= $_GET['idarticle'] ?>" method="POST">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required><br>
                
                <label for="rating">Note :</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required><br>
                
                <label for="review">Votre avis :</label><br>
                <textarea id="review" name="review" rows="5" required></textarea><br>
                
                <button type="submit" class="btn">Envoyer</button>
            </form>
        </section>
    </main>
    
    <footer>
        &copy; 2025 Designova 2686-2824- Tous droits réservés
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