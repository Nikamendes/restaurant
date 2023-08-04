<?php
require_once './back/config.php';
require_once './back/langue.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $type_utilisateur = htmlspecialchars($_POST['type_utilisateur']);
        $email = htmlspecialchars($_POST['email']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

        // Requête préparée pour ajouter un nouvel utilisateur
        $sql = "INSERT INTO restaurant_utilisateurs (nom, prenom, type_utilisateur, email, mot_de_passe) VALUES (:nom, :prenom, :type_utilisateur, :email, :mot_de_passe)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':type_utilisateur', $type_utilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Utilisateur ajouté avec succès.";
            // Rediriger vers la page admin.php après l'ajout
            header('Location: admin.php');
            exit(); 
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur.";
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
    <title>Ajouter un Utilisateur</title>
</head>
<body>
    <h1>Ajouter un Utilisateur</h1>
    <form action="" method="POST">
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="type_utilisateur">Type d'Utilisateur:</label>
            <select id="type_utilisateur" name="type_utilisateur" required>
                <option value="admin">Admin</option>
                <option value="recruteur">Recruteur</option>
                <option value="candidat">Candidat</option>
            </select>
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
            <input type="submit" value="Ajouter Utilisateur">
        </div>
    </form>

    <script>
        //  événement pour afficher une alerte lorsque le formulaire est soumis 
        document.querySelector('form').addEventListener('submit', function (event) {
            alert('Le formulaire a été soumis avec succès !');
        });
    </script>
    <script src="scripts.js"></script>
</body>
</html>