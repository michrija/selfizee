ALTER TABLE `clients` ADD `note_intern` TEXT NULL DEFAULT NULL AFTER `is_active_add_client`;
ALTER TABLE `clients` ADD `client_type_id` INT NOT NULL AFTER `note_intern`;
ALTER TABLE `clients` ADD `abonnement` INT NOT NULL DEFAULT '0' AFTER `client_type_id`;
ALTER TABLE `clients` ADD `date_debut_contact` DATE NULL DEFAULT NULL AFTER `abonnement`;

ALTER TABLE `users` ADD `is_active_custom_marque_blanche` TINYINT(1) NULL DEFAULT '0' AFTER `is_active_acces_stat`;