<?php
require_once './back/config.php';
require_once './back/langue.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_annonce = $_POST['id_annonce'];
        $id_administrateur = $_POST['id_administrateur'];

        // Requête préparée pour ajouter une nouvelle validation d'annonce dans la table 'restaurant_validation_Annonces'
        $sql = "INSERT INTO restaurant_validation_Annonces (id_annonce, id_administrateur) VALUES (:id_annonce, :id_administrateur)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_annonce', $id_annonce, PDO::PARAM_INT);
        $stmt->bindParam(':id_administrateur', $id_administrateur, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection vers la page admin.php après l'ajout réussi
            header("Location: admin.php");
            exit;
        } else {
            echo "Erreur lors de l'ajout de la validation d'annonce.";
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
    <title>Ajouter Validation d'Annonce</title>
</head>
<body>
    <h1>Ajouter Validation d'Annonce</h1>
    <form action="" method="POST">

    <div>
            <label for="id_validation">ID Validation :</label>
            <input type="text" id="id_validation" name="id_validation" required>
        </div>
        <div>
            <label for="id_annonce">ID Annonce :</label>
            <input type="text" id="id_annonce" name="id_annonce" required>
        </div>
        <div>
            <label for="id_administrateur">ID Administrateur :</label>
            <input type="text" id="id_administrateur" name="id_administrateur" required>
        </div>
        <div>
            <input type="submit" value="Ajouter Validation d'Annonce">
        </div>
    </form>
    <script src="scripts.js"></script>
</body>
</html>