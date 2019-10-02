DROP TABLE IF EXISTS `custom_optins`;
CREATE TABLE IF NOT EXISTS `custom_optins` (
  `int` int(11) NOT NULL AUTO_INCREMENT,
  `champ_id` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modifed` datetime DEFAULT NULL,
  PRIMARY KEY (`int`),
  KEY `FK_custom_options` (`champ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `custom_optins`
--
ALTER TABLE `custom_optins`
  ADD CONSTRAINT `FK_custom_options` FOREIGN KEY (`champ_id`) REFERENCES `champs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;