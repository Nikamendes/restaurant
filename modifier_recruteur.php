<?php
require_once "./back/config.php";
require_once './back/langue.php';

try {
    // Récupérer les données du recruteur à partir de la base de données
    if (isset($_GET['id_recruteur'])) {
        $id_recruteur = $_GET['id_recruteur'];

        $sql = "SELECT * FROM restaurant_recruteurs WHERE id_recruteur = :id_recruteur";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_recruteur', $id_recruteur, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $recruteur = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$recruteur) {
                echo "Recruteur non trouvé.";
            }
        } else {
            echo "Erreur lors de l'exécution de la requête : ";
            print_r($stmt->errorInfo());
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_recruteur = $_POST['id_recruteur'];
        $nom_utilisateur = htmlspecialchars($_POST['nom_utilisateur']);
        $email = htmlspecialchars($_POST['email']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom_entreprise = htmlspecialchars($_POST['nom_entreprise']);
        $adresse_entreprise = htmlspecialchars($_POST['adresse_entreprise']);

        // Requête préparée pour mettre à jour les données du recruteur
        $sql = "UPDATE restaurant_recruteurs 
                SET nom_utilisateur = :nom_utilisateur,email = :email, mot_de_passe = :mot_de_passe,
                nom = :nom, prenom = :prenom, nom_entreprise = :nom_entreprise, adresse_entreprise = :adresse_entreprise
                WHERE id_recruteur = :id_recruteur";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom_entreprise', $nom_entreprise, PDO::PARAM_STR);
        $stmt->bindParam(':adresse_entreprise', $adresse_entreprise, PDO::PARAM_STR);
        $stmt->bindParam(':id_recruteur', $id_recruteur, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Données du recruteur mises à jour avec succès.";
            // Redirection vers la page admin.php après la mise à jour
            header("Location: admin.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour des données du recruteur.";
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
    <link rel="stylesheet" href="style3.css">
    <title>Modifier un Recruteur</title>
</head>
<body>
    <h1>Modifier un Recruteur</h1>
    <?php
    if (isset($recruteur)) {
    ?>
    <form action="" method="POST">
        <input type="hidden" name="id_recruteur" value="<?php echo $id_recruteur; ?>">
        <div>
            <label for="nom_utilisateur">Nom d'utilisateur :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required value="<?php echo $recruteur['nom_utilisateur']; ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?php echo $recruteur['email']; ?>">
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required value="<?php echo $recruteur['mot_de_passe']; ?>">
        </div>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required value="<?php echo $recruteur['nom']; ?>">
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required value="<?php echo $recruteur['prenom']; ?>">
        </div>
        <div>
            <label for="nom_entreprise">Nom de l'entreprise :</label>
            <input type="text" id="nom_entreprise" name="nom_entreprise" required value="<?php echo $recruteur['nom_entreprise']; ?>">
        </div>
        <div>
            <label for="adresse_entreprise">Adresse de l'entreprise :</label>
            <input type="text" id="adresse_entreprise" name="adresse_entreprise" required value="<?php echo $recruteur['adresse_entreprise']; ?>">
        </div>
        <div>
            <input type="submit" value="Mettre à jour">
        </div>
    </form>
    <?php
    } else {
        echo "Recruteur non trouvé.";
    }
    ?>
     <script src="scripts.js"></script>
</body>
</html>