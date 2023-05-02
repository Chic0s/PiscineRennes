-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 avr. 2023 à 12:44
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chicosydu2`
--

-- --------------------------------------------------------

--
-- Structure de la table `Adminpage`
--

DROP TABLE IF EXISTS `Adminpage`;
CREATE TABLE IF NOT EXISTS `Adminpage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identifiants` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Adminpage`
--

INSERT INTO `Adminpage` (`id`, `identifiants`, `mdp`) VALUES
(1, 'local', 'local'),
(2, 'draeto', 'draeto'),
(4, 'nouqui', 'nouqui'),
(5, 'ghostman', 'ghostman');

-- --------------------------------------------------------

--
-- Structure de la table `Bassin`
--

DROP TABLE IF EXISTS `Bassin`;
CREATE TABLE IF NOT EXISTS `Bassin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_piscine` int NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Piscine` (`id_piscine`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Bassin`
--

INSERT INTO `Bassin` (`id`, `id_piscine`, `description`) VALUES
(1, 1, 'Nordique'),
(2, 1, 'Couvert'),
(3, 1, 'Bassin'),
(4, 4, 'Sportif'),
(5, 4, 'Espace ludique'),
(6, 2, 'Principal'),
(7, 3, 'Grand Bassin'),
(8, 3, 'Petit Bassin');

-- --------------------------------------------------------

--
-- Structure de la table `Code`
--

