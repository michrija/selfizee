ALTER TABLE `configuration_bornes` ADD `type_mise_en_page_id` INT NULL AFTER `evenement_id`;

ALTER TABLE `configuration_animations` ADD `type_animation_id` INT NULL COMMENT 'Juste pour connaitre le type anim correspond' AFTER `configuration_borne_id`;
ALTER TABLE `fond_verts` CHANGE `configuration_borne_id` `configuration_borne_id` INT(11) NULL;

ALTER TABLE `ecrans_navigations` CHANGE `config_borne_id` `configuration_borne_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `configuration_bornes` CHANGE `type_animation_id` `type_animation_id` INT(11) NULL;

ALTER TABLE `cadres` ADD `file_overlay` VARCHAR(255) NULL AFTER `file_name`;