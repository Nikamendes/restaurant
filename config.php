<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k35gck9e_projets";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Modification de la colonne ID_candidat comme clé primaire et auto-incrémentée
    $sql_alter_candidats = "
    ALTER TABLE restaurant_candidats
    MODIFY COLUMN ID_candidat INT AUTO_INCREMENT PRIMARY KEY";
    
    // $conn->exec($sql_alter_candidats); 

    // Création de la table restaurant_utilisateurs si elle n'existe pas déjà
    $sql_create_utilisateurs = "
    CREATE TABLE IF NOT EXISTS restaurant_utilisateurs (
        id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
        nom VARCHAR(50),
        prenom VARCHAR(50),
        type_utilisateur VARCHAR(20),
        email VARCHAR(100),
        mot_de_passe VARCHAR(100)
    )";

    $conn->exec($sql_create_utilisateurs);

    // Création de la table restaurant_recruteurs si elle n'existe pas déjà
    $sql_create_recruteurs = "
    CREATE TABLE IF NOT EXISTS restaurant_recruteurs (
        id_recruteur INT AUTO_INCREMENT PRIMARY KEY,
        nom_utilisateur VARCHAR(50) NOT NULL,
        email VARCHAR(100),
        mot_de_passe VARCHAR(255) NOT NULL,
        nom VARCHAR(50) NOT NULL,
        prenom VARCHAR(50) NOT NULL,
        nom_entreprise VARCHAR(100) NOT NULL,
        adresse_entreprise VARCHAR(200) NOT NULL
    )";

    $conn->exec($sql_create_recruteurs);

    // Création de la table restaurant_candidats si elle n'existe pas déjà
    $sql_create_candidats = "
    CREATE TABLE IF NOT EXISTS restaurant_candidats (
        ID_candidat INT PRIMARY KEY AUTO_INCREMENT,
        mot_de_passe VARCHAR(100),
        Nom VARCHAR(50),
        Prenom VARCHAR(50),
        Experience TEXT,
        Adresse VARCHAR(100),
        Disponibilite VARCHAR(100),
        CV VARCHAR(100),
        Annonce VARCHAR(100),
        statut VARCHAR(10) DEFAULT 'En attente'
    )";

    $conn->exec($sql_create_candidats);

    // Création de la table restaurant_validation_Annonces si elle n'existe pas déjà
    $sql_create_validation_annonces = "
    CREATE TABLE IF NOT EXISTS restaurant_validation_Annonces (
        id_validation INT PRIMARY KEY AUTO_INCREMENT,
        id_annonce INT,
        id_administrateur INT,
        FOREIGN KEY (id_annonce) REFERENCES restaurant_annonces(id_annonce)
    )";

     // Création de la table restaurant_annonces si elle n'existe pas déjà
     $sql_create_annonces = "
     CREATE TABLE IF NOT EXISTS restaurant_annonces (
         id_annonce INT PRIMARY KEY AUTO_INCREMENT,
         lieu VARCHAR(100),
         description TEXT
     )";

    $conn->exec($sql_create_validation_annonces);

    //echo "Tables créées avec succès";

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>