CREATE TABLE `envoi_email_statistiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `envoi_id` int(11) NOT NULL,
  `event_type` varchar(250) NOT NULL,
  `date_event` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_envoi_email_statistiques` (`envoi_id`),
  CONSTRAINT `FK_envoi_email_statistiques` FOREIGN KEY (`envoi_id`) REFERENCES `envois` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

ALTER TABLE `envoi_email_statistiques` ADD `error` VARCHAR(250) NULL AFTER `date_event`; 
