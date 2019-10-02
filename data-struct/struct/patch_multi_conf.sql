/*[18:29:44][1279 ms]*/ ALTER TABLE `selfizeev2`.`configuration_animations` DROP FOREIGN KEY `FK_configuration_animations_multilecong`;
/*[18:29:58][2855 ms]*/ ALTER TABLE `selfizeev2`.`configuration_animations` DROP COLUMN `multiconfiguration_id`;
/*[18:30:39][3166 ms]*/ ALTER TABLE `selfizeev2`.`configuration_bornes`     ADD COLUMN `multiconfiguration_id` INT NULL AFTER `taille_ecran_id`;
/*[18:30:48][  47 ms]*/ ALTER TABLE `selfizeev2`.`configuration_bornes` ADD CONSTRAINT `FK_configuration_bornes` FOREIGN KEY (`multiconfiguration_id`) REFERENCES `multiconfigurations` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;
/*[18:30:58][3400 ms]*/ ALTER TABLE `selfizeev2`.`configuration_bornes` ADD CONSTRAINT `FK_configuration_bornes_conf` FOREIGN KEY (`multiconfiguration_id`) REFERENCES `multiconfigurations` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;

