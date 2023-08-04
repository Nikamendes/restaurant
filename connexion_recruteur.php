<?php
// Démarre la session si ce n'est pas déjà fait
session_start();

require_once './back/config.php';
require_once './back/langue.php';

// Vérification de l'état de connexion du recruteur
if (isset($_SESSION['restaurant_recruteur_id'])) {
    // Le recruteur est déjà connecté, redirigez-le vers la page appropriée
    header('Location: page_recruteur.php');
    exit();
} else {
    // Le recruteur n'est pas connecté, affichez le formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Formulaire de connexion
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        
        // Connexion à la base de données (vous devrez remplacer les informations de connexion par les vôtres)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "k35gck9e_projets";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour vérifier si l'email existe dans la base de données et correspond au mot de passe
            $stmt = $conn->prepare("SELECT id_recruteur, nom, prenom FROM restaurant_recruteurs WHERE email = :email AND mot_de_passe = :mot_de_passe");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);
            $stmt->execute();
            $recruteur = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($recruteur !== false) {
                // L'email et le mot de passe correspondent à un recruteur dans la base de données
                $_SESSION['restaurant_recruteur_id'] = $recruteur['id_recruteur'];
                $_SESSION['nom_recruteur'] = $recruteur['nom'];
                $_SESSION['prenom_recruteur'] = $recruteur['prenom'];

                // Redirigez vers la page du recruteur
                header("Location: page_recruteur.php");
                exit();
            } else {
                // L'email n'existe pas dans la base de données ou les informations de connexion sont incorrectes
                echo "Email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
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
        <h1>Connexion Recruteur</h1>
        <form method="POST" action="connexion_recruteur.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="mot_de_passe">Mot de passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required><br>
            
            <button type="submit">Se connecter</button>
        </form>
    </div>
    <script src="scripts.js"></script>
</body>
</html>