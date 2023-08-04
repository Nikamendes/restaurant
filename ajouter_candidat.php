
<?php
require_once './back/config.php';
require_once './back/langue.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $experience = htmlspecialchars($_POST['experience']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $disponibilite = htmlspecialchars($_POST['disponibilite']);
        $cv = htmlspecialchars($_POST['cv']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
        $annonce = htmlspecialchars($_POST['annonce']); // Ajout de la variable annonce

        // Requête préparée pour ajouter un nouveau candidat
        $sql = "INSERT INTO restaurant_candidats (email,Nom, Prenom, Experience, Adresse, Disponibilite, CV, mot_de_passe, Annonce) 
                VALUES (:nom, :prenom, :experience, :adresse, :disponibilite, :cv, :mot_de_passe, :annonce)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':experience', $experience, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':disponibilite', $disponibilite, PDO::PARAM_STR);
        $stmt->bindParam(':cv', $cv, PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
        $stmt->bindParam(':annonce', $annonce, PDO::PARAM_STR); // Ajout de la variable annonce

        if ($stmt->execute()) {
            // Redirige vers la page admin.php après l'ajout
            header('Location: admin.php');
            exit; 
        } else {
            echo "Erreur lors de l'ajout du candidat.";
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
    <title>Ajouter un Candidat</title>
</head>
<body>
    <h1>Ajouter un Candidat</h1>
    <form action="" method="POST">
        <div>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>
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
            <input type="submit" value="Ajouter Candidat">
        </div>
    </form>

    <script>
        // événement pour afficher une alerte lorsque le formulaire est soumis
        document.querySelector('form').addEventListener('submit', function (event) {
            alert('Le formulaire a été soumis avec succès !');
        });
    </script>
    <script src="scripts.js"></script>
</body>
</html>