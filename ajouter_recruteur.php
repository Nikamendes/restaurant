<?php
require_once './back/config.php';
require_once './back/langue.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom_utilisateur = htmlspecialchars($_POST['nom_utilisateur']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom_entreprise = htmlspecialchars($_POST['nom_entreprise']);
        $adresse_entreprise = htmlspecialchars($_POST['adresse_entreprise']);

        // Requête préparée pour ajouter un nouveau recruteur
        $sql = "INSERT INTO restaurant_recruteur (nom_utilisateur, mot_de_passe, nom, prenom, nom_entreprise, adresse_entreprise) 
                VALUES (:nom_utilisateur, :mot_de_passe, :nom, :prenom, :nom_entreprise, :adresse_entreprise)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom_entreprise', $nom_entreprise, PDO::PARAM_STR);
        $stmt->bindParam(':adresse_entreprise', $adresse_entreprise, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Recruteur ajouté avec succès.";
            // Rediriger vers la page admin.php après l'ajout
            header('Location: admin.php');
            exit(); 
        } else {
            echo "Erreur lors de l'ajout du Recruteur.";
        }
    }
} catch (PDOException $e) {
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
    <title>Ajouter un Recruteur</title>
</head>
<body>
    <h1>Ajouter un Recruteur</h1>
    <form action="" method="POST">
        <div>
            <label for="nom_utilisateur">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="nom_entreprise">Nom de l'entreprise :</label>
            <input type="text" id="nom_entreprise" name="nom_entreprise" required>
        </div>
        <div>
            <label for="adresse_entreprise">Adresse de l'entreprise :</label>
            <input type="text" id="adresse_entreprise" name="adresse_entreprise" required>
        </div>
        <div>
            <input type="submit" value="Ajouter Recruteur">
        </div>
    </form>

    <script>
        //événement pour afficher une alerte lorsque le formulaire est soumis avec succès
        document.querySelector('form').addEventListener('submit', function (event) {
            alert('Le formulaire a été soumis avec succès !');
        });
    </script>
    
    <script src="scripts.js"></script>
</body>
</html>