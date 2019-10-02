CREATE TABLE `cadres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(250) NOT NULL,
  `ordre` int(11) DEFAULT NULL,
  `configuration_borne_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cadres` (`configuration_borne_id`),
  CONSTRAINT `FK_cadres` FOREIGN KEY (`configuration_borne_id`) REFERENCES `configuration_bornes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

