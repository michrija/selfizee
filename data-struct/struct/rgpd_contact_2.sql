ALTER TABLE `photos` ADD `deleted_via_rgpd` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'vaut true si supprimé via la rgbpd' AFTER `date_corbeille`;
ALTER TABLE `photos` ADD `deleted_date_rgpd` DATETIME NULL COMMENT 'Date de suppression via la rgpd' AFTER `deleted_via_rgpd`;
ALTER TABLE `photos` ADD `queue_rgpd` INT NULL AFTER `deleted_via_rgpd`;