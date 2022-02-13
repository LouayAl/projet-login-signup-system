-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.6.4-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for amechnou_db
CREATE DATABASE IF NOT EXISTS `amechnou_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */;
USE `amechnou_db`;

-- Dumping structure for table amechnou_db.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- Dumping data for table amechnou_db.admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`email`, `mot_de_passe`, `code`) VALUES
	('admin@admin.com', '$2y$10$YdYzEAjNLlOgJKeZ53De5uMx8Qb2ZH5uSua1FcUsgZCxYW2ZdTba6', '`n?]aBf}7@LA/#8V');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table amechnou_db.etudiants
CREATE TABLE IF NOT EXISTS `etudiants` (
  `cin` varchar(10) NOT NULL,
  `utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_n` date DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `pays` varchar(50) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `sexe` varchar(1) DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `filiere` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `couverture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cin`),
  UNIQUE KEY `utilisateur` (`utilisateur`),
  KEY `cin` (`cin`),
  KEY `FK1_niveau_etudiants` (`niveau`),
  KEY `FK2_filiere_etudiants` (`filiere`),
  CONSTRAINT `FK1_niveau_etudiants` FOREIGN KEY (`niveau`) REFERENCES `niveaux` (`nom`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `FK2_filiere_etudiants` FOREIGN KEY (`filiere`) REFERENCES `filieres` (`nom`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table amechnou_db.etudiants: ~4 rows (approximately)
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` (`cin`, `utilisateur`, `mot_de_passe`, `nom`, `prenom`, `email`, `date_n`, `tel`, `pays`, `ville`, `sexe`, `niveau`, `filiere`, `image`, `couverture`) VALUES
	('h1', 'hhh', '$2y$10$YdYzEAjNLlOgJKeZ53De5uMx8Qb2ZH5uSua1FcUsgZCxYW2ZdTba6', 'hom', 'hemom', 'hom@gmail.com', '2022-02-11', '0610101010', 'Maroc', 'Tanger', 'm', 'CI1', 'GINF', '/public/images/users/h1.jpg', NULL),
	('h2', 'hhh2', '$2y$10$YdYzEAjNLlOgJKeZ53De5uMx8Qb2ZH5uSua1FcUsgZCxYW2ZdTba6', 'hom2', 'hemom2', 'hom2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	('h3h3', 'h3h3', '$2y$10$l2HlVrHngorM3HLEBTHpieYxDEODeEZEJLmlGHTXdI2bv7sihJedy', 'dfff', 'asasa', 'h3h3@gmail.com', '2022-02-02', '002080', 'asas', 'adad', 'F', 'CI1', 'G3EI', NULL, NULL),
	('h44', 'h4h4', '$2y$10$UvuN/F9EBc/axglcwlbgj.lyazDKepZ8DM5WWzFH5x85Prufs08lK', 'asdasavc', 'fzer rt', 'qzgjcr@solarunited.net', '2022-02-04', 'asas', 'qsq', 'ccc', 'M', 'CI1', 'G3EI', NULL, NULL);
/*!40000 ALTER TABLE `etudiants` ENABLE KEYS */;

-- Dumping structure for table amechnou_db.filieres
CREATE TABLE IF NOT EXISTS `filieres` (
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`nom`),
  KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- Dumping data for table amechnou_db.filieres: ~5 rows (approximately)
/*!40000 ALTER TABLE `filieres` DISABLE KEYS */;
INSERT INTO `filieres` (`nom`) VALUES
	('G3EI'),
	('GIL'),
	('GINF'),
	('GSEA'),
	('GSTR');
/*!40000 ALTER TABLE `filieres` ENABLE KEYS */;

-- Dumping structure for table amechnou_db.niveaux
CREATE TABLE IF NOT EXISTS `niveaux` (
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`nom`),
  KEY `nom` (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table amechnou_db.niveaux: ~4 rows (approximately)
/*!40000 ALTER TABLE `niveaux` DISABLE KEYS */;
INSERT INTO `niveaux` (`nom`) VALUES
	('CI1'),
	('CI2'),
	('CP1'),
	('CP2');
/*!40000 ALTER TABLE `niveaux` ENABLE KEYS */;

-- Dumping structure for table amechnou_db.notes
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cin_etudiant` varchar(10) NOT NULL,
  `niveau` varchar(50) DEFAULT '',
  `note_s1` double DEFAULT 0,
  `note_s2` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK1_cin_etudiant_notes` (`cin_etudiant`),
  KEY `FK2_niveau_notes` (`niveau`),
  CONSTRAINT `FK1_cin_etudiant_notes` FOREIGN KEY (`cin_etudiant`) REFERENCES `etudiants` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_niveau_notes` FOREIGN KEY (`niveau`) REFERENCES `niveaux` (`nom`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table amechnou_db.notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
