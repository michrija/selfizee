ALTER TABLE `credits` DROP `Campagne`;
ALTER TABLE `credits` ADD `evenement_name` VARCHAR(255) NULL AFTER `evenement_id`;
ALTER TABLE `credits` ADD `adress_invoice` VARCHAR(255) NULL AFTER `evenement_name`;