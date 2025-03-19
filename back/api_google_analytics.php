<?php

// Fonction pour rechercher un fichier dans un répertoire et ses sous-répertoires
function findFile($directory, $filename) {
    $files = scandir($directory);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $directory . DIRECTORY_SEPARATOR . $file;

        if (is_dir($filePath)) {
            // Recherche récursive dans le sous-répertoire
            $result = findFile($filePath, $filename);
            if ($result) {
                return $result; // On retourne le chemin trouvé
            }
        } elseif ($file === $filename) {
            // Le fichier est trouvé
            return $filePath;
        }
    }

    return false; // Fichier non trouvé
}

// Nom du fichier à rechercher
$filename = 'designova-454205-6856ed361431.json';

// Répertoire de départ (le dossier actuel)
$startingDirectory = __DIR__;

// Recherche du fichier
$result = findFile($startingDirectory, $filename);

if ($result) {
    echo "✅ Fichier trouvé : $result";
} else {
    echo "❌ Fichier non trouvé.";
}
?>
