ALTER TABLE `clients` ADD `is_active_add_client` BOOLEAN NOT NULL DEFAULT FALSE AFTER `img_fond_login`;
ALTER TABLE `clients` ADD `client_type_id` INT(11) NOT NULL AFTER `client_type`;
ALTER TABLE `clients` CHANGE `client_type` `client_type` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;