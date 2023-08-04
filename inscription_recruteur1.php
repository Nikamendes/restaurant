<?php
session_start();

// Assurez-vous que le fichier './back/langue.php' existe et n'a pas d'erreurs.
require_once './back/config.php';
require_once './back/langue.php';

try {
    // Traitement du formulaire d'inscription du recruteur lorsqu'il est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom_utilisateur = $_POST['nom_utilisateur'];
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $nom_entreprise = $_POST['nom_entreprise'];
        $adresse_entreprise = $_POST['adresse_entreprise'];

        // Insérer les données du recruteur dans la base de données
        $sql = "INSERT INTO restaurant_recruteurs (nom_utilisateur, email, mot_de_passe, nom, prenom, nom_entreprise, adresse_entreprise) 
                VALUES (:nom_utilisateur, :email, :mot_de_passe, :nom, :prenom, :nom_entreprise, :adresse_entreprise)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom_entreprise', $nom_entreprise, PDO::PARAM_STR);
        $stmt->bindParam(':adresse_entreprise', $adresse_entreprise, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Inscription réussie, rediriger le recruteur vers la page de connexion
            header('Location: page_recruteur.php');
            exit();
        } else {
            // Erreur lors de l'inscription du recruteur
            $message = "Erreur lors de l'inscription du recruteur. Veuillez réessayer.";
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion à la base de données, vous pouvez afficher un message d'erreur ou faire autre chose.
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style3.css">
    <title>Inscription Recruteur</title>
</head>
<body>
    <h1>Inscription Recruteur</h1>
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <form action="" method="POST">
        <div>
            <label for="nom_utilisateur">Nom d'utilisateur:</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="nom_entreprise">Nom de l'entreprise:</label>
            <input type="text" id="nom_entreprise" name="nom_entreprise" required>
        </div>
        <div>
            <label for="adresse_entreprise">Adresse de l'entreprise:</label>
            <input type="text" id="adresse_entreprise" name="adresse_entreprise" required>
        </div>
        <div>
            <input type="submit" value="S'inscrire en tant que Recruteur">
        </div>
    </form>
    <script src="scripts.js"></script>
</body>
</html>