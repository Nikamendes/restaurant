<?php
// Vérifier si l'ID du candidat à supprimer est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_candidat = $_GET['id'];
    
    require_once './back/config.php';

    // Vérifier si le candidat avec cet ID existe dans la base de données
    $query = "SELECT * FROM restaurant_candidats WHERE ID_candidat = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id_candidat);
    $stmt->execute();
    $candidat = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si le formulaire de confirmation a été soumis, supprimer le candidat
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $query_delete = "DELETE FROM restaurant_candidats WHERE ID_candidat = :id";
        $stmt_delete = $conn->prepare($query_delete);
        $stmt_delete->bindParam(':id', $id_candidat);
        
        if ($stmt_delete->execute()) {
            // Candidat supprimé avec succès, rediriger vers la page de gestion des candidats
            header('Location: admin.php');
            exit();
        } else {
            // Erreur lors de la suppression du candidat
            echo "Une erreur s'est produite lors de la suppression du candidat.";
        }
    }
} else {
    // Rediriger vers la page de gestion des candidats si l'ID n'est pas spécifié
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
    <title>Supprimer Candidat</title>
</head>
<body>
    <h1>Supprimer Candidat</h1>
    <p>Voulez-vous vraiment supprimer le candidat <?php echo $candidat['Nom'] . ' ' . $candidat['Prenom']; ?> ?</p>
    <form method="POST">
        <input type="submit" value="Confirmer la suppression" />
    </form>
    <a href="admin.php">Annuler</a>
</body>
</html>