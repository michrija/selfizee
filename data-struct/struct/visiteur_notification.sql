ALTER TABLE `visiteurs` ADD `is_notification_send` BOOLEAN NULL AFTER `evenement_id`; 
ALTER TABLE `visiteurs` CHANGE `is_notification_send` `is_notification_send` TINYINT(1) NULL DEFAULT '0'; 