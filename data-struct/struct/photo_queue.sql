ALTER TABLE `photos` ADD `queue` VARCHAR(250) NOT NULL AFTER `token`; 
ALTER TABLE `photos` ADD `source_upload` ENUM('bo','upload') NOT NULL AFTER `queue`; 
ALTER TABLE `envois` ADD `queue` VARCHAR(250) NULL AFTER `message_id_in_smsenvoi`; 
ALTER TABLE `contacts` ADD `queue` VARCHAR(250) NOT NULL AFTER `photo_id`; 
ALTER TABLE `contacts` CHANGE `queue` `queue` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL; 
ALTER TABLE `contacts` ADD `source_upload` VARCHAR(250) NULL AFTER `queue`; 