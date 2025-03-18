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
    <title>Avis sur l'article - Designova</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main>
        <section id="article-reviews">
            <h1>Avis sur l'article</h1>
            
            <h2>Avis des lecteurs</h2>
            <div class="reviews">
                <?php foreach ($avis as $a) : ?>
                    <article class="review">
                        <h3><?= htmlspecialchars($a['name']) ?></h3>
                        <p><?= htmlspecialchars($a['review']) ?></p>
                        <small>Note: <?= $a['rating'] ?>/5</small>
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
</body>
</html>