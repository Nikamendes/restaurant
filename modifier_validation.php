<?php
// Vérifier si l'ID de la validation d'annonce à modifier est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_validation = $_GET['id'];
    
    require_once './back/config.php';
    require_once './back/langue.php';

    // Vérifier si la validation d'annonce avec ID existe dans la base de données
    $query = "SELECT * FROM restaurant_validation_annonces WHERE id_validation = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id_validation);
    $stmt->execute();
    $validation = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si la validation d'annonce n'existe pas, rediriger vers une page d'erreur ou de gestion des validations d'annonces
    if (!$validation) {
        header('Location: gestion_validations_annonces.php');
        exit();
    }

    // Si le formulaire de modification a été soumis, mettre à jour la validation d'annonce
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_annonce = $_POST['id_annonce'];
        $id_administrateur = $_POST['id_administrateur'];

        $query_update = "UPDATE restaurant_validation_annonces SET id_annonce = :id_annonce, id_administrateur = :id_administrateur WHERE id_validation = :id";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bindParam(':id_annonce', $id_annonce);
        $stmt_update->bindParam(':id_administrateur', $id_administrateur);
        $stmt_update->bindParam(':id', $id_validation);
        
        if ($stmt_update->execute()) {
            // Validation d'annonce mise à jour avec succès, rediriger vers la page de admin.php
            header('Location: admin.php');
            exit();
        } else {
            // Erreur lors de la mise à jour de la validation d'annonce
            echo "Une erreur s'est produite lors de la mise à jour de la validation d'annonce.";
        }
    }
} else {
    // Rediriger vers la page si l'ID n'est pas spécifié
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style3.css">
    <title>Modifier Validation Annonce</title>
</head>
<body>
    <h1>Modifier Validation Annonce</h1>
    <form method="POST">
        <label for="id_annonce">ID Annonce:</label>
        <input type="text" id="id_annonce" name="id_annonce" value="<?php echo $validation['id_annonce']; ?>" required><br>

        <label for="id_administrateur">ID Administrateur:</label>
        <input type="text" id="id_administrateur" name="id_administrateur" value="<?php echo $validation['id_administrateur']; ?>" required><br>

        <input type="submit" value="Enregistrer les modifications" />
    </form>
    <a href="gestion_validations_annonces.php">Annuler</a>
    <script src="scripts.js"></script>
</body>
</html>