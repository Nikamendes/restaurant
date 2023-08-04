<?php 
require_once './back/config.php';
require_once './back/langue.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_annonce = htmlspecialchars($_POST['id_annonce']);
        $annonce = htmlspecialchars($_POST['annonce']);
        $lieu = htmlspecialchars($_POST['lieu']);
        $description = htmlspecialchars($_POST['description']);

        // Requête préparée pour ajouter une nouvelle annonce dans la table 'restaurant_annonces'
        $sql = "INSERT INTO restaurant_annonces (id_annonce, lieu, description) VALUES (:id_annonce, :lieu, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_annonce', $id_annonce, PDO::PARAM_INT);
        $stmt->bindParam(':annonce', $annonce, PDO::PARAM_STR);
        $stmt->bindParam(':lieu', $lieu, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Redirection vers la page admin.php après l'ajout réussi
            header("Location: admin.php");
            exit; 
        } else {
            echo "Erreur lors de l'ajout de l'annonce.";
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
    <title>Ajouter une Annonce</title>
</head>
<body>
    <h1>Ajouter une Annonce</h1>
    <form action="" method="POST">
        <div>
            <label for="id_annonce">ID Annonce:</label>
            <input type="text" id="id_annonce" name="id_annonce" required>
        </div>
        <div>
            <label for="annonce">Annonce:</label>
            <input type="text" id="annonce" name="annonce" required>
        </div>
        <div>
            <label for="lieu">Lieu:</label>
            <input type="text" id="lieu" name="lieu" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <input type="submit" value="Ajouter Annonce">
        </div>

    </form>
    <script src="scripts.js"></script>
</body>
</html>