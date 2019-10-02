CREATE TABLE `taille_ecrans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

ALTER TABLE `configuration_bornes`     ADD COLUMN `taille_ecran_id` INT NULL AFTER `is_filtre`,    CHANGE `is_filtre` `is_filtre` TINYINT(1) DEFAULT '0' NULL ;
ALTER TABLE `configuration_bornes` ADD CONSTRAINT `FK_configuration_bornes` FOREIGN KEY (`taille_ecran_id`) REFERENCES `taille_ecrans` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;
ALTER TABLE `configuration_bornes` ADD CONSTRAINT `FK_configuration_bornes` FOREIGN KEY (`taille_ecran_id`) REFERENCES `taille_ecrans` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;
ALTER TABLE `configuration_bornes` ADD CONSTRAINT `FK_configuration_bornes_taille` FOREIGN KEY (`taille_ecran_id`) REFERENCES `taille_ecrans` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;