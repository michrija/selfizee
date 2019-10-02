CREATE TABLE `historique_connexions`(     `id` INT NOT NULL AUTO_INCREMENT ,     `user_id` INT ,     `galerie_id` INT ,     `evenement_id` INT ,     `queue` VARCHAR(250) ,     `created` DATETIME ,     `modified` DATETIME ,     PRIMARY KEY (`id`)  );
ALTER TABLE `historique_connexions`  ENGINE=INNODB AUTO_INCREMENT=1 COMMENT='' ROW_FORMAT=DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;
