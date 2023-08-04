<?php
session_start();

require_once './back/config.php';
require_once './back/langue.php';

// Vérifier si l'utilisateur est déjà connecté, auquel cas rediriger vers la page appropriée
if (isset($_SESSION['user_id'])) {
    header('Location: page_candidat.php'); 
    exit();
}

// formulaire de enregistrement quand il est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $experience = $_POST['experience'];
    $adresse = $_POST['adresse'];
    $disponibilite = $_POST['disponibilite'];
    $cv = $_POST['cv'];

    //Insérer les données du candidat dans la base de données
    $sql_insert_candidat = "INSERT INTO restaurant_candidats (Nom, Prenom, mot_de_passe, Experience, Adresse, Disponibilite, CV) 
    VALUES (:nom, :prenom, :mot_de_passe, :experience, :adresse, :disponibilite, :cv)";
    $stmt = $conn->prepare($sql_insert_candidat);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
    $stmt->bindParam(':experience', $experience, PDO::PARAM_STR);
    $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $stmt->bindParam(':disponibilite', $disponibilite, PDO::PARAM_STR);
    $stmt->bindParam(':cv', $cv, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        // Enregistrement réussi, rediriger l'utilisateur vers la page de connexion
        header('Location: index.php');
        exit();
    } else {
        // Erreur lors de l'enregistrement du candidat
        $message = "Erreur lors de l'enregistrement du candidat. Veuillez réessayer.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style3.css">
    <title>Inscription Candidat</title>
</head>
<body>
    <h1>Inscription Candidat</h1>
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <form action="" method="POST">
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe:</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        </div>
        <div>
            <label for="experience">Expérience:</label>
            <select id="experience" name="experience" required>
                <option value="">Sélectionner une option</option>
                <option value="Pas d'expérience">Pas d'expérience</option>
                <option value="1 an">1 an</option>
                <option value="2 ans">2 ans</option>
                <option value="Plus de 2 ans">Plus de 2 ans</option>
            </select>
        </div>
        <div>
            <label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" required>
        </div>
        <div>
            <label for="disponibilite">Disponibilité:</label>
            <select id="disponibilite" name="disponibilite" required>
                <option value="">Sélectionner une option</option>
                <option value="Matin (10h-13h)">Matin (10h-13h)</option>
                <option value="Après-midi (14h-18h)">Après-midi (14h-18h)</option>
                <option value="Soir (19h-22h)">Soir (19h-22h)</option>
            </select>
        </div>
        <div>
            <label for="cv">CV:</label>
            <input type="file" id="cv" name="cv" required accept=".pdf,.doc,.docx">
        </div>
        <div>
            <input type="submit" value="S'inscrire">
        </div>
    </form>
    <script src="scripts.js"></script>
</body>
</html>