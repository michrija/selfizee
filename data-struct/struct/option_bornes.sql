CREATE TABLE `option_bornes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chemin_dossier_assets` text,
  `chemin_dossier_events` text,
  `fichier_setting_base` text,
  `ftp_server` varchar(250) DEFAULT NULL,
  `ftp_username` varchar(250) DEFAULT NULL,
  `ftp_password` varchar(250) DEFAULT NULL,
  `ftp_port` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8