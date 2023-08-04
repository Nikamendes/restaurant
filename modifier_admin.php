<?php

require_once './back/config.php';
require_once './back/langue.php';

$redirect = false;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_utilisateur = filter_input(INPUT_POST, 'id_utilisateur', FILTER_VALIDATE_INT);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $type_utilisateur = htmlspecialchars($_POST['type_utilisateur']);
        $email = htmlspecialchars($_POST['email']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

        // Requête préparée pour mettre à jour les données de l'utilisateur
        $sql = "UPDATE restaurant_utilisateurs 
                SET nom = :nom, prenom = :prenom, type_utilisateur = :type_utilisateur, email = :email, mot_de_passe = :mot_de_passe
                WHERE id_utilisateur = :id_utilisateur";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':type_utilisateur', $type_utilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Données de l'utilisateur mises à jour avec succès.";
            $redirect = true; 
        } else {
            echo "Erreur lors de la mise à jour des données de l'utilisateur.";
        }
    }

    // Récupérer les données de l'utilisateur à partir de la base de données
    if (isset($_GET['id_utilisateur'])) {
        $id_utilisateur = filter_input(INPUT_GET, 'id_utilisateur', FILTER_VALIDATE_INT); // Filtrer l'ID de l'utilisateur reçu en GET
        echo "ID de l'utilisateur à modifier : " . $id_utilisateur; // Ajoutez cette ligne

        $sql = "SELECT * FROM restaurant_utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "Erreur lors de l'exécution de la requête : ";
            print_r($stmt->errorInfo());//afficher les erreurs
        }

        if (!$utilisateur) {
            echo "Utilisateur non trouvé.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

// Redirection vers admin.php si la mise à jour a réussi
if ($redirect) {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style3.css">
    <title>Modifier un Utilisateur</title>
</head>
<body>
    <h1>Modifier un Utilisateur</h1>
    <?php
    if (isset($utilisateur)) {     
    ?>
    <form action="" method="POST">
        <input type="hidden" name="id_utilisateur" value="<?php echo $id_utilisateur; ?>">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required value="<?php echo $utilisateur['nom']; ?>">
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required value="<?php echo $utilisateur['prenom']; ?>">
        </div>
        <div>
            <label for="type_utilisateur">Type d'utilisateur :</label>
            <input type="text" id="type_utilisateur" name="type_utilisateur" required value="<?php echo $utilisateur['type_utilisateur']; ?>">
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required value="<?php echo $utilisateur['email']; ?>">
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required value="<?php echo $utilisateur['mot_de_passe']; ?>">
        </div>
        
        <div>
            <input type="submit" value="Mettre à jour">
        </div>
    </form>
    <?php
    } else {
        echo "Utilisateur non trouvé.";
    }
    ?>
     <script src="scripts.js"></script>
</body>
</html>