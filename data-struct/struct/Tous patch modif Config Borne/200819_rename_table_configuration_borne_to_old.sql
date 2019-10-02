RENAME TABLE `configuration_bornes` TO `selfizee_event_09052019`.`configuration_bornes_old`;

RENAME TABLE `config_bornes` TO `selfizee_event_09052019`.`configuration_bornes`;

ALTER TABLE `cadres` CHANGE `config_borne_id` `configuration_borne_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `ecrans_navigations` CHANGE `config_borne_id` `configuration_borne_id` INT(11) NULL DEFAULT NULL;

ALTER TABLE `image_fond_verts` CHANGE `config_borne_id` `configuration_borne_id` INT(11) NULL DEFAULT NULL;