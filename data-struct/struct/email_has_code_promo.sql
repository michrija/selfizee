ALTER TABLE `email_configurations`     ADD COLUMN `is_has_code_promo` BOOL DEFAULT '0' NULL AFTER `evenement_id`,     ADD COLUMN `content_code_promo` LONGTEXT NULL AFTER `is_has_code_promo`,    CHANGE `content` `content` LONGTEXT NOT NULL;
CREATE TABLE `code_promos`(     `id` INT NOT NULL AUTO_INCREMENT ,     `code_promo` VARCHAR(250) ,     `email_configuration_id` INT NOT NULL ,     `created` DATETIME ,     `modified` DATETIME ,     PRIMARY KEY (`id`)  );
ALTER TABLE `code_promos`  ENGINE=INNODB AUTO_INCREMENT=1 COMMENT='' ROW_FORMAT=DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;
ALTER TABLE `code_promos` ADD CONSTRAINT `FK_code_promos` FOREIGN KEY (`email_configuration_id`) REFERENCES `email_configurations` (`id`);
ALTER TABLE `code_promos`     ADD COLUMN `envoi_id` INT NULL AFTER `photo_id`,     ADD COLUMN `created` DATETIME NULL AFTER `envoi_id`,     ADD COLUMN `modifed` DATETIME NULL AFTER `created`,    CHANGE `email_configuration_id` `email_configuration_id` INT(11) NOT NULL,     CHANGE `created` `is_deja_attribue` BOOL DEFAULT '0' NULL ,     CHANGE `modified` `photo_id` INT NULL ;