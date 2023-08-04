<?php
require_once './back/config.php';
require_once './back/langue.php';

try {
    // Récupérer la liste des annonces disponibles
    $sql = "SELECT annonce, lieu, description FROM restaurant_annonces";
    $result = $conn->query($sql);
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
    <link rel="stylesheet" href="style1.css">
    <title>Liste d'Emplois</title>
</head>
<body>
    <div class="container">
        <h1>Liste d'Emplois</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Annonce</th>
                    <th>Lieu</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["annonce"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["lieu"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucune annonce disponible.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary btn-sm">Accueil</a>
    </div>
    <script src="scripts.js"></script>
</body>
</html>