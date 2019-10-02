/*ALTER TABLE `evenements` ADD `login` VARCHAR(255) NULL AFTER `deleted`, ADD `password` VARCHAR(255) NULL AFTER `login`, ADD `is_active_acces_config` TINYINT(1) NOT NULL DEFAULT '0' AFTER `password`, ADD `is_active_acces_event` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_config`, ADD `is_active_acces_edit_photo` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_event`, ADD `is_active_acces_send_email` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_edit_photo`, ADD `is_active_acces_send_sms` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_active_acces_send_email`, ADD `is_active_acces_data` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_send_sms`, ADD `is_active_acces_timeline` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_data`;*/



ALTER TABLE `users` 
ADD `is_for_event` TINYINT(1) NOT NULL DEFAULT '0' AFTER `client_id`,
 ADD `password_visible` VARCHAR(255) NULL AFTER `is_for_event`,
  ADD `is_active_acces_config` TINYINT(1) NOT NULL DEFAULT '0' AFTER `password_visible`,
   ADD `is_active_acces_event` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_config`,
    ADD `is_active_acces_edit_photo` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_event`,
     ADD `is_active_acces_send_email` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_edit_photo`, 
     ADD `is_active_acces_send_sms` TINYINT(1) NOT NULL DEFAULT '0' AFTER `is_active_acces_send_email`,
      ADD `is_active_acces_data` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_send_sms`,
       ADD `is_active_acces_timeline` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_data`;

       ALTER TABLE `users` ADD `is_active_acces_affichage_photo` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_event`;
       ALTER TABLE `users` ADD `is_active_acces_stat` TINYINT(1) NOT NULL DEFAULT '1' AFTER `is_active_acces_timeline`;