ALTER TABLE `themes` ADD `description` VARCHAR(255) NULL AFTER `nom`, ADD `client_id` INT NULL AFTER `description`, ADD `user_id` INT NULL AFTER `client_id`;
