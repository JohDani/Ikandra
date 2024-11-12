-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour ikandra
CREATE DATABASE IF NOT EXISTS `ikandra` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ikandra`;

-- Listage de la structure de table ikandra. abonnement
CREATE TABLE IF NOT EXISTS `abonnement` (
  `id_abonnement` int NOT NULL AUTO_INCREMENT,
  `id_prix_abonnement` int NOT NULL DEFAULT '2',
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_abonnement`),
  KEY `FK_abonnement_utilisateur` (`id_utilisateur`),
  KEY `FK_abonnement_prix_abonnement` (`id_prix_abonnement`),
  CONSTRAINT `FK_abonnement_prix_abonnement` FOREIGN KEY (`id_prix_abonnement`) REFERENCES `prix_abonnement` (`id_prix_abonnement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_abonnement_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.abonnement : ~0 rows (environ)

-- Listage de la structure de table ikandra. candidat_entreprise
CREATE TABLE IF NOT EXISTS `candidat_entreprise` (
  `id_candidat_entreprise` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `date_candidature` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_profil` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  `id_offres` int DEFAULT NULL,
  PRIMARY KEY (`id_candidat_entreprise`) USING BTREE,
  KEY `FK_candidat_utilisateur` (`id_profil`),
  KEY `FK_candidat_entreprise` (`id_entreprise`),
  KEY `FK_candidat_offres` (`id_offres`),
  CONSTRAINT `FK_candidat_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidat_offres` FOREIGN KEY (`id_offres`) REFERENCES `offres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidat_utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.candidat_entreprise : ~1 rows (environ)
INSERT INTO `candidat_entreprise` (`id_candidat_entreprise`, `status`, `date_candidature`, `id_profil`, `id_entreprise`, `id_offres`) VALUES
	(69, 0, '2024-06-04 08:04:01', 28, 14, 33);

-- Listage de la structure de table ikandra. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.categories : ~8 rows (environ)
INSERT INTO `categories` (`id`, `nom`) VALUES
	(1, 'Developpeur'),
	(2, 'Designer'),
	(3, 'Reparateur'),
	(4, 'chauffeur'),
	(5, 'communication'),
	(6, 'Mecanicien'),
	(7, 'Commercial sur terrain'),
	(8, 'Test');

-- Listage de la structure de table ikandra. competences
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` int DEFAULT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_profil` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_profil` (`id_profil`),
  CONSTRAINT `FK_profil` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.competences : ~2 rows (environ)
INSERT INTO `competences` (`id`, `ref`, `titre`, `id_profil`) VALUES
	(61, 30, 'Illustrator', 28),
	(62, 100, 'Photoshop', 28);

-- Listage de la structure de table ikandra. conge
CREATE TABLE IF NOT EXISTS `conge` (
  `id_conge` int NOT NULL AUTO_INCREMENT,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `raison` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_demande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_personnel` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  PRIMARY KEY (`id_conge`),
  KEY `FK_conge_entreprise` (`id_entreprise`),
  KEY `FK_conge_personnels` (`id_personnel`),
  CONSTRAINT `FK_conge_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_conge_personnels` FOREIGN KEY (`id_personnel`) REFERENCES `personnels` (`id_personnel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.conge : ~0 rows (environ)

-- Listage de la structure de table ikandra. contrat
CREATE TABLE IF NOT EXISTS `contrat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.contrat : ~7 rows (environ)
INSERT INTO `contrat` (`id`, `nom`) VALUES
	(15, 'CDD'),
	(16, 'Freelance'),
	(17, 'Projet'),
	(18, 'Stagaire'),
	(19, 'CDI'),
	(21, 'JHJHJH'),
	(22, 'm,m,');

-- Listage de la structure de table ikandra. departement
CREATE TABLE IF NOT EXISTS `departement` (
  `id_departement` int NOT NULL AUTO_INCREMENT,
  `nom_departement` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  PRIMARY KEY (`id_departement`),
  KEY `id_entreprise` (`id_entreprise`),
  CONSTRAINT `FK_departement_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.departement : ~1 rows (environ)
INSERT INTO `departement` (`id_departement`, `nom_departement`, `id_entreprise`) VALUES
	(23, 'communidcation', 14);

-- Listage de la structure de table ikandra. diplomes
CREATE TABLE IF NOT EXISTS `diplomes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `titre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '',
  `id_profil` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_diplomes_utilisateur` (`id_profil`),
  CONSTRAINT `FK_diplomes_utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.diplomes : ~1 rows (environ)
INSERT INTO `diplomes` (`id`, `ref`, `titre`, `id_profil`) VALUES
	(14, '2024', 'DTS IG', 28);

-- Listage de la structure de table ikandra. entreprise
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `nom_entreprise` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse_entreprise` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Ville` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `pays` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_entreprise`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `FK_entreprise_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.entreprise : ~2 rows (environ)
INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `adresse_entreprise`, `Ville`, `id_utilisateur`, `pays`) VALUES
	(14, 'IKANDRA', 'Lot IIV ', NULL, 25, 'Antananarivo'),
	(15, 'IKANDRA2', 'Lot II V', NULL, 26, 'Anosy');

-- Listage de la structure de table ikandra. entretien
CREATE TABLE IF NOT EXISTS `entretien` (
  `id_entretien` int NOT NULL AUTO_INCREMENT,
  `date_entretien` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `lieu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_notif` datetime DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statue` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '0',
  `id_profil` int DEFAULT NULL,
  `id_offre` int DEFAULT NULL,
  PRIMARY KEY (`id_entretien`),
  KEY `FK_entretien_offres` (`id_offre`),
  KEY `FK_entretien_utilisateur` (`id_profil`),
  CONSTRAINT `FK_entretien_offres` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_entretien_utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.entretien : ~0 rows (environ)

-- Listage de la structure de table ikandra. essai
CREATE TABLE IF NOT EXISTS `essai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `duree` int NOT NULL DEFAULT '0',
  `unit` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.essai : ~1 rows (environ)
INSERT INTO `essai` (`id`, `duree`, `unit`) VALUES
	(1, 2, 1);

-- Listage de la structure de table ikandra. experiences
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_profil` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK__utilisateur` (`id_profil`),
  CONSTRAINT `FK__utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.experiences : ~1 rows (environ)
INSERT INTO `experiences` (`id`, `ref`, `titre`, `id_profil`) VALUES
	(4, '2023', 'Web designer', 28);

-- Listage de la structure de table ikandra. langues
CREATE TABLE IF NOT EXISTS `langues` (
  `id_langue` int NOT NULL AUTO_INCREMENT,
  `langue` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_langue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.langues : ~0 rows (environ)

-- Listage de la structure de table ikandra. notification
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL,
  `message` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statue` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_entreprise` int NOT NULL,
  `id_candidat` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.notification : ~0 rows (environ)

-- Listage de la structure de table ikandra. offres
CREATE TABLE IF NOT EXISTS `offres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `poste` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `images` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `categorie` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `date_publication` datetime DEFAULT CURRENT_TIMESTAMP,
  `villes` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statue` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_entreprise` (`id_entreprise`),
  CONSTRAINT `FK_offres_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.offres : ~2 rows (environ)
INSERT INTO `offres` (`id`, `poste`, `images`, `description`, `categorie`, `date_publication`, `villes`, `id_entreprise`, `email`, `telephone`, `contrat`, `statue`) VALUES
	(32, '', '7a327b38af079d6de6105a493b506cbb', '<p><br></p><h2><strong class="ql-size-large" style="color: rgb(255, 255, 102);"><em><a href="Vous êtes fort dans le domaine de graphique Designer? " rel="noopener noreferrer" target="_blank">Vous êtes fort dans le domaine de graphique Designer?</a></em></strong><strong class="ql-size-large" style="color: rgb(0, 71, 178);"><em><a href="Vous êtes fort dans le domaine de graphique Designer? " rel="noopener noreferrer" target="_blank"> </a></em></strong></h2><p>L\'entreprise A recherche un web designer et/ou graphique designer.</p><h2><span class="ql-size-large">Profil recherché:</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Agée de 20 ans au minimum</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Ayant 1 an d\'experience au moins dans ce domaine</li></ol><h2><span class="ql-size-large">Dossiers à fournir:</span></h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Lettre de motivation</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>votre CV</li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Photocopie de CIN</li></ol><p><br></p>', 'Designer', '2024-05-31 21:00:18', 'Antananarivo', 14, NULL, NULL, 'CDD', '0'),
	(33, '', 'image', '<p>ee</p>', 'Commercial sur terrain', '2024-05-31 21:09:25', 'Antananarivo', 14, NULL, NULL, 'CDD', '0');

-- Listage de la structure de table ikandra. payement_abonnement
CREATE TABLE IF NOT EXISTS `payement_abonnement` (
  `id_payement_abonnement` int NOT NULL AUTO_INCREMENT,
  `reference_transaction` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `date_payement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `debut_contrat` datetime DEFAULT NULL,
  `fin_contrat` datetime DEFAULT NULL,
  `prix` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_payement_abonnement`),
  KEY `FK_payement_abonnement_utilisateur` (`id_utilisateur`),
  CONSTRAINT `FK_payement_abonnement_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.payement_abonnement : ~6 rows (environ)
INSERT INTO `payement_abonnement` (`id_payement_abonnement`, `reference_transaction`, `date_payement`, `debut_contrat`, `fin_contrat`, `prix`, `status`, `id_utilisateur`) VALUES
	(2, 'REF 4512', '2024-05-27 21:42:45', '2024-05-27 00:00:00', '2024-06-06 00:00:00', 6000, 2, 26),
	(3, 'REF 4562', '2024-05-27 21:49:01', '2024-05-27 00:00:00', '2024-06-06 00:00:00', 6000, 2, 26),
	(4, 'REF 111 Airtel Money', '2024-05-27 21:54:40', '2024-05-27 00:00:00', '2024-06-06 11:25:00', 6000, 2, 25),
	(5, 'REF 121212', '2024-05-27 22:15:54', '2024-05-27 19:15:54', '2024-06-06 10:15:54', 15000, 2, 25),
	(6, 'AIRTEL MONEY', '2024-06-03 20:22:02', NULL, NULL, 15000, 2, 25),
	(9, 'AIRTEL MONEY TR HJ', '2024-06-03 22:52:45', '2024-06-03 19:53:03', '2024-07-03 19:53:03', 15000, 1, 25);

-- Listage de la structure de table ikandra. payement_salaire
CREATE TABLE IF NOT EXISTS `payement_salaire` (
  `id_payement` int NOT NULL AUTO_INCREMENT,
  `date_payement` date DEFAULT NULL,
  `mois` int NOT NULL DEFAULT '1',
  `anee` year DEFAULT NULL,
  `id_personnel` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  PRIMARY KEY (`id_payement`),
  KEY `FK__personnels` (`id_personnel`),
  KEY `FK__entreprise` (`id_entreprise`),
  CONSTRAINT `FK__entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__personnels` FOREIGN KEY (`id_personnel`) REFERENCES `personnels` (`id_personnel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.payement_salaire : ~0 rows (environ)

-- Listage de la structure de table ikandra. pays
CREATE TABLE IF NOT EXISTS `pays` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.pays : ~0 rows (environ)

-- Listage de la structure de table ikandra. personnels
CREATE TABLE IF NOT EXISTS `personnels` (
  `id_personnel` int NOT NULL AUTO_INCREMENT,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom_personnel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '<p class="text-danger">vide</p>',
  `telephone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contrat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `salaire` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_departement` int DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remarque` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_poste` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  PRIMARY KEY (`id_personnel`),
  KEY `FK_personnels_entreprise` (`id_entreprise`),
  KEY `id_poste` (`id_poste`),
  CONSTRAINT `FK_personnels_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_personnels_poste` FOREIGN KEY (`id_poste`) REFERENCES `poste` (`id_poste`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.personnels : ~3 rows (environ)
INSERT INTO `personnels` (`id_personnel`, `image`, `nom_personnel`, `telephone`, `email`, `contrat`, `salaire`, `id_departement`, `date_debut`, `adresse`, `remarque`, `id_poste`, `id_entreprise`, `status`) VALUES
	(16, 'image', 'Tiana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
	(17, 'image', 'Tiana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
	(18, 'image', '<p class="text-danger">vide</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '0');

-- Listage de la structure de table ikandra. poste
CREATE TABLE IF NOT EXISTS `poste` (
  `id_poste` int NOT NULL AUTO_INCREMENT,
  `nom_poste` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `min` text COLLATE utf8mb4_general_ci,
  `max` text COLLATE utf8mb4_general_ci,
  `id_departement` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  PRIMARY KEY (`id_poste`),
  KEY `id_departement` (`id_departement`),
  KEY `id_entreprise` (`id_entreprise`),
  CONSTRAINT `FK_poste_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_poste_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.poste : ~0 rows (environ)

-- Listage de la structure de table ikandra. prix_abonnement
CREATE TABLE IF NOT EXISTS `prix_abonnement` (
  `id_prix_abonnement` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `prix` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_prix_abonnement`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.prix_abonnement : ~2 rows (environ)
INSERT INTO `prix_abonnement` (`id_prix_abonnement`, `titre`, `prix`) VALUES
	(1, 'Abonnement à contrat type 1', '6000'),
	(2, 'Abonnement à contrat type 2', '15000');

-- Listage de la structure de table ikandra. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `images` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'images',
  `nom_utilisateur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mdp` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_contrat` int DEFAULT NULL,
  `types` int DEFAULT '2',
  `theme` int DEFAULT '0',
  `profil` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nationalite` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '0',
  `id_diplomes` int DEFAULT NULL,
  `id_langues` int DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_contrat` (`id_contrat`),
  KEY `FK_utilisateur_diplomes` (`id_diplomes`),
  KEY `FK_utilisateur_langues` (`id_langues`),
  CONSTRAINT `FK_utilisateur_diplomes` FOREIGN KEY (`id_diplomes`) REFERENCES `diplomes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_utilisateur_langues` FOREIGN KEY (`id_langues`) REFERENCES `langues` (`id_langue`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.utilisateur : ~3 rows (environ)
INSERT INTO `utilisateur` (`id_utilisateur`, `images`, `nom_utilisateur`, `prenom`, `adresse`, `email`, `telephone`, `mdp`, `date_creation`, `id_contrat`, `types`, `theme`, `profil`, `about`, `nationalite`, `status`, `id_diplomes`, `id_langues`) VALUES
	(25, 'images', 'Norosoa Mamitiana                  ', ' ', '', 'daniieltiana@gmail.com', '0336156833', 'e10adc3949ba59abbe56e057f20f883e', '2024-05-27 21:54:40', 2, 2, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(26, 'image', 'Nambinina', 'Tiana', NULL, 'tiana@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-05-27 22:15:54', 1, 2, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(28, 'e4c145571c7757fbfe98b38be890205b', 'Daniel tiana', '', '', 'daniieltiana@io.com', '0336156833', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-02 23:18:02', 0, 3, 0, 'Designer', 'Je suis un designer professionnel ', NULL, '0', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
