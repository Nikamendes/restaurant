<?php
session_start();

require_once './back/config.php';
require_once './back/langue.php';

// Vérification de l'état de connexion de l'utilisateur
if (isset($_SESSION['restaurant_candidat_id'])) {
    // L'utilisateur est déjà connecté, redirigez-le vers la page appropriée
    header('Location: page_candidat.php');
    exit();
} else {
    // L'utilisateur n'est pas connecté, affichez le formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //formulaire de connexion
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Vérifiez les informations de connexion dans la base de données
        $query = "SELECT ID_candidat FROM restaurant_candidats WHERE Email = :email AND mot_de_passe = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $candidat = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($candidat) {
            // Authentification, stockez l'ID du candidat dans la session
            $_SESSION['restaurant_candidat_id'] = $candidat['ID_candidat'];
            header('Location: page_candidat.php');
            exit();
        } else {
            // Authentification échouée, affichez un message d'erreur
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
    <title>Mon Site Web</title>
</head>
<body>
    <h1>Connexion Candidat</h1>
    <form method="POST" action="connect_candidat.php">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>
        
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Se connecter</button>
    </form>
    <script src="scripts.js"></script>
</body>
</html>