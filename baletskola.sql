-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
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


-- Dumping database structure for baletskola
CREATE DATABASE IF NOT EXISTS `baletskola` /*!40100 DEFAULT CHARACTER SET ucs2 COLLATE ucs2_latvian_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `baletskola`;

-- Dumping structure for table baletskola.audzeknikostimi
CREATE TABLE IF NOT EXISTS `audzeknikostimi` (
  `AudzKostID` int NOT NULL,
  `PiesDatums` date NOT NULL,
  `KostimiID` int NOT NULL,
  `AudzeknaKostimaPersonasKods` char(12) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  PRIMARY KEY (`AudzKostID`),
  KEY `KostimiID` (`KostimiID`),
  KEY `personasKods` (`AudzeknaKostimaPersonasKods`) USING BTREE,
  CONSTRAINT `AudzeknaKostimaPersonasKods` FOREIGN KEY (`AudzeknaKostimaPersonasKods`) REFERENCES `lietotajs` (`personasKods`),
  CONSTRAINT `KostimiID` FOREIGN KEY (`KostimiID`) REFERENCES `kostimi` (`KostimiID`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.audzeknikostimi: ~0 rows (approximately)

-- Dumping structure for table baletskola.audzeknisgrupa
CREATE TABLE IF NOT EXISTS `audzeknisgrupa` (
  `AudzeknisGrupaID` int NOT NULL,
  `PienDatums` date NOT NULL,
  `AudzeknaGrupasPersonasKods` char(12) COLLATE ucs2_latvian_ci NOT NULL,
  `GrupasAudzeknaNosaukums` varchar(5) COLLATE ucs2_latvian_ci NOT NULL,
  PRIMARY KEY (`AudzeknisGrupaID`),
  KEY `AudzeknaGrupasPersonasKods` (`AudzeknaGrupasPersonasKods`),
  KEY `GrupasAudzeknaNosaukums` (`GrupasAudzeknaNosaukums`),
  CONSTRAINT `AudzeknaGrupasPersonasKods` FOREIGN KEY (`AudzeknaGrupasPersonasKods`) REFERENCES `lietotajs` (`personasKods`),
  CONSTRAINT `GrupasAudzeknaNosaukums` FOREIGN KEY (`GrupasAudzeknaNosaukums`) REFERENCES `grupa` (`GrupasNosaukums`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.audzeknisgrupa: ~0 rows (approximately)

-- Dumping structure for table baletskola.bernsvecaks
CREATE TABLE IF NOT EXISTS `bernsvecaks` (
  `BernsVecaksID` int NOT NULL,
  `BernaPersonasKods` char(12) COLLATE ucs2_latvian_ci NOT NULL,
  `VecakaPersonasKods` char(12) COLLATE ucs2_latvian_ci NOT NULL,
  PRIMARY KEY (`BernsVecaksID`),
  KEY `BernaPersonasKods` (`BernaPersonasKods`),
  KEY `VecakaPersonasKods` (`VecakaPersonasKods`),
  CONSTRAINT `BernaPersonasKods` FOREIGN KEY (`BernaPersonasKods`) REFERENCES `lietotajs` (`personasKods`),
  CONSTRAINT `VecakaPersonasKods` FOREIGN KEY (`VecakaPersonasKods`) REFERENCES `lietotajs` (`personasKods`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.bernsvecaks: ~0 rows (approximately)

-- Dumping structure for table baletskola.filiale
CREATE TABLE IF NOT EXISTS `filiale` (
  `Filiale` int NOT NULL,
  `Valsts` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  `Pilseta` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  `Rajons` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  `Iela` varchar(20) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  `Eka` varchar(10) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  `Indekss` char(7) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  PRIMARY KEY (`Filiale`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.filiale: ~0 rows (approximately)

-- Dumping structure for table baletskola.grupa
CREATE TABLE IF NOT EXISTS `grupa` (
  `GrupasNosaukums` varchar(5) COLLATE ucs2_latvian_ci NOT NULL,
  `Grafiks` tinytext COLLATE ucs2_latvian_ci NOT NULL,
  `FilialeID` int NOT NULL,
  PRIMARY KEY (`GrupasNosaukums`),
  KEY `FilialeID` (`FilialeID`),
  CONSTRAINT `FilialeID` FOREIGN KEY (`FilialeID`) REFERENCES `filiale` (`Filiale`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.grupa: ~0 rows (approximately)

-- Dumping structure for table baletskola.kostimi
CREATE TABLE IF NOT EXISTS `kostimi` (
  `KostimiID` int NOT NULL,
  `Nosaukums` varchar(30) COLLATE ucs2_latvian_ci NOT NULL,
  `Krasa` varchar(30) COLLATE ucs2_latvian_ci NOT NULL,
  `Izmers` varchar(20) COLLATE ucs2_latvian_ci NOT NULL,
  `Attels` blob NOT NULL,
  PRIMARY KEY (`KostimiID`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.kostimi: ~0 rows (approximately)

-- Dumping structure for table baletskola.lietotajs
CREATE TABLE IF NOT EXISTS `lietotajs` (
  `personasKods` char(12) COLLATE ucs2_latvian_ci NOT NULL,
  `Vards` varchar(30) COLLATE ucs2_latvian_ci NOT NULL,
  `Uzvards` varchar(30) COLLATE ucs2_latvian_ci NOT NULL,
  `Epasts` varchar(30) COLLATE ucs2_latvian_ci NOT NULL,
  `Parole` varchar(30) COLLATE ucs2_latvian_ci NOT NULL,
  `Talrunis` char(12) COLLATE ucs2_latvian_ci NOT NULL,
  `DzimDiena` date NOT NULL,
  `LomaID` int NOT NULL,
  PRIMARY KEY (`personasKods`),
  KEY `LomaID` (`LomaID`),
  CONSTRAINT `LomaID` FOREIGN KEY (`LomaID`) REFERENCES `loma` (`LomaID`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.lietotajs: ~0 rows (approximately)

-- Dumping structure for table baletskola.loma
CREATE TABLE IF NOT EXISTS `loma` (
  `LomaID` int NOT NULL,
  `LomasNosaukums` varchar(30) COLLATE ucs2_latvian_ci NOT NULL,
  PRIMARY KEY (`LomaID`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.loma: ~0 rows (approximately)

-- Dumping structure for table baletskola.pedagogsgrupa
CREATE TABLE IF NOT EXISTS `pedagogsgrupa` (
  `PedagogsGrupaID` int NOT NULL,
  `NodSk` int NOT NULL,
  `PedagogaPersonasKods` char(12) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  `GrupasPedagogaNosaukums` varchar(5) CHARACTER SET ucs2 COLLATE ucs2_latvian_ci NOT NULL,
  PRIMARY KEY (`PedagogsGrupaID`),
  KEY `PedagogaPersonasKods` (`PedagogaPersonasKods`),
  KEY `GrupasNosaukums` (`GrupasPedagogaNosaukums`) USING BTREE,
  CONSTRAINT `GrupasPedagogaNosaukums` FOREIGN KEY (`GrupasPedagogaNosaukums`) REFERENCES `grupa` (`GrupasNosaukums`),
  CONSTRAINT `PedagogaPersonasKods` FOREIGN KEY (`PedagogaPersonasKods`) REFERENCES `lietotajs` (`personasKods`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_latvian_ci;

-- Dumping data for table baletskola.pedagogsgrupa: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
