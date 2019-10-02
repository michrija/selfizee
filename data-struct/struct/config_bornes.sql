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

/*Table structure for table `configuration_bornes` */

DROP TABLE IF EXISTS `configuration_bornes`;

CREATE TABLE `configuration_bornes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evenement_id` int(11) DEFAULT NULL,
  `type_animation_id` int(11) NOT NULL,
  `nbr_pose` int(11) DEFAULT NULL,
  `multiconfiguration_id` int(11) DEFAULT NULL,
  `decompte_prise_photo` int(11) DEFAULT NULL,
  `decompte_time_out` int(11) DEFAULT NULL,
  `is_reprise_photo` tinyint(1) DEFAULT NULL,
  `is_prise_coordonnee` tinyint(1) DEFAULT NULL,
  `titre_formulaire` varchar(250) DEFAULT NULL,
  `is_impression` tinyint(1) DEFAULT NULL,
  `is_multi_impression` tinyint(1) DEFAULT NULL,
  `nbr_max_impression` int(11) DEFAULT NULL,
  `nbr_max_photo` int(11) DEFAULT NULL,
  `texte_impression` text,
  `is_impression_auto` tinyint(1) DEFAULT NULL,
  `nbr_copie_impression_auto` int(11) DEFAULT NULL,
  `type_imprimante_id` int(11) DEFAULT NULL,
  `model_borne_id` int(11) DEFAULT NULL,
  `disposition_vignette_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_configuration_bornes` (`evenement_id`),
  KEY `FK_configuration_bornes_animation` (`type_animation_id`),
  KEY `FK_configuration_bornes_multiconf` (`multiconfiguration_id`),
  KEY `FK_configuration_bornes_type_impirmante` (`type_imprimante_id`),
  KEY `FK_configuration_bornes_model_borne` (`model_borne_id`),
  KEY `FK_configuration_bornes_dispo_vignette` (`disposition_vignette_id`),
  CONSTRAINT `FK_configuration_bornes` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_configuration_bornes_animation` FOREIGN KEY (`type_animation_id`) REFERENCES `type_animations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_configuration_bornes_dispo_vignette` FOREIGN KEY (`disposition_vignette_id`) REFERENCES `disposition_vignettes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_configuration_bornes_model_borne` FOREIGN KEY (`model_borne_id`) REFERENCES `model_bornes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_configuration_bornes_multiconf` FOREIGN KEY (`multiconfiguration_id`) REFERENCES `multiconfigurations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_configuration_bornes_type_impirmante` FOREIGN KEY (`type_imprimante_id`) REFERENCES `type_imprimantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
