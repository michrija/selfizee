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

/*Table structure for table `multiconfigurations` */

DROP TABLE IF EXISTS `multiconfigurations`;

CREATE TABLE `multiconfigurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `multiconfigurations` */

insert  into `multiconfigurations`(`id`,`nom`,`created`,`modified`) values (1,'Cadre photo + bandelette','2018-10-16 12:35:59','2018-10-16 12:35:59');
insert  into `multiconfigurations`(`id`,`nom`,`created`,`modified`) values (2,'Cadre photo + multipose','2018-10-16 12:36:08','2018-10-16 12:36:08');
insert  into `multiconfigurations`(`id`,`nom`,`created`,`modified`) values (3,'Polaroid + bandelette','2018-10-16 12:36:18','2018-10-16 12:36:18');
insert  into `multiconfigurations`(`id`,`nom`,`created`,`modified`) values (4,'Polaroid + multipose','2018-10-16 12:36:28','2018-10-16 12:36:28');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
