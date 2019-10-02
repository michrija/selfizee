ALTER TABLE `galeries` ADD `invited_can_upload_photo` BOOLEAN NULL DEFAULT FALSE AFTER `is_livredor_active`, ADD `is_photo_invited_must_moderate` BOOLEAN NULL DEFAULT FALSE AFTER `invited_can_upload_photo`; 
ALTER TABLE `galeries` ADD `email_to_notify` VARCHAR(250) NULL AFTER `is_photo_invited_must_moderate`;
ALTER TABLE `photos` ADD `is_validate` BOOLEAN NULL DEFAULT '1' AFTER `date_corbeille`;
ALTER TABLE `photos` CHANGE `source_upload` `source_upload` ENUM('bo','upload','galerie') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'BO : depuis le BO web partie admin , upload :Shell automatique ; galeie : depuis la galerie par les invités'; 
ALTER TABLE `galeries` ADD `is_moderation_notification_sent` BOOLEAN NULL DEFAULT FALSE AFTER `email_to_notify`; 