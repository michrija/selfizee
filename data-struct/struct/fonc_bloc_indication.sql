INSERT INTO `fonctionnalites` (`id`, `nom`, `description`, `texte_helper`, `titre_link`, `link`, `ordre`) VALUES (NULL, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '', 'Bloc d\'incitation', '', '0');
ALTER TABLE `fonctionnalites` ADD `show_in_menu` BOOLEAN NULL DEFAULT TRUE AFTER `ordre`;
