<?php
require_once "./back/config.php";

try {
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_recruteur = $_POST['id_recruteur'];

        // Requête préparée pour supprimer le recruteur
        $sql = "DELETE FROM restaurant_recruteurs WHERE id_recruteur = :id_recruteur";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_recruteur', $id_recruteur, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection vers la page admin.php après la suppression réussie
            header("Location: admin.php");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            echo "Erreur lors de la suppression du recruteur.";
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
    <title>Supprimer un Recruteur</title>
</head>
<body>
    <h1>Supprimer un Recruteur</h1>
    <?php
    if (isset($_GET['id_recruteur'])) {
        $id_recruteur = $_GET['id_recruteur'];

        // Récupérer les données du recruteur à partir de la base de données
        $sql = "SELECT * FROM restaurant_recruteurs WHERE id_recruteur = :id_recruteur";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_recruteur', $id_recruteur, PDO::PARAM_INT);
        $stmt->execute();
        $recruteur = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$recruteur) {
            echo "Recruteur non trouvé.";
        }
    }
    ?>

    <p>Êtes-vous sûr de vouloir supprimer le recruteur <?php echo $recruteur['nom_utilisateur']; ?> ?</p>
    <form action="" method="POST">
        <input type="hidden" name="id_recruteur" value="<?php echo $id_recruteur; ?>">
        <input type="submit" value="Oui, Supprimer">
    </form>
</body>
</html>