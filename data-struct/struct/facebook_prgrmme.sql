ALTER TABLE `facebook_autos` ADD `is_programmee` TINYINT NOT NULL DEFAULT '0' AFTER `is_active`;
ALTER TABLE `facebook_autos` CHANGE `is_programmee` `is_programmee` TINYINT(1) NOT NULL DEFAULT '0';
ALTER TABLE `facebook_autos` ADD `date_programmee` DATETIME NOT NULL AFTER `date_fin`;
ALTER TABLE `facebook_autos` CHANGE `date_programmee` `date_programmee` DATETIME NULL;