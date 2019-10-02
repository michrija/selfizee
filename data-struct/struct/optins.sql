CREATE TABLE `optins`(     `id` INT NOT NULL AUTO_INCREMENT ,     `titre` VARCHAR(250) NOT NULL ,     `created` DATETIME ,     `modified` DATETIME ,     PRIMARY KEY (`id`)  );
ALTER TABLE `optins`  ENGINE=INNODB AUTO_INCREMENT=1 COMMENT='' ROW_FORMAT=DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ;
RENAME TABLE `optins` TO `type_optins`;
ALTER TABLE `champs` ADD `type_optin_id` INT NULL AFTER `configuration_borne_id`; 
ALTER TABLE `champs` ADD CONSTRAINT `FK_champs_optin` FOREIGN KEY (`type_optin_id`) REFERENCES `type_optins` (`id`) ON DELETE SET NULL  ON UPDATE SET NULL ;

INSERT INTO `type_optins` (`id`, `titre`, `created`, `modified`) VALUES
(1, 'J\'accepte que ma photo soit enregistrée dans la galerie de l\'événement', '2019-02-12 17:00:00', '2019-02-12 17:00:00'),
(2, 'J\'accepte que ma photo me soit envoyée par e-mail et sms', '2019-02-12 17:00:00', '2019-02-12 17:00:00'),
(3, 'J\'accepte que ma photo me soit envoyée par e-mail ', '2019-02-12 17:00:00', '2019-02-12 17:00:00'),
(4, 'J\'accepte que ma photo me soit envoyée par sms ', '2019-02-12 17:00:00', '2019-02-12 17:00:00'),
(5, 'J\'accepte que ma photo soit publiée sur les réseaux sociaux', '2019-02-12 17:00:00', '2019-02-12 17:00:00'),
(6, 'Texte personnalisé', '2019-02-12 17:00:00', '2019-02-12 17:00:00');