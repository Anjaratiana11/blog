<?php
// admin.php
session_start();

// Inclusion de l'autoload de Composer
require_once '../vendor/autoload.php';

// Initialisation de l'API Google Analytics
$client = new Google_Client();
$client->setApplicationName("Designova Analytics Dashboard");

// Charger les credentials à partir du secret ou d'une variable d'environnement
$credentialsPath = '/etc/secrets/designova-454205-6856ed361431.json'; // Chemin vers le fichier de credentials dans Docker
if (file_exists($credentialsPath)) {
    $client->setAuthConfig($credentialsPath);
} else {
    $credentials = getenv('GOOGLE_CREDENTIALS');
    if ($credentials) {
        $client->setAuthConfig(json_decode($credentials, true));
    } else {
        die('Erreur : Aucune configuration d\'authentification trouvée.');
    }
}

$client->addScope('https://www.googleapis.com/auth/analytics.readonly');

try {
    $analyticsService = new Google_Service_AnalyticsData($client);
} catch (Exception $e) {
    die('Erreur lors de l\'initialisation de l\'API Analytics : ' . $e->getMessage());
}

// Préparation de la requête pour récupérer les sessions des 7 derniers jours
$request = new Google_Service_AnalyticsData_RunReportRequest([
    'dateRanges' => [
        ['startDate' => '7daysAgo', 'endDate' => 'today']
    ],
    'metrics' => [
        ['name' => 'sessions']
    ]
]);

try {
    $response = $analyticsService->properties->runReport('properties/482561072', $request);
} catch (Exception $e) {
    die('Erreur lors de la récupération des données Analytics : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Google Analytics & Tag Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        table { border-collapse: collapse; margin-top: 1em; }
        table, th, td { border: 1px solid #ccc; padding: 8px; }
        th { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <h1>Dashboard Admin</h1>

    <section>
        <h2>Données Google Analytics</h2>
        <?php
        if (!empty($response->getRows())) {
            echo "<table>";
            echo "<tr><th>Sessions (7 derniers jours)</th></tr>";
            foreach ($response->getRows() as $row) {
                $sessions = $row->getMetricValues()[0]->getValue();
                echo "<tr><td>" . htmlspecialchars($sessions) . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucune donnée disponible pour la période demandée.</p>";
        }
        ?>
    </section>
</body>
</html>
