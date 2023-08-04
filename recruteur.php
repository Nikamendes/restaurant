<?php
session_start();

require_once './back/config.php';
require_once './back/langue.php';

// Vérifier si le recruteur est déjà connecté, en le redirigeant vers la page appropriée
if (isset($_SESSION['restaurant_recruteur_id'])) {
    header('Location: info_recruteur.php');
    exit();
}

// Traiter le formulaire de recruteur lorsqu'il est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nom_entreprise = $_POST['nom_entreprise'];
    $adresse_entreprise = $_POST['adresse_entreprise'];

    // Insertion des données du recruteur dans la base de données
    $sql_insert_recruteur = "INSERT INTO restaurant_recruteurs (nom_utilisateur, mot_de_passe, nom, prenom, nom_entreprise, adresse_entreprise) 
                            VALUES (:nom_utilisateur, :mot_de_passe, :nom, :prenom, :nom_entreprise, :adresse_entreprise)";
    
    $stmt = $conn->prepare($sql_insert_recruteur);
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':nom_entreprise', $nom_entreprise, PDO::PARAM_STR);
    $stmt->bindParam(':adresse_entreprise', $adresse_entreprise, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Enregistrement réussi, rediriger le recruteur vers la page page_recruteur
        header('Location: page_recruteur.php');
        exit();
    } else {
        // Erreur lors de l'enregistrement du recruteur
        $message = "Erreur lors de l'inscription du recruteur. Veuillez réessayer.";
    }
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