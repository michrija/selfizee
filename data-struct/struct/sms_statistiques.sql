CREATE TABLE `sms_statistiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` int(1) NOT NULL DEFAULT '0' COMMENT '0:envoi en cours / en attente d’accusé / aucun accusé attendu \n 1 : accusé de réception reçu \n 2: echec non livrer ',
  `envoi_id` int(11) NOT NULL,
  `errormsg` varchar(200) DEFAULT NULL,
  `ar` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_sms_envoi` (`envoi_id`),
  CONSTRAINT `FK_sms_statistiques` FOREIGN KEY (`envoi_id`) REFERENCES `envois` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1
