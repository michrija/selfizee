ALTER TABLE `photos` ADD `is_stat_traite` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'false: statistique non traité, 1 statistique traité' AFTER `is_validate`;

CREATE TABLE `photo_statistiques` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`photo_id` int(11) NOT NULL,
	`nb_homme` int(4) DEFAULT NULL,
	`nb_femme` int(4) DEFAULT NULL,
	`moins_20` int(4) NOT NULL,
	`a_20_30` int(4) NOT NULL,
	`a_30_40` int(4) NOT NULL,
	`a_40_60` int(4) NOT NULL,
	`plus_60` int(4) NOT NULL,
	`nb_sourire` int(4) NOT NULL,
	`nb_neutre` int(4) NOT NULL,
	`nb_triste` int(4) NOT NULL,
	`nb_surpris` int(4) NOT NULL,
	`nb_colere` int(4) NOT NULL,
	`stat_globale` longtext,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `photo_statistiques` ADD `nb_peur` INT(4) NOT NULL AFTER `nb_surpris`;
ALTER TABLE `photo_statistiques` ADD `age_total` INT NOT NULL COMMENT 'Total des ages des peronnes de la photo' AFTER `plus_60`;