<?php
require_once "./back/config.php";

try {
    
    // Vérifier si l'identifiant de validation d'annonce est présent dans l'URL
    if (isset($_GET['id'])) {
        $id_validation = $_GET['id'];

        // Requête préparée pour supprimer la validation d'annonce de la table 'restaurant_validation_Annonces'
        $sql = "DELETE FROM restaurant_validation_annonces WHERE id_validation = :id_validation";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_validation', $id_validation, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection vers la page admin.php après la suppression réussie
            header("Location: admin.php");
            exit; 
        } else {
            echo "Erreur lors de la suppression de la validation d'annonce.";
        }
    } else {
        // identifiant de validation d'annonce manquant dans l'URL, afficher un message d'erreur
        die("Identifiant de validation d'annonce manquant dans l'URL.");
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>