<?php  
    include('includes/fonctions.php');   // Ce fichier doit contenir la fonction ajouterContact()
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contactez l'équipe de Designova pour toute demande concernant les tendances du design et du marketing digital. Nous sommes là pour répondre à vos questions et partager nos conseils.">
    <meta name="keywords" content="contact, Designova, tendances design, digital, marketing digital, SEO, communication">
    <meta name="author" content="Designova Team">
    <title>Contact - Designova</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
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
            <!-- Inclure ici une barre de navigation -->
            <ul>
                <li><a href="index.php">Articles</a></li>
                <li><a href="about.php">À propos</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="contact">
            <h1>Contactez-nous</h1>
            <p>Nous serions ravis de recevoir vos questions, suggestions, ou commentaires. N'hésitez pas à nous envoyer un message en utilisant le formulaire ci-dessous :</p>

            <?php
            // Traitement du formulaire
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];

                // Appeler la fonction ajouterContact
                if (ajoutContact($name, $email, $message)) {
                    echo "<p>Votre message a été envoyé avec succès !</p>";
                } else {
                    echo "<p>Erreur lors de l'envoi du message. Veuillez réessayer.</p>";
                }
            }
            ?>

            <form action="contact.php" method="POST">
                <div>
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="message">Message :</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit">Envoyer</button>
            </form>

            <p>Vous pouvez également nous contacter via nos réseaux sociaux :</p>
            <ul>
                <li><a href="https://www.facebook.com/designova" target="_blank">Facebook</a></li>
                <li><a href="https://www.twitter.com/designova" target="_blank">Twitter</a></li>
                <li><a href="https://www.instagram.com/designova" target="_blank">Instagram</a></li>
            </ul>
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
