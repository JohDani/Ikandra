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
DROP DATABASE IF EXISTS `ikandra`;
CREATE DATABASE IF NOT EXISTS `ikandra` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ikandra`;

-- Listage de la structure de table ikandra. abonnement
DROP TABLE IF EXISTS `abonnement`;
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
DROP TABLE IF EXISTS `candidat_entreprise`;
CREATE TABLE IF NOT EXISTS `candidat_entreprise` (
  `id_candidat_entreprise` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `date_candidature` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_profil` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  `id_offres` int DEFAULT '0',
  PRIMARY KEY (`id_candidat_entreprise`) USING BTREE,
  KEY `FK_candidat_utilisateur` (`id_profil`),
  KEY `FK_candidat_entreprise` (`id_entreprise`),
  KEY `FK_candidat_entreprise_offres` (`id_offres`),
  CONSTRAINT `FK_candidat_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidat_entreprise_offres` FOREIGN KEY (`id_offres`) REFERENCES `offres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidat_utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.candidat_entreprise : ~5 rows (environ)
INSERT INTO `candidat_entreprise` (`id_candidat_entreprise`, `status`, `date_candidature`, `id_profil`, `id_entreprise`, `id_offres`) VALUES
	(150, 0, '2024-06-06 06:00:57', 57, 25, 69),
	(151, 0, '2024-06-06 06:01:27', 58, 25, 69),
	(152, 0, '2024-06-06 06:01:30', 58, 26, 67),
	(153, 0, '2024-06-06 06:01:33', 58, 25, 66),
	(154, 0, '2024-06-06 06:01:38', 58, 25, 65),
	(155, 1, '2024-06-06 06:12:55', 57, 26, 70);

-- Listage de la structure de table ikandra. candidat_entreprises
DROP TABLE IF EXISTS `candidat_entreprises`;
CREATE TABLE IF NOT EXISTS `candidat_entreprises` (
  `id_candidat_entreprise` int NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `id_offres` int DEFAULT NULL,
  `id_profil` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  `date_candidature` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_candidat_entreprise`),
  KEY `FK_candidat_entreprises_offres` (`id_offres`),
  KEY `FK_candidat_entreprises_utilisateur` (`id_profil`),
  KEY `FK_candidat_entreprises_entreprise` (`id_entreprise`),
  CONSTRAINT `FK_candidat_entreprises_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidat_entreprises_offres` FOREIGN KEY (`id_offres`) REFERENCES `offres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidat_entreprises_utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.candidat_entreprises : ~0 rows (environ)

-- Listage de la structure de table ikandra. categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.categories : ~4 rows (environ)
INSERT INTO `categories` (`id`, `nom`) VALUES
	(1, 'Developpeur'),
	(2, 'Designer'),
	(3, 'Reparateur'),
	(4, 'chauffeur'),
	(5, 'communication'),
	(6, 'Mecanicien'),
	(7, 'Commercial sur terrain'),
	(8, 'Test'),
	(9, 'Assistance');

-- Listage de la structure de table ikandra. competences
DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` int DEFAULT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_profil` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_profil` (`id_profil`),
  CONSTRAINT `FK_profil` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.competences : ~17 rows (environ)
INSERT INTO `competences` (`id`, `ref`, `titre`, `id_profil`) VALUES
	(70, 21, 'PHP', 50),
	(71, 10, 'HTML', 50),
	(72, 5, 'HTML', 51),
	(73, 10, 'TEST', 51),
	(74, 15, 'TEST2', 51),
	(75, 50, 'TEST 3', 51),
	(76, 5, 'HTML CSS', 53),
	(77, 10, 'Java', 53),
	(78, 50, 'PHP', 53),
	(79, 20, 'TEST1', 57),
	(80, 50, 'TEST2', 57),
	(81, 70, 'PHOTOSHOP', 58),
	(82, 65, 'Illustrator', 58),
	(83, 5, '55', 60),
	(84, 55, '55', 60),
	(85, 5, 'gg', 62),
	(86, 75, 'tt', 62),
	(87, 5, 'HTML', 57);

