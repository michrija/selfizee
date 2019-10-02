CREATE TABLE `ecrans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_accueil` varchar(250) DEFAULT NULL,
  `btn_page_accueil` varchar(250) DEFAULT NULL,
  `page_prise_photo` varchar(250) DEFAULT NULL,
  `page_prise_photo_visualisation` varchar(250) DEFAULT NULL,
  `page_choix_filtre` varchar(250) DEFAULT NULL,
  `page_remerciement` varchar(250) DEFAULT NULL,
  `page_choix_fond_vert` varchar(250) DEFAULT NULL,
  `configuration_borne_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ecrans` (`configuration_borne_id`),
  CONSTRAINT `FK_ecrans` FOREIGN KEY (`configuration_borne_id`) REFERENCES `configuration_bornes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8
