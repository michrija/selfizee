ALTER TABLE `cadres` CHANGE `file_name` `file_name` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

ALTER TABLE `ecrans` ADD `page_config_fond_configuration_id` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0: si couleur de fond, 1: si image de fond' AFTER `page_choix_configuration`, ADD `page_config_fond_configuration_couleur` VARCHAR(25) NULL COMMENT ' couleur personnalisé du fond de la page de configuration' AFTER `page_config_fond_configuration_id`;

ALTER TABLE `ecrans` ADD `page_config_fond_vert_id` TINYINT(1) NOT NULL COMMENT '0: si couleur de fond, 1: si image de fond' AFTER `page_choix_fond_vert`, ADD `page_config_fond_vert_couleur` VARCHAR(25) NULL COMMENT 'couleur personnalisé du fond de la page de configuration' AFTER `page_config_fond_vert_id`;