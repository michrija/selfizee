ALTER TABLE `clients` ADD `acces_custom` TINYINT(1) NULL DEFAULT NULL AFTER `country`, ADD `acces_modele_email` TINYINT(1) NULL DEFAULT NULL AFTER `acces_custom`, ADD `acces_modele_sms` TINYINT(1) NULL DEFAULT NULL AFTER `acces_modele_email`, ADD `acces_mise_en_page` TINYINT(1) NULL DEFAULT NULL AFTER `acces_modele_sms`;