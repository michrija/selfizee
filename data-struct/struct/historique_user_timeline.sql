ALTER TABLE `photos` ADD `user_id` INT NULL DEFAULT NULL COMMENT 'id de l\'utilisateur qui a fait la dernière action' AFTER `id`;
ALTER TABLE `photo_downloads` ADD `user_id` INT NULL DEFAULT NULL COMMENT 'id de l\'utilisateur qui a telecharger la photo' AFTER `id`;
ALTER TABLE `galerie_downloads` ADD `user_id` INT NULL DEFAULT NULL COMMENT 'id de l\'utilisateur qui a téléchargé la photo depuis la galerie' AFTER `id`;
ALTER TABLE `evenements` ADD `user_id` INT NULL DEFAULT NULL COMMENT 'id de l\'utilisateur de celui quii a crée l\'événement' AFTER `id`;
ALTER TABLE `envois` ADD `user_id` INT NULL DEFAULT NULL COMMENT 'id de l\'utilisateur qui a envoyé le sms ou mail, ça vaut 0 si c\'est automatique' AFTER `id`;
ALTER TABLE `contacts` ADD `user_id` INT NULL DEFAULT NULL COMMENT 'id de l\'utilisateur qui a importé le contact' AFTER `id`;