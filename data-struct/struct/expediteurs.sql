CREATE TABLE `expediteurs` (     `id` INT NOT NULL AUTO_INCREMENT ,     `email` VARCHAR(250) NOT NULL ,     `client_id` INT NOT NULL ,     `created` DATETIME ,     `modified` DATETIME ,     PRIMARY KEY (`id`)  );
ALTER TABLE `expediteurs`  ENGINE=INNODB AUTO_INCREMENT=1 COMMENT='' ROW_FORMAT=DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;
ALTER TABLE `expediteurs` ADD `is_create_in_mailjet` BOOLEAN NOT NULL DEFAULT FALSE AFTER `email`, ADD `is_validate_sent_in_mailjet` BOOLEAN NOT NULL DEFAULT FALSE AFTER `is_create_in_mailjet`;
ALTER TABLE `expediteurs` ADD CONSTRAINT `FK_expediteurs` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
ALTER TABLE `expediteurs`     CHANGE `is_create_in_mailjet` `is_create_in_mailjet` TINYINT(1) DEFAULT '0' NULL ,     CHANGE `is_validate_sent_in_mailjet` `is_validate_sent_in_mailjet` TINYINT(1) DEFAULT '0' NULL ;

