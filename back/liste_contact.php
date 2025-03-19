<?php 
include_once 'includes/FonctionsBack.php';    // Les fonctions CRUD (findAllContact)

$contacts = findAllContact();  // Récupérer tous les contacts
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de gestion des contacts utilisateurs. Voir les messages envoyés par les utilisateurs.">
    <meta name="keywords" content="contacts, gestion des messages, administration">
    <meta name="author" content="Designova Team">
    <title>Liste des Contacts</title>
    <link rel="stylesheet" href="css/stylesback.css"> 
    <link rel="icon" type="image/png" href="../front/images/logo.png">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="admin.php">Statistiques</a></li>
                <li><a href="liste_contact.php">Contacts</a></li>
                <li><a href="gestion_article.php">Articles</a></li>
                <li><a href="api_google_analytics.php">Goggle analytics & tag manager</a></li>
            </ul>
        </nav>    
    </header>
    <h1>Liste des Messages de Contact</h1>
    <section class="contact-list">
        <?php if (count($contacts) > 0): ?>
            <!-- Boucle pour afficher les messages -->
            <?php foreach ($contacts as $contact): ?>
                <div class="contact-item">
                    <h3><?php echo htmlspecialchars($contact['name']); ?> <span><?php echo htmlspecialchars($contact['created_at']); ?></span></h3>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($contact['email']); ?></p>
                    <p><strong>Message:</strong> <?php echo htmlspecialchars(substr($contact['message'], 0, 150)) . (strlen($contact['message']) > 150 ? '...' : ''); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun message de contact trouvé.</p>
        <?php endif; ?>
    </section>

    <footer>
        &copy; 2025 Designova - Gestion des contacts
    </footer>

</body>
</html>
