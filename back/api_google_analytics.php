<?php
// admin.php
session_start();

// Inclusion de l'autoload de Composer
require_once '../vendor/autoload.php';

// Initialisation de l'API Google Analytics Data (GA4)
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

// Préparation de la requête pour récupérer plusieurs métriques des 7 derniers jours
$request = new Google_Service_AnalyticsData_RunReportRequest([
    'dateRanges' => [
        ['startDate' => '7daysAgo', 'endDate' => 'today']
    ],
    'metrics' => [
        ['name' => 'sessions'],
        ['name' => 'activeUsers'],
        ['name' => 'engagedSessions'],
        ['name' => 'averageSessionDuration']
    ]
]);

try {
    // Remplace "properties/482561072" par l'ID de propriété GA4 approprié
    $response = $analyticsService->properties->runReport('properties/482561072', $request);
} catch (Exception $e) {
    die('Erreur lors de la récupération des données Analytics : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="contacts, gestion des messages, administration">
    <title>Admin Dashboard - Google Analytics & Tag Manager</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            margin: 20px;
            color: #333;
        }
        h1, h2 {
            color: #2c3e50;
        }
        table {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #2980b9;
            color: #fff;
            text-transform: uppercase;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        p.message {
            text-align: center;
            font-size: 1.2em;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
    <link rel="stylesheet" href="css/stylesback.css"> 
    <link rel="icon" type="image/png" href="../front/images/logo.png">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="liste_contact.php">Contacts</a></li>
                <li><a href="gestion_article.php">Articles</a></li>
                <li><a href="api_google_analytics.php">Goggle analytics & tag manager</a></li>
            </ul>
        </nav>    
    </header>
    <div class="container">
        <h1>Dashboard Admin</h1>

        <section>
            <h2>Données Google Analytics (7 derniers jours)</h2>
            <?php
            $rows = $response->getRows();
            if (!empty($rows)) {
                // Affichage dans un tableau avec plusieurs colonnes
                echo "<table>";
                echo "<tr>
                        <th>Sessions</th>
                        <th>Utilisateurs Actifs</th>
                        <th>Sessions Engagées</th>
                        <th>Durée Moyenne des Sessions (s)</th>
                      </tr>";
                foreach ($rows as $row) {
                    // On suppose que l'ordre des métriques est : sessions, activeUsers, engagedSessions, averageSessionDuration
                    $metrics = $row->getMetricValues();
                    echo "<tr>";
                    foreach ($metrics as $metric) {
                        echo "<td>" . htmlspecialchars($metric->getValue()) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='message'>Aucune donnée disponible pour la période demandée.</p>";
            }
            ?>
        </section>

        <section>
            <h2>Données Google Tag Manager</h2>
            <p>Les données issues de Google Tag Manager ne sont pas directement accessibles via une API de reporting standard.<br>
            Pour consulter ces données, veuillez accéder à l'interface de Google Tag Manager.</p>
            <p style="text-align: center;">
                <a href="https://tagmanager.google.com/" target="_blank" style="color: #2980b9; text-decoration: none; font-weight: bold;">Accéder à Google Tag Manager</a>
            </p>
        </section>
    </div>
</body>
</html>
