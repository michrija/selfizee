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

/*Table structure for table `disposition_vignettes` */

DROP TABLE IF EXISTS `disposition_vignettes`;

CREATE TABLE `disposition_vignettes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `nbr_pose` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `disposition_vignettes` */

insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (1,'11','11.png',1,'2018-10-22 08:51:06','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (2,'21','21.png',2,'2018-10-22 08:51:34','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (3,'22','22.png',2,'2018-10-22 08:51:49','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (4,'23','23.png',2,'2018-10-22 08:52:08','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (5,'24','24.png',2,'2018-10-22 08:52:23','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (6,'31','31.png',3,'2018-10-22 08:52:38','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (7,'32','32.png',3,'2018-10-22 08:52:52','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (8,'33','33.png',3,'2018-10-22 08:53:07','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (9,'34','34.png',3,'2018-10-22 08:53:22','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (10,'35','35.png',3,'2018-10-22 08:53:36','2018-10-22');
insert  into `disposition_vignettes`(`id`,`nom`,`file_name`,`nbr_pose`,`created`,`modified`) values (11,'36','36.png',3,'2018-10-22 08:54:00','2018-10-22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
