CREATE TABLE `email_statistiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evenement_id` int(11) NOT NULL,
  `opened_percent` float DEFAULT NULL,
  `delivered_percent` float DEFAULT NULL,
  `clicked_percent` float DEFAULT NULL,
  `blocked_percent` float DEFAULT NULL,
  `spam_percent` float DEFAULT NULL,
  `average_click_delays` float DEFAULT NULL COMMENT 'valeur en seconde',
  `average_open_delays` float DEFAULT NULL,
  `average_opened_count` float DEFAULT NULL,
  `delivere_count` float DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_email_statistiques` (`evenement_id`),
  CONSTRAINT `FK_email_statistiques` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
