ALTER TABLE `clients` ADD `client_type_id` INT(11) NULL AFTER `client_type`;
ALTER TABLE `clients` ADD `is_active_add_client` BOOLEAN NOT NULL DEFAULT FALSE AFTER `img_fond_login`;