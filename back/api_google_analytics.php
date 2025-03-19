
<?php


// Inclusion de l'autoload de Composer
require_once '../vendor/autoload.php';

// Fonction pour tester l'existence et le chargement des credentials
function testCredentials() {
    // Récupérer le chemin des credentials depuis une variable d'environnement
    $credentialsPath = getenv('GOOGLE_CREDENTIALS');
    
    if (!$credentialsPath) {
        echo 'La variable d\'environnement GOOGLE_CREDENTIALS n\'est pas définie ou vide.';
        return false;
    }
    
    // Vérifier si le fichier existe
    if (!file_exists($credentialsPath)) {
        echo 'Le fichier de credentials Google n\'existe pas à l\'emplacement spécifié : ' . $credentialsPath;
        return false;
    }
    
    // Essayer de charger les credentials avec Google_Client
    try {
        $client = new Google_Client();
        $client->setApplicationName("Designova Analytics Dashboard");
        $client->setAuthConfig($credentialsPath);  // Charger le fichier JSON des credentials
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');
        
        // Test d'authentification avec l'API Analytics
        $analyticsService = new Google_Service_AnalyticsReporting($client);
        echo 'Les credentials ont été chargés avec succès !';
        return true;
    } catch (Exception $e) {
        echo 'Erreur lors du chargement des credentials ou de l\'authentification : ' . $e->getMessage();
        return false;
    }
}

// Lancer le test des credentials
testCredentials();
?>
