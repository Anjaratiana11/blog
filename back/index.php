<?php
session_start();

// Définir les identifiants par défaut
$defaultUsername = 'admin';
$defaultPassword = 'password123';

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: /gestion_article.php");
    exit();
}

$error = '';

// Traitement du formulaire de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === $defaultUsername && $password === $defaultPassword) {
        // Connexion réussie
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: /index.php");
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <style>
        body {
            background: #f4f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            margin-bottom: 1em;
            color: #2c3e50;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.75em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 0.75em;
            background-color: #2980b9;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        input[type="submit"]:hover {
            background-color: #1f6391;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
