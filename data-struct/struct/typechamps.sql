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

/*Table structure for table `type_champs` */

DROP TABLE IF EXISTS `type_champs`;

CREATE TABLE `type_champs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `type_champs` */

insert  into `type_champs`(`id`,`nom`,`created`,`modified`) values (1,'Texte ','2018-10-18 14:13:28','2018-10-18 14:13:28');
insert  into `type_champs`(`id`,`nom`,`created`,`modified`) values (2,'Case à cocher ','2018-10-18 14:13:39','2018-10-18 14:13:39');
insert  into `type_champs`(`id`,`nom`,`created`,`modified`) values (3,'Bouton radio ','2018-10-18 14:13:49','2018-10-18 14:13:49');
insert  into `type_champs`(`id`,`nom`,`created`,`modified`) values (4,'QCM','2018-10-18 14:14:07','2018-10-18 14:14:07');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
