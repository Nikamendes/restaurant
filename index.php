<?php
session_start();

require_once './back/config.php';
require_once './back/langue.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Restaurant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    font-size: 36px;
    margin-bottom: 20px;
    text-align: center;
}

p {
    line-height: 1.6;
    margin-bottom: 20px;
}

.btn {
    display: block;
    width: 100%;
    max-width: 200px; /* Réduire la largeur maximale à 200px */
    margin: 10px auto;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
}

.btn:hover {
    background-color: #0056b3;
}
</style>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <h1>Bienvenue sur notre site de recrutement</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <p>TRT Conseil est une agence de recrutement spécialisée dans l’hôtellerie et la restauration. Fondée en 2014, la société s’est agrandie au fil des ans et possède dorénavant plus de 12 centres dispersés aux quatre coins de la France.</p>
            </div>
            <div class="col-md-6">
                <a href="connexion.php" class="btn btn-primary btn-sm d-block mb-2">Administrateur</a>
                <a href="connexion_recruteur.php" class="btn btn-primary btn-sm d-block mb-2">Recruteur</a>
                <a href="inscription_candidat.php" class="btn btn-primary btn-sm d-block mb-2">Inscription Candidat</a>
                <a href="connect_candidat.php" class="btn btn-primary btn-sm d-block mb-2">Connexion Candidat</a>
                <a href="liste_annonces.php" class="btn btn-primary btn-sm d-block">Les Offres</a>
            </div>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>