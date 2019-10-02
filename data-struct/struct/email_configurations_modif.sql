ALTER TABLE `email_configurations` ADD `date_heure_envoi` DATETIME NULL AFTER `couleur_share_instagram`;
ALTER TABLE `email_configurations` ADD `is_active` BOOLEAN NULL DEFAULT TRUE AFTER `date_heure_envoi`;
