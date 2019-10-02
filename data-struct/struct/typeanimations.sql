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

/*Table structure for table `type_animations` */

DROP TABLE IF EXISTS `type_animations`;

CREATE TABLE `type_animations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `type_animations` */

insert  into `type_animations`(`id`,`nom`,`created`,`modified`) values (1,'Carte postale','2018-10-16 12:34:03','2018-10-16 12:34:03');
insert  into `type_animations`(`id`,`nom`,`created`,`modified`) values (2,'Carte postale multipose','2018-10-16 12:34:21','2018-10-16 12:34:21');
insert  into `type_animations`(`id`,`nom`,`created`,`modified`) values (3,'Bandelette ','2018-10-16 12:34:30','2018-10-16 12:34:30');
insert  into `type_animations`(`id`,`nom`,`created`,`modified`) values (4,'Polaroid ','2018-10-16 12:34:39','2018-10-16 12:34:39');
insert  into `type_animations`(`id`,`nom`,`created`,`modified`) values (5,'Animation fond vert','2018-10-16 12:34:53','2018-10-16 12:34:53');
insert  into `type_animations`(`id`,`nom`,`created`,`modified`) values (6,'Double configuration','2018-10-16 12:35:08','2018-10-16 12:35:08');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
