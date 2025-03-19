<?php
// admin.php
session_start();

// Inclusion de l'autoload de Composer
require_once '../vendor/autoload.php';

// INITIALISATION DE L'API GOOGLE ANALYTICS
$credentials = getenv('GOOGLE_CREDENTIALS');
$client = new Google_Client();
$client->setApplicationName("Designova Analytics Dashboard");
if ($credentials) {
    $client->setAuthConfig(json_decode($credentials, true));
}$client->addScope('https://www.googleapis.com/auth/analytics.readonly');

try {
    $analyticsService = new Google_Service_AnalyticsReporting($client);
} catch (Exception $e) {
    die('Erreur lors de l\'initialisation de l\'API Analytics : ' . $e->getMessage());
}

// Préparation de la requête pour récupérer les sessions des 7 derniers jours
$request = new Google_Service_AnalyticsReporting_ReportRequest();
$request->setViewId('G-JHFERGL7X5'); // Votre ID de vue Google Analytics
$request->setDateRanges([
    new Google_Service_AnalyticsReporting_DateRange([
        'startDate' => '7daysAgo',
        'endDate'   => 'today'
    ])
]);
$request->setMetrics([
    new Google_Service_AnalyticsReporting_Metric([
        'expression' => 'ga:sessions',
        'alias'      => 'Sessions'
    ])
]);

$body = new Google_Service_AnalyticsReporting_GetReportsRequest();
$body->setReportRequests([$request]);

try {
    $reports = $analyticsService->reports->batchGet($body);
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
        // Traitement de la réponse et affichage des données
        if (!empty($reports)) {
            foreach ($reports as $report) {
                $rows = $report->getData()->getRows();
                if (!empty($rows)) {
                    echo "<table>";
                    echo "<tr><th>Sessions (7 derniers jours)</th></tr>";
                    foreach ($rows as $row) {
                        $metrics = $row->getMetrics();
                        foreach ($metrics as $metric) {
                            $values = $metric->getValues();
                            echo "<tr><td>" . htmlspecialchars($values[0]) . "</td></tr>";
                        }
                    }
                    echo "</table>";
                } else {
                    echo "<p>Aucune donnée disponible pour la période demandée.</p>";
                }
            }
        } else {
            echo "<p>Aucune donnée retournée par l'API.</p>";
        }
        ?>
    </section>

    <section>
        <h2>Données Google Tag Manager</h2>
        <p>Les données issues de Google Tag Manager ne sont pas directement accessibles via une API de reporting standard. Pour afficher ces données, consultez l’interface de GTM ou développez une solution personnalisée via l’API Tag Manager.</p>
        <p><a href="https://tagmanager.google.com/" target="_blank">Accéder à Google Tag Manager</a></p>
    </section>
</body>
</html>
