ALTER TABLE `email_configurations` ADD `is_envoi_plannifie` BOOLEAN NULL AFTER `couleur_share_instagram`;
ALTER TABLE `sms_configurations` ADD `is_envoi_plannifie` BOOLEAN NULL AFTER `limiter_un_sms`
ALTER TABLE `email_configurations` CHANGE `is_envoi_plannifie` `is_envoi_plannifie` TINYINT(1) NULL DEFAULT '0';
ALTER TABLE `sms_configurations` CHANGE `is_envoi_plannifie` `is_envoi_plannifie` TINYINT(1) NULL DEFAULT '0'
