<?php
require_once "./back/config.php";

try {
    $redirect = false; // Variable de redirection

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id_utilisateur']) && is_numeric($_POST['id_utilisateur'])) {
            // Valider l'ID de l'utilisateur en utilisant is_numeric()
            $id_utilisateur = intval($_POST['id_utilisateur']);

            // Requête préparée pour supprimer l'utilisateur
            $sql = "DELETE FROM restaurant_utilisateurs WHERE id_utilisateur = :id_utilisateur";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Utilisateur supprimé avec succès.";
                $redirect = true;
            } else {
                echo "Erreur lors de la suppression de l'utilisateur.";
            }
        } else {
            echo "ID de l'utilisateur non valide.";
        }
    }

    if (isset($_GET['id_utilisateur']) && is_numeric($_GET['id_utilisateur'])) {
        $id_utilisateur = intval($_GET['id_utilisateur']);

        // Récupérer les données de l'utilisateur à partir de la base de données
        $sql = "SELECT * FROM restaurant_utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$utilisateur) {
            echo "Utilisateur non trouvé.";
        }
    } else {
        echo "ID de l'utilisateur non valide.";
    }

    // Redirection vers admin.php si la suppression a réussi
    if ($redirect) {
        header("Location: admin.php");
        exit;
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
    <title>Supprimer un Utilisateur</title>
</head>
<body>
    <h1>Supprimer un Utilisateur</h1>
    <?php
    if (isset($utilisateur)) {
        echo "<p>Êtes-vous sûr de vouloir supprimer l'utilisateur {$utilisateur['id_utilisateur']} ?</p>";
        echo "<form action='' method='POST'>";
        echo "<input type='hidden' name='id_utilisateur' value='{$utilisateur['id_utilisateur']}'>";
        echo "<button type='submit' class='btn btn-danger btn-sm'>Supprimer</button>";
        echo "</form>";
    }
    ?>
</body>
</html>