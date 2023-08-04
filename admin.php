<?php
require_once './back/config.php';
require_once './back/langue.php';

// Récupérer les utilisateurs
$query_users = "SELECT * FROM restaurant_utilisateurs";
$users = $conn->query($query_users)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les recruteurs
$query_recruteurs = "SELECT * FROM restaurant_recruteurs";
$recruteurs = $conn->query($query_recruteurs)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les candidats
$query_candidats = "SELECT * FROM restaurant_candidats";
$candidats = $conn->query($query_candidats)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les annonces
$query_annonces = "SELECT * FROM restaurant_annonces";
$annonces = $conn->query($query_annonces)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les validations d'annonces
$query_validations = "SELECT * FROM restaurant_validation_annonces";
$validations = $conn->query($query_validations)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
    <title>Page d'administration</title>
</head>
<body>
<h1>Page d'administration</h1>
    <div class="container">
        <h1>Utilisateurs</h1>
        <a href="ajouter_admin.php" class="btn btn-primary btn-sm">Ajouter</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Type d'utilisateur</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user['id_utilisateur']; ?></td>
                        <td><?php echo $user['nom']; ?></td>
                        <td><?php echo $user['prenom']; ?></td>
                        <td><?php echo $user['type_utilisateur']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['mot_de_passe']; ?></td>
                        <td>
                            <a href="modifier_admin.php?id_utilisateur=<?php echo $user['id_utilisateur']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_admin.php?id_utilisateur=<?php echo $user['id_utilisateur']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h1>Recruteurs</h1>
        <a href="inscription_recruteur.php" class="btn btn-primary btn-sm">Inscrire recruteur</a>
       
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recruteurs as $recruteur) : ?>
                    <tr>
                        <td><?php echo $recruteur['id_recruteur']; ?></td>
                        <td><?php echo $recruteur['email']; ?></td>
                        <td><?php echo $recruteur['nom_utilisateur']; ?></td>
                        <td><?php echo $recruteur['nom']; ?></td>
                        <td><?php echo $recruteur['prenom']; ?></td>
                        <td><?php echo $recruteur['nom_entreprise']; ?></td>
                        <td><?php echo $recruteur['adresse_entreprise']; ?></td>
                        <td>
                            <a href="modifier_recruteur.php?id_recruteur=<?php echo $recruteur['id_recruteur']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_recruteur.php?id_recruteur=<?php echo $recruteur['id_recruteur']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h1>Candidats</h1>
        <a href="ajouter_candidat.php" class="btn btn-primary btn-sm">Ajouter Candidat</a>
        
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
                    <th>Statut</th>
                    <th>Actions</th>
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
                        <td><?php echo $candidat['statut']; ?></td>
                        <td>
                            <a href="modifier_candidat.php?id=<?php echo $candidat['ID_candidat']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_candidat.php?id=<?php echo $candidat['ID_candidat']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h1>Annonces</h1>
        <a href="ajouter_annonce.php" class="btn btn-primary mb-3">Ajouter Annonce</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID Annonce</th>
                    <th>Annonce</th>
                    <th>Lieu de travail</th>
                    <th>Description</th>
                    <th>Actions</th>
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
                            <a href="modifier_annonce.php?id_annonce=<?php echo $annonce['id_annonce']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_annonce.php?id_annonce=<?php echo $annonce['id_annonce']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h1>Validations d'annonces</h1>
        <a href="ajouter_validation_annonce.php" class="btn btn-primary mb-3">Ajouter Validation d'annonce</a>
       
        <table class="table">
            <thead>
                <tr>
                    <th>ID Validation</th>
                    <th>ID Annonce</th>
                    <th>ID Administrateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($validations as $validation) : ?>
                    <tr>
                        <td><?php echo $validation['id_validation']; ?></td>
                        <td><?php echo $validation['id_annonce']; ?></td>
                        <td><?php echo $validation['id_administrateur']; ?></td>
                        <td>
                            <a href="modifier_validation.php?id=<?php echo $validation['id_validation']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_validation_annonce.php?id=<?php echo $validation['id_validation']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>       
            <a href="index.php" class="btn btn-primary btn-sm">Accueil</a>
            <a href="deconnexion.php" class="btn btn-primary btn-sm">Deconnexion</a>
        </div>

    </div>
    <script src="scripts.js"></script>
    <!-- les fichiers JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>