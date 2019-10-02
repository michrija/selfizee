CREATE TABLE `champ_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `champ_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_champ_options` (`champ_id`),
  CONSTRAINT `FK_champ_options` FOREIGN KEY (`champ_id`) REFERENCES `champs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8