-- Listage de la structure de table ikandra. conge
DROP TABLE IF EXISTS `conge`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.conge : ~1 rows (environ)
INSERT INTO `conge` (`id_conge`, `date_debut`, `date_fin`, `raison`, `date_demande`, `id_personnel`, `id_entreprise`) VALUES
	(12, '2024-05-09', '2024-05-17', 'Malade', '2024-06-06 04:40:07', 35, 27);

-- Listage de la structure de table ikandra. contrat
DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.contrat : ~7 rows (environ)
INSERT INTO `contrat` (`id`, `nom`) VALUES
	(15, 'CDD'),
	(16, 'Freelance'),
	(17, 'Projet'),
	(18, 'Stagaire'),
	(19, 'CDI'),
	(21, 'JHJHJH'),
	(22, 'm,m,'),
	(23, 'bbb');

-- Listage de la structure de table ikandra. departement
DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id_departement` int NOT NULL AUTO_INCREMENT,
  `nom_departement` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  PRIMARY KEY (`id_departement`),
  KEY `id_entreprise` (`id_entreprise`),
  CONSTRAINT `FK_departement_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.departement : ~6 rows (environ)
INSERT INTO `departement` (`id_departement`, `nom_departement`, `id_entreprise`) VALUES
	(32, 'Departement 1', 25),
	(33, 'Departement 2', 25),
	(34, 'Departement 3', 25),
	(35, 'Departement 1', 27),
	(36, 'Departement 2', 27),
	(37, 'Departement 1', 29),
	(38, 'Departement 3', 29);

-- Listage de la structure de table ikandra. diplomes
DROP TABLE IF EXISTS `diplomes`;
CREATE TABLE IF NOT EXISTS `diplomes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `titre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '',
  `id_profil` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_diplomes_utilisateur` (`id_profil`),
  CONSTRAINT `FK_diplomes_utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.diplomes : ~15 rows (environ)
INSERT INTO `diplomes` (`id`, `ref`, `titre`, `id_profil`) VALUES
	(25, '2024', 'DTS', 50),
	(26, '2015', 'BEPC', 51),
	(27, '2011', 'CEPE', 51),
	(28, '2023', 'BEPC', 53),
	(29, '2024', 'BACC', 53),
	(30, '2012', 'BEPC', 57),
	(31, '2015', 'BAC', 57),
	(32, '2012', 'GD', 58),
	(33, '2013', 'test2', 58),
	(34, '2000', 'r', 59),
	(35, '2015', 't', 60),
	(36, '2012', 'i', 60),
	(37, '2023', 't', 61),
	(38, '2024', 't', 61),
	(39, '2017', 't', 62),
	(40, '2024', 'DTS', 57);

-- Listage de la structure de table ikandra. entreprise
DROP TABLE IF EXISTS `entreprise`;
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.entreprise : ~3 rows (environ)
INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `adresse_entreprise`, `Ville`, `id_utilisateur`, `pays`) VALUES
	(25, 'Demo', 'Demo', NULL, 52, 'Demo'),
	(26, 'Recrutement', 'LOT II V 65', NULL, 54, 'Antananarivo'),
	(27, 'GRH', 'LOT II V 65', NULL, 55, 'Antananarivo'),
	(28, 'Recrutement', 'LOT II V 65', NULL, 56, 'Antananarivo'),
	(29, 'Demo', 'Demo', NULL, 63, 'Demo');

-- Listage de la structure de table ikandra. entretien
DROP TABLE IF EXISTS `entretien`;
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.entretien : ~2 rows (environ)
INSERT INTO `entretien` (`id_entretien`, `date_entretien`, `heure`, `lieu`, `date_notif`, `email`, `telephone`, `statue`, `id_profil`, `id_offre`) VALUES
	(19, '2024-06-21', '19:48:00', 'Lieu', '2024-06-06 05:48:36', 'demonstration1@gmail.com', '03111235652', '0', 62, 66),
	(20, '2024-06-18', '20:13:00', 'Tsimbazaza LOt II V56', '2024-06-06 06:14:04', 'recrutement@gmail.com', '03111235652', '1', 57, 70);

