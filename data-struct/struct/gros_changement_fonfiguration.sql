
/*[10:42:40][ 468 ms]*/ CREATE TABLE `configuration_animations`(     `id` INT NOT NULL AUTO_INCREMENT ,     `type_cadre` INT ,     `nbr_pose` INT ,     `disposition_vignette_id` INT ,     `configuration_borne_id` INT ,     PRIMARY KEY (`id`)  );

/*[10:46:59][3198 ms]*/ ALTER TABLE `configuration_animations`  ENGINE=INNODB AUTO_INCREMENT=1 COMMENT='' ROW_FORMAT=DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;

/*[10:47:15][2309 ms]*/ ALTER TABLE `configuration_animations` ADD CONSTRAINT `FK_configuration_animations` FOREIGN KEY (`configuration_borne_id`) REFERENCES `configuration_bornes` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;

/*[10:54:00][ 172 ms]*/ ALTER TABLE `configuration_bornes` DROP COLUMN `type_cadre`, DROP COLUMN `nbr_pose`, DROP COLUMN `multiconfiguration_id`, DROP COLUMN `disposition_vignette_id`;

/*[10:54:16][  94 ms]*/ ALTER TABLE `configuration_bornes` DROP COLUMN `type_cadre`, DROP COLUMN `nbr_pose`, DROP COLUMN `multiconfiguration_id`, DROP COLUMN `disposition_vignette_id`;

/*[10:54:30][ 452 ms]*/ ALTER TABLE `configuration_bornes` DROP FOREIGN KEY `FK_configuration_bornes_dispo_vignette`;

/*[10:54:44][  32 ms]*/ ALTER TABLE `configuration_animations` ADD CONSTRAINT `FK_configuration_animations` FOREIGN KEY (`disposition_vignette_id`) REFERENCES `disposition_vignettes` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;
/*[10:54:54][3853 ms]*/ ALTER TABLE `configuration_animations` ADD CONSTRAINT `FK_configuration_animations_disposition` FOREIGN KEY (`disposition_vignette_id`) REFERENCES `disposition_vignettes` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;

/*[10:55:20][2590 ms]*/ ALTER TABLE `configuration_bornes` DROP COLUMN `type_cadre`, DROP COLUMN `nbr_pose`, DROP COLUMN `disposition_vignette_id`;

/*[10:55:34][3931 ms]*/ ALTER TABLE `configuration_animations`     ADD COLUMN `multiconfiguration_id` INT NULL AFTER `configuration_borne_id`;

/*[10:55:53][ 312 ms]*/ ALTER TABLE `configuration_bornes` DROP FOREIGN KEY `FK_configuration_bornes_multiconf`;

/*[10:56:17][5647 ms]*/ ALTER TABLE `configuration_bornes` DROP COLUMN `multiconfiguration_id`;

/*[10:56:31][  32 ms]*/ ALTER TABLE `configuration_animations` ADD CONSTRAINT `FK_configuration_animations` FOREIGN KEY (`multiconfiguration_id`) REFERENCES `multiconfigurations` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;
/*[10:56:47][2964 ms]*/ ALTER TABLE `configuration_animations` ADD CONSTRAINT `FK_configuration_animations_multilecong` FOREIGN KEY (`multiconfiguration_id`) REFERENCES `multiconfigurations` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;
/*[11:43:26][1170 ms]*/ ALTER TABLE `cadres` DROP FOREIGN KEY `FK_cadres`;
TRUNCATE TABLE `cadres`;
/*[11:43:55][ 344 ms]*/ ALTER TABLE `cadres`     CHANGE `configuration_borne_id` `configuration_animation_id` INT(11) NOT NULL;
/*[11:47:27][3386 ms]*/ ALTER TABLE `cadres` ADD CONSTRAINT `FK_cadres` FOREIGN KEY (`configuration_animation_id`) REFERENCES `configuration_animations` (`id`) ON DELETE CASCADE  ON UPDATE CASCADE ;
