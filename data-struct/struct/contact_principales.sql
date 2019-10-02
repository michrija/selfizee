DROP TABLE IF EXISTS `contact_principales`;
CREATE TABLE IF NOT EXISTS `contact_principales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `is_active_contact` tinyint(1) DEFAULT '0',
  `contact_client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


