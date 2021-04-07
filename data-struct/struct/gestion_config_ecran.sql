ALTER TABLE `ecrans` CHANGE `page_config_fond_accueil_id` `page_config_fond_accueil_id` TINYINT(1) NULL DEFAULT NULL COMMENT '0: si couleur de fond, 1: si image de fond';
ALTER TABLE `ecrans` ADD `page_config_fond_remerciement_id` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0: si couleur de fond, 1: si image de fond' AFTER `page_filtre_titre_right`, ADD `page_config_fond_couleur` VARCHAR(25) NULL AFTER `page_config_fond_remerciement_id`;
ALTER TABLE `ecrans` CHANGE `page_config_fond_prise_photo_id` `page_config_fond_prise_photo_id` TINYINT(1) NULL DEFAULT NULL COMMENT '0: si couleur de fond, 1: si image de fond';
ALTER TABLE `ecrans` CHANGE `page_config_fond_filtre_id` `page_config_fond_filtre_id` TINYINT(1) NULL DEFAULT NULL COMMENT '0: si couleur de fond, 1: si image de fond'; 