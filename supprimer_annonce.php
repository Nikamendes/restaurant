<?php
require_once "./back/config.php";

try {
    if (isset($_GET['id_annonce'])) {
        $id_annonce = $_GET['id_annonce'];

        // Requête préparée pour supprimer l'annonce en fonction de l'ID de l'annonce
        $sql = "DELETE FROM restaurant_annonces WHERE id_annonce = :id_annonce";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_annonce', $id_annonce, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection vers la page admin.php après la suppression réussie
            header("Location: admin.php");
            exit; 
        } else {
            echo "Erreur lors de la suppression de l'annonce.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>