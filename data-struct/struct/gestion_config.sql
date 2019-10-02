CREATE TABLE `page_config_fonds` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`couleur` varchar(25) NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `page_config_boutons` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`fichier` varchar(120) NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `page_config_boutons` ADD `tag` VARCHAR(60) NULL COMMENT 'Nom du bouton' AFTER `id`;

DROP TABLE IF EXISTS `page_config_polices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_config_polices` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nom_police` varchar(100) NOT NULL,
  `css_specification` varchar(250) DEFAULT NULL,
  `url_police` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
LOCK TABLES `page_config_polices` WRITE;
/*!40000 ALTER TABLE `page_config_polices` DISABLE KEYS */;
INSERT INTO `page_config_polices` VALUES (1,'Rubik','font-family: \'Rubik\', sans-serif;','<link href=\"https://fonts.googleapis.com/css?family=Rubik\" rel=\"stylesheet\">','2019-03-11 00:00:00','2019-03-11 00:00:00'),(2,'Montserrat','font-family: \'Montserrat\', sans-serif;','<link href=\"https://fonts.googleapis.com/css?family=Montserrat:200,300,300i,400,400i,500,500i\" rel=\"stylesheet\">','2019-03-11 00:00:00','2019-03-11 00:00:00'),(3,'Roboto','font-family: \'Roboto Mono\', monospace;','<link href=\"https://fonts.googleapis.com/css?family=Roboto+Mono:300,400,400i,700,700i\" rel=\"stylesheet\">','2019-03-11 00:00:00','2019-03-11 00:00:00');


ALTER TABLE `ecrans` ADD `page_config_fond_accueil_id` INT(4) NULL COMMENT 'id du fond prédéfini' AFTER `page_accueil`;
ALTER TABLE `ecrans` ADD `page_config_fond_accueil_couleur` VARCHAR(25) NULL COMMENT 'couleur personnalisé du fond' AFTER `page_config_fond_accueil_id`;

ALTER TABLE `ecrans` ADD `btn_page_accueil_id` INT NULL COMMENT 'Id du bouton prédéfini' AFTER `btn_page_accueil`;
ALTER TABLE `ecrans` ADD `choix_all_pages` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'appliquer sur toutes les pages' AFTER `btn_page_accueil_id`;

ALTER TABLE `ecrans` ADD `page_config_fond_prise_photo_id` INT(4) NULL COMMENT 'id du fond prédéfini' AFTER `page_prise_photo`;
ALTER TABLE `ecrans` ADD `page_config_fond_prise_photo_couleur` VARCHAR(25) NULL COMMENT 'couleur personnalisé du fond' AFTER `page_config_fond_prise_photo_id`;

ALTER TABLE `ecrans` ADD `page_config_fond_filtre_id` INT(4) NULL COMMENT 'id du fond prédéfini' AFTER `page_choix_filtre`;
ALTER TABLE `ecrans` ADD `page_config_fond_filtre_couleur` VARCHAR(25) NULL COMMENT 'couleur personnalisé du fond' AFTER `page_config_fond_filtre_id`;

ALTER TABLE `ecrans` ADD `page_filtre_titre` VARCHAR(250) NULL AFTER `page_config_fond_filtre_couleur`, ADD `page_filtre_titre_couleur` VARCHAR(25) NULL AFTER `page_filtre_titre`, ADD `page_filtre_titre_avance` TINYINT(1) NULL COMMENT 'Mise en page avancé' AFTER `page_filtre_titre_couleur`, ADD `page_filtre_titre_police_id` INT(4) NULL COMMENT 'Id de la police utilisée' AFTER `page_filtre_titre_avance`, ADD `page_filtre_titre_taille` VARCHAR(6) NULL AFTER `page_filtre_titre_police_id`, ADD `page_filtre_titre_left` VARCHAR(6) NULL AFTER `page_filtre_titre_taille`, ADD `page_filtre_titre_right` VARCHAR(6) NULL AFTER `page_filtre_titre_left`;