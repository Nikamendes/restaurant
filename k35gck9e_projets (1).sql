-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 juil. 2023 à 16:56
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `k35gck9e_projets`
--

-- --------------------------------------------------------

--
-- Structure de la table `restaurant_annonces`
--

CREATE TABLE `restaurant_annonces` (
  `id_annonce` int(11) NOT NULL,
  `annonce` varchar(50) NOT NULL,
  `lieu` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurant_annonces`
--

INSERT INTO `restaurant_annonces` (`id_annonce`, `annonce`, `lieu`, `description`) VALUES
(1, 'Sur Site', 'Distances', 'Gérer les réserves sur la plateforme'),
(2, 'Bar', 'Local', 'Aider dans le bar');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant_candidats`
--

CREATE TABLE `restaurant_candidats` (
  `ID_candidat` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Experience` text DEFAULT NULL,
  `Adresse` varchar(100) DEFAULT NULL,
  `Disponibilite` varchar(100) DEFAULT NULL,
  `CV` varchar(100) DEFAULT NULL,
  `Annonce` varchar(100) DEFAULT NULL,
  `statut` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurant_candidats`
--

INSERT INTO `restaurant_candidats` (`ID_candidat`, `email`, `mot_de_passe`, `Nom`, `Prenom`, `Experience`, `Adresse`, `Disponibilite`, `CV`, `Annonce`, `statut`) VALUES
(6, 'kelly@exemple.com', '56789', 'Rodriguez', 'Kelly', '1 an', '5 rue Amerique 1001', 'Après-midi (14h-18h)', '285-modele-cv-vide (1).docx', 'Sur Site', 'Accepté'),
(7, 'patricia@exemple.test', '2468', 'Silva', 'Patricia', 'Plus de 2 ans', '5 rue Amerique 1001', 'Matin (10h-13h)', '285-modele-cv-vide (1).docx', 'Sur Site', ''),
(11, 'oliver@exemple.com', '3456', 'Claude', 'Oliveira', 'Pas d\'expérience', '5 rue Amerique 1001', 'Matin (10h-13h)', '285-modele-cv-vide (1).docx', 'bar', '');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant_recruteurs`
--

CREATE TABLE `restaurant_recruteurs` (
  `id_recruteur` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom_entreprise` varchar(100) NOT NULL,
  `adresse_entreprise` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurant_recruteurs`
--

INSERT INTO `restaurant_recruteurs` (`id_recruteur`, `nom_utilisateur`, `email`, `mot_de_passe`, `nom`, `prenom`, `nom_entreprise`, `adresse_entreprise`) VALUES
(1, 'jose', 'jose@exemple.com', '1234', 'Dupont', 'Jose', 'RST', '@rst.entreprise'),
(9, 'Patricia Silva', 'silva@test.test', '2345', 'Silva', 'Patricia', 'DTR', '5 rue Amerique 1001');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant_utilisateurs`
--

CREATE TABLE `restaurant_utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `type_utilisateur` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurant_utilisateurs`
--

INSERT INTO `restaurant_utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `type_utilisateur`, `email`, `mot_de_passe`) VALUES
(1, 'Dubois', 'jonhs', 'administrateur', 'jonh@exemple.com', '1234'),
(4, 'Silva', 'Patricia', 'admin', 'patricia@exemple.test', '98754'),
(5, 'Does', 'John', 'admin', 'does@exemple.com', '345789');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant_validation_annonces`
--

CREATE TABLE `restaurant_validation_annonces` (
  `id_validation` int(11) NOT NULL,
  `id_annonce` int(11) DEFAULT NULL,
  `id_administrateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurant_validation_annonces`
--

INSERT INTO `restaurant_validation_annonces` (`id_validation`, `id_annonce`, `id_administrateur`) VALUES
(2, 1, 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `restaurant_annonces`
--
ALTER TABLE `restaurant_annonces`
  ADD PRIMARY KEY (`id_annonce`);

--
-- Index pour la table `restaurant_candidats`
--
ALTER TABLE `restaurant_candidats`
  ADD PRIMARY KEY (`ID_candidat`);

--
-- Index pour la table `restaurant_recruteurs`
--
ALTER TABLE `restaurant_recruteurs`
  ADD PRIMARY KEY (`id_recruteur`);

--
-- Index pour la table `restaurant_utilisateurs`
--
ALTER TABLE `restaurant_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `restaurant_validation_annonces`
--
ALTER TABLE `restaurant_validation_annonces`
  ADD PRIMARY KEY (`id_validation`),
  ADD KEY `id_annonce` (`id_annonce`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `restaurant_annonces`
--
ALTER TABLE `restaurant_annonces`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `restaurant_candidats`
--
ALTER TABLE `restaurant_candidats`
  MODIFY `ID_candidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `restaurant_recruteurs`
--
ALTER TABLE `restaurant_recruteurs`
  MODIFY `id_recruteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `restaurant_utilisateurs`
--
ALTER TABLE `restaurant_utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `restaurant_validation_annonces`
--
ALTER TABLE `restaurant_validation_annonces`
  MODIFY `id_validation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `restaurant_validation_annonces`
--
ALTER TABLE `restaurant_validation_annonces`
  ADD CONSTRAINT `restaurant_validation_annonces_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `restaurant_annonces` (`id_annonce`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
