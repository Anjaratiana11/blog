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
    <meta name="description" content="Lisez les avis des utilisateurs sur nos articles et partagez vos propres commentaires. Rejoignez la discussion sur les dernières tendances du design graphique et digital.">
    <meta name="keywords" content="avis, article, design, UX, UI, tendances, commentaires, partager">
    <meta name="author" content="Designova Team">
    <title>Avis sur l'article - Designova</title>
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
        <section id="article-reviews">
            <h1>Avis sur l'article "Les tendances UI/UX en 2025"</h1>
            <p><em>Publié le 25 mars 2025 par Designova</em></p>

            <!-- Affichage des avis -->
            <h2>Avis des lecteurs</h2>
            <div class="reviews">
                <article class="review">
                    <h3>Marie Dupont</h3>
                    <p>Super article ! Les tendances UI/UX pour 2025 sont très intéressantes. J'ai particulièrement aimé la partie sur la réalité augmentée dans le design.</p>
                </article>

                <article class="review">
                    <h3>Jean Martin</h3>
                    <p>Très bon contenu, mais je pense qu'il manque des exemples concrets. Une analyse plus approfondie serait bienvenue.</p>
                </article>

                <article class="review">
                    <h3>Claire Lefevre</h3>
                    <p>Article très complet, mais j'aurais aimé voir plus de détails sur les tendances du mobile-first. Cela devrait vraiment être au cœur des futures stratégies de design.</p>
                </article>
            </div>

            <!-- Formulaire pour ajouter un avis -->
            <h2>Ajoutez votre avis</h2>
            <form action="submit_review.php" method="post">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required><br>

                <label for="review">Votre avis :</label><br>
                <textarea id="review" name="review" rows="5" required></textarea><br>

                <button type="submit" class="btn">Envoyer</button>
            </form>
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
