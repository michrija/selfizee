ALTER TABLE `catalogues` ADD `client_id` INT NULL AFTER `format_id`, ADD `user_id` INT NULL AFTER `client_id`;
ALTER TABLE `catalogue_cadres` ADD `client_id` INT NULL AFTER `format_id`, ADD `user_id` INT NULL AFTER `client_id`;