-- Listage de la structure de table ikandra. essai
DROP TABLE IF EXISTS `essai`;
CREATE TABLE IF NOT EXISTS `essai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `duree` int NOT NULL DEFAULT '0',
  `unit` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.essai : ~0 rows (environ)
INSERT INTO `essai` (`id`, `duree`, `unit`) VALUES
	(1, 2, 1);

-- Listage de la structure de table ikandra. experiences
DROP TABLE IF EXISTS `experiences`;
CREATE TABLE IF NOT EXISTS `experiences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_profil` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK__utilisateur` (`id_profil`),
  CONSTRAINT `FK__utilisateur` FOREIGN KEY (`id_profil`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.experiences : ~11 rows (environ)
INSERT INTO `experiences` (`id`, `ref`, `titre`, `id_profil`) VALUES
	(8, '2021', 'Exp', 50),
	(9, '2012', 'EXP', 50),
	(10, '2024', 'Exp', 51),
	(11, '2022', 'EXP2', 51),
	(12, '2012', 'Developpeur JS', 53),
	(13, '2011', 'Developpeur PHP', 53),
	(14, '2006', 'TEST', 57),
	(15, '2007', 'TEST2', 57),
	(16, '2015', 'TEST', 58),
	(17, '2016', 'TEST3', 58),
	(18, '2016', '2015', 60),
	(19, '1974', 'exp', 62);

-- Listage de la structure de table ikandra. langues
DROP TABLE IF EXISTS `langues`;
CREATE TABLE IF NOT EXISTS `langues` (
  `id_langue` int NOT NULL AUTO_INCREMENT,
  `langue` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_langue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.langues : ~0 rows (environ)

-- Listage de la structure de table ikandra. notification
DROP TABLE IF EXISTS `notification`;
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
DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `poste` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `images` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'images',
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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.offres : ~9 rows (environ)
INSERT INTO `offres` (`id`, `poste`, `images`, `description`, `categorie`, `date_publication`, `villes`, `id_entreprise`, `email`, `telephone`, `contrat`, `statue`) VALUES
	(59, '', 'IMG19:18:085bcccd900881c042ae3cace77b04b23d', '<p>lkl</p>', 'Designer', '2024-06-05 22:18:08', 'Demo', 25, NULL, NULL, 'CDD', '0'),
	(60, '', '31c11844b92d357d823381b120455cb2', '<p>kjk</p>', 'Developpeur', '2024-06-05 22:18:56', 'Demo', 25, NULL, NULL, 'Freelance', '0'),
	(62, '', 'a8a3edc775fec7a854dba1023a7766f1', '<p>A la recherche d\'un reparateur GSM pro.</p><p>Notre Mission est de satisfaire les clients, </p><h2>PROFIL:</h2><p>Maitrise de l\'electronique</p><p>Connaissance de structuration des smartphones</p>', 'Reparateur', '2024-06-05 22:20:19', 'Demo', 25, NULL, NULL, 'Freelance', '0'),
	(63, '', 'e5d67599bbb698e0cb7ec7a0713419e2', '<p>LL</p>', 'Developpeur', '2024-06-05 22:22:39', 'Demo', 25, NULL, NULL, 'CDD', '0'),
	(64, '', '31c11844b92d357d823381b120455cb2', '<p>CDD</p>', 'Test', '2024-06-05 22:25:19', 'Demo', 25, NULL, NULL, 'CDD', '0'),
	(65, '', '031955b481535b9f97059e152f7d2b9d', '<p>Notre entreprise recherche des MArketaires, des revendeurs ou commerciales sur terrain.</p><p>Les produits sont des meublesde haute qualité.</p><h2>Dossiers à fournir:</h2><p>LM</p><p>4 photo</p><h2>PROFIL</h2><p>âGÉ DE 18 à 23 ans</p><p>Personne Honnette</p><p>...</p><p>...</p>', 'Commercial sur terrain', '2024-06-05 22:25:39', 'Demo', 25, NULL, NULL, 'CDD', '0'),
	(66, '', '48d1cfe864020e9e07977fba1f93a4df', '<h1>Vous êtes DEVELOPPEURS?</h1><h1>ceci est alors pour vous</h1><p>Le studio A est à la recherche des jeunes developpeurs disposés a faire des projets à MADAGSCAR.</p><h3>PROFIL recherché</h3><p>AYANT AU OINS 21 ans</p><p>Maitrise des langages speciali\'se en BacK END</p>', 'Designer', '2024-06-05 22:26:05', 'Demo', 25, NULL, NULL, 'CDD', '0'),
	(67, '', '31c11844b92d357d823381b120455cb2', '<p>Vous aimeriez vous l\'innovation?</p><p>Meme dans la maison, vous avez une opportunité de gagner d\'argent.</p><h2>C\'est quoi le secret?</h2><p>Le poste proposé est assistance client en ligne, vous avez une pportunité de<strong> 5000euro</strong> par mois</p><h2>PROFIL RECHERCHË</h2><p>Age majeur</p><p>Maitrise des materiels informatique et technologie</p><p>Connaissance en assistant client</p>', 'Test', '2024-06-06 04:17:25', 'Antananarivo', 26, NULL, NULL, 'Freelance', '0'),
	(69, '', '31c11844b92d357d823381b120455cb2', '<p>RECRUTement</p>', 'Designer', '2024-06-06 05:49:49', 'Demo', 25, NULL, NULL, 'CDD', '0'),
	(70, '', '48d1cfe864020e9e07977fba1f93a4df', '<p>FULLJS </p>', 'Developpeur', '2024-06-06 06:11:56', 'Antananarivo', 26, NULL, NULL, 'CDD', '0');

-- Listage de la structure de table ikandra. payement_abonnement
DROP TABLE IF EXISTS `payement_abonnement`;
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.payement_abonnement : ~7 rows (environ)
INSERT INTO `payement_abonnement` (`id_payement_abonnement`, `reference_transaction`, `date_payement`, `debut_contrat`, `fin_contrat`, `prix`, `status`, `id_utilisateur`) VALUES
	(24, 'essai contrat', '2024-06-05 21:55:53', '2024-06-05 18:55:53', '2024-06-12 18:55:53', 0, 2, 52),
	(25, 'essai contrat', '2024-06-06 04:10:21', '2024-06-06 01:10:21', '2024-06-13 01:10:21', 0, 2, 54),
	(26, 'essai contrat', '2024-06-06 04:35:48', '2024-06-06 01:35:48', '2024-06-13 01:35:48', 0, 2, 55),
	(27, 'essai contrat', '2024-06-06 04:40:55', '2024-06-06 01:40:55', '2024-06-13 01:40:55', 0, 2, 56),
	(28, 'REF 1612', '2024-06-06 05:42:31', '2024-06-06 02:42:54', '2024-07-06 02:42:54', 15000, 2, 52),
	(29, 'essai contrat', '2024-06-06 06:06:13', '2024-06-06 03:06:13', '2024-06-13 03:06:13', 0, 2, 63),
	(30, 'AIRTEL MONEY', '2024-06-06 06:16:46', '2024-06-06 03:17:10', '2024-07-06 03:17:10', 6000, 1, 54);

-- Listage de la structure de table ikandra. payement_salaire
DROP TABLE IF EXISTS `payement_salaire`;
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.payement_salaire : ~2 rows (environ)
INSERT INTO `payement_salaire` (`id_payement`, `date_payement`, `mois`, `anee`, `id_personnel`, `id_entreprise`) VALUES
	(43, '2024-05-07', 1, '2024', 35, 27),
	(44, '2024-05-09', 6, '2024', 35, 27);

-- Listage de la structure de table ikandra. pays
DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.pays : ~0 rows (environ)

-- Listage de la structure de table ikandra. personnels
DROP TABLE IF EXISTS `personnels`;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.personnels : ~2 rows (environ)
INSERT INTO `personnels` (`id_personnel`, `image`, `nom_personnel`, `telephone`, `email`, `contrat`, `salaire`, `id_departement`, `date_debut`, `adresse`, `remarque`, `id_poste`, `id_entreprise`, `status`) VALUES
	(35, 'e7d740dcfb4bb2457cd83d451a0db418', 'Personnel', '03111235652', 'demonstration1@gmail.com', 'CDD', '1250000', 35, '2024-04-22', 'LOT II V 61', '', 30, 27, '0'),
	(36, 'd211ef850df9cee9d09c234904c16782', 'Personnel', '03111235652', 'demonstration1@gmail.com', 'CDD', '1250000', 37, '2024-06-17', 'LOT II V 61', '', 32, 29, '0');

-- Listage de la structure de table ikandra. poste
DROP TABLE IF EXISTS `poste`;
CREATE TABLE IF NOT EXISTS `poste` (
  `id_poste` int NOT NULL AUTO_INCREMENT,
  `nom_poste` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `min` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `max` text COLLATE utf8mb4_general_ci,
  `id_departement` int DEFAULT NULL,
  `id_entreprise` int DEFAULT NULL,
  PRIMARY KEY (`id_poste`),
  KEY `id_departement` (`id_departement`),
  KEY `id_entreprise` (`id_entreprise`),
  CONSTRAINT `FK_poste_departement` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_poste_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.poste : ~4 rows (environ)
INSERT INTO `poste` (`id_poste`, `nom_poste`, `min`, `max`, `id_departement`, `id_entreprise`) VALUES
	(30, 'POSTE 1', NULL, NULL, 35, 27),
	(31, 'POSTE 2', NULL, NULL, 35, 27),
	(32, 'POSTE 1', '', '8', 37, 29),
	(33, 'POSTE 2', '', '12', 37, 29);

-- Listage de la structure de table ikandra. prix_abonnement
DROP TABLE IF EXISTS `prix_abonnement`;
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
DROP TABLE IF EXISTS `utilisateur`;
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table ikandra.utilisateur : ~15 rows (environ)
INSERT INTO `utilisateur` (`id_utilisateur`, `images`, `nom_utilisateur`, `prenom`, `adresse`, `email`, `telephone`, `mdp`, `date_creation`, `id_contrat`, `types`, `theme`, `profil`, `about`, `nationalite`, `status`, `id_diplomes`, `id_langues`) VALUES
	(48, 'images', 'gg', '', NULL, 'admin@gmail.com', NULL, 'c33367701511b4f6020ec61ded352059', '2024-06-05 21:42:31', 0, 1, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(49, 'images', 'test', '', NULL, 'Test@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-06-05 21:46:01', 0, 3, 0, NULL, NULL, NULL, '1', NULL, NULL),
	(50, 'images', 'maivana.com', '', '', 'maivana@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-05 21:50:36', 0, 3, 0, 'jjh', 'RTT', NULL, '1', NULL, NULL),
	(51, 'images', 'TEST candidat', '', 'ADRESS', 'candidat@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-05 21:52:40', 0, 3, 0, 'TEST FONCTION', 'Je suis', NULL, '1', NULL, NULL),
	(52, 'images', 'Test', 'Demonstration', NULL, 'demonstration1@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-06-05 21:55:53', 2, 2, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(53, 'images', 'Mamy Niaina', '', 'LOT II V 61', 'mamii@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 04:05:30', 0, 3, 0, 'Developpeur PHP', 'LOREM IPSUM DOLOR', NULL, '0', NULL, NULL),
	(54, 'images', 'Test', 'Recrutenment', NULL, 'recrutement@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 04:10:21', 1, 2, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(55, 'images', 'Test', 'Recrutenment', NULL, 'GRH@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 04:35:48', 2, 2, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(56, '8107cf4892e2ed03e52d8889b1cead94', 'Test Recrutenment', ' ', NULL, 'demonstration5@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 04:40:55', 1, 2, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(57, 'd27c0b11d57e59b980eccae7e9dcc500', 'CANDIDAT', '', 'Lot II V 65', 'candidat1@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 04:42:25', 0, 3, 0, 'TE', 'ESS', NULL, '0', NULL, NULL),
	(58, 'images', 'Tojo', '', '', 'candidat2@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 05:06:59', 0, 3, 0, 'DESIGNER', '', NULL, '0', NULL, NULL),
	(59, 'images', 'Csndidat', '', NULL, 'candidat3@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 05:12:10', 0, 3, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(60, 'images', 'tin', '', '', 'candidat4@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 05:18:13', 0, 3, 0, 'wtwry', '', NULL, '0', NULL, NULL),
	(61, 'images', 't', '', NULL, 'candidat5@gmail.com', NULL, 'c20ad4d76fe97759aa27a0c99bff6710', '2024-06-06 05:29:06', 0, 3, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(62, 'images', 'candidat', '', NULL, 'candidat6@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 05:32:46', 0, 3, 0, NULL, NULL, NULL, '0', NULL, NULL),
	(63, 'images', 'Personnel', 'Recrutenment', NULL, 'demonstration@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', '2024-06-06 06:06:13', 2, 2, 0, NULL, NULL, NULL, '1', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
