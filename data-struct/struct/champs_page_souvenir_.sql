ALTER TABLE `champs` ADD `page_souvenir_id` INT NULL AFTER `configuration_borne_id`;
ALTER TABLE `champs` CHANGE `configuration_borne_id` `configuration_borne_id` INT(11) NULL;