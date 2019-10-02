ALTER TABLE `contacts` ADD `email_propose` VARCHAR(255) NULL AFTER `email`;

ALTER TABLE `contacts` ADD `is_email_checked` TINYINT NULL DEFAULT NULL AFTER `email`;

ALTER TABLE `contacts` ADD `email_old` VARCHAR(255) NULL AFTER `email_propose`;