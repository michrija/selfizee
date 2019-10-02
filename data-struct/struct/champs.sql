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

/*Table structure for table `champs` */

DROP TABLE IF EXISTS `champs`;

CREATE TABLE `champs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_champ_id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `type_donnee_id` int(11) DEFAULT NULL,
  `ordre` int(11) DEFAULT NULL,
  `configuration_borne_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_champs` (`type_champ_id`),
  KEY `FK_champs_donne` (`type_donnee_id`),
  KEY `FK_champs_configuration` (`configuration_borne_id`),
  CONSTRAINT `FK_champs` FOREIGN KEY (`type_champ_id`) REFERENCES `type_champs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_champs_configuration` FOREIGN KEY (`configuration_borne_id`) REFERENCES `configuration_bornes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_champs_donne` FOREIGN KEY (`type_donnee_id`) REFERENCES `type_donnees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `champs` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
