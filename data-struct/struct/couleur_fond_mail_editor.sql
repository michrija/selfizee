ALTER TABLE `email_configurations` ADD `couleur_fond_editeur` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `evenement_id`, ADD `couleur_download_link` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `couleur_fond_editeur`;