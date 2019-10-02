CREATE TABLE `evenement_creas` (
  `id` int(11) NOT NULL,
  `evenement_id` int(11) NOT NULL,
  `canvas_elements` longtext,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `evenement_creas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `evenement_creas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `evenements` ADD `is_lock_crea` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0: Non, 1: en cours de modification' AFTER `is_data_acces`;
