ALTER TABLE `sms_configurations` ADD `limiter_un_sms` 
BOOLEAN NOT NULL DEFAULT FALSE AFTER `nbr_sms`;
ALTER TABLE `sms_configurations` ADD `date_heure_envoi` DATETIME NOT NULL AFTER `limiter_un_sms`;
ALTER TABLE `sms_configurations` CHANGE `date_heure_envoi` `date_heure_envoi` DATETIME NULL;
ALTER TABLE `sms_configurations` CHANGE `limiter_un_sms` `limiter_un_sms` TINYINT(1) NULL DEFAULT '0';
ALTER TABLE `sms_configurations` ADD `is_active` BOOLEAN NULL DEFAULT TRUE AFTER `date_heure_envoi`;

