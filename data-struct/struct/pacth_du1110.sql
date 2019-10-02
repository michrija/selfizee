CREATE TABLE `envoi_statistiques` ( `id` int(11) NOT NULL AUTO_INCREMENT, `is_opened` tinyint(1) DEFAULT NULL, `opened_at` datetime DEFAULT NULL, `arrived_at` datetime DEFAULT NULL, `envoi_id` int(11) NOT NULL, `created` datetime DEFAULT NULL, `modified` datetime DEFAULT NULL, PRIMARY KEY (`id`), KEY `FK_envoi_statistiques` (`envoi_id`), CONSTRAINT `FK_envoi_statistiques` FOREIGN KEY (`envoi_id`) REFERENCES `envois` (`id`) ON DELETE CASCADE ON UPDATE CASCADE ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ;



CREATE TABLE `photo_vues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_viewer` varchar(250) DEFAULT NULL,
  `photo_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photo_vues` (`photo_id`),
  CONSTRAINT `FK_photo_vues` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `envois` ADD `message_id_in_mailjet` VARCHAR(250) NULL AFTER `is_force_envoi`, ADD `message_id_in_smsenvoi` VARCHAR(250) NULL AFTER `message_id_in_mailjet`; 



