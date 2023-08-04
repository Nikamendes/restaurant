<?php
session_start();

require_once './back/config.php';
require_once './back/langue.php';

// Vérification de l'état de connexion de l'utilisateur
if (isset($_SESSION['restaurant_users_id'])) {
    // L'utilisateur est déjà connecté, redirigez-le vers la page appropriée
    header('Location: dashboard.php');
    exit();
} else {
    // L'utilisateur n'est pas connecté, affichez le formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //formulaire de connexion
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // authentification, redirigez l'utilisateur vers la page appropriée
        header('Location: admin.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
</head>
    <title>Mon Site Web</title>
</head>
<body>
    <div class="container">
        <h1>Connexion Administrateur</h1>
        <form method="POST" action="connexion.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>
    <script src="scripts.js"></script>
</body>
</html>