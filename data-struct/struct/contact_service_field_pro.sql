ALTER TABLE `contact_services` ADD `prenom` VARCHAR(250) NULL AFTER `nom`;
ALTER TABLE `contact_services` ADD `ville` VARCHAR(250) NULL AFTER `objet`;
ALTER TABLE `contact_services` ADD `societe` VARCHAR(250) NULL AFTER `ville`, ADD `fonction` VARCHAR(250) NULL AFTER `societe`, ADD `pays` VARCHAR(250) NULL AFTER `fonction`, ADD `portable` VARCHAR(250) NULL AFTER `pays`;
