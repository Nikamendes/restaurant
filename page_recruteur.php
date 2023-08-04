<?php

session_start();

require_once './back/config.php';
require_once './back/langue.php';

// Vérifier si le recruteur est connecté
if (!isset($_SESSION['restaurant_recruteur_id'])) {
    // Rediriger le recruteur vers la page de connexion s'il n'est pas connecté
    header('Location: connexion_recruteur.php');
    exit();
}

// les informations du recruteur depuis la table restaurant_recruteurs
$recruteurId = $_SESSION['restaurant_recruteur_id'];
$sqlRecruteur = "SELECT * FROM restaurant_recruteurs WHERE id_recruteur = :id";
$stmtRecruteur = $conn->prepare($sqlRecruteur);
$stmtRecruteur->bindParam(':id', $recruteurId);
$stmtRecruteur->execute();
$recruteur = $stmtRecruteur->fetch(PDO::FETCH_ASSOC);

// Obtenir la liste des candidats depuis la table restaurant_candidats
$sqlCandidats = "SELECT * FROM restaurant_candidats";
$stmtCandidats = $conn->query($sqlCandidats);
$candidats = $stmtCandidats->fetchAll(PDO::FETCH_ASSOC);

// Obtenir la liste des autres recruteurs depuis la table restaurant_recruteurs
$sqlRecruteurs = "SELECT * FROM restaurant_recruteurs WHERE id_recruteur != :id";
$stmtRecruteurs = $conn->prepare($sqlRecruteurs);
$stmtRecruteurs->bindParam(':id', $recruteurId);
$stmtRecruteurs->execute();
$autresRecruteurs = $stmtRecruteurs->fetchAll(PDO::FETCH_ASSOC);

// Obtenir la liste des annonces disponibles depuis la table restaurant_annonces
$sqlAnnonces = "SELECT * FROM restaurant_annonces";
$stmtAnnonces = $conn->query($sqlAnnonces);
$annonces = $stmtAnnonces->fetchAll(PDO::FETCH_ASSOC);

// Obtenir la liste des validations d'annonces depuis la table restaurant_validations_annonces
$sqlValidations = "SELECT * FROM restaurant_validation_annonces";
$stmtValidations = $conn->query($sqlValidations);
$validations = $stmtValidations->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
   <head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Espace Recruteur</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>

    <div class="container">
        <h1 class="mt-3">Bienvenue, <?php echo $recruteur['prenom'] . ' ' . $recruteur['nom']; ?></h1>
        <h1 class="mt-3">Page Recruteur</h1>

        <h2 class="mt-4">Validations d'annonces</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Validation</th>
                    <th>ID Annonce</th>
                    <th>ID Administrateur</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($validations as $validation) : ?>
                    <tr>
                        <td><?php echo $validation['id_validation']; ?></td>
                        <td><?php echo $validation['id_annonce']; ?></td>
                        <td><?php echo $validation['id_administrateur']; ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <h2 class="mt-4">Recruteurs</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID Recruteur</th>
                    <th>Nom Utilisateur</th>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nom de l'entreprise</th>
                    <th>Adresse de l'entreprise</th>
                    
                </tr>
            </thead>
            
            <tbody>
                <?php foreach ($autresRecruteurs as $autreRecruteur) : ?>
                    <tr>
                        <td><?php echo $autreRecruteur['id_recruteur']; ?></td>
                        <td><?php echo $autreRecruteur['nom_utilisateur']; ?></td>
                        <td><?php echo $autreRecruteur['email']; ?></td>
                        <td><?php echo $autreRecruteur['nom']; ?></td>
                        <td><?php echo $autreRecruteur['prenom']; ?></td>
                        <td><?php echo $autreRecruteur['nom_entreprise']; ?></td>
                        <td><?php echo $autreRecruteur['adresse_entreprise']; ?></td>
                        <td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="mt-4">Candidats</h2>
<a href="ajouter_candidat1.php" class="btn btn-primary btn-sm">Ajouter Candidat</a>
<form action="traiter_candidats.php" method="POST"> <!-- Remplacez "traiter_candidats.php" par le nom du fichier PHP qui va traiter les données des candidats -->
    <table class="table">
        <thead>
            <tr>
                <th>ID Candidat</th>
                <th>Email</th>
                <th>Mot de Passe</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Expérience</th>
                <th>Adresse</th>
                <th>Disponibilité</th>
                <th>CV</th>
                <th>Annonce</th>
                <th>Accepté</th> 
                <th>Refusé</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidats as $candidat) : ?>
                <tr>
                    <td><?php echo $candidat['ID_candidat']; ?></td>
                    <td><?php echo $candidat['email']; ?></td>
                    <td><?php echo $candidat['mot_de_passe']; ?></td>
                    <td><?php echo $candidat['Nom']; ?></td>
                    <td><?php echo $candidat['Prenom']; ?></td>
                    <td><?php echo $candidat['Experience']; ?></td>
                    <td><?php echo $candidat['Adresse']; ?></td>
                    <td><?php echo $candidat['Disponibilite']; ?></td>
                    <td><?php echo $candidat['CV']; ?></td>
                    <td><?php echo $candidat['Annonce']; ?></td>
                    <td>
                        
                        <input type="checkbox" name="accepte[<?php echo $candidat['ID_candidat']; ?>]">
                    </td>
                    <td>
                        
                        <input type="checkbox" name="refuse[<?php echo $candidat['ID_candidat']; ?>]">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <input type="submit" value="Enregistrer les candidats acceptés/refusés">
</form>
        
        <h2 class="mt-4">Annonces</h2>
        <a href="ajouter_annonce1.php" class="btn btn-primary mb-3">Ajouter Annonce</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Annonce</th>
                    <th>Annonce</th>
                    <th>Lieu de travail</th>
                    <th>Description</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($annonces as $annonce) : ?>
                    <tr>
                        <td><?php echo $annonce['id_annonce']; ?></td>
                        <td><?php echo $annonce['annonce']; ?></td>
                        <td><?php echo $annonce['lieu']; ?></td>
                        <td><?php echo $annonce['description']; ?></td>
                        <td>
                           
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <br>
        <a href="deconnexion.php" class="btn btn-danger">Déconnexion</a>
    </div>
    <script src="scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>