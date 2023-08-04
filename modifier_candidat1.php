<?php
    require_once "./back/config.php";
    require_once './back/langue.php';

    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_candidat = $_POST['id_candidat'];
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $experience = htmlspecialchars($_POST['experience']);
            $adresse = htmlspecialchars($_POST['adresse']);
            $disponibilite = htmlspecialchars($_POST['disponibilite']);
            $cv = htmlspecialchars($_POST['cv']);
            $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
            $annonce = htmlspecialchars($_POST['annonce']); // Ajout de l'attribut "annonce"

            // Requête préparée pour mettre à jour les données du candidat
            $sql = "UPDATE restaurant_candidats 
                    SET Nom = :nom, Prenom = :prenom, Experience = :experience, Adresse = :adresse, Disponibilite = :disponibilite, CV = :cv, mot_de_passe = :mot_de_passe, Annonce = :annonce
                    WHERE ID_candidat = :id_candidat";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':experience', $experience, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':disponibilite', $disponibilite, PDO::PARAM_STR);
            $stmt->bindParam(':cv', $cv, PDO::PARAM_STR);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
            $stmt->bindParam(':annonce', $annonce, PDO::PARAM_STR); // Liaison de l'attribut "annonce"
            $stmt->bindParam(':id_candidat', $id_candidat, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "Données du candidat mises à jour avec succès.";
                // Redirige vers la page page_candidat.php après la mise à jour
                header('Location: page_candidat.php');
                exit; 
            } else {
                echo "Erreur lors de la mise à jour des données du candidat.";
            }
        }

         // Récupérer les données du candidat à partir de la base de données
         if (isset($_GET['ID_candidat'])) { 
            $ID_candidat = $_GET['ID_candidat']; 

            $sql = "SELECT * FROM restaurant_candidats WHERE ID_candidat = :ID_candidat";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ID_candidat', $ID_candidat, PDO::PARAM_INT); // Utilisez le nom correct de la variable
            $stmt->execute();
            $candidat = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$candidat) {
                echo "Candidat non trouvé.";
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
    <title>Modifier un Candidat</title>
</head>
<body>
    <?php if (isset($candidat)) : ?>
        <h1>Modifier un Candidat</h1>
        <form action="" method="POST">
            <input type="hidden" name="id_candidat" value="<?php echo $id_candidat; ?>">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required value="<?php echo $candidat['Nom']; ?>">
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required value="<?php echo $candidat['Prenom']; ?>">
            </div>
            <div>
                <label for="experience">Expérience :</label>
                <select id="experience" name="experience" required>
                    <option value="">Sélectionner une option</option>
                    <option value="Pas d'expérience" <?php if ($candidat['Experience'] === "Pas d'expérience") echo 'selected'; ?>>Pas d'expérience</option>
                    <option value="1 an" <?php if ($candidat['Experience'] === "1 an") echo 'selected'; ?>>1 an</option>
                    <option value="2 ans" <?php if ($candidat['Experience'] === "2 ans") echo 'selected'; ?>>2 ans</option>
                    <option value="Plus de 2 ans" <?php if ($candidat['Experience'] === "Plus de 2 ans") echo 'selected'; ?>>Plus de 2 ans</option>
                </select>
            </div>
            <div>
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required value="<?php echo $candidat['Adresse']; ?>">
            </div>
            <div>
                <label for="disponibilite">Disponibilité :</label>
                <select id="disponibilite" name="disponibilite" required>
                    <option value="">Sélectionner une option</option>
                    <option value="Matin (10h-13h)" <?php if ($candidat['Disponibilite'] === "Matin (10h-13h)") echo 'selected'; ?>>Matin (10h-13h)</option>
                    <option value="Après-midi (14h-18h)" <?php if ($candidat['Disponibilite'] === "Après-midi (14h-18h)") echo 'selected'; ?>>Après-midi (14h-18h)</option>
                    <option value="Soir (19h-22h)" <?php if ($candidat['Disponibilite'] === "Soir (19h-22h)") echo 'selected'; ?>>Soir (19h-22h)</option>
                </select>
            </div>
            <div>
                <label for="cv">CV :</label>
                <input type="file" id="cv" name="cv" required accept=".pdf,.doc,.docx">
            </div>
            <div>
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required value="<?php echo $candidat['mot_de_passe']; ?>">
            </div>          
            <div>
                <label for="annonce">Annonce :</label>
                <input type="text" id="annonce" name="annonce" required value="<?php echo $candidat['Annonce']; ?>">
            </div>
            <div>
                <input type="submit" value="Mettre à jour">
            </div>
        </form>
    <?php else : ?>
        <p>Candidat non trouvé.</p>
    <?php endif; ?>
    <script src="scripts.js"></script>
</body>
</html>