/*
SQLyog Ultimate v8.71 
MySQL - 5.7.9 : Database - selfizeev2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `selfizeev2`;

/*Table structure for table `filtre_configuration_bornes` */

DROP TABLE IF EXISTS `filtre_configuration_bornes`;

CREATE TABLE `filtre_configuration_bornes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filtre_id` int(11) DEFAULT NULL,
  `configuration_borne_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_filtre_configuration_bornes` (`filtre_id`),
  KEY `FK_filtre_configuration_bornes_2` (`configuration_borne_id`),
  CONSTRAINT `FK_filtre_configuration_bornes` FOREIGN KEY (`filtre_id`) REFERENCES `filtres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_filtre_configuration_bornes_2` FOREIGN KEY (`configuration_borne_id`) REFERENCES `configuration_bornes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `filtre_configuration_bornes` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