DROP TABLE IF EXISTS `Code`;
CREATE TABLE IF NOT EXISTS `Code` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_vente` int DEFAULT NULL,
  `id_reservation` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_vente` (`id_vente`) USING BTREE,
  KEY `id_reservation` (`id_reservation`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Code`
--

INSERT INTO `code` (`id`, `code`, `id_vente`, `id_reservation`) VALUES
(2, '111111111', 1, 1),
(3, '222222222', NULL, NULL),
(4, '333333333', 2, 13),
(5, '444444444', 3, 14),
(6, '555555555', 4, 37),
(9, '2dUmeU9MQ', 6, NULL),
(10, 'M3KfY5yZ1', 6, NULL),
(11, 'McjiNRJRo', 7, NULL),
(12, 'JGkWBuTtJ', 8, NULL),
(13, '7dkh9mNdZ', 8, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Créneaux`
--

DROP TABLE IF EXISTS `Créneaux`;
CREATE TABLE IF NOT EXISTS `Créneaux` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_bassin` int NOT NULL,
  `date_debut_cours` datetime NOT NULL,
  `date_fin_cours` datetime NOT NULL,
  `nb_places` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Bassin` (`id_bassin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Créneaux`
--

INSERT INTO `Créneaux` (`id`, `id_bassin`, `date_debut_cours`, `date_fin_cours`, `nb_places`) VALUES
(1, 6, '2023-02-27 16:00:00', '2023-02-27 17:00:00', 10),
(2, 6, '2023-02-28 15:00:00', '2023-02-28 16:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Etat_piscine`
--

DROP TABLE IF EXISTS `Etat_piscine`;
CREATE TABLE IF NOT EXISTS `Etat_piscine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Etat_piscine`
--

INSERT INTO `Etat_piscine` (`id`, `label`) VALUES
(1, 'Normal'),
(2, 'Dégradé'),
(3, 'Fermeture ponctuelle'),
(4, 'Fermeture définitive');

-- --------------------------------------------------------

--
-- Structure de la table `Formule`
--

DROP TABLE IF EXISTS `Formule`;
CREATE TABLE IF NOT EXISTS `Formule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `type` enum('Entrée simple','Entrée simple avec dispositif Sortir','Forfait horaire','Forfait horaire avec dispositif Sortir') CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `prix` float NOT NULL,
  `periode_validite` int NOT NULL DEFAULT '31536000',
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Formule`
--

INSERT INTO `Formule` (`id`, `nom`, `type`, `prix`, `periode_validite`, `description`) VALUES
(1, 'Entrée simple - 18 ans', 'Entrée simple', 2.25, 31536000, ''),
(2, 'Entrée simple - 3 ans', 'Entrée simple', 0, 31536000, ''),
(3, 'Entrée simple adulte', 'Entrée simple', 5.25, 31536000, ''),
(4, 'Entrée simple adulte avec Sortir', 'Entrée simple avec dispositif Sortir', 0.8, 31536000, ''),
(5, 'Entrée simple enfant avec Sortir', 'Entrée simple avec dispositif Sortir', 0.5, 31536000, ''),
(6, 'Forfait adulte 5h', 'Forfait horaire', 14.2, 31536000, ''),
(7, 'Forfait adulte 10h', 'Forfait horaire', 23.6, 31536000, ''),
(8, 'Forfait enfant 5h', 'Forfait horaire', 6.05, 31536000, ''),
(9, 'Forfait enfant 10h', 'Forfait horaire', 9.35, 31536000, ''),
(10, 'Forfait adulte avec Sortir', 'Forfait horaire avec dispositif Sortir', 4, 31536000, ''),
(11, 'Forfait enfant avec Sortir', 'Forfait horaire avec dispositif Sortir', 2.75, 31536000, '');

-- --------------------------------------------------------

--
-- Structure de la table `Piscine`
--

DROP TABLE IF EXISTS `Piscine`;
CREATE TABLE IF NOT EXISTS `Piscine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `id_etat_piscine` int NOT NULL,
  `src_image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Etat_Piscine` (`id_etat_piscine`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Piscine`
--

INSERT INTO `Piscine` (`id`, `nom`, `adresse`, `id_etat_piscine`, `src_image`) VALUES
(1, 'Bréquigny', '12 boulevard Albert 1er ', 1, 'img/choix_Brequigny.jpg'),
(2, 'Saint-Georges', '2 rue Gambetta', 2, 'img/choix_Saint-Georges.jpg'),
(3, 'Villejean', '1 square d\'Alsace ', 3, 'img/choix_Villejean.jpg'),
(4, 'Gayeulles', '15 avenue des Gayeulles', 4, 'img/choix_Gayeulles.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

DROP TABLE IF EXISTS `Reservation`;
CREATE TABLE IF NOT EXISTS `Reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_creneau` int NOT NULL,
  `heure_res` datetime NOT NULL,
  `code` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_Creneau` (`id_creneau`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Reservation`
--

INSERT INTO `Reservation` (`id`, `id_creneau`, `heure_res`, `code`) VALUES
(1, 1, '2023-02-24 09:13:42', 111111111),
(2, 1, '2023-02-24 12:29:29', 222222222),
(13, 1, '2023-03-03 13:35:57', 333333333),
(14, 1, '2023-03-03 22:06:35', 444444444),
(35, 1, '2023-04-20 13:59:28', 555555555),
(36, 1, '2023-04-20 14:02:11', 555555555),
(37, 1, '2023-04-20 14:02:51', 555555555);

-- --------------------------------------------------------

--
-- Structure de la table `Ventes`
--

DROP TABLE IF EXISTS `Ventes`;
CREATE TABLE IF NOT EXISTS `Ventes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_commande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_peremption` date NOT NULL,
  `nb_commandes` int NOT NULL,
  `id_formule` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Ref_offre` (`id_formule`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Ventes`
--

INSERT INTO `Ventes` (`id`, `date_commande`, `date_peremption`, `nb_commandes`, `id_formule`) VALUES
(1, '2023-02-24 09:55:04', '2023-06-30', 1, 3),
(2, '2023-02-24 09:55:04', '2023-03-31', 1, 3),
(3, '2023-02-24 11:50:12', '2023-03-31', 1, 3),
(4, '2023-03-03 11:47:34', '2023-06-30', 1, 3),
(5, '2023-04-21 08:18:34', '2024-04-20', 1, 11),
(6, '2023-04-21 08:25:57', '2024-04-20', 1, 11),
(7, '2023-04-21 08:40:42', '2024-04-20', 1, 6),
(8, '2023-04-21 08:40:42', '2024-04-20', 1, 7);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Bassin`
--
ALTER TABLE `Bassin`
  ADD CONSTRAINT `Bassin_ibfk_1` FOREIGN KEY (`id_piscine`) REFERENCES `Piscine` (`id`);

--
-- Contraintes pour la table `Code`
--
ALTER TABLE `Code`
  ADD CONSTRAINT `Code_ibfk_1` FOREIGN KEY (`id_vente`) REFERENCES `Ventes` (`id`),
  ADD CONSTRAINT `Code_ibfk_2` FOREIGN KEY (`id_reservation`) REFERENCES `Reservation` (`id`);

--
-- Contraintes pour la table `Créneaux`
--
ALTER TABLE `Créneaux`
  ADD CONSTRAINT `Créneaux_ibfk_1` FOREIGN KEY (`id_bassin`) REFERENCES `Bassin` (`id`);

--
-- Contraintes pour la table `Piscine`
--
ALTER TABLE `Piscine`
  ADD CONSTRAINT `piscine_ibfk_1` FOREIGN KEY (`id_etat_piscine`) REFERENCES `Etat_piscine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `Reservation_ibfk_1` FOREIGN KEY (`id_creneau`) REFERENCES `Créneaux` (`id`);

--
-- Contraintes pour la table `Ventes`
--
ALTER TABLE `Ventes`
  ADD CONSTRAINT `Ventes_ibfk_1` FOREIGN KEY (`id_formule`) REFERENCES `Formule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
