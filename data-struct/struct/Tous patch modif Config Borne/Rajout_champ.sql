ALTER TABLE `champs` ADD `config_borne_id` INT NULL AFTER `configuration_borne_id`;
ALTER TABLE `ecrans` ADD `config_borne_id` INT NULL AFTER `configuration_borne_id`;
ALTER TABLE `cadres` ADD `type_cadre` INT NULL DEFAULT '0' AFTER `ordre`, ADD `config_borne_id` INT NULL AFTER `type_cadre`;
ALTER TABLE `cadres` CHANGE `configuration_animation_id` `configuration_animation_id` INT(11) NULL;
ALTER TABLE `fond_verts` ADD `config_borne_id` INT NULL AFTER `ordre`;
ALTER TABLE `fond_verts` CHANGE `configuration_borne_id` `configuration_borne_id` INT(11) NULL;
