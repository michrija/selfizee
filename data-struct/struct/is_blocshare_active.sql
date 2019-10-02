ALTER TABLE `email_configurations` ADD `is_blocshare_active` BOOLEAN NULL DEFAULT FALSE AFTER `is_active`, ADD `is_has_couleur_fond` BOOLEAN NULL DEFAULT FALSE AFTER `is_blocshare_active`;
ALTER TABLE `email_configurations` ADD `couleur_fond_editeur` VARCHAR(250) NULL DEFAULT '#FFFFFF' AFTER `is_has_couleur_fond`;
