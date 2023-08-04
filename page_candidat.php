<?php
session_start();

require_once "./back/config.php";
require_once './back/langue.php';

// Vérifier si le candidat est connecté
if (!isset($_SESSION['restaurant_candidat_id'])) {
    // Si le candidat est pas connecté, rediriger vers la page de connexion
    header('Location: connect_candidat.php');
    exit();
}

// Récupérer les informations du candidat depuis la table restaurant_candidat
$candidat_id = $_SESSION['restaurant_candidat_id'];
$requete_candidat = "SELECT email, mot_de_passe, Nom, Prenom, Experience, Adresse, Disponibilite, CV, Annonce, statut FROM restaurant_candidats WHERE ID_candidat = :candidat_id";
$resultat_candidat = $conn->prepare($requete_candidat);
$resultat_candidat->execute([':candidat_id' => $candidat_id]);
$candidat = $resultat_candidat->fetch(PDO::FETCH_ASSOC);

if (!$candidat) {
    // le candidat est pas trouvé dans la base de données
    $error_message = "Candidat non trouvé.";
    exit();
}

try {
    // Récupérer les annonces depuis la table restaurant_annonces
    $requete_annonces = "SELECT lieu, description, annonce FROM restaurant_annonces";
    $resultat_annonces = $conn->query($requete_annonces);
    $annonces = $resultat_annonces->fetchAll(PDO::FETCH_ASSOC);

    if (!$annonces) {
        // aucune annonce est trouvée dans la base de données
        $error_message = "Aucune annonce trouvée.";
    }
} catch (PDOException $e) {
    $error_message = "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Page Candidat</title>
</head>
<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

h2 {
    color: #007bff;
    margin-top: 20px;
    margin-bottom: 10px;
}

p {
    margin-bottom: 20px;
}

a {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #0056b3;
}


.candidate-info {
    border-bottom: 1px solid #ccc;
    padding: 10px 0;
}

.candidate-info h3 {
    color: #333;
    margin-top: 0;
}

.candidate-info p {
    margin-bottom: 5px;
}


.candidate-cv {
    background-color: #f9f9f9;
    border-radius: 5px;
    padding: 15px;
}


@media (max-width: 576px) {
    .container {
        max-width: 100%;
        margin: 20px;
    }
}

</style>
<body>
    <div class="container">
        <h1 class="my-4">Bienvenue <?php echo isset($candidat['Prenom']) ? $candidat['Prenom'] : ''; ?> <?php echo isset($candidat['Nom']) ? $candidat['Nom'] : ''; ?></h1>

        <h2>Informations du candidat :</h2>
        <ul>
            <li><strong>Email :</strong> <?php echo isset($candidat['email']) ? $candidat['email'] : ''; ?></li>
            <li><strong>Mot de passe :</strong> <?php echo isset($candidat['mot_de_passe']) ? $candidat['mot_de_passe'] : ''; ?></li>
            <li><strong>Expérience :</strong> <?php echo isset($candidat['Experience']) ? $candidat['Experience'] : ''; ?></li>
            <li><strong>Adresse :</strong> <?php echo isset($candidat['Adresse']) ? $candidat['Adresse'] : ''; ?></li>
            <li><strong>Disponibilité :</strong> <?php echo isset($candidat['Disponibilite']) ? $candidat['Disponibilite'] : ''; ?></li>
            <li><strong>CV :</strong> <?php echo isset($candidat['CV']) ? $candidat['CV'] : ''; ?></li>
            <li><strong>Annonce :</strong> <?php echo isset($candidat['Annonce']) ? $candidat['Annonce'] : ''; ?></li>
            <li><strong>Statut :</strong> <?php echo isset($candidat['statut']) ? $candidat['statut'] : ''; ?></li>
        </ul>

        <h2>Annonces :</h2>
        <?php if (!empty($annonces)) { ?>
            <?php foreach ($annonces as $annonce) { ?>
                <h3>Lieu : <?php echo $annonce['lieu']; ?></h3>
                <p>Description : <?php echo $annonce['description']; ?></p>
                <p>Annonce : <?php echo $annonce['annonce']; ?></p>
            <?php } ?>
        <?php } else { ?>
            <p>Aucune annonce disponible pour le moment.</p>
        <?php } ?>

        <a href="modifier_candidat1.php">Modifier mes données</a>
        <br>
        <a href="deconnexion.php">Déconnexion</a>
    </div>
    <script src="scripts.js"></script>
</body>
</html>


